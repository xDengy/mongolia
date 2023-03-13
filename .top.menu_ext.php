<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    Array(
        "IBLOCK_TYPE" => "catalog", 
        "IBLOCK_ID" => "4", 
        "SEF_BASE_URL" => "/catalog/",
        "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/", 
        "DEPTH_LEVEL" => "4",
        "CACHE_TYPE" => "N",
    )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>