<?php

namespace ST\CustomDelivery;

use GuzzleHttp\Client;

class CdekCourierDelivery extends \Bitrix\Sale\Delivery\Services\Base
{
    protected static $isCalculatePriceImmediately = true;
    protected static $whetherAdminExtraServicesShow = true;

    public function __construct(array $initParams)
    {
        parent::__construct($initParams);

//        p($initParams);
//        exit();
    }

    public static function getClassTitle()
    {
        return 'Доставка СДЭК курьером';
    }

    public static function getClassDescription()
    {
        return 'Интеграция по API со СДЭК Курьер [UMAX]';
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
                    'CLIENT_ID' => array(
                        'TYPE' => 'STRING',
                        'NAME' => 'Идентификатор клиента (Равен Account)',
                    ),
                    'CLIENT_SECRET' => array(
                        'TYPE' => 'STRING',
                        'NAME' => 'Cекретный ключ клиента (Равен Secure password)',
                    ),
                    'FROM_ZIP' => array(
                        'TYPE' => 'STRING',
                        'NAME' => 'Индекс места отправления',
                    ),
                    'TARIFF' => array(
                        'TYPE' => 'STRING',
                        'NAME' => 'Тариф доставки',
                        'DEFAULT' => 139
                    ),
                    'MIN_DELIVERY_PRICE' => array(
                        'TYPE' => 'STRING',
                        'NAME' => 'Минимальная стоимость доставки (При значении 0, минимальтая стоимость определяется Почтой России)',
                        'DEFAULT' => 0
                    )
                )
            )
        );
        return $result;
    }

    public function authCdek()
    {
        $client = new Client([
            'base_uri' => 'https://api.cdek.ru/v2/oauth/token',
            'timeout'  => 3.0,
        ]);

        $res = $client->request('POST', '', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->config['MAIN']['CLIENT_ID'],
                'client_secret' => $this->config['MAIN']['CLIENT_SECRET'],
            ]
        ]);

        return json_decode($res->getBody()->getContents(), 1);
    }

    public function getDeliveryPrice($shipment, $propertyZipValue)
    {
        $authResponse = $this->authCdek();

        if (!empty($authResponse['access_token']))
        {
            $client = new Client([
                'base_uri' => 'https://api.cdek.ru/v2/calculator/tariff',
                'timeout'  => 3.0,
            ]);

            $res = $client->request('POST', '', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $authResponse['access_token']
                ],
                "json" => [
                    "type" => 1,
                    "currency" => 1,
                    "tariff_code" => $this->config['MAIN']['TARIFF'],
                    "from_location" => [
                        "postal_code" => $this->config['MAIN']['FROM_ZIP']
                    ],
                    "to_location" => [
                        "postal_code" => $propertyZipValue
                    ],
                    "packages" => [
                        "weight" => $shipment->getWeight()
                    ]
                ]
            ]);

            return json_decode($res->getBody()->getContents(), 1);
        }

        return false;
    }

    protected function calculateConcrete(\Bitrix\Sale\Shipment $shipment = null)
    {
        $order = $shipment->getCollection()->getOrder();
        $props = $order->getPropertyCollection();

        $propertyZipValue = $props->getItemByOrderPropertyCode('ZIP')->getValue();

        $deliveryPrice = 0;
        $deliveryPeriod = "";

        if (!empty($propertyZipValue)) {
            // Получение стоимости доставки
            $arResponse = $this->getDeliveryPrice($shipment, $propertyZipValue);

            if ($arResponse) {
                $deliveryPrice = $arResponse['total_sum'];

                $deliveryPrice = round($deliveryPrice, 2);

                if (intval($this->config['MAIN']['MIN_DELIVERY_PRICE']) > 0 && (intval($deliveryPrice) < intval($this->config['MAIN']['MIN_DELIVERY_PRICE']))) {
                    $deliveryPrice = intval($this->config['MAIN']['MIN_DELIVERY_PRICE']);
                }

                $deliveryPeriod = $arResponse['period_min'] . "-" . $arResponse['period_max'];
            }
        }

        $result = new \Bitrix\Sale\Delivery\CalculationResult();
        $result->setDeliveryPrice($deliveryPrice);

        $result->setPeriodDescription($deliveryPeriod);

        return $result;
    }
}
