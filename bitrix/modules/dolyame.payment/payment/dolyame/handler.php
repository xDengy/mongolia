<?php

namespace Sale\Handlers\PaySystem;

use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Error;
use Bitrix\Main\Localization;
use Bitrix\Main\Request;
use Bitrix\Sale\Order;
use Bitrix\Sale\Payment;
use Bitrix\Sale\PaySystem;
use Bitrix\Sale\PriceMaths;
use Dolyame\Payment\Client;
use Dolyame\Payment\Helper;

\CModule::IncludeModule("dolyame.payment");

class DolyameHandler extends PaySystem\ServiceHandler
{
	/**
	 * @param Payment $payment
	 * @param Request|null $request
	 * @return PaySystem\ServiceResult
	 */
	public function initiatePay(Payment $payment, Request $request = null)
	{
		$result           = new PaySystem\ServiceResult();
		$paymentShouldPay = number_format(PriceMaths::roundPrecision($payment->getSum()), 2, '.', '');
		$order            = $payment->getCollection()->getOrder();

		$orderItems = $this->getOrderItems($payment);

		$prepaidAmount = \CDolyamePayment::calcPrepaidAmount($paymentShouldPay, $orderItems);

		$data = [
			'order'            => [
				'id'             => $this->getBusinessValue($payment, 'ORDER_NUMBER'),
				'amount'         => $paymentShouldPay,
				'prepaid_amount' => $prepaidAmount,
				'items'          => $orderItems,
			],
			'client_info'      => [
				'first_name' => $this->getFirstName($order),
				'last_name'  => $this->getLastName($order),
				'phone'      => $this->getPhone($order),
				'email'      => $this->getEmail($order),
			],
			'notification_url' => $this->getNotifyUrl($payment),
			'fail_url'         => $this->getFailUrl($payment) . "&orderId=" . $payment->getOrderId(),
			'success_url'      => $this->getSuccessUrl($payment) . "&orderId=" . $payment->getOrderId(),
		];

		if ($this->getBusinessValue($payment, 'FISCALISATION') === 'Y') {
			$data['fiscalization_settings'] = ['type' => 'enabled'];
		}

		if ($this->isPaymentProcessed($payment)) {
			$result->addError(new Error(Localization\Loc::getMessage('DOLYAME.PAYMENT_ALREADY_PAYED')));
			return $result;
		}

		$createResult = $this->createPayment($payment, $data);
		if (!$createResult->isSuccess()) {
			$result->addErrors($createResult->getErrors());
			return $result;
		}

		$paymentData = $createResult->getData();
		$this->saveTransaction($data, $paymentData, $payment);

		if (method_exists($result, "setPaymentUrl")) {
			$result->setPaymentUrl($paymentData['link']);
		}

//		if ($this->needRedirect($payment)) {
//			LocalRedirect($paymentData['link'], true);
//		}

		$this->setExtraParams($paymentData);

//		$showTemplateResult = $this->showTemplate($payment, "template");
//		if ($showTemplateResult->isSuccess()) {
//			$result->setTemplate($showTemplateResult->getTemplate());
//		} else {
//			$result->addErrors($showTemplateResult->getErrors());
//		}

		return $result;
	}

	protected function needRedirect($payment)
	{
		if ($this->getBusinessValue($payment, 'AUTO_REDIRECT') != 'Y') {
			return false;
		}
		if (defined('BX_CRONTAB') && BX_CRONTAB === true) {
			return false;
		}

		$url  = $this->getCurrentUrl();
		$path = parse_url($url, PHP_URL_PATH);
		if ($path == false) {
			return false;
		}
		$exclideList = Option::get('dolyame.payment', 'redirect_exclude_list');
		$exclideList = explode("\n", $exclideList);
		foreach ($exclideList as $url) {
			if (strpos($path, trim($url)) !== false) {
				return false;
			}
		}
		return true;
	}

