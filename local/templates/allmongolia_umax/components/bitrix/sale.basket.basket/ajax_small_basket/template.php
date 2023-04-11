<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixBasketComponent $component */


$return_array = [
    'is_authorized' => $USER->IsAuthorized(),
    'basket_link' => '/cart/',
    'delayed_link' => '/cart/?delayed=Y',
    'delayed_code' => '',
    'basket_not_loaded' => false,
    'prod_count' => count($arResult["ITEMS"]['AnDelCanBuy']),
    'full_price' => $arResult['allSum'],
    'full_price_formatted' => \CCurrencyLang::CurrencyFormat($arResult['allSum'], 'RUB'),
    'show_preloader' => false,
    'items' => [],
    'delayed' => [],
    'not_in_stock' => [],
    'delayed_count' => count($arResult["ITEMS"]['DelDelCanBuy']),
    'not_in_stock_count' => count($arResult["ITEMS"]['nAnCanBuy']),
    'show' => 'basket',
    'check_all' => 'no',
    'coupon' => '',
    'coupon_list' => $arResult['COUPON_LIST'],
    'basket_data' => [
        'price_without_discount' => (int) preg_replace('~\D+~','', str_replace('&#8381;', '', $arResult['PRICE_WITHOUT_DISCOUNT'])),
        'discount_price_all' => $arResult['DISCOUNT_PRICE_ALL'],
        'all_weight' => $arResult['allWeight_FORMATED'],
        'all_sum' => $arResult['allSum'],
    ],
    'id' => $arResult['ID'],
    'applied_discount_list' => $arResult['APPLIED_DISCOUNT_LIST'],
    'full_discount_list' => $arResult['FULL_DISCOUNT_LIST'],
    'opt_price' => $GLOBALS['opt_price'] ? true : false
];

foreach ($arResult["ITEMS"]['DelDelCanBuy'] as $item) {
    $return_array['delayed'][$item['PRODUCT_ID']] = $item;
}

foreach ($arResult["ITEMS"]['AnDelCanBuy'] as $item) {
    $modificator = intval(CIBlockElement::GetProperty(11, $item['PRODUCT_ID'], array("sort" => "asc"), Array("CODE"=>"UPAKOVKA_1"))->Fetch()['VALUE']);
    $elem = CIBlockElement::GetByID($item['PRODUCT_ID'])->Fetch();
    $obSections = CIBlockSection::GetNavChain(11, $elem["IBLOCK_SECTION_ID"]);
    $sections = [];
    while ($obSection = $obSections->GetNext()) $sections[] = $obSection['NAME'];

    $item['CATEGORY_PATH'] =  !empty($sections) ? implode("/", $sections) : "";
    $item['BRAND'] = CIBlockElement::GetProperty(11, $item['PRODUCT_ID'], array("sort" => "asc"), Array("CODE"=>"CML2_MANUFACTURER"))->Fetch()['VALUE'];
    $item['MODIFICATOR'] = $modificator ? $modificator : 1;
    $item['PACKAGES'] = $item['MODIFICATOR'] > 1 ? 'уп' : $item['MEASURE_TEXT'];
    $item['PREVIEW_PICTURE_SRC'] = !empty($item['PREVIEW_PICTURE_SRC']) ? $item['PREVIEW_PICTURE_SRC'] : '/upload/default-photo-180.png';
    $return_array['items'][$item['PRODUCT_ID']] = $item;
}

foreach ($arResult["ITEMS"]['nAnCanBuy'] as $item) {
    $return_array['not_in_stock'][$item['PRODUCT_ID']] = $item;
}

echo Bitrix\Main\Web\Json::encode($return_array);
