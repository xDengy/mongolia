<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//p($arResult);
?>

<?if (!empty($arResult)):?>
<ul class="personal-list">
	<h3 class="account-list-heading">Личный кабинет</h3>
	<?foreach($arResult as $key => $arItem):?>
		<li>
			<a class="account-list-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
		</li>
	<?endforeach?>
</ul>
<?endif?>
