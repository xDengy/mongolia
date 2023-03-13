<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/cart.css");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/cart.js");

$APPLICATION->SetPageProperty("title", "Корзина");
$APPLICATION->SetTitle("Корзина");

// получение списка товаров для текущего пользователя
//$dbRes = \Bitrix\Sale\Basket::getList([
//    'select' => ['NAME', 'QUANTITY'],
//    'filter' => [
//        '=FUSER_ID' => \Bitrix\Sale\Fuser::getId(),
//        '=ORDER_ID' => null,
//        '=LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
//        '=CAN_BUY' => 'Y',
//    ]
//]);

//$userId = \Bitrix\Sale\Fuser::getId();
//$siteId = \Bitrix\Main\Context::getCurrent()->getSite();
//
//$basket = \Bitrix\Sale\Basket::loadItemsForFUser($userId, $siteId);
//
////while ($item = $dbRes->fetch())
////{
////    p($item);
////}
//
//$basketItem = $basket->getItemById(13);
//
//p($basketItem);

?>

<div class="cart cart-wrap">
    <basket-component />
</div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
