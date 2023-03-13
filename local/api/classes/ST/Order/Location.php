<?php
/**
 * Created by PhpStorm.
 * User: bogdanmelkov
 * Date: 06.06.2020
 * Time: 20:41
 */

namespace BM\Checkout;
use Bitrix\Main\Loader;

trait Location
{
    /**
     * Определение местоположения
     */
    public function getLocationData()
    {
        Loader::includeModule('sale');
        $location = false;
        global $USER;
        if ($USER->IsAuthorized() && SITE_ID) {
            if ($location_last_order = $this->getLocationByLastOrder()) {
                $location = $location_last_order;
            } else {
                $city = \CUser::GetByID($USER->GetID())->Fetch()['PERSONAL_CITY'];
                if ($city) $location = $this->getLocationByCityName($city);
            }
        }
        if (!$location) {
            $location = $this->getLocationByIp();
        }

        return $location;
    }


    /**
     * Определение местоположения по ip
     */
    protected function getLocationByIp()
    {
        $ip = \Bitrix\Main\Service\GeoIp\Manager::getRealIp();
        $location_id = \Bitrix\Sale\Location\GeoIp::getLocationId($ip, LANGUAGE_ID);

        if (empty($location_id)) $location_id = 43;

        return \CSaleLocation::GetByID($location_id);
    }

    /**
     * Определение местоположения по названию
     * @param $city
     * @return array
     */
    protected function getLocationByCityName($city)
    {
        $res = \CSaleLocation::GetList(
            ['*'],
            ['CITY_NAME' => $city],
            false,
            ['nTopCount' => 1]
        );

        $location = false;

        while($item = $res->fetch())
        {
            $location = \CSaleLocation::GetByID($item['ID']);
        }

        return $location;
    }

    /**
     * Определение местоположения по последнему заказу
     */
    protected function getLocationByLastOrder()
    {
        $location = false;

        global $USER;

        $registry = \Bitrix\Sale\Registry::getInstance(\Bitrix\Sale\Registry::REGISTRY_TYPE_ORDER);

        $orderClassName = $registry->getOrderClassName();

        $filter = [
            'filter' => [
                'USER_ID' => $USER->GetId(),
                'LID' => SITE_ID,
            ],
            'select' => ['ID'],
            'order' => ['ID' => 'DESC'],
            'limit' => 1,
        ];

        if ($arOrder = $orderClassName::getList($filter)->fetch())
        {
            $lastOrder = $orderClassName::load($arOrder['ID']);
            $delivery_location = $lastOrder->getPropertyCollection()->getDeliveryLocation();

            if ($delivery_location) {
                $location_code = $delivery_location->getValue();
                $location_id = \CSaleLocation::getLocationIDbyCODE($location_code);
                $location = \CSaleLocation::GetByID($location_id);
            }
        }

        return $location;
    }
}