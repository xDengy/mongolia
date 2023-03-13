<?php
use \Bitrix\Main;
use \Bitrix\Main\Application;
use \Bitrix\Main\Error;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Sale\Order;
use \Bitrix\Sale\Result;
use \Dolyame\Payment\Client;
use \Bitrix\Main\Config\Option;

$arClasses = array(
	'Dolyame\Payment\Client' => 'lib/Client.php',
	'Dolyame\Payment\Helper' => 'lib/Helper.php',
	'Dolyame\Payment\MeasureCodeToStringMapper' => 'lib/Measurecodetostringmapper.php',
);

CModule::AddAutoloadClasses("dolyame.payment", $arClasses);

class CDolyamePayment
{
	public static function getTransactionList($filter, $sort = [])
	{
		$connection = Application::getConnection();
		$sqlHelper  = $connection->getSqlHelper();

		$byOrder = [];
		if (!empty($sort)) {
			foreach ($sort as $by => $order) {
				$order = mb_strtolower($order);
				if ($order != 'asc') {
					$order = 'desc';
				}
				if ($by == 'order_number') {
					$by = "LENGTH(order_number) $order, order_number";
				}
				$byOrder[] = "$by $order";
			}
			$byOrder = implode(',', $byOrder);
		} else {
			$byOrder = 'order_id desc, `date` desc';
		}

		$where = array();
		foreach ($filter as $key => $item) {
			$where[] = "$key= '" . $sqlHelper->forSql($item) . "'";
		}

		if ($where) {
			$where = 'WHERE ' . implode(" AND ", $where);
		} else {
			$where = '';
		}
		$sql = "
			SELECT *
			FROM dolyame_payment
			$where order by $byOrder";
		$dbRes = $connection->query($sql);
		return $dbRes;
	}

