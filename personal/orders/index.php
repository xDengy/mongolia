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

    $fuserID = Fuser::getId();

    $allGoods = \Bitrix\Sale\Order::GetList([
        'filter' => [
            'USER_ID' => $fuserID
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
        <table class="personal-wrap">
            <?if($allGoods):?>
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
            <?else:?>

            <?endif?>
        </table>
    </div>
<?
}
?>
<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');?>
