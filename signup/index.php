<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->AddChainItem('Регистрация', '');
if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/fastregistration.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/fastregistration.js");
$APPLICATION->SetPageProperty("title", "Регистрация");
$APPLICATION->SetTitle("Регистрация");

$siteSettings = getSiteSettings();

$grecaptchaSiteKey = $siteSettings["RECAPTCHA_SITE_KEY"]["VALUE"];
?>

<signup-component grecaptcha-site-key='<?= $grecaptchaSiteKey ?>'></signup-component>


<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
