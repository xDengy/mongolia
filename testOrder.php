<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use ST\Order\umaxOrderClass;

$orderClass = new umaxOrderClass();

$orderClass->executeComponent();
