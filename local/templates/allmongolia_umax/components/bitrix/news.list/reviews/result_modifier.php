<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

$component = $this->__component;

// foreach ($arResult['ITEMS'] as $key => $item) {
// 	$reviewItem = CIBlockElement::GetList([], ['ID' => $item['PROPERTIES']['ELEMID']['VALUE']], false, false, [])->GetNextElement();
// 	$prodProps = $reviewItem->GetProperties();

// 	$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(3)->fetch();
// 	$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
// 	$entityDataClass = $entity->getDataClass();
// 	$ob_size = $entityDataClass::getList(array(
// 		"select" => array("*"),
// 		'filter' => ['UF_XML_ID' => $prodProps['SIZE']['VALUE']]
// 	))->Fetch();

// 	$arResult['ITEMS'][$key]['PROPERTIES']['SIZE'] = $ob_size;
// }
?>
