<?php

namespace ST\CustomDelivery;

use GuzzleHttp\Client;

class RuPostDelivery extends \Bitrix\Sale\Delivery\Services\Base
{
    protected static $isCalculatePriceImmediately = true;
    protected static $whetherAdminExtraServicesShow = false;

    public function __construct(array $initParams)
    {
        parent::__construct($initParams);
    }

    public static function getClassTitle()
    {
        return 'Доставка почтой России [UMAX]';
    }

    public static function getClassDescription()
    {
        return 'Интеграция по API с почтой России [UMAX]';
    }

    public function isCalculatePriceImmediately()
    {
        return self::$isCalculatePriceImmediately;
    }

    public static function whetherAdminExtraServicesShow()
    {
        return self::$whetherAdminExtraServicesShow;
    }

    protected function getConfigStructure()
    {
        $result = array(
            'MAIN' => array(
                'TITLE' => 'Основные',
                'DESCRIPTION' => 'Основные настройки',
                'ITEMS' => array(
                    'TARIFF' => array(
                        'TYPE' => 'STRING',
                        'NAME' => 'Тариф доставки',
                        'DEFAULT' => 4030
                    ),
                    'FROM_ZIP' => array(
                        'TYPE' => 'STRING',
                        'NAME' => 'Индекс места отправления',
                    ),
                    'VAT' => array(
                        'TYPE' => 'Y/N',
                        'NAME' => 'Включать в стоимость доставки НДС',
                        'DEFAULT' => 'Y'
                    ),
                    'MIN_DELIVERY_PRICE' => array(
                        'TYPE' => 'STRING',
                        'NAME' => 'Минимальная стоимость доставки (При значении 0, минимальтая стоимость определяется Почтой России)',
                        'DEFAULT' => 0
                    ),
//                    'PACKAGING_TYPE' => array(
//                        'TYPE' => 'ENUM',
//                        'NAME' => 'Тип упаковки',
//                        'DEFAULT' => 'BOX',
//                        'OPTIONS' => array(
//                            'BOX' => 'Коробка',
//                            'ENV' => 'Конверт',
//                        )
//                    ),
                )
            )
        );
        return $result;
    }

    public function getDeliveryPrice($order, $shipment, $propertyZipValue)
    {
        $client = new Client([
            //            'base_uri' => 'https://delivery.pochta.ru/v2/calculate/tariff?json',
            'base_uri' => 'https://tariff.pochta.ru/v2/calculate/tariff?json',

            'timeout'  => 4.0,
        ]);

        $res = $client->request('GET', '', [
            'query' => [
                'object' => $this->config['MAIN']['TARIFF'], //4020,
                'from' => $this->config['MAIN']['FROM_ZIP'],
                'to' => $propertyZipValue,
                'weight' => $shipment->getWeight(),
                // 'sumoc' => round(intval($order->getBasket()->getPrice())) * 100
            ]
        ]);

        return json_decode($res->getBody()->getContents(), 1);
    }

    public function getDeliveryPeriod($order, $shipment, $propertyZipValue)
    {
        $client = new Client([
            'base_uri' => 'https://tariff.pochta.ru/v2/calculate/delivery?json',
//            https://tariff.pochta.ru/v2/calculate/delivery?json&object=4020&from=670045&to=344065&weight=1000&pack=10
            'timeout'  => 4.0,
        ]);

        $res = $client->request('GET', '', [
            'query' => [
                'object' => $this->config['MAIN']['TARIFF'], //4020,
                'from' => $this->config['MAIN']['FROM_ZIP'],
                'to' => $propertyZipValue,
                'weight' => $shipment->getWeight()
            ]
        ]);

        return json_decode($res->getBody()->getContents(), 1);
    }

    protected function calculateConcrete(\Bitrix\Sale\Shipment $shipment = null)
    {
        $result = new \Bitrix\Sale\Delivery\CalculationResult();

        $order = $shipment->getCollection()->getOrder(); // заказ
        $props = $order->getPropertyCollection();
//        $locationCode = $props->getDeliveryLocation()->getValue(); // местоположение

//        $propertyValue = $props->getItemByOrderPropertyCode('ZIP')->getValue();
//        $propertyValue = $props->getItemByOrderPropertyCode('ADDRESS')->getValue();

        $propertyZipValue = $props->getItemByOrderPropertyCode('ZIP')->getValue();
        $propertyAddressValue = $props->getItemByOrderPropertyCode('ADDRESS')->getValue();

        $deliveryPrice = 0;
        $deliveryPeriod = "";

        if (!empty($propertyZipValue)) {
            // Получение стоимости доставки
            $arResponse = $this->getDeliveryPrice($order, $shipment, $propertyZipValue);

        //    p($arResponse);
        //    exit();

//            if (array_key_exists(0, $arResponse['postoffice']))
//            {
//                $weightMax = $arResponse['postoffice'][0]['weight-max'];
//
//                if (intval($arResponse['weight']) > intval($weightMax))
//                {
//                    $result->addError('Превышен максимальный вес посылки');
//                    return $result;
//                }
//            }

            $arResponsePeriod = $this->getDeliveryPeriod($order, $shipment, $propertyZipValue);

            if ($arResponsePeriod['delivery']['min'] == $arResponsePeriod['delivery']['max'])
            {
                $deliveryPeriod = $arResponsePeriod['delivery']['min'];
            } else {
                $deliveryPeriod = $arResponsePeriod['delivery']['min'] . "-" . $arResponsePeriod['delivery']['max'];
            }

            $deliveryPrice = $arResponse['paymoney'];

            if ($this->config['MAIN']['VAT'] === 'Y') {
                $deliveryPrice = $arResponse['paymoneynds'];
            }

            $deliveryPrice = round($deliveryPrice / 100, 2);

            // p($arResponse);
            // exit();

            if (intval($this->config['MAIN']['MIN_DELIVERY_PRICE']) > 0 && (intval($deliveryPrice) < intval($this->config['MAIN']['MIN_DELIVERY_PRICE']))) {
                $deliveryPrice = intval($this->config['MAIN']['MIN_DELIVERY_PRICE']);
            }
        }

    //    p($deliveryPrice);
    //    exit();

        $result->setDeliveryPrice($deliveryPrice);

        $result->setPeriodDescription($deliveryPeriod);

        return $result;
    }
}
