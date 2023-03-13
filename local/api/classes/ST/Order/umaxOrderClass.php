<?

namespace ST\Order;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\Context;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Delivery\Services\Manager;
use Bitrix\Sale\Order;
use Bitrix\Sale;
use Bitrix\Sale\PriceMaths;
use Bitrix\Main\Diag;

use Simba\Catalog\Product;

use ST\Order\Delivery;
use ST\Order\Payment;

class umaxOrderClass extends \CBitrixComponent
{
    /**
     * @var \Bitrix\Sale\Order
     */
    public $arResult = [];

    public $order;

    public $requestData;

    public $default_delivery = 11;

    public $default_payment = 1;

    protected $errors = [];

    protected $msg = [];

    function __construct($requestData)
    {
        parent::__construct(null);

        if (!Loader::includeModule('main')) {
            $this->errors[] = 'No main module';
        }

        if (!Loader::includeModule('sale'))
        {
            $this->errors[] = 'No sale module';
        };

        if (!Loader::includeModule('catalog'))
        {
            $this->errors[] = 'No catalog module';
        };

        if (empty($requestData))
        {
            $this->errors[] = 'Пустое тело запроса';
        }
        else
        {
            $this->requestData = $requestData;
        }
    }

    function onPrepareComponentParams($arParams)
    {
        if (isset($arParams['PERSON_TYPE_ID']) && intval($arParams['PERSON_TYPE_ID']) > 0) {
            $arParams['PERSON_TYPE_ID'] = intval($arParams['PERSON_TYPE_ID']);
        } else {
            if (intval($this->request['payer']['person_type_id']) > 0) {
                $arParams['PERSON_TYPE_ID'] = intval($this->request['payer']['person_type_id']);
            } else {
                $arParams['PERSON_TYPE_ID'] = 1;
            }
        }

        return $arParams;
    }

    public function registerUser()
    {
        global $USER;

        $password = randString(8);

        \CModule::IncludeModule("main");

        $user = new \CUser;

        $arFields = Array(
            "NAME"              => $this->requestData['customer_name'],
            "LAST_NAME"         => $this->requestData['customer_lastname'],
            "EMAIL"             => $this->requestData['customer_email'],
            "LOGIN"             => "+" . preg_replace('/[^0-9]/', '', $this->requestData['customer_phone']),
            "PHONE_NUMBER"      => "+" . preg_replace('/[^0-9]/', '', $this->requestData['customer_phone']),
            "LID"               => "ru",
            "ACTIVE"            => "Y",
            "GROUP_ID"          => [2],
            "PASSWORD"          => $password,
            "CONFIRM_PASSWORD"  => $password,
            "ADMIN_NOTES" => "Зарегистрирован автоматически при оформлении заказа"
        );

        $ID = $user->Add($arFields);

        if (intval($ID) > 0) {
            $USER->Authorize($ID);
            $arResult['NEW_USER'] = array(
                'LOGIN' => $this->requestData['customer_phone'],
                'EMAIL' => $this->requestData['customer_email'],
                'PASSWORD' => $password,
            );

            // Отправка сообщения пользователю с его логином и паролем
            \CEvent::Send("NEW_AUTO_REGISTERED_USER", "s1", array(
                'NAME' => $this->requestData['customer_name'],
                'LAST_NAME' => $this->requestData['customer_lastname'],
                'LOGIN' => $this->requestData['customer_phone'],
                'PASSWORD' => $password,
                'EMAIL' => $this->requestData['customer_email'],
            ));

            return $ID;
        } else {
            foreach (explode('.', $user->LAST_ERROR) as $error) {
                if (!empty(strip_tags($error)) && strlen(strip_tags($error)) > 1) {
                    $this->errors[] = strip_tags($error);
                }
            }
        }

        return false;
    }

