<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (empty($arResult))
	return?>

<div class="footer__information-item">
	<div class="footer__information-top">
		<p class="footer__information-name"><?=$arResult[0]['TEXT']?></p>
		<a class="footer__information-arrow"></a>
	</div>
	<ul class="footer__information-list">
		<?foreach($arResult as $key => $arItem):?>
			<?if($key == 0)
				continue?>
			<li>
				<a class="footer__information-link" href="<?=$arItem["LINK"]?>">
					<?=$arItem["TEXT"]?>
				</a>
			</li>
		<?endforeach?>
	</ul>
</div>