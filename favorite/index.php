<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/catalog.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/productcard.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/favourites.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/favourites.js");

$APPLICATION->SetPageProperty("title", "Избранное");
$APPLICATION->SetTitle("Избранное");
?>

<section class="favourites">
    <?
        global $USER;
        $userId = $USER->getId();
    ?>
    <favorites-product-component user-id='<?= $userId ?>'></favorites-product-component>
</section>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
