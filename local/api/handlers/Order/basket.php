<?php
/**
 * Created by PhpStorm.
 * User: Maxim Masalov
 * Date: 08.08.2019
 * Time: 12:03
 */

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('catalog');

use Bitrix\Sale\Basket;

class BasketController
{
    /**
     * BasketController constructor.
     * @param $action
     * @param $answer
     */
    public function __construct($action, $answer)
    {
        if (method_exists($this, $action)) {
            $this->$action($answer);
            return true;
        }
        return false;
    }


    /**
     * Метод авторизует пользователя
     * @param $array
     */
    public function getBasket($array = [])
    {
        global $APPLICATION;

        $APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "ajax_small_basket", [
            "ACTION_VARIABLE"  => "basketAction",    // Название переменной действия
            "AUTO_CALCULATION" => "Y",    // Автопересчет корзины
            "COLUMNS_LIST"     => [    // Выводимые колонки
                0 => "NAME",
                1 => "DISCOUNT",
                2 => "WEIGHT",
                3 => "DELETE",
                4 => "DELAY",
                5 => "TYPE",
                6 => "PRICE",
                7 => "QUANTITY",
                8 => "PROPERTY_CML2_ARTICLE",
                9 => "PROPERTY_COLLECTION",
                10 => "PROPERTY_DISABLE_DISCOUNTS",
                11 => "PROPERTY_NOVAIL"
            ],
            "CORRECT_RATIO"                   => "N",    // Автоматически рассчитывать количество товара кратное коэффициенту
            "GIFTS_BLOCK_TITLE"               => "Выберите один из подарков",
            "GIFTS_CONVERT_CURRENCY"          => "N",
            "GIFTS_HIDE_BLOCK_TITLE"          => "N",
            "GIFTS_HIDE_NOT_AVAILABLE"        => "N",
            "GIFTS_MESS_BTN_BUY"              => "Выбрать",
            "GIFTS_MESS_BTN_DETAIL"           => "Подробнее",
            "GIFTS_PAGE_ELEMENT_COUNT"        => "4",
            "GIFTS_PLACE"                     => "BOTTOM",
            "GIFTS_PRODUCT_PROPS_VARIABLE"    => "prop",
            "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "GIFTS_SHOW_DISCOUNT_PERCENT"     => "Y",
            "GIFTS_SHOW_IMAGE"                => "Y",
            "GIFTS_SHOW_NAME"                 => "Y",
            "GIFTS_SHOW_OLD_PRICE"            => "N",
            "GIFTS_TEXT_LABEL_GIFT"           => "Подарок",
            "HIDE_COUPON"                     => "Y",    // Спрятать поле ввода купона
            "PATH_TO_ORDER"                   => "/cart/order",    // Страница оформления заказа
            "PRICE_VAT_SHOW_VALUE"            => "N",    // Отображать значение НДС
            "QUANTITY_FLOAT"                  => "N",    // Использовать дробное значение количества
            "SET_TITLE"                       => "N",    // Устанавливать заголовок страницы
            "TEMPLATE_THEME"                  => "blue",    // Цветовая тема
            "USE_ENHANCED_ECOMMERCE"          => "N",    // Отправлять данные электронной торговли в Google и Яндекс
            "USE_GIFTS"                       => "N",    // Показывать блок "Подарки"
            "USE_PREPAYMENT"                  => "N",    // Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
        ],
            false
        );
    }


    /**
     * Метод устанавливает количество товара
     * @param $array
     */
    public function setQuantity($array)
    {
        $res = CSaleBasket::Update($array['id'], [
            'PRODUCT_ID' => $array['product_id'],
            'QUANTITY' => $array['quantity']
        ]);
        //$this->getBasket();

        $arBasketItem = CSaleBasket::GetByID($array['id']);

        $success = 1;

        if (!$res) { $success = 0; }

        echo json_encode([
            'success' => $success,
            'quantity' =>  (int) $arBasketItem['QUANTITY']
        ]);
        exit();
    }


    /**
     * Метод удаляет товар из корзины
     * @param $array
     */
    public function delete($array)
    {
        if (!is_array($array['id'])) {
            CSaleBasket::delete($array['id']);
        } else {
            foreach ($array['id'] as $item) {
                if ($item['check'] == 'yes') {
                    CSaleBasket::delete($item['ID']);
                }
            }
        }
        //$this->getBasket();
    }


    /**
     * Метод добавляет товар в корзину
     * @param $array
     */
    public function add($array)
    {
        $product_id = (int) $array['id'];
        $product = new \Simba\Catalog\Product($product_id);
        $quantity = $product->getQuantity();

//        $db_res = CPrice::GetList(array(), array(
//            "PRODUCT_ID" => $product_id,
//        ));
//        $ar_res = $db_res->Fetch();


        if (intval($array['quantity']) > intval($quantity['QUANTITY'])) {
            if (intval($quantity['QUANTITY']) === 0) {
                echo json_encode([
                    'success' => 0,
                    'msg' => 'Данного товара нет в наличии'
                ], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode([
                    'success' => 0,
                    'msg' => 'Остаток данного товара меньше чем вы хотите добавить в корзину'
                ], JSON_UNESCAPED_UNICODE);
            }

            exit();
        }

        if($quantity['QUANTITY'] > 0 && $array['quantity'] > 0 && (($array['from_list'] == 'Y' && $array['quantity'] < $quantity['QUANTITY']) || $array['from_list'] !== 'Y')) {

            $id = Add2BasketByProductID(
                $product_id,
                (int) $array['quantity'],
                array(
                    'DELAY' => ($array['delayed'] === true ? 'Y' : 'N')
//                    'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
//                    'PRICE' => $ar_res['PRICE']
                )
            );

            if(!$id) {
              CModule::IncludeModule("iblock");

              $basket = \Bitrix\Sale\Basket::loadItemsForFUser(\Bitrix\Sale\Fuser::getId(), \Bitrix\Main\Context::getCurrent()->getSite());

              $db_res = CPrice::GetList(array(), array(
                  "PRODUCT_ID" => $product_id,
                ));
              $ar_res = $db_res->Fetch();

              $res = CIBlockElement::GetByID($product_id);
              $ar_res0 = $res->GetNext();


              $item = $basket->createItem('catalog', $product_id);
              $item->setFields([
                'QUANTITY' => (int) $array['quantity'],
                'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
                'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
                'PRICE' => $ar_res['PRICE'],
                'CUSTOM_PRICE' => 'Y',
                'NAME' =>htmlspecialcharsBack($ar_res0['NAME'])
              ]);
              $basket->save();
            }



            if($array['delayed'] === true) {
                CSaleBasket::Update($id, ["DELAY" => "Y"]);
            }
        }


//        $this->getBasket();
    }


    /**
     * Отложить товар
     * @param $array
     */
    public function delay($array)
    {
        if (!is_array($array['id'])) {
            CSaleBasket::Update($array['id'], ["DELAY" => "Y"]);
        } else {
            foreach ($array['id'] as $item) {
                if ($item['check'] == 'yes') {
                    CSaleBasket::Update($item['ID'], ["DELAY" => "Y"]);
                }
            }
        }

        $this->getBasket();
    }


    /**
     * Возврат товара из отложенных
     * @param $array
     */
    public function returnToBasket($array)
    {
        CSaleBasket::Update($array['id'], ["DELAY" => "N"]);
        $this->getBasket();
    }


    /**
     * Очистка корзины
     * @param $array
     */
    public function clearBasket($array)
    {
        CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
        $this->getBasket();
    }

    public function getBonuses($data)
    {
        echo json_encode(\ST\Bonuses\Bonuses::getAllowedBonuses($data['userId'], $data['price']));
    }
}


$action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';

$answer = json_decode(file_get_contents('php://input'), true);
header('Content-type: application/json');
// Выполняем метод класса
new BasketController($action, $answer);