    protected function createVirtualOrder($user_id = false)
    {
        global $USER;

        try {
            $siteId = \Bitrix\Main\Context::getCurrent()->getSite();

            $basketItems = \Bitrix\Sale\Basket::loadItemsForFUser(
                \CSaleBasket::GetBasketUserID(),
                $siteId
            )
                ->getOrderableItems();


            if (count($basketItems) == 0) {
                \LocalRedirect('/cart/');
            }

            $user_id = !empty($user_id) ? $user_id : $USER->GetID();

            $this->order = \Bitrix\Sale\Order::create($siteId, $user_id);
            $this->order->setPersonTypeId(!empty($this->requestData['PERSON_TYPE_ID']) ? $this->requestData['PERSON_TYPE_ID'] : 1);

            $this->order->setBasket($basketItems);

            $basket = $this->order->getBasket();

            $this->setOrderProps();

            $discountManager = new Sale\DiscountCouponsManager();

            $discountManager->init(
                $discountManager->MODE_ORDER, [
                    "userId" => $this->order->getUserId(),
                    "orderId" => $this->order->getId()
                ]
            );

            $session = \Bitrix\Main\Application::getInstance()->getSession();

            // Работа с купоном
            if ($this->requestData['set_coupon'])
            {
                if (!empty($this->requestData['COUPON']))
                {
                    $this->msg[] = 'Купон успешно применён';

                    Sale\DiscountCouponsManager::add($this->requestData['COUPON']);
                } else {
                    $this->msg[] = 'Купон успешно удален';

                    Sale\DiscountCouponsManager::clear(true);
                }
            }

                // Работа с бонусами

                // if (!empty($this->requestData['BONUSES']) && $this->requestData['BONUSES'] !== 0 && empty($_SESSION['couponBonuses']))
                // {
                //     $this->msg[] = 'Бонусы с вашего счета будут списаны после оплаты заказа';

                //     $session->set('couponBonuses', $couponBonuses);

                //     Sale\DiscountCouponsManager::add($couponBonuses);
                // }
                // else if (!empty($this->requestData['BONUSES']) && $this->requestData['BONUSES'] !== 0 && !empty($_SESSION['couponBonuses']))
                // {
                //     $this->msg[] = 'Бонусы с вашего счета будут списаны после оплаты заказа';

                //     $resCoupon = Sale\DiscountCouponsManager::clearApplyCoupon($session['couponBonuses']);
                //     if($resCoupon) {
                //         $this->msg[] = 'true 1';
                //     }

                //     $session->set('couponBonuses', $couponBonuses);

                //     Sale\DiscountCouponsManager::add($couponBonuses);
                // }
                // else if (empty($couponBonuses) && !empty($_SESSION['couponBonuses']))
                // {
                //     $this->msg[] = 'Оплата бонусами отменена';

                //     $resCoupon = Sale\DiscountCouponsManager::clearApplyCoupon($session['couponBonuses']);

                //     if (!empty($_SESSION['couponBonuses']))
                //     {
                //         unset($_SESSION['couponBonuses']);
                //     }
                // }
            // } else {
                // Sale\DiscountCouponsManager::clear(true);
            // }

            $discounts = $this->order->getDiscount();
            $discounts->calculate();

            $shipmentCollection = $this->order->getShipmentCollection();

            $delivery_id = (int) $this->requestData['delivery_id'];
            $delivery_id = $delivery_id > 0 ? $delivery_id : $this->default_delivery;

            $payment_id = (int) $this->requestData['payment_id'];

            $this->setOrderProps();

            $shipment = $shipmentCollection->createItem();

            $shipmentItemCollection = $shipment->getShipmentItemCollection();
            $shipment->setField('CURRENCY', $this->order->getCurrency());

            $service = \Bitrix\Sale\Delivery\Services\Manager::getObjectById($delivery_id);

            // Добавляем экстра-сервисы
            $extra_services = json_decode($this->requestData['delivery_extra_services'], 1);

            $arExtraServices = [];

            if (is_array($extra_services) && !empty($extra_services)) {
                foreach ($service->getExtraServices()->getItems() as $extraServiceId => $extraServiceValue)
                {
                    if (in_array($extraServiceValue->getCode(), $extra_services))
                    {
                        $arExtraServices[$extraServiceId] = 'Y';
                    }
                }

                if (!empty($arExtraServices))
                {
                    $shipment->setExtraServices($arExtraServices);
                }
            }

            foreach ($this->order->getBasket()->getOrderableItems() as $item) {
                $shipmentItem = $shipmentItemCollection->createItem($item);
                $shipmentItem->setQuantity($item->getQuantity());
            }

            $shipment->setDeliveryService($service);
            $shipment->setField('DELIVERY_NAME', \Bitrix\Sale\Delivery\Services\Manager::getObjectById($delivery_id)->getNameWithParent());

            $shipmentCollection->calculateDelivery();

            $this->setOrderProps();

            $paymentCollection = $this->order->getPaymentCollection();
            $payment = $paymentCollection->createItem(\Bitrix\Sale\PaySystem\Manager::getObjectById($payment_id > 0 ? $payment_id : $this->default_payment));
            $payment->setField("SUM", $this->order->getPrice());

            $payment->setField("CURRENCY", $this->order->getCurrency());

            $this->setOrderProps();

            $this->order->setField('USER_DESCRIPTION', $this->requestData['customer_description']);
//            $this->order->setField('DELIVERY_COURIER', 'N');

//            $propertyCollection = $this->order->getPropertyCollection();
//
//            p($this->order->setField('PRICE', 300));
//
//            $discounts = $this->order->getDiscount();
//            $discounts->calculate();
//
//            $shipmentCollection->calculateDelivery();
//
//            p([
//                $this->order->getField('PRICE'),
//                $this->order->getField("SUM")
//            ]);
//            exit();

        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }
    }

