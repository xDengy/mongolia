<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Sale\Fuser;
use Bitrix\Main\Page\Asset;

global $USER, $APPLICATION;

$APPLICATION->SetPageProperty("title", "История Заказов");
$APPLICATION->SetTitle("История Заказов");

if(!$USER->IsAuthorized()) {
    LocalRedirect('/signin/');
} else {

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/fastregistration.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/personal.css");

    $allGoods = \Bitrix\Sale\Order::GetList([
        'filter' => [
            'USER_ID' => $USER->GetId()
        ],
        'order' => [
            'ID' => 'desc'
        ]
    ]);
    $allOrders = [];
    while($order = $allGoods->Fetch()) {
        $order['QUANTITY'] = CSaleBasket::GetList(
            array(),array('ORDER_ID' => $order['ID']),
            false, false,
            array('*')
        )->SelectedRowsCount();
        $allOrders[] = $order;
    }
?>
    <div class="wrapper personal">
        <?if($allOrders):?>
            <table class="personal-wrap">
                <?foreach($allOrders as $key => $order):?>
                    <?
                        $order['FORMATED_PRICE'] = number_format($order['PRICE'], 0, '', ' ') . ' руб.';
                    ?>
                    <tr class="table-head">
                        <td class="text-left pt-3"><a href="order/?order_id=<?=$order['ID']?>">№<?=$order['ID']?></a></td>
                        <td class="text-center pt-3 xs">Количество</td>
                        <td class="text-center pt-3 xs">Всего</td>
                        <td class="text-center pt-3 xs">Добавлено</td>
                    </tr>
                    <tr class="table-body">
                        <td class="text-left table-status-wrapper pt-3 <?if($key < count($allOrders) - 1):?>pb-3<?else:?>pb-3-m<?endif?>">
                            <div class="table-status <?=$order['STATUS_ID']?>">
                                <?switch ($order['STATUS_ID']) {
                                    case 'C':
                                        echo 'Отменен';
                                        break;
                                    case 'N':
                                        echo 'Принят, ожидается оплата';
                                        break;
                                    case 'NF':
                                        echo 'Оплачен, ожидается отправка';
                                        break;
                                    case 'F':
                                        echo 'Выполнен';
                                        break;
                                    default:
                                        # code...
                                        break;
                                }?>
                            </div>
                        </td>
                        <td class="text-center <?if($key < count($allOrders) - 1):?>pb-3<?else:?>pb-3-m<?endif?>">
                            <div class="table-head xs-m">
                                <div class="text-center pt-3 ">Количество</div>
                            </div>
                            <?=$order['QUANTITY']?>
                        </td>
                        <td class="text-center <?if($key < count($allOrders) - 1):?>pb-3<?else:?>pb-3-m<?endif?>">
                            <div class="table-head xs-m">
                                <div class="text-center pt-3 ">Всего</div>
                            </div>
                            <?=$order['FORMATED_PRICE']?>
                        </td>
                        <td class="text-center <?if($key < count($allOrders) - 1):?>pb-3<?else:?>pb-3-m<?endif?>">
                            <div class="table-head xs-m">
                                <div class="text-center pt-3 ">Добавлено</div>
                            </div>
                            <?=explode(' ', $order['DATE_INSERT'])[0]?>
                        </td>
                    </tr>
                    <?if($key < count($allOrders) - 1):?>
                        <tr class="border">
                            <td colspan="4"></td>
                        </tr>
                    <?endif?>
                <?endforeach?>
            </table>
        <?else:?>
            <?
                Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/catalog.css");
                Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/productcard.css");
                Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/favourites.css");
            ?>
            <div class="wrap">
                <div class="empty-favourites-cards">
                    <div class="card__title">
                        Список заказов пуст
                    </div>
                    <div class="card__img">
                        <img src="/local/templates/allmongolia_umax/assets/images/order-result.png">
                    </div>
                    <div class="card__link">
                        <a href="/" class="product-items__bottom-item-content-form-btn">
                            На главную <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z" fill="black"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        <?endif?>
    </div>
<?
}
?>
<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');?>
