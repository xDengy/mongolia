<?

namespace ST\Payments;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use GuzzleHttp\Client;

class SberClass {

    public $siteSettings;

    public function __construct() {
        $this->siteSettings = getSiteSettings();
    }

    public function registerOrderInSBER($payment, $email)
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

        $res = $client->request('POST', 'register.do', [
            'headers' => [
                "accept"          => 'application/json',
                "content-type"    => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'userName' => $this->siteSettings["SBERBANK_LOGIN"]["~VALUE"],
                'password' => $this->siteSettings["SBERBANK_PASSWORD"]["~VALUE"],
                'orderNumber' => $payment->getOrderId() . "-x-" . rand(),
                'description' => "Allmongolia | Номер заказа на сайте: {$payment->getOrderId()}",
                'amount' => 100, //$payment->getSum() * 100,
                'email' => $email,
                'returnUrl' => $this->siteSettings["SBERBANK_RETURN_SUCCESS_URL"]["VALUE"]
                    . '?paysystem=sber&siteOrderId=' . $payment->getOrderId(),
                'failUrl' => $this->siteSettings["SBERBANK_RETURN_FAIL_URL"]["VALUE"]
                    . '?paysystem=sber&siteOrderId=' . $payment->getOrderId(),
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
}