    protected function setOrderProps()
    {
        global $USER;

        $propertyCollection = $this->order->getPropertyCollection();

        $phoneProp = $propertyCollection->getPhone();
        $phoneProp->setValue($this->requestData['customer_phone']);

        $nameProp = $propertyCollection->getPayerName();
        $nameProp->setValue($this->requestData['customer_name'] . ' ' . $this->requestData['customer_lastname']);

        $emailPropValue = $propertyCollection->getUserEmail();
        $emailPropValue->setValue($this->requestData['customer_email']);

//        $arUser = $USER->GetByID(intval($USER->GetID()))->Fetch();

//        p($this->order->getAvailableFields());
//        exit();
//        return $this->requestData;

//        p($this->requestData['customer_phone']);
//        exit();

        // Устанавливаем свойства
//        $propertyCollection = $this->order->getPropertyCollection();
//
//        $phoneProp = $propertyCollection->getPhone();
//        $phoneProp->setValue($this->requestData['customer_phone']);
//
//        $nameProp = $propertyCollection->getPayerName();
//        $nameProp->setValue($this->requestData['customer_name']);

//        $this->order->setField('PHONE', $this->requestData['customer_phone']);
//        $this->order->setField('EMAIL', $this->requestData['customer_email']);

//        $this->order->setField('FIO', $this->requestData['customer_name'] . ' ' . $this->requestData['customer_lastname']);
//        $this->order->setField('USER_DESCRIPTION', $this->requestData['customer_description']);


        // Проставляем св-ва экстра-сервисов
        $extra_services = json_decode($this->requestData['delivery_extra_services'], 1);

        foreach ($this->order->getPropertyCollection() as $prop) {
            /** @var \Bitrix\Sale\PropertyValue $prop */
            $value = '';

            switch ($prop->getField('CODE')) {
                case 'FIO':
                    $value = $this->requestData['customer_name'];
                    $value .= ' ' . $this->requestData['customer_lastname'];

                    $value = trim($value);
//                    if (empty($value)) {
//                        $value = $arUser['FIO'];
//                    }
                    break;

                case 'EMAIL':
                    $value = trim($this->requestData['customer_email']);
                    if (empty($value)) {
                        $value = '';
                    }
                    break;

                case 'PHONE':
                    $value = trim($this->requestData['customer_phone']);
                    if (empty($value)) {
                        $value = '';
                    }
                    break;

                case 'ZIP':
                    $value = trim($this->requestData['zipcode']);
                    if (empty($value)) {
                        $value = '';
                    }
                    break;

                case 'ADDRESS':
                    $value = trim($this->requestData['delivery_address']);

                    if (empty($value)) {
                        $value = '';
                    }
                    break;

                case 'BONUSES':
                    $value = $this->requestData['BONUSES'];
                    if (empty($value)) {
                        $value = '';
                    }
                    break;

                // Если получать будет другой человек
                case 'OTHER_RECIPIENT':
                    $value = $this->requestData['any_receive'] === 'true' ? 'Y' : 'N';
                    if (empty($value)) {
                        $value = '';
                    }
                    break;
                case 'CALLBACK_MANAGER_SERVICE':
                    $value = $this->requestData['callback_manager_service'] === 'true' ? 'Y' : 'N';
                    if (empty($value)) {
                        $value = '';
                    }
                    break;
                case 'FITTING_SERVICE':
                    $value = in_array('FITTING', $extra_services) ? 'Y' : 'N';
                    if (empty($value)) {
                        $value = '';
                    }
                    break;
                case 'PARTIAL_DELIVERY_SERVICE':
                    $value = in_array('PARTIAL_DELIVERY', $extra_services) ? 'Y' : 'N';
                    if (empty($value)) {
                        $value = '';
                    }
                    break;

                default:
            }

            // Если доставка курьером
            if ($this->requestData['courier'] === 'true')
            {
                $courierInfo = json_decode($this->requestData['courier_info'], 1);

                switch ($prop->getField('CODE')) {
                    case 'DELIVERY_COURIER':
                        $value = $this->requestData['courier'] === 'true' ? 'Y' : 'N';
                        if (empty($value)) {
                            $value = '';
                        }
                        break;
                    case 'CITY':
                        $value = $courierInfo['city'];
                        if (empty($value)) {
                            $value = '';
                        }
                        break;
                    case 'STREET':
                        $value = $courierInfo['street'];
                        if (empty($value)) {
                            $value = '';
                        }
                        break;
                    case 'HOUSE':
                        $value = $courierInfo['house'];
                        if (empty($value)) {
                            $value = '';
                        }
                        break;
                    case 'FLAT':
                        $value = $courierInfo['flat'];
                        if (empty($value)) {
                            $value = '';
                        }
                        break;
                    case 'ENTRANCE':
                        $value = $courierInfo['entrance'];
                        if (empty($value)) {
                            $value = '';
                        }
                        break;
                    case 'LEVEL':
                        $value = $courierInfo['level'];
                        if (empty($value)) {
                            $value = '';
                        }
                        break;
                    case 'INTERCOM':
                        $value = $courierInfo['intercom'];
                        if (empty($value)) {
                            $value = '';
                        }
                        break;
                    case 'DELIVERY_COURIER_DATE':
                        $value = $courierInfo['delivery_date'];
                        if (empty($value)) {
                            $value = '';
                        }
                        break;

                    default:
                }
            }

            if (empty($value)) {
                foreach ($this->request as $key => $val) {
                    if (strtolower($key) == strtolower($prop->getField('CODE'))) {
                        $value = $val;
                    }
                }
            }

            if (empty($value)) {
                $value = $prop->getProperty()['DEFAULT_VALUE'];
            }

            if (!empty($value)) {
                $prop->setValue($value);
            }
        }
    }

