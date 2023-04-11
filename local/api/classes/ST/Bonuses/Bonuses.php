<?php

namespace ST\Bonuses;
use Bitrix\Main\Loader;

class Bonuses
{
    static private $siteSettings = [];

    public function __construct()
    {
        self::$siteSettings = getSiteSettings();
    }

    // Подготовить класс HighLoad блока
    public static function getHighloadEntity()
    {
        Loader::includeModule("highloadblock");
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(7)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        return $entity_data_class;
    }

    // Подготовить список элементов типа CIBlockResult
    public static function prepareList($order = ["UF_DATE_CREATE" => "ASC"], $filter = [])
    {
        $entity_data_class = self::getHighloadEntity();
        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => $order,
            "filter" => $filter
        ));

        return $rsData;
    }

    // Подготовить массив элементов
    public static function prepareArray($order = ["UF_DATE_CREATE" => "ASC"], $filter = [])
    {
        $res = self::prepareList($order, $filter);
        $rsData = [];
        while($ob = $res->Fetch()) {
            $rsData[] = $ob;
        }

        return $rsData;
    }

    public static function addExpiredBonuses($userId, $value)
    {
        $fields = [
            'UF_NAME' => $userId,
            'UF_XML_ID' => $value,
            'UF_DATE_CREATE' => date('d.m.Y H:M:S'),
            'UF_EXPIRES' => 1
        ];
        $ob = self::getHighloadEntity();
        $res = $ob::Add($fields);

        self::addBonuses($userId, self::$siteSettings['EXPIRED_VALUE']['VALUE']);
    }

    // Сумма баллов пользователя
    public static function getUserBonusesSum($userId)
    {
        $rsData = self::prepareList([], ['UF_NAME' => $userId]);
        $sum = 0;
        while ($collectionXMLId = $rsData->Fetch()) {
            $sum += intval($collectionXMLId['UF_XML_ID']);
        };

        return $sum;
    }

    // Доступные баллы пользователя для списания в текущем заказе
    public static function getAllowedBonuses($userId, $orderPrice)
    {
        $curUser = \CSaleUserAccount::GetByUserID($userId, 'RUB');
        $percentage = intval($curUser['NOTES']) > 0 ? intval($curUser['NOTES']) : self::$siteSettings['BONUSES_PERCENTAGE']['VALUE'];
        $bonuses = round(($percentage * intval($orderPrice)) / 100);
        
        if($bonuses > $curUser['CURRENT_BUDGET']) {
            $bonuses = $curUser['CURRENT_BUDGET'];
        }

        return $bonuses;
    }

    // Списать баллы
    public static function applyBonuses($userId, $bonusesToPay, $orderId)
    {
        if($bonusesToPay <= 0)
            return true;

        // Переменная-копия количества баллов для списания
        $originalBonusesToPay = $bonusesToPay;

        $arOrder = CSaleOrder::GetByID($orderId);

        $withdrawSum = CSaleUserAccount::Withdraw(
                $arOrder["USER_ID"],
                $bonusesToPay,
                $arOrder["CURRENCY"],
                $arOrder["ID"]
            );

        if ($withdrawSum > 0)
        {
            $arFields = array(
                    "SUM_PAID" => $withdrawSum,
                    "USER_ID" => $arOrder["USER_ID"]
                );
            CSaleOrder::Update($arOrder["ID"], $arFields);

            if ($withdrawSum == $arOrder["PRICE"])
                CSaleOrder::PayOrder($arOrder["ID"], "Y", False, False);
        }

        $rsData = self::prepareList(['UF_EXPIRES' => 'DESC'], ['UF_NAME' => $userId, 'UF_EXPIRES' => 1]);

        // Вычисления
        while ($collectionXMLId = $rsData->Fetch()) {
            // Разница количества баллов Highload элемента и баллов для списания
            $bonusesDiff = intval($collectionXMLId['UF_XML_ID']) - intval($bonusesToPay);

            // Подготовка класса для обновления/удаления Highload элемента
            $entity = self::getHighloadEntity();

            if (intval($bonusesToPay) > 0)
            {
                if(intval($bonusesDiff) <= 0) { // Если разница меньше/равно 0
                    // Вычитаем из количества баллов для списания количество баллов Highload элемента
                    $bonusesToPay = $bonusesToPay - $collectionXMLId['UF_XML_ID'];

                    // Удаляем
                    $entity::delete($collectionXMLId['ID']);

                } else if(intval($bonusesDiff) > 0) { // Если разница больше 0
                    // Вычитаем из количества баллов для списания количество баллов Highload элемента для дальнейшего изменения элемента
                    $collectionXMLId['UF_XML_ID'] = $collectionXMLId['UF_XML_ID'] - $bonusesToPay;

                    $entity::update($collectionXMLId['ID'], $collectionXMLId);
                    break;
                }
            } else {
                break;
            }
        };

        return true;
    }

    // Начислить баллы
    public static function addBonuses($userId, $bonuses, $orderId = 0)
    {
        $curUser = \CSaleUserAccount::GetByUserID($userId, 'RUB');

        if(!$curUser) {
            $fields = [
                'USER_ID' => $userId,
                'CURRENT_BUDGET' => 0,
                'CURRENCY' => 'RUB',
                'NOTES' => strval(self::$siteSettings['BONUSES_PERCENTAGE']['VALUE']),
            ];
            \CSaleUserAccount::Add($fields);

            $curUser = \CSaleUserAccount::GetByUserID($userId, 'RUB');
        }

        $curUser['CURRENT_BUDGET'] = '+' . $bonuses;

        \CSaleUserAccount::UpdateAccount(
            $userId,
            $curUser['CURRENT_BUDGET'],
            $curUser['CURRENCY'],
            '',
            $orderId,
            $curUser['NOTES']
        );

        return true;
    }

    public static function getTransactList($userId)
    {
        $transactAr = [];
        $res = \CSaleUserTransact::GetList(Array("ID" => "DESC"), array("USER_ID" => $userId));
        while ($arFields = $res->Fetch()) {
            $transactAr[] = $arFields;
        }

        return $transactAr;
    }

    public static function createCoupon($userId, $discount)
    {
        $oldCoupon = \CSaleDiscount::getList([], ['XML_ID' => $userId], false, false, ['ACTIONS'])->Fetch();
        if($oldCoupon) {
            self::deleteCoupon($oldCoupon['ID']);
        }
        $array = [
            'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
            'NAME' => "Списание баллами пользователя " . $userId . ' на сумму ' . $discount . ' в заказе',
            'ACTIVE' => 'Y',
            'SORT' => 100,
            'PRIORITY' => 1,
            "CURRENCY" => "RUB",
            'LAST_DISCOUNT' => 'N',
            'MODIFIED_BY' => 1,
            'XML_ID' => $userId,
            'CONDITIONS' => [
                'CLASS_ID' => 'CondGroup',
                'DATA' => [
                    'All' => 'AND',
                    'True' => 'True',
                ],
                'CHILDREN' => '',
            ],
            'ACTIONS' => [
                'CLASS_ID' => 'CondGroup',
                'DATA' => [
                    'All' => 'AND',
                ],
                'CHILDREN' => [
                    [
                        'CLASS_ID' => 'ActSaleBsktGrp',
                        'DATA' => [
                            'Type' => 'Discount',
                            'Value' => $discount,
                            'Unit' => 'CurAll',
                            'All' => 'AND',
                            'True' => 'True',
                        ],
                        'CHILDREN' => '',
                    ],
                ],
            ],
            'USER_GROUPS' => [
                2
            ]
        ];

        $ID = \CSaleDiscount::Add($array);

        $codeCoupon = CatalogGenerateCoupon();
        $fields = [
            "DISCOUNT_ID" => $ID,
            "COUPON" => $codeCoupon,
            "ACTIVE" => "Y",
            "TYPE" => 2,
            "USER_ID" => $userId,
            "MAX_USE" => 1,
        ];
        $coupon = \Bitrix\Sale\Internals\DiscountCouponTable::add($fields);

        return $codeCoupon;
    }

    public static function deleteCoupon($ID)
    {
        $sale = new \CSaleDiscount;
        $sale->Delete($ID);
    }

    public static function applyBonusesAfterPay($order_id, $status)
    {
        $order = [];

        $order['CANCELED'] = 'Y';

        if ($order_id > 0) {
            $order = [];
            $order = \CSaleOrder::GetByID($order_id);
        }
        
        if ($status == 'NF' && $order['CANCELED'] == "N" && $order['PAYED'] == "Y")
        {
            // Начисляем бонусы
            $siteSettings = getSiteSettings();

            $bonuses = round(intval($order['PRICE'] - $order['PRICE_DELIVERY']) * (intval($siteSettings['BONUSES_PERCENTAGE']['VALUE']) / 100));
            
            $order = \Bitrix\Sale\Order::load($order_id);
            $propColl = $order->getPropertyCollection();
            $propertyValue = $propColl->getItemByOrderPropertyCode('BONUSES');
            
            $isBonused = 0;
            if($propertyValue)
                $isBonused = intval($propertyValue->getValue());

            if ($isBonused == 0)
            {
                self::addBonuses($order->getUserId(), $bonuses, $order_id);
            }

            $orders = \CSaleOrder::GetList([], ['USER_ID' => $order->getUserId(), 'CANCELED' => 'N', 'PAYED' => 'Y']);
            $sum = 0;
            while($orderData = $orders->Fetch()) {
                $sum += $orderData['PRICE'] - $orderData['PRICE_DELIVERY'];
            }
            $percentage = 1;
            $max = 4;
            for ($i = 1; $i <= $max; $i++) { 
                if($sum < $siteSettings['PAYMENT_INT_TO_' . $i]['VALUE'] && $sum > $siteSettings['PAYMENT_INT_FROM_' . $i]['VALUE']) {
                    $percentage = $i;
                    break;
                }
            }
            $percentageValue = $siteSettings['BONUSES_PAY_' . $percentage]['VALUE'];

            $curUser = \CSaleUserAccount::GetByUserID($order->getUserId(), 'RUB');

            if($curUser['NOTES'] !== strval($percentageValue)) {
                $fields = [
                    'USER_ID' => $order->getUserId(),
                    'CURRENT_BUDGET' => $curUser['CURRENT_BUDGET'],
                    'CURRENCY' => 'RUB',
                    'NOTES' => strval($percentageValue),
                ];
                \CSaleUserAccount::Update($curUser['ID'], $fields);
            }
        }
    }

    public static function checkBonuses()
    {
        $list = self::prepareList([], ['UF_EXPIRES' => 1]);
        while($el = $list->Fetch()) {
            if(strtotime($el['UF_DATE_CREATE'] . '+ 2 months') < strtotime(date('d.m.Y h:i:s'))) {
                // Получение пользователя
                $curUser = \CSaleUserAccount::GetByUserID($el['UF_NAME'], 'RUB');

                $curUser['CURRENT_BUDGET'] = '-' . $el['UF_XML_ID'];

                \CSaleUserAccount::UpdateAccount(
                    $el['UF_NAME'],
                    $curUser['CURRENT_BUDGET'],
                    $curUser['CURRENCY'],
                    '',
                    $curUser['ORDER_ID'],
                    $curUser['NOTES'],
                );

                $entity = self::getHighloadEntity();
                $entity::delete($el['ID']);
            }
        }
        return "\\ST\\Bonuses\\Bonuses::checkBonuses();";
    }
}
