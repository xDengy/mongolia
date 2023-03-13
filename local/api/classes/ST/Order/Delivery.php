<?php


namespace ST\Order;


use Bitrix\Sale\Order;

class Delivery
{
    /**
     * Возвращает доступные доставки
     *
     * @param $shipment_collection
     * @return array|\Bitrix\Sale\Delivery\Services\Base[]
     */
    public static function getAvailableDeliveries($shipment_collection)
    {
        $shipment = false;

        foreach ($shipment_collection as $shipmentItem) {
            if (!$shipmentItem->isSystem()) {
                $shipment = $shipmentItem;
                break;
            }
        }

        $availableDeliveries = [];

        if (!empty($shipment)) {
            $availableDeliveries = \Bitrix\Sale\Delivery\Services\Manager::getRestrictedObjectsList($shipment);
        }

        return $availableDeliveries;
    }

    public static function getFirstNonSystemShipment(Order $order)
    {
        foreach ($order->getShipmentCollection() as $shipment) {
            if (!$shipment->isSystem()) {
                return $shipment;
            }
        }

        return null;
    }

    public static function deliveryValidate(Order $order) {
        $shipment = self::getFirstNonSystemShipment($order);

        $errors = [];

        if ($shipment !== null) {
            if ($shipment->getDelivery() instanceof \Bitrix\Sale\Delivery\Services\Base) {
                $obDelivery = $shipment->getDelivery();
                $availableDeliveries = \Bitrix\Sale\Delivery\Services\Manager::getRestrictedObjectsList($shipment);
                if (!isset($availableDeliveries[$obDelivery->getId()])) {
                    $errors[] = new \Bitrix\Sale\ResultError('Доставка '.$obDelivery->getNameWithParent(). ' недоступна', 'OPEN_SOURCE_ORDER_DELIVERY_UNAVAILABLE');
                }
            } else {
                $errors[] = new \Bitrix\Sale\ResultError('Необходимо выбрать доставку', 'OPEN_SOURCE_ORDER_NO_DELIVERY_SELECTED');
            }
        } else {
            $errors[] = new \Bitrix\Sale\ResultError('Отгрузка не найдена', 'OPEN_SOURCE_ORDER_SHIPMENT_NOT_FOUND');
        }

        return $errors;
    }

    static function build_sorter($key)
    {
        return function ($a, $b) use ($key) {
            return strnatcmp($a[$key], $b[$key]);
        };
    }

    /**
     * Массив доставок
     *
     * @param $deliveryItems
     * @return array
     */
    public static function deliveriesListToArray($deliveryItems)
    {
        $arRes = [];

        foreach ($deliveryItems as $item) {
            $dbRestr = \Bitrix\Sale\Delivery\Restrictions\Manager::getList(array(
                'filter' => array('SERVICE_ID' => $item->getId()) // ID службы доставки
            ))->Fetch();

            $arRes[$item->getId()] = [
                "ID" => $item->getId(),
                "NAME" => $item->getName(),
                "SORT" => $item->getSort(),
                "DESCRIPTION" => $item->getDescription(),
                "PARENT_NAME" => $item->getNameWithParent(),
                "RESTRICTIONS" => $dbRestr,
                "DATA" => [
                    $item->getClassDescription(),
                    $item->getDescription()
                ]
            ];

            $extraServices = $item->getExtraServices();

            if ($extraServices) {
                $arExtraServices = [];
                foreach ($extraServices->getItems() as $extraService) {
                    $arExtraServices[$extraService->getId()] = [
                        'id' => $extraService->getId(),
                        'code' => $extraService->getCode(),
                        'name' => $extraService->getName(),
                        'description' => $extraService->getDescription(),
                        'value' => $extraService->getValue(),
                        'price' => $extraService->getPrice(),
                        'params' => $extraService->getParams(),
                        'currency' => $extraService->getOperatingCurrency(),
                        'embedded' => $extraService->isEmbeddedOnly(),
                        'cost' => $extraService->getCost(),
                        'can_user_edit' => $extraService->canUserEditValue(),
                        'is_store' => $extraService->isStore(),
                        'is_inner' => $extraService->isInner(),
                        'class_title' => $extraService->getClassTitle()
                    ];
                }
                $arRes[$item->getId()]['EXTRA_SERVICES'] = $arExtraServices;
            }
        }

//        usort($arRes, self::build_sorter('SORT'));
//
//        p($arRes);
//
//        exit();

        return $arRes;
    }
}
