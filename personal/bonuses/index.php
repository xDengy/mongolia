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
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/bonuses.js");

    $transactAr = \ST\Bonuses\Bonuses::getTransactList($USER->getId());

    $curUser = \CSaleUserAccount::GetByUserID($USER->getId(), 'RUB');
?>
    <div class="wrapper info">
        <div class="all-bonuses">
            <span>
                ВСЕГО
            </span>
            <div class="bonuses">
                <?if($curUser['CURRENT_BUDGET']):?>
                    <?=number_format(explode('.', $curUser['CURRENT_BUDGET'])[0], 0, '', ' ')?>
                <?else:?>
                    0
                <?endif?>
            </div>
        </div>
        <div class="bonus-system">
            <a href="/bonus-system/">
                Система лояльности
            </a>
        </div>
        <invite-component user-id='<?=$USER->getId()?>'></invite-component>
    </div>
    <div class="wrapper personal">
        <?if($transactAr):?>
            <table class="personal-wrap">
                <?foreach($transactAr as $key => $transact):?>
                    <?
                        if(intval(explode('.', $transact['AMOUNT'])[0]) == 0) {
                            continue;
                        }
                        $order['FORMATED_PRICE'] = number_format($order['PRICE'], 0, '', ' ') . ' руб.';
                    ?>
                    <tr class="table-head table-body">
                        <td class=" <?if($key < count($transactAr) - 1):?>pb-1-5<?endif?> <?if($key !== 0):?>pt-1-5<?endif?>">
                            <?=explode(' ', $transact['TRANSACT_DATE'])[0]?>
                        </td>
                        <td class="text-left <?if($key < count($transactAr) - 1):?>pb-1-5<?endif?> <?if($key !== 0):?>pt-1-5<?endif?>">
                            <?if($transact['ORDER_ID']):?>
                                <a href="/personal/orders/order/?order_id=<?=$transact['ORDER_ID']?>">№<?=$transact['ORDER_ID']?></a>
                            <?else:?>
                                <a>Другой способ добавления</a>
                            <?endif?>
                        </td>
                        <td class="text-center <?if($key < count($transactAr) - 1):?>pb-1-5<?endif?> <?if($key !== 0):?>pt-1-5<?endif?>">
                            <div class="bonuses-value">
                                <?if($transact['DEBIT'] == 'N'):?>
                                    -
                                <?else:?>
                                    +
                                <?endif?>
                                <?=explode('.', $transact['AMOUNT'])[0]?>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 14.553L4.77526 17.7586C4.56593 17.9288 4.33756 18.009 4.09017 17.9992C3.84277 17.9901 3.62392 17.9194 3.43362 17.787C3.24332 17.6546 3.09602 17.4749 2.99174 17.248C2.88669 17.021 2.88174 16.7752 2.97689 16.5104L4.60399 11.2623L0.464884 8.34031C0.23652 8.18902 0.0937924 7.99044 0.0367014 7.74458C-0.0203897 7.49872 -0.0108744 7.27177 0.065247 7.06374C0.141368 6.8557 0.274581 6.67112 0.464884 6.50998C0.655188 6.34961 0.883552 6.26942 1.14998 6.26942H6.25963L7.91527 0.822684C8.01042 0.557912 8.1581 0.354416 8.3583 0.212196C8.55773 0.0707322 8.77164 0 9 0C9.22836 0 9.44227 0.0707322 9.6417 0.212196C9.8419 0.354416 9.98958 0.557912 10.0847 0.822684L11.7404 6.26942H16.85C17.1164 6.26942 17.3448 6.34961 17.5351 6.50998C17.7254 6.67112 17.8586 6.8557 17.9348 7.06374C18.0109 7.27177 18.0204 7.49872 17.9633 7.74458C17.9062 7.99044 17.7635 8.18902 17.5351 8.34031L13.396 11.2623L15.0231 16.5104C15.1183 16.7752 15.1137 17.021 15.0094 17.248C14.9044 17.4749 14.7567 17.6546 14.5664 17.787C14.3761 17.9194 14.1572 17.9901 13.9098 17.9992C13.6624 18.009 13.4341 17.9288 13.2247 17.7586L9 14.553Z" fill="#DADADA"/>
                                </svg>
                            </div>
                        </td>
                    </tr>
                    <?if($key < count($transactAr) - 1):?>
                        <tr class="border">
                            <td colspan="3"></td>
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
                        Список транзакций пуст
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
