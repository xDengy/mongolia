<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use ST\Auth\AuthClass;

global $USER;

$authClass = new AuthClass();

$result = $authClass->logout();

echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit();
