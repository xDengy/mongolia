<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Page\Asset;

global $USER, $APPLICATION;

$APPLICATION->SetPageProperty("title", "Бонусы");
$APPLICATION->SetTitle("Бонусы");

if(!$USER->IsAuthorized()) {
    LocalRedirect('/signin/');
} else {
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/fastregistration.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/personal.css");

    $transactAr = \ST\Bonuses\Bonuses::getTransactList($USER->getId());
?>
    <div class="wrapper personal">
        <table class="personal-wrap">
            <?if($transactAr):?>
                    <?foreach($transactAr as $key => $transact):?>
                        <?
                            $order['FORMATED_PRICE'] = number_format($order['PRICE'], 0, '', ' ') . ' руб.';
                        ?>
                        <tr class="table-head">
                            <td class="text-left pt-3">
                                <?if($transact['ORDER_ID']):?>
                                    <a href="/personal/orders/order/?order_id=<?=$transact['ORDER_ID']?>">№<?=$transact['ORDER_ID']?></a>
                                <?else:?>
                                    <a>Добавлено вручную</a>
                                <?endif?>
                            </td>
                            <td class="text-center pt-3 xs">Баллы</td>
                            <td class="text-center pt-3 xs">Начислено/Списано</td>
                        </tr>
                        <tr class="table-body">
                            <td class="text-center pt-3 xs"></td>
                            <td class="text-center <?if($key < count($transactAr) - 1):?>pb-3<?else:?>pb-3-m<?endif?>">
                                <div class="table-head xs-m">
                                    <div class="text-center pt-3 ">Баллы</div>
                                </div>
                                <?if($transact['DEBIT'] == 'N'):?>
                                    -
                                <?else:?>
                                    +
                                <?endif?>
                                <?=explode('.', $transact['AMOUNT'])[0]?>
                            </td>
                            <td class="text-center <?if($key < count($transactAr) - 1):?>pb-3<?else:?>pb-3-m<?endif?>">
                                <div class="table-head xs-m">
                                    <div class="text-center pt-3 ">Начислено/Списано</div>
                                </div>
                                <?=explode(' ', $transact['TRANSACT_DATE'])[0]?>
                            </td>
                        </tr>
                        <?if($key < count($transactAr) - 1):?>
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