    public function basketListToArray($basketItems)
    {
        $arRes = [];
        $arMeasure = [];
        $dbMeasure = \CCatalogMeasure::getList();
        while ($obMeasure = $dbMeasure->Fetch()) {
            $arMeasure[$obMeasure['ID']] = $obMeasure;
        }
        foreach ($basketItems as $item) {
            $product = new Product(['ID' => $item->getProductId()]);
            $iProduct = \CCatalogProduct::GetByID($item->getProductId());

            $picture = $product->getPhotos(true, ['x_small']);

            $arRes[] = [
                "ID"              => $item->getId(),
                "PRODUCT_ID"      => $item->getProductId(),
                "NAME"            => $item->getField('NAME'),
                "IMAGE"           => $picture['x_small']['src'],
                "DETAIL_PAGE_URL" => $item->getField('DETAIL_PAGE_URL'),
                "PRICE"           => $item->getPrice(),
                "FULL_PRICE"      => $item->getFinalPrice(),
                "DISCOUNT_PRICE"  => $item->getDiscountPrice(),
                "BASE_PRICE"      => $item->getBasePrice(),
                "QUANTITY"        => $item->getQuantity(),
                "WEIGHT"          => (float) $item->getWeight(),
                "MEASURE"         => $arMeasure[$iProduct['MEASURE']],
            ];
        }
        return $arRes;
    }

