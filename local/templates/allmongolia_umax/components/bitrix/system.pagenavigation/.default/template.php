<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="catalog-content-pagination">
    <?if($arResult['NavPageNomer'] - 1 > 0):?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageNomer'] - 1?>" class="catalog-content-pagination__item-nav catalog-content-pagination__item-nav--prev">
            <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.469669 5.46967C0.176777 5.76256 0.176777 6.23744 0.469669 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.469669 5.46967ZM20 5.25H1V6.75H20V5.25Z" fill="#838383"></path>
            </svg> 
            Назад
        </a>
    <?endif?>
    <div class="catalog-content-pagination__item-wrap">
		<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="catalog-content-pagination__item <?if($arResult['NavPageNomer'] == $arResult["nStartPage"]):?>active<?endif?>"><?=$arResult["nStartPage"]?></a>
			<?$arResult["nStartPage"]++?>
		<?endwhile?>
    </div>
    <?if($arResult['NavPageNomer'] + 1 <= $arResult["nEndPage"]):?>
        <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageNomer'] + 1?>" class="catalog-content-pagination__item-nav">
            Далее
            <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.5303 5.46967C19.8232 5.76256 19.8232 6.23744 19.5303 6.53033L14.7574 11.3033C14.4645 11.5962 13.9896 11.5962 13.6967 11.3033C13.4038 11.0104 13.4038 10.5355 13.6967 10.2426L17.9393 6L13.6967 1.75736C13.4038 1.46447 13.4038 0.989593 13.6967 0.696699C13.9896 0.403806 14.4645 0.403806 14.7574 0.696699L19.5303 5.46967ZM0 5.25H19V6.75H0V5.25Z" fill="#838383"></path>
            </svg>
        </a>
    <?endif?>
</div>