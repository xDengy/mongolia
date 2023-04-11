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

if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<?
	foreach ($arResult['SECTIONS'] as $arSection)
	{
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		if($APPLICATION->GetCurPage() == '/catalog/novinki/') {
			$arSection['SECTION_PAGE_URL'] .= 'filter/novinka-is-true/apply/';
		}
		?>
		<div class="catalog-nav__item-bottom catalog-nav__item-bottom--categories accordion-catalog__description">
			<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="catalog-nav__item-categories-input <?if($arSection['SECTION_PAGE_URL'] == $APPLICATION->GetCurPage()):?>active<?endif?>" onclick="javascript:void(0);">
				<label for="catalog__categories--1"><?=$arSection['NAME']?></label>
			</a>
		</div>
		<?
	}
?>
<?
}
?>