<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

$siteId = \Bitrix\Main\Context::getCurrent()->getSite();

$basketItems = \Bitrix\Sale\Basket::loadItemsForFUser(
    \CSaleBasket::GetBasketUserID(),
    $siteId
)
    ->getOrderableItems();

if (count($basketItems) == 0) {
    \LocalRedirect('/cart/');
}

global $USER, $APPLICATION;

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/cart.css");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/cart.js");

$APPLICATION->SetPageProperty("title", "Оформление заказа");
$APPLICATION->SetTitle("Оформление заказа");

$userAr = CUser::GetById($USER->GetId())->GetNext();

if (!empty($userAr)) {
    $userAr['PHONE_NUMBER'] = \Bitrix\Main\UserPhoneAuthTable::GetList([
        'filter' => [
            'USER_ID' => $USER->GetId()
        ]
    ])->Fetch()['PHONE_NUMBER'];
}

$siteSettings = getSiteSettings();

$grecaptchaSiteKey = $siteSettings["RECAPTCHA_SITE_KEY"]["VALUE"];
$dadataToken = $siteSettings["DADATA_TOKEN"]["VALUE"];

$session = \Bitrix\Main\Application::getInstance()->getSession();

//p($session);
?>

<div class="cart cart-wrap">
    <order-component
            grecaptcha-site-key='<?= $grecaptchaSiteKey ?>'
            dadata-token='<?= $dadataToken ?>'
            :user-data='<?= json_encode($userAr) ?>'
            coupon='<?= $session["coupon"] ?>'
            coupon-bonus='<?= $session["couponBonuses"] ?>'
    />
</div>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