	public static function getOrderItems($id)
	{
		$connection = Application::getConnection();
		$sqlHelper  = $connection->getSqlHelper();

		$row = $connection
			->query("
						SELECT * FROM dolyame_payment where id='" . $sqlHelper->forSql($id) . "'")
			->fetch();
		if (!$row) {
			return false;
		}

		$items = Main\Web\Json::decode($row['items']);
		return $items;
	}

	public static function processAction($post)
	{
		$result = new Result();

		if (!isset($post['action'])) {
			return $result->addError(new Error(Loc::getMessage('DOLYAME.PAYMENT_ERROR_EMPTY_ACTION')));
		}

		$connection = Application::getConnection();
		$sqlHelper  = $connection->getSqlHelper();
		$orderData  = $connection
			->query("
						SELECT * FROM dolyame_payment WHERE id='" . $sqlHelper->forSql($post['id']) . "'")
			->fetch();
		if (!$orderData) {
			return $result->addError(new Error(Loc::getMessage('DOLYAME.PAYMENT_ERROR_ORDER_NOT_FOUND')));
		}

		$order = Order::load($orderData['order_id']);
		if (!$order) {
			return $result->addError(new Error(Loc::getMessage('DOLYAME.PAYMENT_ERROR_ORDER_LOAD')));
		}

		$payment = $order
			->getPaymentCollection()
			->getItemById($orderData['payment_id']);
		if (!$payment) {
			return $result->addError(new Error(Loc::getMessage('DOLYAME.PAYMENT_ERROR_PAYMENT_NOT_FOUND')));
		}

		$params = $payment
			->getPaySystem()
			->getParamsBusValue($payment);

		if ($post['action'] == 'refund') {
			$result = self::refundOrder($params, $post);
			if ($result->isSuccess()) {
				$paymentData = $result->getData();
				self::saveRefundId($post['id'], $paymentData['refund_id']);
				self::updateTransactionStatus($post['id'], 'refunded');
				$payment->setPaid('N');
				$psData      = [
					"PS_STATUS_CODE"        => 'refun',
					"PS_STATUS_DESCRIPTION" => 'Refund id:' . $paymentData['refund_id'],
					"PS_SUM"                => $paymentData['amount'],
					"PS_RESPONSE_DATE"      => new Bitrix\Main\Type\DateTime(),
				];
				if ($paymentData['amount']) {
					$psData["SUM"]       = $paymentData['amount'];
					$psData["PAID"]      = 'Y';
					$psData["PS_STATUS"] = 'Y';
				}

				$payment->setFields($psData);
				$order->save();
			}
		}
		if ($post['action'] == 'commit') {
			$result = self::commitOrder($params, $post);
			if ($result->isSuccess()) {
				$paymentData = $result->getData();
				self::updateTransactionStatus($post['id'], 'committed');
				self::updateTransactionData($post['id'], 'amount', $paymentData['amount']);
				self::updateTransactionData($post['id'], 'items', Main\Web\Json::encode($paymentData['items'], JSON_UNESCAPED_UNICODE));
				$psData      = [
					"PS_STATUS_CODE"        => 'commi',
					"PS_SUM"                => $paymentData['amount'],
					"PS_RESPONSE_DATE"      => new Bitrix\Main\Type\DateTime(),
				];
				if ($paymentData['amount']) {
					$payment->setPaid('N');
					$psData["SUM"]       = $paymentData['amount'];
					$psData["PAID"]      = 'Y';
					$psData["PS_STATUS"] = 'Y';
				}

				$payment->setFields($psData);
				$order->save();
			}
		}
		return $result;
	}

	public static function refundOrder($params, $post)
	{
		$result = new Result();

		$api = new Client($params['SHOP_NAME'], $params['SHOP_PASSWORD']);

		$api->setCertPath($_SERVER["DOCUMENT_ROOT"] . '/' . $params['CERT_PATH']);
		$api->setKeyPath($_SERVER["DOCUMENT_ROOT"] . '/' . $params['KEY_PATH']);
		if (Option::get('dolyame.payment', 'use_file_handler')) {
			$api->useFileRequestHandler();
		}

		$data = self::prepareRefundData($post);
		if ($params['FISCALISATION'] === 'Y') {
			$data['fiscalization_settings'] = ['type' => 'enabled'];
		}

		$errorMessage = '';

		try {
			$data = Main\Web\Json::encode($data, JSON_UNESCAPED_UNICODE);
			$response = $api->refund($params['ORDER_NUMBER'], $data);
			$result->setData($response);
		} catch (\Exception $e) {
			$errorMessage = $e->getMessage();
			if ($e->getCode() != 422) {
				$result->addError(new Error($errorMessage));
				return $result;
			}
			$result = self::getTransactionInfo($api, $params['ORDER_NUMBER']);
		}

		return $result;
	}

	public static function commitOrder($params, $post)
	{
		$result = new Result();

		$api = new Client($params['SHOP_NAME'], $params['SHOP_PASSWORD']);

		$api->setCertPath($_SERVER["DOCUMENT_ROOT"] . '/' . $params['CERT_PATH']);
		$api->setKeyPath($_SERVER["DOCUMENT_ROOT"] . '/' . $params['KEY_PATH']);
		if (Option::get('dolyame.payment', 'use_file_handler')) {
			$api->useFileRequestHandler();
		}

		$data = self::prepareCommitData($post);
		if ($params['FISCALISATION'] === 'Y') {
			$data['fiscalization_settings'] = ['type' => 'enabled'];
		}

		$errorMessage = '';

		try {
			$dataEncoded = Main\Web\Json::encode($data, JSON_UNESCAPED_UNICODE);
			$response = $api->commit($params['ORDER_NUMBER'], $dataEncoded);
			$response['amount'] = $data['amount'];
			$response['items'] = $data['items'];
			$result->setData($response);
		} catch (\Exception $e) {
			$errorMessage = $e->getMessage();
			if ($e->getCode() != 422) {
				$result->addError(new Error($errorMessage));
				return $result;
			}
			$result = self::getTransactionInfo($api, $params['ORDER_NUMBER']);
		}

		return $result;
	}

	public function getTransactionInfo($api, $orderId)
	{
		$result = new Result();
		try{
			$info = $api->info($orderId);
		} catch (\Exception $e) {
			$result->addError(new Error($e->getMessage()));
			return $result;
		}
		if(empty($info['refund_info'])) {
			$result->addError(new Error($errorMessage));
			return $result;
		}
		$result->setData([
			'refund_id' => $info['refund_info']['items'][0]['refund_id'],
			'amount'    => $info['amount'] - $info['refund_info']['total_refunded_amount']
		]);
		return $result;
	}

	public static function prepareRefundData($post)
	{
		$refundableSum = 0;
		$refundItems   = [];
		foreach ($post['position'] as $position) {
			$refundableSum += $post['price'][$position] * $post['quantity'][$position];
			$item = [
				"name"     => $post['name'][$position],
				"quantity" => $post['quantity'][$position],
				"price"    => $post['price'][$position],
			];
			if (!empty($post['sku'][$position])) {
				$item['sku'] = $post['sku'][$position];
			}
			if (!empty($post['receipt'][$position])) {
				$item['receipt'] = Main\Web\Json::decode($post['receipt'][$position]);
			}
			$refundItems[] = $item;
		}

		$refundableSum -= $post['refunded_prepaid_amount'];

		$data = [
			'amount'                  => number_format($refundableSum, 2, '.', ''),
			'returned_items'          => $refundItems,
			'refunded_prepaid_amount' => $post['refunded_prepaid_amount'],
		];
		return $data;
	}

	public static function prepareCommitData($post)
	{
		$sum = 0;
		$items   = [];
		foreach ($post['position'] as $position) {
			$sum += $post['price'][$position] * $post['quantity'][$position];
			$item = [
				"name"     => $post['name'][$position],
				"quantity" => $post['quantity'][$position],
				"price"    => $post['price'][$position],
			];
			if (!empty($post['sku'][$position])) {
				$item['sku'] = $post['sku'][$position];
			}
			if (!empty($post['receipt'][$position])) {
				$item['receipt'] = Main\Web\Json::decode($post['receipt'][$position]);
			}
			$items[] = $item;
		}

		$sum -= $post['refunded_prepaid_amount'];

		$data = [
			'amount'         => number_format($sum, 2, '.', ''),
			'items'          => $items,
			'prepaid_amount' => $post['refunded_prepaid_amount'],
		];
		return $data;
	}

	public static function calcPrepaidAmount($amount, $items)
	{
		$itemsSum = array_reduce($items, function($carry, $item){
			$carry += $item['price'] * $item['quantity'];
			return $carry;
		});
		$diff = $itemsSum - $amount;
		return number_format($diff, 2, '.', '');
	}

	public static function updateTransactionStatus($id, $status)
	{
		$connection = Application::getConnection();
		$sqlHelper  = $connection->getSqlHelper();
		$connection->query("UPDATE dolyame_payment SET status='" . $sqlHelper->forSql($status) . "' WHERE id='" . $sqlHelper->forSql($id) . "'");
	}

	public static function saveRefundId($id, $refundId)
	{
		$connection = Application::getConnection();
		$sqlHelper  = $connection->getSqlHelper();
		$connection->query("UPDATE dolyame_payment SET refund_id='" . $sqlHelper->forSql($refundId) . "' WHERE id='" . $sqlHelper->forSql($id) . "'");
	}

	public static function updateTransactionData($id, $field, $value)
	{
		$connection = Application::getConnection();
		$sqlHelper  = $connection->getSqlHelper();
		$connection->query("UPDATE dolyame_payment SET ".$sqlHelper->quote($field)."='" . $sqlHelper->forSql($value) . "' WHERE id='" . $sqlHelper->forSql($id) . "'");
	}
}
