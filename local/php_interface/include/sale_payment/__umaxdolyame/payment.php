<?
//if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$entityId = CSalePaySystemAction::GetParamValue("ORDER_PAYMENT_ID");

list($orderId, $paymentId) = \Bitrix\Sale\PaySystem\Manager::getIdsByPayment(29);

p([$orderId, $paymentId]);
exit();

if ($orderId > 0)
{
	/** @var \Bitrix\Sale\Order $order */
	$order = \Bitrix\Sale\Order::load($orderId);
	if ($order)
	{
		/** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
		$paymentCollection = $order->getPaymentCollection();
		if ($paymentCollection && $paymentId > 0)
		{
			/** @var \Bitrix\Sale\Payment $payment */
			$payment = $paymentCollection->getItemById($paymentId);
			if ($payment)
			{
				$service = \Bitrix\Sale\PaySystem\Manager::getObjectById($payment->getPaymentSystemId());
				if ($service)
					$service->initiatePay($payment);
			}
		}
	}
}
