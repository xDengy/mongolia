<?php


namespace BM\Checkout;


use Bitrix\Sale\Order;

class EmailSender
{
    public static function OrderMailEvent(Order $order)
    {
        $orderId = $order->getId();

        $strOrderList = "";
        $arBasketList = [];
        $dbBasketItems = \CSaleBasket::GetList(
            array("ID" => "ASC"),
            array("ORDER_ID" => $orderId),
            false,
            false,
            array("ID", "PRODUCT_ID", "NAME", "QUANTITY", "PRICE", "CURRENCY", "TYPE", "SET_PARENT_ID")
        );
        while ($arItem = $dbBasketItems->Fetch())
        {
            if (\CSaleBasketHelper::isSetItem($arItem))
                continue;

            $arBasketList[] = $arItem;
        }

        if (!empty($arBasketList) && is_array($arBasketList))
        {
            foreach ($arBasketList as $arItem)
            {
                $strOrderList .= $arItem["NAME"]." - ".$arItem["QUANTITY"]." : ".SaleFormatCurrency($arItem["PRICE"], $arItem["CURRENCY"]);
                $strOrderList .= "\n";
            }
        }

        global $DB, $SERVER_NAME;

        $user = \CUser::GetByID($order->getField('USER_ID'))->Fetch();

        $email = $order->getField("EMAIL");

        $arFields = array(
            "ORDER_ID" => $order->getField('ACCOUNT_NUMBER'),
            "ORDER_DATE" => Date($DB->DateFormatToPHP(\CLang::GetDateFormat("SHORT", SITE_ID))),
            "ORDER_USER" => preg_replace("/ {2,}/", " ",trim($user['LAST_NAME'] . ' ' . $user['NAME'] . ' ' . $user['SECOND_NAME'])),
            "PRICE" => \SaleFormatCurrency($order->getPrice(), "RUB"),
            "BCC" => \COption::GetOptionString("sale", "order_email", "order@".$SERVER_NAME),
            "EMAIL" => $email,
            "ORDER_LIST" => $strOrderList,
            "SALE_EMAIL" => \COption::GetOptionString("sale", "order_email", "order@".$SERVER_NAME),
            "DELIVERY_PRICE" => $order->getPrice() - $order->getDeliveryPrice(),
        );

        $eventName = "SALE_NEW_ORDER";
        $bSend = true;

        foreach(GetModuleEvents("sale", "OnOrderNewSendEmail", true) as $arEvent)
            if (ExecuteModuleEventEx($arEvent, array($orderId, &$eventName, &$arFields))===false)
                $bSend = false;

        if($bSend)
        {
            $event = new \CEvent;
            $event->Send($eventName, SITE_ID, $arFields, "Y");
        }
    }
}