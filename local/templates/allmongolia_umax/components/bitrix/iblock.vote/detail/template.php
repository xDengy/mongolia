<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init(array("ajax"));

// if($arResult["PROPERTIES"]["VOTE_COUNT"]["VALUE"])
// 	$DISPLAY_VALUE = round($arResult["PROPERTIES"]["RATING"]["VALUE"]/$arResult["PROPERTIES"]["VOTE_COUNT"]["VALUE"], 2);
// if($arParams["ELEMENT_CODE"] == 'IBLOCK_REVIEWS')
// 	$DISPLAY_VALUE = $arResult["PROPERTIES"]["RATING"]["VALUE"];

$DISPLAY_VALUE = 0;
$ratingCount = 0;
$ratingSum = 0;

$el_res = CIBlockElement::GetList([], ['ACTIVE' => 'Y', 'PROPERTY' => [
	'ELEMID' => $arResult['ID']
], 'IBLOCK_ID' => '5']);
while($ob_el = $el_res->GetNextElement()) {
	$el = $ob_el->GetProperties();
	$ratingCount++;
	$ratingSum += intval($el['RATING']['VALUE']);
}

if($ratingCount > 0)
	$DISPLAY_VALUE = round($ratingSum / $ratingCount, 1);

?>
<div class="rating-mini">
	<?
	foreach ($arResult["VOTE_NAMES"] as $i => $name)
	{
		$className = "";
		if (round($DISPLAY_VALUE) > $i)
			$className = "active";
		?>
			<span class="<?= $className?>"></span>
		<?
	}
?>
</div>
<?if ($arParams["SHOW_RATING"] == "Y"):?>
	<div class="product-page__estimation-text">Отзывы (<?=$ratingCount?>)</div>
<?endif;?>