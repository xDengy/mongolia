<?

namespace ST\Payments;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;
use Bitrix\Sale\Payment;
use Bitrix\Sale\PriceMaths;

class DolyameClass {

    public $siteSettings;

    public function __construct() {
        $this->siteSettings = getSiteSettings();
    }

    public function registerOrderInDolyame($payment, $email)
    {
        $base_uri = 'https://partner.dolyame.ru/v1/orders/';

        $uuid = Uuid::uuid4()->toString();
        $orderItems = $this->getOrderItems($payment);

        $client = new Client([
            'base_uri' => $base_uri,
            'timeout'  => 2.0,
            'verify'   => false,
        ]);

        $res = $client->request('POST', 'create', [
            'headers' => [
                "accept"          => 'application/json',
                "content-type"    => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'X-Correlation-ID' => $uuid,
                'order' => [
                    'id' => '3421117899-x',
                    'amount' => 100,
                    'prepaid_amount' => 100,
                    'items' => $orderItems,
                    'notification_url' => $this->getNotifyUrl(),
                    'fail_url' => $this->siteSettings["SBERBANK_RETURN_FAIL_URL"]["VALUE"]
                        . '?paysystem=dolyame&siteOrderId=' . $payment->getOrderId(),
                    'success_url' => $this->siteSettings["SBERBANK_RETURN_SUCCESS_URL"]["VALUE"]
                        . '?paysystem=sber&siteOrderId=' . $payment->getOrderId(),
                ],

//                'userName' => $this->siteSettings["SBERBANK_LOGIN"]["~VALUE"],
//                'password' => $this->siteSettings["SBERBANK_PASSWORD"]["~VALUE"],
//                'orderNumber' => $payment->getOrderId() . "-x-" . rand(),
//                'description' => "Allmongolia | Номер заказа на сайте: {$payment->getOrderId()}",
//                'amount' => $payment->getSum() * 100,
//                'email' => $email,
//                'returnUrl' => $this->siteSettings["SBERBANK_RETURN_SUCCESS_URL"]["VALUE"]
//                    . '?paysystem=sber&siteOrderId=' . $payment->getOrderId(),
//                'failUrl' => $this->siteSettings["SBERBANK_RETURN_FAIL_URL"]["VALUE"]
//                    . '?paysystem=sber&siteOrderId=' . $payment->getOrderId(),
            ],
        ]);

        return json_decode($res->getBody()->getContents(), 1);
    }

    public function checkPayStatus($orderId)
    {
        $base_uri = 'https://securecardpayment.ru/payment/rest/';

        if ($this->siteSettings["SBERBANK_TEST_MODE"]["VALUE"] === 'Y') {
            $base_uri = 'https://3dsec.sberbank.ru/payment/rest/';
        }

        $client = new Client([
            'base_uri' => $base_uri,
            'timeout'  => 2.0,
            'verify'   => false,
        ]);

        $res = $client->request('POST', 'getOrderStatusExtended.do', [
            'headers' => [
                "accept"          => 'application/json',
                "content-type"    => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'userName' => $this->siteSettings["SBERBANK_LOGIN"]["VALUE"],
                'password' => $this->siteSettings["SBERBANK_PASSWORD"]["VALUE"],
                'orderId' => $orderId,
            ],
        ]);

        $result = json_decode($res->getBody()->getContents(), 1);

        if (intval($result['actionCode']) === 0) {
            $orderID = explode('-x-', $result['orderNumber'])[0];

            $arOrder = \CSaleOrder::GetByID($orderID);
            if ($arOrder)
            {
                global $USER;

                $arFields = array(
                    "STATUS_ID" => $this->siteSettings["SBERBANK_PAYED_STATUS"]["VALUE"],
                    "CANCELED" => "N",
                    "PAYED" => "Y",
                    "PS_STATUS"=> "Y",
                    "PS_STATUS_CODE" => $this->siteSettings["SBERBANK_PAYED_STATUS"]["VALUE"],
                    "PS_RESPONSE_DATE" => Date(\CDatabase::DateFormatToPHP(\CLang::GetDateFormat("FULL", 'ru'))),
                    "DATE_PAYED" => Date(\CDatabase::DateFormatToPHP(\CLang::GetDateFormat("FULL", 'ru'))),
                    "USER_ID" => $arOrder["USER_ID"],
                    "EMP_PAYED_ID" => $USER->GetID()
                );

                \CSaleOrder::Update($orderID, $arFields);
            }
        }

        return $result;
    }

    protected function getOrderItems(Payment $payment)
    {
        $items = [
            'system' => [],
            'other'  => [],
        ];

        $deliveryItem = [];

        $shipmentCollection = $payment
            ->getCollection()
            ->getOrder()
            ->getShipmentCollection();

        foreach ($shipmentCollection as $shipment) {
            $itemKey = 'other';
            if ($shipment->isSystem()) {
                $itemKey = 'system';
            }
            $shipmentItemCollection = $shipment->getShipmentItemCollection();

            foreach ($shipmentItemCollection as $shipmentItem) {
                $basketItem = $shipmentItem->getBasketItem();
                if ($basketItem->isBundleChild()) {
                    continue;
                }

                if (!$basketItem->getFinalPrice()) {
                    continue;
                }

                if ($shipmentItem->getQuantity() <= 0) {
                    continue;
                }
                $itemPrice = $basketItem->getPrice();
                if (method_exists($basketItem, "getPriceWithVat")) {
                    $itemPrice = $basketItem->getPriceWithVat();
                }
                $item = [
                    "name"     => str_replace(["\r\n", "\r", "\n"], " ", $basketItem->getField('NAME')),
                    "quantity" => $shipmentItem->getQuantity(),
                    "price"    => number_format(PriceMaths::roundPrecision($itemPrice), 2, '.', ''),
                ];
//                $item            = array_merge($item, $this->getProductReceiptData($payment, $basketItem));
                $items[$itemKey][] = $item;
            }
            if ($shipment->getPrice() && !$shipment->isSystem()) {
                $deliveryItem = array(
                    "name"     => $shipment->getDeliveryName(),
                    "quantity" => 1,
                    "price"    => number_format(PriceMaths::roundPrecision($shipment->getPrice()), 2, '.', ''),
                );
//                $deliveryItem = array_merge($deliveryItem, $this->getDeliveryReceiptData($payment, $shipment));
            }
        }
        if (empty($items['other'])) {
            $items = $items['system'];
        } else {
            $items = $items['other'];
        }
        if ($deliveryItem) {
            $items[] = $deliveryItem;
        }
        return $items;
    }

    protected function getNotifyUrl(Payment $payment)
    {
        $context = \Bitrix\Main\Application::getInstance()->getContext();
        $request = $context->getRequest();
        $siteId  = $context->getSite();
        $params  = [
            'BX_PAYSYSTEM_CODE' => $payment->getPaymentSystemId(),
            'BX_PAYMENT_ID'     => $payment->getId(),
        ];

        $host = $request->getHttpHost();
        if (!$host) {
            $arSite = \Bitrix\Main\SiteTable::getById($siteId)->fetch();
            $host   = $arSite['SERVER_NAME'];
        }
        //		$url = 'https://' . $host . '/bitrix/tools/dolyame_sale_ps_result.php?' . http_build_query($params);
        $url = 'http://' . $host . '/local/api/classes/ST/Payments/Dolyame/dolyame_sale_ps_result.php?' . http_build_query($params);
        return $url;
    }
}