    public function getCurrentShipment(Order $order)
    {
        /** @var Shipment $shipment */
        foreach ($order->getShipmentCollection() as $shipment) {
            if (!$shipment->isSystem()) {
                return $shipment;
            }
        }

        return null;
    }

    public function getCalculateDeliveries($order)
    {
        $orderClone = $order->createClone();
        $shipment = $this->getCurrentShipment($orderClone);
        $shipmentCollection = $orderClone->getShipmentCollection();
        $deliveryItems = Delivery::getAvailableDeliveries($shipmentCollection);


        foreach ($deliveryItems as $k => $obDelivery) {
            $id = $obDelivery->getId();
            $shipment->setField('DELIVERY_ID', $id);

            $shipmentCollection->calculateDelivery();

            $calcResult = $obDelivery->calculate($shipment);

            if ($calcResult->isSuccess()) {
                $massiv[$id] = [
                    //"DELIVERY_PRICE" => $calcResult->getPrice(),
                    "DELIVERY_PRICE"  => $orderClone->getDeliveryPrice(),
                    "DELIVERY_PERIOD" => $calcResult->getPeriodDescription()
                ];

            } else {
                $massiv[$id] = [
                    "DELIVERY_PRICE"  => false,
                    "DELIVERY_PERIOD" => false
                ];
            }
        }
        return $massiv;
    }

    public function validateSteps()
    {
        // Валидация данных пользователя
        if (strlen(strip_tags($this->requestData['customer_name'])) < 2) {
            $this->errors[] = 'Имя не может состоять менее чем из 2 букв';
        }

        // Валидация данных пользователя
        if (strlen(strip_tags($this->requestData['customer_lastname'])) < 2)
        {
            $this->errors[] = 'Фамилия не может состоять менее чем из 2 букв';
        }

        if ($this->requestData['courier'] === 'false')
        {
            // Валидация данных пользователя
            if (strlen(strip_tags($this->requestData['delivery_city'])) < 2) {
                $this->errors[] = 'Пожалуйста укажите город для доставки';
            }

            if (
                empty($this->requestData['delivery_address']) &&
                !empty($this->requestData['delivery_city'])
            )
            {
                $this->errors[] = 'Пожалуйста выберите ПВЗ';
            }
        } else {
            $courierInfo = json_decode($this->requestData['courier_info'], 1);

            if (empty($courierInfo['city']))
            {
                $this->errors[] = 'Пожалуйста укажите город для доставки';
            }

            if (empty($courierInfo['street']))
            {
                $this->errors[] = 'Пожалуйста укажите улицу для доставки';
            }

            if (empty($courierInfo['house']))
            {
                $this->errors[] = 'Пожалуйста укажите дом для доставки';
            }

            if (empty($courierInfo['flat']))
            {
                $this->errors[] = 'Пожалуйста укажите квартиру или офис для доставки';
            }
        }
    }

