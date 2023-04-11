<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');?>
<?
use Bitrix\Sale\Fuser;
use Bitrix\Main\Page\Asset;
use ST\Order\Payment;

global $USER, $APPLICATION;

if(!$USER->GetId()) {
    LocalRedirect('/signin/');
} else {
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/fastregistration.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/personal.css");

    $order = \Bitrix\Sale\Order::GetList([
        'filter' => [
            'ID' => $_GET['order_id'],
            'USER_ID' => $USER->GetId()
        ],
    ])->Fetch();

    if($order) {
        $APPLICATION->SetPageProperty("title", "Заказ №" .  $_GET['order_id']);
        $APPLICATION->SetTitle("Заказ №" .  $_GET['order_id']);
        
        $order['QUANTITY'] = CSaleBasket::GetList(
            array(),array('ORDER_ID' => $order['ID']),
            false, false,
            array('*')
        )->SelectedRowsCount();
        $order['ORDER_PROPS'] = [];
        $obOrderProps = CSaleOrderPropsValue::GetOrderProps($order['ID']);
        while($orderProp = $obOrderProps->Fetch()) {
            $order['ORDER_PROPS'][$orderProp['CODE']] = $orderProp;
        }
        $order['ITEMS'] = [];
        $items = CSaleBasket::GetList(
            array(),array('ORDER_ID' => $order['ID']),
            false, false,
            array('*')
        );
        $discount = 0;
        while($item = $items->Fetch()) {
            if($item['DISCOUNT_PRICE'] > 0) {
                $discount += $item['DISCOUNT_PRICE'];
            }
            $prodData = CIBlockElement::GetByID($item['PRODUCT_ID']);
            $product = [];
            while($prod = $prodData->GetNextElement()) {
                $product = $prod->GetFields();
                $product['PROPERTIES'] = $prod->GetProperties();
            }

            $order['ITEMS'][] = [
                'BASKET_DATA' => $item,
                'PRODUCT' => $product
            ];
        }
        $order['PAY_SYSTEM_NAME'] = \Bitrix\Sale\PaymentCollection::getList([
            'select' => ['*'],
            'filter' => [
                '=ORDER_ID' => $order['ID'],
            ]
        ])->Fetch()['PAY_SYSTEM_NAME'];
        $order['DELIVERY_NAME'] = \Bitrix\Sale\ShipmentCollection::getList([
            'select' => ['*'],
            'filter' => [
                '=ORDER_ID' => $order['ID'],
            ]
        ])->Fetch()['DELIVERY_NAME'];
    } else {
        require($_SERVER['DOCUMENT_ROOT'] . '/404.php');
    }
?>
    <div class="wrapper order-detail personal">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td class="text-left" colspan="2">Детали заказа</td>
                </tr>
            </thead>
            <tbody>
                <tr class="order-info">
                    <td class="text-left">
                        <b>№ Заказа:</b> #<?=$order['ID']?><br>
                        <b>Добавлено:</b> <?=explode(' ', $order['DATE_INSERT'])[0]?>
                    </td>
                    <td class="text-left">
                        <b>Способ оплаты:</b> <?=$order['PAY_SYSTEM_NAME']?><br>
                        <b>Способ доставки:</b> <?=$order['DELIVERY_NAME']?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?if($order['ORDER_PROPS']['ADDRESS']['VALUE']):?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-left" style="vertical-align: top;">Адрес доставки</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left"><?=$order['ORDER_PROPS']['ADDRESS']['VALUE']?></td>
                    </tr>
                </tbody>
            </table>
        <?endif?>
        <div class="table table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                    <td class="text-left">Название товара</td>
                    <td class="text-right">Количество</td>
                    <td class="text-right">Цена</td>
                    <td class="text-right">Всего</td>
                    </tr>
                </thead>
                <tbody>
                    <?foreach($order['ITEMS'] as $item):?>
                        <tr>
                            <td class="text-left product-link">
                                <a href="<?=$item['BASKET_DATA']['DETAIL_PAGE_URL']?>"><?=$item['BASKET_DATA']['NAME']?></a>
                            </td>
                            <td class="text-right"><?=$item['BASKET_DATA']['QUANTITY']?></td>
                            <td class="text-right"><?=number_format($item['BASKET_DATA']['PRICE'], 0, '', ' ')?>р.</td>
                            <td class="text-right"><?=number_format($item['BASKET_DATA']['PRICE'] * $item['BASKET_DATA']['QUANTITY'], 0, '', ' ')?>р.</td>
                        </tr>
                    <?endforeach?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td class="text-right"><b>Сумма</b></td>
                        <td class="text-right"><?=number_format(intval($order['PRICE']) - intval($order['PRICE_DELIVERY']), 0, '', ' ')?>р.</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td class="text-right"><b>Доставка</b></td>
                        <td class="text-right"><?=number_format($order['PRICE_DELIVERY'], 0, '', ' ')?>р.</td>
                    </tr>
                    <?if($order['ORDER_PROPS']['BONUSES']['VALUE']):?>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-right"><b>Списано баллами</b></td>
                            <td class="text-right"><?=number_format($order['ORDER_PROPS']['BONUSES']['VALUE'], 0, '', ' ')?>р.</td>
                        </tr>
                    <?endif?>
                    <?if($discount > 0):?>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-right"><b>Скидка</b></td>
                            <td class="text-right"><?=number_format($discount, 0, '', ' ')?>р.</td>
                        </tr>
                    <?endif?>
                    <tr>
                        <td colspan="2"></td>
                        <td class="text-right"><b>Итого</b></td>
                        <td class="text-right"><?=number_format($order['PRICE'], 0, '', ' ')?>р.</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?if($order['USER_DESCRIPTION']):?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-left">Комментарий</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left"><?=$order['USER_DESCRIPTION']?></td>
                    </tr>
                </tbody>
            </table>
        <?endif?>
        <div class="order-pay-wrapper">
            <div class="status-wrapper">
                <div class="status-title">Статус</div>
                <div class="status-type">
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
            </div>
            <?
            $orderLoaded = \Bitrix\Sale\Order::load($_GET['order_id']);
            $payment_link = Payment::initializePayment($orderLoaded);
            
            if (
                $order['STATUS_ID'] == 'N' &&
                $order['PAY_SYSTEM_ID'] !== 1 &&
                $order['PAY_SYSTEM_ID'] !== 4 &&
                $order['PAY_SYSTEM_ID'] !== 6 &&
                strlen($payment_link) > 0
            ) {

            ?>
                <div class="pay">
                    <a href="<?= $payment_link ?>">Оплатить</a>
                </div>
            <? } ?>
        </div>
    </div>
<? } ?>
<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');?>
