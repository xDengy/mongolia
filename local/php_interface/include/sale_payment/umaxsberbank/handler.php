<?php

namespace Sale\Handlers\PaySystem;

use Bitrix\Main\Config;
use Bitrix\Main\Error;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Request;
use Bitrix\Main\Result;
use Bitrix\Main\Text\Encoding;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Web\HttpClient;
use Bitrix\Sale\Order;
use Bitrix\Sale\PaySystem;
use Bitrix\Sale\Payment;
use Bitrix\Sale\PriceMaths;

use GuzzleHttp\Client;
use ST\Payments\SberClass;

//Loc::loadMessages(__FILE__);

class UmaxSberbankHandler extends PaySystem\ServiceHandler // implements PaySystem\IRefund //, PaySystem\IHold
{
    public function initiatePay(Payment $payment, Request $request = null)
    {
        $result = new PaySystem\ServiceResult();

        $order = $payment->getOrder();

        $propertyCollection = $order->getPropertyCollection();

        $propUserEmail = $propertyCollection->getUserEmail();

        try {
            $sberClass = new SberClass();

            $sberRes = $sberClass->registerOrderInSBER(
                $payment,
                $propUserEmail
            );
        } catch (\Exception $e) {
            $result->addError(new Error('При оплате произошла ошибка.'));
            return $result;
        }

        $result->setPaymentUrl($sberRes['formUrl']);

        // установка типа операции
        $result->setOperationType('A');

        // получение конфига
//        $this->getBusinessValue($payment, 'PS_CHANGE_STATUS_PAY');

        // триггер ошибкия
//        $result->addError(new Error('blyat'));

//        $result->isSuccess();
//        p($result);
//        exit();

        return $result;
    }

    public function refund(Payment $payment, $refundableSum)
    {
        p('refund', true, '/pay.log');
    }

    public function cancel(Payment $payment)
    {
        p('cancel', true, '/pay.log');
    }

    public function isRefundableExtended()
    {
        p('isRefundableExtended', true, '/pay.log');
        return false;
    }

    public function confirm(Payment $payment)
    {
        p('confirm', true, '/pay.log');
    }

    public function getPaymentIdFromRequest(Request $request)
    {
        p('getPaymentIdFromRequest', true, '/pay.log');
//        $paymentId = $request->get('ORDER');
//
//        $paymentId = preg_replace("/^[0]+/","",$paymentId);
//
//        return intval($paymentId);
    }

    public function getCurrencyList()
    {
        p('getCurrencyList', true, '/pay.log');
        return array('RUB');
    }

    public static function getIndicativeFields()
    {
        p('getIndicativeFields', true, '/pay.log');
        return ['mdOrder', 'orderNumber', 'checksum', 'operation', 'status'];
    }

    static protected function isMyResponseExtended(Request $request, $paySystemId)
    {
        p('isMyResponseExtended', true, '/pay.log');
        return true;
    }

    public function processRequest(Payment $payment, Request $request)
    {
        
    }
}