    public function getOrderData()
    {
        global $USER;
        $user_id = !empty($user_id) ? $user_id : $USER->GetID();

//        if(intval($this->requestData['BONUSES']) > 0) {
//            $bonusesCoupon = \ST\Bonuses\Bonuses::createCoupon($user_id, $this->requestData['BONUSES']);
//        }

        $this->createVirtualOrder(false);

        $order = $this->order;

        $basket = $this->order->getBasket();

        $shipment_collection = $this->order->getShipmentCollection();

        $available_deliveries = Delivery::getAvailableDeliveries($shipment_collection);
        $deliveries_list_dop_info = $this->getCalculateDeliveries($order);
        $deliveries_list = Delivery::deliveriesListToArray($available_deliveries);

        foreach ($deliveries_list as $key => $value) {
            if ((int) $value['ID'] === $this->default_delivery) {
                unset($deliveries_list[$key]);
                continue;
            }

            $deliveries_list[$key]['DELIVERY_PRICE'] = $deliveries_list_dop_info[$key]['DELIVERY_PRICE'];
            $deliveries_list[$key]['DELIVERY_PERIOD'] = $deliveries_list_dop_info[$key]['DELIVERY_PERIOD'];
        }

        $payment_collection = $order->getPaymentCollection();
        $payment_sum = $order->getPrice();
        $payment_currency = $order->getCurrency();
        $available_payments = Payment::getAvailablePayments($payment_collection, $payment_sum, $payment_currency);

        $shipment_collection->calculateDelivery();

        $success = false;
        $payment_link = '';

        if (intval($this->requestData['save']) === 1)
        {
            $this->validateSteps();

            // Валидация доставки
            $this->errors = array_merge($this->errors, Delivery::deliveryValidate($order));

            // Валидация оплаты
            $this->errors = array_merge($this->errors, Payment::validatePayment($order));

            $user_id = false;

            global $USER;

            if (!$USER->IsAuthorized()) {
                try {
                    //Регистрация пользователя, если необходимо
                    $user_id = $this->registerUser();
                } catch (\Exception $e) {
                    $this->errors[] = $e->getMessage();
                }
            }

            if (empty($this->errors))
            {
                $this->createVirtualOrder($user_id);
                $order = $this->order;

                $order->doFinalAction(true);
                $res = $order->save();

                $res_errors = $res->getErrors();

                $success = true;
                $online_pay = true;

                if (!empty($res_errors)) {
                    foreach ($res_errors as $error) {
                        $this->errors[] = $error;
                    }
                    $success = false;
                }

                $order_id = $res->getId();
//                $order_id = 118;

                /** @var \Bitrix\Sale\Payment $payment */
                $order = \Bitrix\Sale\Order::load($order_id);

                if ($order)
                {
                    /** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
                    $paymentCollection = $order->getPaymentCollection();
                    if ($paymentCollection > 0)
                    {
                        $payment = $paymentCollection[0];

                        $withdrawSum = \CSaleUserAccount::Withdraw(
                            $order->getUserId(),
                            intval($this->requestData['BONUSES']),
                            $order->getCurrency(),
                            $order->getId()
                        );

                        if (!empty($this->requestData['BONUSES']) && $withdrawSum > 0)
                        {
                            $payment->setFields([
                                'PAY_SYSTEM_ID' => intval($payment->getField('PAY_SYSTEM_ID')),
                                'SUM' => PriceMaths::roundPrecision($order->getPrice() - $withdrawSum),
                            ]);

                            $arFields = [
                                "SUM_PAID" => $withdrawSum,
                                "USER_ID" => $order->getUserId()
                            ];
                            \CSaleOrder::Update($order->getId(), $arFields);

                            // Если сумма заказа была полностью оплачена бонусами
                            if ($withdrawSum == $order->getPrice())
                            {
                                $online_pay = false;

                                \CSaleOrder::PayOrder($order->getId(), "Y", False, False);

                                $success = true;

                                $siteSettings = getSiteSettings();

                                $payment_link = $siteSettings["SBERBANK_RETURN_SUCCESS_URL"]["VALUE"]
                                    . '?paysystem=upon_receipt&orderId=' . $order_id;
                            }
                        }

                        $service = Sale\PaySystem\Manager::getObjectById($payment->getPaymentSystemId());
                        $context = \Bitrix\Main\Application::getInstance()->getContext();
                        $res = $service->initiatePay($payment, $context->getRequest());
                    }
                }

                // Если использовался обработчик системы оплаты
                if (!$res->isSuccess() && $online_pay) {
                    $success = false;
                    $online_pay = false;
                } else {
                    $payment_link = $res->getPaymentUrl();
                }

                // Если использовался сценарий без онлайн оплаты
                if (strlen(trim($payment_link)) <= 0 && !$online_pay)
                {
                    $success = true;

                    $siteSettings = getSiteSettings();

                    $payment_link = $siteSettings["SBERBANK_RETURN_SUCCESS_URL"]["VALUE"]
                        . '?paysystem=upon_receipt&orderId=' . $order_id;
                }

//                if (strlen(trim($payment_link)) > 0)
//                {
//                    $propertyCollection = $order->getPropertyCollection();
//                    $somePropValue = $propertyCollection->getItemByOrderPropertyCode('PAY_LINK');
//
//                    if (!$somePropValue)
//                    {
//                        \CSaleOrderPropsValue::Add([
//                            'ORDER_ID' => $order->getId(),
//                            'ORDER_PROPS_ID' => 22,
//                            'NAME' => "Ссылка на оплату",
//                            'VALUE' => $payment_link,
//                            'CODE' => "PAY_LINK",
//                        ]);
//                    } else {
//                        $propValue = $somePropValue->getValue();
//                        if (empty($propValue)) {
//                            $somePropValue->setValue($payment_link);
//                            $somePropValue->save();
//                        }
//                    }
//                }
            }
        }

        $basket_items = $this->basketListToArray($basket);

        return [
            'order'          => [
                'props'              => $this->requestData,
                'price'              => $order->getPrice(),
                'delivery_price'     => $order->getDeliveryPrice(),
                'discount_list'      => $order->getDiscount()->getApplyResult(),
                'discount_price'     => PriceMaths::roundPrecision($basket->getBasePrice() - $basket->getPrice()),
                'basket_price'       => $basket->getPrice(),
                'basket_weight'      => $basket->getWeight(),
                'basket_items_count' => count($basket_items),
//                'manager_calculate'  => DeliveryNotifications::getDeliveryManagerCalculate(),
//                'unloading_only'     => DeliveryNotifications::getDeliveryUnloadingOnly(),
            ],
            'basket'         => [
                'items'      => $basket_items,
                'price'      => $basket->getPrice(),
                'base_price' => $basket->getBasePrice(),
            ],
//            'pvz'            => [
//                'sdek'  => $cdek ?? '',
//                'bbery' => $bbery,
//                'ozon'  => $ozonPvz,
//            ],
            'delivery'       => $deliveries_list,
//            'predelivery'    => $predelivery,
            'delivery_id'    => $order->getField('DELIVERY_ID'),
            'delivery_name'  => $order->getField('DELIVERY_NAME'),
            'payments'       => Payment::paymentListToArray($available_payments, $basket->getPrice()),
            'payment_id'     => $order->getPaymentSystemId()[0],
            'errors'         => $this->errors,
            'msg'            => $this->msg,
            'success'        => $success ? 'Y' : 'N',
            'payment_link'   => $payment_link,
//            'non_authorized' => $non_authorized,
            'payment_link'   => $payment_link,
            'order_id'       => $order_id,
        ];
    }
}
