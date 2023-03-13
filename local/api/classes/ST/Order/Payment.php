<?php

namespace ST\Order;


use Bitrix\Sale\Order;
use Bitrix\Sale;

class Payment
{
    /**
     * Возвращает доступные способы оплаты
     *
     * @param $payment_collection
     * @param $payment_sum
     * @param $payment_currency
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ArgumentOutOfRangeException
     * @throws \Bitrix\Main\NotImplementedException
     * @throws \Bitrix\Main\ObjectException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getAvailablePayments($payment_collection, $payment_sum, $payment_currency)
    {
        $payment = \Bitrix\Sale\Payment::create($payment_collection);
        $payment->setField('SUM', $payment_sum);
        $payment->setField("CURRENCY", $payment_currency);

        return \Bitrix\Sale\PaySystem\Manager::getListWithRestrictions($payment);
    }

    /**
     * Представление способов оплат в виде массива
     *
     * @param $payments
     * @return array
     */
    public static function paymentListToArray($payments, $price)
    {
//        if($price < 350) {
//            $payments = array_values($payments);
//            foreach ($payments as $k => $payment) {
//                if ($payment['PAY_SYSTEM_ID'] == 2) {
//                    $keyForUnset = $k;
//                }
//            }
//            unset($payments[$keyForUnset]);
//        }

        foreach ($payments as $k => $payment) {
            $payments[$k]['LOGOTIP_SRC'] = \CFile::GetPath($payment['LOGOTIP']);
        }

        return array_values($payments);
    }

    /**
     * Валидация оплаты
     *
     * @param Order $order
     * @return array
     */
    public static function validatePayment(Order $order): array
    {
        $errors = [];

        if (!$order->getPaymentCollection()->isEmpty()) {
            $payment = $order->getPaymentCollection()->current();

            $obPaySystem = $payment->getPaySystem();
            if ($obPaySystem instanceof \Bitrix\Sale\PaySystem\Service) {
                try {
                    $availablePaySystems = \Bitrix\Sale\PaySystem\Manager::getListWithRestrictions($payment);
                    if (!isset($availablePaySystems[$payment->getPaymentSystemId()])) {
                        $errors[] = 'Тип оплаты '.$payment->getPaymentSystemName(). ' недоступен';
                    }
                } catch (\Exception $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = 'Необходимо выбрать тип оплаты';
            }
        } else {
            $errors[] = 'Необходимо выбрать тип оплаты';
        }

        return $errors;
    }

    public static function initializePayment($order)
    {
        if ($order)
        {
//            /** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
            $paymentCollection = $order->getPaymentCollection();

            if ($paymentCollection > 0)
            {
                $payment = $paymentCollection[0];

                $service = Sale\PaySystem\Manager::getObjectById($payment->getPaymentSystemId());
                $context = \Bitrix\Main\Application::getInstance()->getContext();
                $res = $service->initiatePay($payment, $context->getRequest());

                if ($res->isSuccess())
                {
                    return $res->getPaymentUrl();
                }
            }
        }

        return false;
    }
}
