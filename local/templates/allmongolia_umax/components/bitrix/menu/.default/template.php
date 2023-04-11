<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<?
	foreach($arResult as $key => $arItem):
		if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
			continue;
	?>
		<?
			if (boolval($arItem['IS_PARENT'])) {
				$class = 'header__nav-link';
			} else {
				$class = 'header__list-category-link';
			}
		?>
		<li class="<?= ($arItem['LINK'] === '/catalog/novinki/') ? 'novinki' : '' ?>">
			<a href="<?=$arItem["LINK"]?>" class="<?=$class?> <?if($arItem["SELECTED"]):?>selected<?endif?>"><?=$arItem["TEXT"]?></a>
			<?if(boolval($arItem['IS_PARENT']) && !empty($arItem['PARAMS'])):?>
				<div class="header__nav-additionally">
					<ul class="header__list-category">
			<?endif?>
			<?if((boolval($arResult[$key + 1]['IS_PARENT']) || $key == count($arResult) - 1) && !empty($arItem['PARAMS'])):?>
					</ul>
				</div>
			<?endif?>
		</li>
	<?endforeach?>
<?endif?>