	protected function isPaymentProcessed(Payment $payment)
	{
		$connection = Application::getConnection();
		$sqlHelper  = $connection->getSqlHelper();
		$id         = $payment->getId();

		$row = $connection
			->query("
						SELECT * FROM dolyame_payment where payment_id='" . $sqlHelper->forSql($id) . "'")
			->fetch();
		return in_array($row['status'], ['wait_for_commit', 'waiting_for_commit', 'committed', 'confirmed']);
	}

	public function getCurrencyList()
	{
		return ['RUB'];
	}

	public static function isMyResponse(Request $request, $paySystemId)
	{
		return $request->get('BX_PAYSYSTEM_CODE') === $paySystemId;
	}

	public function getPaymentIdFromRequest(Request $request)
	{
		return $request->get('BX_PAYMENT_ID');
	}

	public function processRequest(Payment $payment, Request $request)
	{
		$result          = new PaySystem\ServiceResult();
		$orderInfoResult = $this->getOrderInfo($payment);

		if (!$orderInfoResult->isSuccess()) {
			$result->addErrors($orderInfoResult->getErrors());
			return $result;
		}
		$orderInfo = $orderInfoResult->getData();
		$this->updateTransaction($orderInfo, $payment);
		if ($this->needToCommit($payment, $orderInfo)) {
			$commitResult = $this->commitPayment($payment);
			if (!$commitResult->isSuccess()) {
				$result->addErrors($commitResult->getErrors());
				return $result;
			}

            // Если коммит isSuccess, то списываем баллы
		}

		$order = $payment->getCollection()->getOrder();
		if ($this->mustBeMarkedAsCanceled($payment, $orderInfo)) {
			$order->setField("CANCELED", "Y");
			$order->save();
			return $result;
		}

		if ($this->mustBeMarkedAsPaid($payment, $orderInfo)) {
			$description = Localization\Loc::getMessage('DOLYAME.PAYMENT_TRANSACTION') . $orderInfo['id'];

			$fields = array(
				"PS_STATUS_CODE"        => mb_substr($orderInfo['status'], 0, 5),
				"PS_STATUS_DESCRIPTION" => $description,
				"PS_SUM"                => $orderInfo['amount'],
				"PS_STATUS"             => 'Y',
				"PS_RESPONSE_DATE"      => new Main\Type\DateTime(),
			);

            // Обновление статуса заказа
            $arFields = array(
                "STATUS_ID" => "NF",
                "PAYED" => "Y",
                "PS_STATUS_CODE"        => mb_substr($orderInfo['status'], 0, 5),
                "PS_STATUS_DESCRIPTION" => $description,
                "PS_SUM"                => $orderInfo['amount'],
                "PS_STATUS"             => 'Y',
                "PS_RESPONSE_DATE"      => new Main\Type\DateTime(),
            );

            \CSaleOrder::Update($order->getId(), $arFields);

			$result->setOperationType(PaySystem\ServiceResult::MONEY_COMING);

			$result->setPsData($fields);
		}
		return $result;
	}

	protected function mustBeMarkedAsPaid($payment, $orderInfo)
	{
		if (
			$this->getBusinessValue($payment, 'AUTO_COMMIT') === 'N'
			&& (
				$orderInfo['status'] === 'waiting_for_commit'
				|| $orderInfo['status'] === 'wait_for_commit'
			)
		) {
			return true;
		}

		if (
			$this->getBusinessValue($payment, 'AUTO_COMMIT') === 'Y'
			&& $orderInfo['status'] === 'committed'
			&& empty($orderInfo['refund_info'])) {
			return true;
		}
		return false;
	}

	protected function mustBeMarkedAsCanceled($payment, $orderInfo)
	{
		if ($this->getBusinessValue($payment, 'AUTO_CANCEL') !== 'Y') {
			return false;
		}
		$order = $payment->getCollection()->getOrder();
		if ($order->isPaid()) {
			return false;
		}
		if ($orderInfo['status'] === 'rejected') {
			return true;
		}
		if ($orderInfo['status'] === 'canceled') {
			return true;
		}
		return false;
	}

	protected function needToCommit($payment, $orderInfo)
	{
		if ($this->getBusinessValue($payment, 'AUTO_COMMIT') === 'N') {
			return false;
		}
		if ($orderInfo['status'] === 'waiting_for_commit') {
			return true;
		}
		if ($orderInfo['status'] === 'wait_for_commit') {
			return true;
		}
		return false;
	}

	public function sendResponse(PaySystem\ServiceResult $result, Request $request)
	{
		global $APPLICATION;
		if (!$result->isSuccess()) {
			$APPLICATION->RestartBuffer();
			header("HTTP/1.1 500 " . $result->getErrorMessages()[0]);
		}
		return '';
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
				$item            = array_merge($item, $this->getProductReceiptData($payment, $basketItem));
				$items[$itemKey][] = $item;
			}
			if ($shipment->getPrice() && !$shipment->isSystem()) {
				$deliveryItem = array(
					"name"     => $shipment->getDeliveryName(),
					"quantity" => 1,
					"price"    => number_format(PriceMaths::roundPrecision($shipment->getPrice()), 2, '.', ''),
				);
				$deliveryItem = array_merge($deliveryItem, $this->getDeliveryReceiptData($payment, $shipment));
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

	protected function getProductReceiptData(Payment $payment, $basketItem)
	{
		if ($this->getBusinessValue($payment, 'FISCALISATION') !== 'Y') {
			return [];
		}

		$productTax = $this->getBusinessValue($payment, 'PRODUCT_NDS');

		$receipt = [
			'payment_method' => $this->getBusinessValue($payment, 'PAYMENT_MODE'),
			'tax'            => $productTax ? $productTax : $this->getProductTax($basketItem),
		];
		if ($this->getBusinessValue($payment, 'FISCALISATION_FFD12') === 'Y') {
			$receipt['payment_object']   = $this->getBusinessValue($payment, 'PAYMENT_SUBJECT');
			$receipt['measurement_unit'] = Localization\Loc::getMessage(Helper::getMeasureCode($basketItem));
		}
		return ['receipt' => $receipt];
	}

	protected function getDeliveryReceiptData(Payment $payment, $item)
	{
		if ($this->getBusinessValue($payment, 'FISCALISATION') !== 'Y') {
			return [];
		}
		$deliveryTax = $this->getBusinessValue($payment, 'DELIVERY_NDS');

		$receipt = [
			'payment_method' => $this->getBusinessValue($payment, 'PAYMENT_MODE'),
			'tax'            => $deliveryTax ? $deliveryTax : $this->getDeliveryTax($item),
		];
		if ($this->getBusinessValue($payment, 'FISCALISATION_FFD12') === 'Y') {
			$receipt['payment_object']   = $this->getBusinessValue($payment, 'PAYMENT_SUBJECT_DELIVERY');
			$receipt['measurement_unit'] = Localization\Loc::getMessage('DOLYAME.PAYMENT_MEASURE_UNIT');
		}
		return ['receipt' => $receipt];
	}

	protected function getProductTax($basketItem)
	{
		if (\Bitrix\Main\Loader::includeModule('catalog')) {
			$dbRes  = \CCatalogProduct::GetVATInfo($basketItem->getProductId());
			$ndsArr = $dbRes->Fetch();
			$taxId  = $this->convertVatId($ndsArr['ID']);
			return $taxId;
		}
		return 'none';
	}

	protected function getDeliveryTax($basketItem)
	{
		$delivery = \Bitrix\Sale\Delivery\Services\Manager::getById($basketItem->getDeliveryId());
		if (is_null($delivery['VAT_ID'])) {
			return 'none';
		}
		return $this->convertVatId($delivery['VAT_ID']);
	}

	public static function convertVatId($vat_id)
	{
		$ndsArr = \CCatalogVat::GetByID($vat_id)->Fetch();
		if ($ndsArr['NAME'] == Localization\Loc::getMessage('DOLYAME.PAYMENT_NO_NDS')) {
			$taxId = 'none';
		} else {
			$rate        = intval($ndsArr['RATE']);
			$vatIncluded = !isset($ndsArr['VAT_INCLUDED']) || $ndsArr['VAT_INCLUDED'] == 'Y';
			switch ($rate) {
				case 20:
					if (!$vatIncluded) {
						$taxId = 'vat120';
					} else {
						$taxId = 'vat20';
					}

					break;
				case 10:
					if (!$vatIncluded) {
						$taxId = 'vat110';
					} else {
						$taxId = 'vat10';
					}
					break;
				case 0:$taxId = 'vat0';
					break;
				default:$taxId = 'none';
					break;
			}
		}
		return $taxId;
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

	protected function getFailUrl(Payment $payment)
	{
		$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
		$failUrl = $this->getBusinessValue($payment, 'FAIL_URL');
		if (!$failUrl) {
			$failUrl = 'https://' . $request->getHttpHost() . '/bitrix/tools/sale_ps_fail.php';
		}

		$failUrl = $this->replaceIdPlaceholders($payment, $failUrl);

		return $failUrl;
	}

	protected function getSuccessUrl(Payment $payment)
	{
		$request    = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
		$successUrl = $this->getBusinessValue($payment, 'SUCCESS_URL');
		if (!$successUrl) {
			$successUrl = 'https://' . $request->getHttpHost() . '/bitrix/tools/sale_ps_success.php';
		}

		$successUrl = $this->replaceIdPlaceholders($payment, $successUrl);

		return $successUrl;
	}

	protected function replaceIdPlaceholders($payment, $link)
	{
		$replace = [
			'#ID#'           => $payment->getId(),
			'#ORDER_ID#'     => $payment->getCollection()->getOrder()->getId(),
			'#ORDER_NUMBER#' => $this->getBusinessValue($payment, 'ORDER_NUMBER'),
		];
		$link = str_replace(array_keys($replace), array_values($replace), $link);
		return $link;
	}

	protected function createPayment(Payment $payment, $data)
	{
		$result = new PaySystem\ServiceResult();

		$api = $this->initApi($payment);
		try {
			$data['order']['id'] = Client::prepareOrderId($data['order']['id']);
			$data                = Main\Web\Json::encode($data, JSON_UNESCAPED_UNICODE);
			$response            = $api->create($data);
			$result->setData($response);
		} catch (\Exception $e) {
			$result->addError(new Error($e->getMessage()));
		}
		return $result;
	}

	protected function getOrderInfo(Payment $payment)
	{
		$result = new PaySystem\ServiceResult();

		$api = $this->initApi($payment);

		try {
			$response = $api->info($this->getBusinessValue($payment, 'ORDER_NUMBER'));
			$result->setData($response);
		} catch (\Exception $e) {
			$result->addError(new Error('Order info error: ' . $e->getMessage()));
		}
		return $result;
	}

	protected function commitPayment(Payment $payment)
	{
		$connection = Application::getConnection();
		$sqlHelper  = $connection->getSqlHelper();
		$result     = new PaySystem\ServiceResult();

		$api = $this->initApi($payment);

		$paymentShouldPay = number_format(PriceMaths::roundPrecision($payment->getSum()), 2, '.', '');

		$row = $connection
			->query("
						SELECT * FROM dolyame_payment where payment_id='" . $sqlHelper->forSql($payment->getId()) . "'")
			->fetch();

		$orderItems = Main\Web\Json::decode($row['items']);

		$prepaidAmount = \CDolyamePayment::calcPrepaidAmount($paymentShouldPay, $orderItems);

		$data = [
			'amount'         => $paymentShouldPay,
			'items'          => $orderItems,
			'prepaid_amount' => $prepaidAmount,
		];

		try {
			$data     = Main\Web\Json::encode($data, JSON_UNESCAPED_UNICODE);
			$response = $api->commit($this->getBusinessValue($payment, 'ORDER_NUMBER'), $data);
			$result->setData($response);
		} catch (\Exception $e) {
			$result->addError(new Error('Commit error: ' . $e->getMessage()));
		}
		return $result;
	}

	protected function getPhone(Order $order)
	{
		$phone = '';
		try {
			if ($propUserPhone = $order->getPropertyCollection()->getPhone()) {
				$phone = $propUserPhone->getValue();
			}
		} catch (\Exception $e) {
			return '';
		}

		$phone = preg_replace("#[^\d]#", "", $phone);
		if (!preg_match("#[7|8]{0,1}(\d{10})#", $phone, $match)) {
			return '';
		}
		return '+7' . $match[1];
	}

	protected function getFirstName(Order $order)
	{
		$name = '';
		try {
			if ($prop = $order->getPropertyCollection()->getPayerName()) {
				$name = $prop->getValue();
			}
		} catch (\Exception $e) {
			return '';
		}
		$name     = explode(' ', $name);
		$position = 0;
		if (count($name) > 1) {
			$position = 1;
		}
		return $name[$position];
	}

	protected function getLastName(Order $order)
	{
		$name = '';
		try {
			if ($prop = $order->getPropertyCollection()->getPayerName()) {
				$name = $prop->getValue();
			}
		} catch (\Exception $e) {
			return '';
		}
		$name = explode(' ', $name);
		if (count($name) < 2) {
			return '';
		}
		return $name[0];
	}

	protected function getEmail(Order $order)
	{
		$email = '';
		try {
			if ($prop = $order->getPropertyCollection()->getUserEmail()) {
				$email = $prop->getValue();
			}
		} catch (\Exception $e) {
			return '';
		}
		return $email;
	}

	protected function saveTransaction(array $data, array $paymentData, Payment $payment)
	{
		$connection      = Main\Application::getConnection();
		$sqlHelper       = $connection->getSqlHelper();
		$paymentSchedule = isset($paymentData['payment_schedule']) ? $paymentData['payment_schedule'] : null;

		$data = [
			'id'               => Client::prepareOrderId($data['order']['id']),
			'order_number'     => $data['order']['id'],
			'order_id'         => $payment->getCollection()->getOrder()->getId(),
			'payment_id'       => $payment->getId(),
			'status'           => $paymentData['status'],
			'items'            => Main\Web\Json::encode($data['order']['items'], JSON_UNESCAPED_UNICODE),
			'date'             => new Main\Type\DateTime(),
			'amount'           => $data['order']['amount'],
			'payment_schedule' => Main\Web\Json::encode($paymentSchedule),
		];

		$tableName = 'dolyame_payment';

		$insert = $sqlHelper->prepareInsert($tableName, $data);

		$sql =
		"REPLACE INTO " . $sqlHelper->quote($tableName) . "(" . $insert[0] . ") " .
			"VALUES (" . $insert[1] . ")";

		$connection->queryExecute($sql);
	}

	protected function updateTransaction(array $orderInfo, Payment $payment)
	{
		$connection      = Main\Application::getConnection();
		$sqlHelper       = $connection->getSqlHelper();
		$paymentSchedule = isset($orderInfo['payment_schedule']) ? $orderInfo['payment_schedule'] : null;
		$paymentSchedule = json_encode($paymentSchedule);
		if (!empty($orderInfo['refund_info'])) {
			$orderInfo['status'] = 'refunded';
		}
		$connection->query("UPDATE dolyame_payment set status='" . $sqlHelper->forSql($orderInfo['status']) . "',
			payment_schedule='" . $sqlHelper->forSql($paymentSchedule) . "' where payment_id=" . $payment->getId());
	}

	protected function initApi(Payment $payment)
	{
		$login    = $this->getBusinessValue($payment, 'SHOP_NAME');
		$password = $this->getBusinessValue($payment, 'SHOP_PASSWORD');

		$api = new Client($login, $password);
		$api->setCertPath(realpath($_SERVER["DOCUMENT_ROOT"]) . '/' . $this->getBusinessValue($payment, 'CERT_PATH'));
		$api->setKeyPath(realpath($_SERVER["DOCUMENT_ROOT"]) . '/' . $this->getBusinessValue($payment, 'KEY_PATH'));
		$api->setLogger($this);
		if (Option::get('dolyame.payment', 'use_file_handler')) {
			$api->useFileRequestHandler();
		}
		return $api;
	}

	protected function getCurrentUrl()
	{
		$request    = Application::getInstance()->getContext()->getRequest();
		$host       = $request->getHttpHost();
		$requestUri = $request->getRequestUri();

		return ($request->isHttps() ? "https://" : "http://") . $host . $requestUri;
	}

	public function info($message)
	{
		if (class_exists('Bitrix\Sale\PaySystem\Logger')) {
			\Bitrix\Sale\PaySystem\Logger::addDebugInfo('Dolyame: ' . $message);
		}
	}

}
