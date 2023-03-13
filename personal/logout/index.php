<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Page\Asset;

global $USER, $APPLICATION;

$APPLICATION->SetPageProperty("title", "Выход");
$APPLICATION->SetTitle("Выход");

if ($USER->IsAuthorized()) {
    $USER->Logout();
    LocalRedirect('/', false, '301 Moved permanently');
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
