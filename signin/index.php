<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/entrance.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/fastregistration.js");

global$APPLICATION;

//$APPLICATION->AddChainItem('Авторизация', '');
$APPLICATION->SetPageProperty("title", "Авторизация");
$APPLICATION->SetTitle("Авторизация");

$siteSettings = getSiteSettings();

$grecaptchaSiteKey = $siteSettings["RECAPTCHA_SITE_KEY"]["VALUE"];
?>

<signin-component grecaptcha-site-key='<?= $grecaptchaSiteKey ?>'></signin-component>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
