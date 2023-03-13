<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('catalog');

use Bitrix\Sale\Basket;

use ST\Order\umaxOrderClass;

$orderClass = new umaxOrderClass($_POST);

$res = $orderClass->getOrderData();


header('Content-type: application/json');
echo json_encode($res, JSON_UNESCAPED_UNICODE);
