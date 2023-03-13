<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

global $USER, $APPLICATION;

use Bitrix\Main\Page\Asset;

use ST\Payments\SberClass;

//use Sale\Handlers\PaySystem\Dolyame\Payment\DolyameHandler;

//Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/cart.css");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/cart.js");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/catalog.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/productcard.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/favourites.css");

$APPLICATION->SetPageProperty("title", "Заказ оформлен");
$APPLICATION->SetTitle("Заказ оформлен");


if (!empty($_GET['paysystem']) && $_GET['paysystem'] === 'sber' && !empty($_GET['orderId']) ) {
    $sberClass = new SberClass();

    $result = $sberClass->checkPayStatus($_GET['orderId']);

    if (intval($result['actionCode']) === 0) {
        $orderID = explode('-x-', $result['orderNumber'])[0];
    } else {
        \LocalRedirect('/cart/order/fail/');
    }
}


//if (!empty($_GET['paysystem']) && $_GET['paysystem'] === 'dolyame' && !empty($_GET['orderId']) ) {
//    $dolyameHandler = new  DolyameHandler();
//
//    $order = \Bitrix\Sale\Order::load($_GET['orderId']);
//    if ($order)
//    {
//        /** @var \Bitrix\Sale\PaymentCollection $paymentCollection */
//        $paymentCollection = $order->getPaymentCollection();
//        if ($paymentCollection > 0)
//        {
//            $payment = $paymentCollection[0];
//
//            $dolyameHandler->processRequest($payment);
//
//            p($dolyameHandler);
//            exit();
//        }
//    }
//}


/*
?>

<? if (!empty($_GET['paysystem']) && $_GET['paysystem'] === 'sber' && !empty($_GET['orderId']) ) { ?>
    <h1>Заказ №<?= $orderID ?>, успешно оплачен</h1>
<? } ?>

<? if (!empty($_GET['paysystem']) && $_GET['paysystem'] === 'upon_receipt' && !empty($_GET['orderId']) ) { ?>
    <h1>Заказ №<?= $_GET['orderId'] ?>, успешно оформлен</h1>
<? } ?>

<? if (!empty($_GET['paysystem']) && $_GET['paysystem'] === 'dolyame' && !empty($_GET['orderId']) ) { ?>
    <h1>Заказ №<?= $_GET['orderId'] ?>, успешно оплачен</h1>
<? } */?>
<div class="wrap">
    <div class="empty-favourites-cards">
        <div class="card__title">
            Спасибо! Ваш заказ оформлен
        </div>
        <div class="card__img">
            <img src="/local/templates/allmongolia_umax/assets/images/order-result.png">
        </div>
        <div class="card__info">
            Посмотреть детали заказа можно <a class="order__link" href="/personal/orders/order/?order_id=<?=$_GET['orderId']?>">здесь</a>
        </div>
        <div class="card__link">
            <a href="/" class="product-items__bottom-item-content-form-btn">
                На главную <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z" fill="black"></path></svg>
            </a>
        </div>
    </div>
</div>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
