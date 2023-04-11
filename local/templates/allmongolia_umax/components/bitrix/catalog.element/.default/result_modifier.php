<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule('highloadblock');

$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(10)->fetch();
$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entityDataClass = $entity->getDataClass();

if(!empty($arResult['OFFERS'])){
    $group_res = $arResult['OFFERS'];
    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photoKey => $img) {
        $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'][$photoKey] = [
            'ID' => $img,
            'PATH' => CFile::GetPath($img),
        ];
    }
    foreach($group_res as  $ofKey => $value) {
        $ob_prod = CIBlockElement::GetList([], ['ID' => $value['ID'], 'IBLOCK_ID' => $value['IBLOCK_ID']], false, false, []);
        $prop = $ob_prod->GetNextElement();
        $prodProps = $prop->GetProperties();

        $ob_size = $entityDataClass::getList(array(
            "select" => array("*"),
            'filter' => ['UF_XML_ID' => $prodProps['RAZMER_OBSHCHIY']['VALUE']]
        ))->Fetch();

        $ob_prod = CIBlockElement::GetList([], ['ID' => $value['ID'], 'IBLOCK_ID' => $value['IBLOCK_ID']], false, false, []);

        $prodAr = $ob_prod->Fetch();
        foreach ($prodProps['MORE_PHOTO']['VALUE'] as $key => $img) {
            $arResult['OFFERS'][$ofKey]['PROPERTIES']['MORE_PHOTO']['VALUE'][$key] = [
                'ID' => $img,
                'PATH' => CFile::GetPath($img),
            ];
        }

        if($ob_size) {
            $arResult['OFFERS_PROPERTIES']['SIZE'][$prodProps['RAZMER_OBSHCHIY']['VALUE']] = [
                'SIZE' => $ob_size,
                'ELEMENT' => $prodAr
            ];
        }

        $arResult['OFFERS'][$ofKey]['FORMATED_PRICE'] = number_format($value['PRICES']['BASE']['VALUE'], 0, '', ' ');
        $arResult['OFFERS'][$ofKey]['FORMATED_DISCOUNT_PRICE'] = number_format($value['PRICES']['BASE']['DISCOUNT_VALUE'], 0, '', ' ');
        $arResult['OFFERS'][$ofKey]['FORMATED_DISCOUNT_DIFF'] = number_format($value['PRICES']['BASE']['DISCOUNT_DIFF'], 0, '', ' ');

        $arResult['OFFERS'][$ofKey]['~DETAIL_TEXT'] = str_replace("\r\n", '<br>', $prodAr['DETAIL_TEXT']);
        
        $product = new \Simba\Catalog\Product($arResult['OFFERS'][$ofKey]['ID']);
        $quantity = $product->getQuantity();

        $arResult['OFFERS'][$ofKey]['QUANTITY'] = $quantity;
    }
    $arResult['CURRENT_ITEM'] = $arResult['OFFERS'][0];
    
} else {
    $arResult['CURRENT_ITEM'] = $arResult;

    foreach ($arResult['CURRENT_ITEM']['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $img) {
        $arResult['CURRENT_ITEM']['PROPERTIES']['MORE_PHOTO']['VALUE'][$key] = [
            'ID' => $img,
            'PATH' => CFile::GetPath($img),
        ];
    }

    $ob_size = $entityDataClass::getList(array(
        "select" => array("*"),
        'filter' => ['UF_XML_ID' => $arResult['PROPERTIES']['RAZMER_OBSHCHIY']['VALUE']]
    ))->Fetch();

    if($ob_size) {
        $arResult['OFFERS_PROPERTIES']['SIZE'][$arResult['PROPERTIES']['RAZMER_OBSHCHIY']['VALUE']] = [
            'SIZE' => $ob_size,
            'ELEMENT' => $prodAr
        ];
    }
        
    $product = new \Simba\Catalog\Product($arResult['ID']);
    $quantity = $product->getQuantity();

    $arResult['CURRENT_ITEM']['QUANTITY'] = $quantity;

    $arResult['CURRENT_ITEM']['FORMATED_PRICE'] = number_format($arResult['CURRENT_ITEM']['PRICES']['BASE']['VALUE'], 0, '', ' ');
    $arResult['CURRENT_ITEM']['FORMATED_DISCOUNT_PRICE'] = number_format($arResult['CURRENT_ITEM']['PRICES']['BASE']['DISCOUNT_VALUE'], 0, '', ' ');
    $arResult['CURRENT_ITEM']['FORMATED_DISCOUNT_DIFF'] = number_format($arResult['CURRENT_ITEM']['PRICES']['BASE']['DISCOUNT_DIFF'], 0, '', ' ');
}

$ob_group = CIBlockElement::GetList([], ['IBLOCK_ID' => $arResult['IBLOCK_ID'], 'PROPERTY' => [
    '=NOMENKLATURA_DLYA_SVYAZI' => $arResult['PROPERTIES']['NOMENKLATURA_DLYA_SVYAZI']['VALUE'],
]], false, false, []);

$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(8)->fetch();
$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entityDataClass = $entity->getDataClass();

while($group = $ob_group->GetNextElement()) {
    $groupFields = $group->GetFields();
    $groupProps = $group->GetProperties();

    $ob_color = $entityDataClass::getList(array(
        "select" => array("*"),
        'filter' => ['UF_XML_ID' => $groupProps['TSVET']['VALUE']]
    ))->Fetch();
    
    if($ob_color) {
        $arResult['OFFERS_PROPERTIES']['COLOR'][$groupProps['TSVET']['VALUE']] = [
            'COLOR' => $ob_color,
            'ELEMENT' => $groupFields
        ];
    }
}

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();