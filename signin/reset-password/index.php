<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/fastregistration.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/fastregistration.js");

global $APPLICATION;

$APPLICATION->SetPageProperty("title", "Восстановление пароля");
$APPLICATION->SetTitle("Восстановление пароля");

$siteSettings = getSiteSettings();

$grecaptchaSiteKey = $siteSettings["RECAPTCHA_SITE_KEY"]["VALUE"];
?>

<reset-password-component grecaptcha-site-key='<?= $grecaptchaSiteKey ?>'></reset-password-component>


<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
