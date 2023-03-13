<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult = [];
foreach ($arParams as $key => $value) {
	$arResult[$key] = $value;
	if($key == 'PHONE')
		$arResult[$key . '_LINK'] = preg_replace('![^+0-9]+!', '', $value);
}

$this->IncludeComponentTemplate();