<?php
/**
 * Created by PhpStorm.
 * User: bogdanmelkov
 * Date: 27.04.2021
 * Time: 15:12
 */

namespace BM\Checkout;


class DeliveryNotifications
{
    static private $deliveryManagerCalculate = false;
    static private $deliveryUnloadingOnly = false;


    public static function setDeliveryManagerCalculate(bool $val) : void
    {
        self::$deliveryManagerCalculate = $val;
    }

    public static function getDeliveryManagerCalculate() : bool
    {
        return self::$deliveryManagerCalculate;
    }

    public static function setDeliveryUnloadingOnly(bool $val) : void
    {
        self::$deliveryUnloadingOnly = $val;
    }

    public static function getDeliveryUnloadingOnly() : bool
    {
        return self::$deliveryUnloadingOnly;
    }
}