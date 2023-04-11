<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<?
	$product = new \Simba\Catalog\Product($item['ID']);
	$quantity = $product->getQuantity();

	$priceExists = false;
	$isOffer = false;
	
	if(!empty($item['OFFERS'])) {
		foreach ($item['OFFERS'] as $key => $value) {
			$q_ob = new \Simba\Catalog\Product($value['ID']);
			$q = $q_ob->getQuantity();
			$isOffer = true;
			if($q['QUANTITY'] > 0) {
				$curItem = $item['OFFERS'][$key];
				if($curItem['ITEM_PRICES'][0]['PRICE'] > 0) {
					$priceExists = true;
				}
				$quantity = $q;
				break;
			}
		}
	} else {
		$curItem = $item;
		if($item['ITEM_PRICES'][0]['PRICE'] > 0) {
			$priceExists = true;
		}
	}
?>

<div class="catalog-content__card 
	<?if($curItem['ITEM_PRICES'][0]['PRICE'] < $curItem['ITEM_PRICES'][0]['BASE_PRICE']):?>catalog-content__card--discount<?endif?> 
	<?if ((int) $quantity['QUANTITY'] == 0):?>catalog-content__card--not<?endif?>
	<?if ($item['PROPERTIES']['NOVINKA']['VALUE_XML_ID'] == 'true'):?>catalog-content__card--new<?endif?>">

	<?
		if($priceExists) {
			$item['FORMATED_PRICE'] = number_format($curItem['ITEM_PRICES'][0]['BASE_PRICE'], 0, '', ' ');
			$item['FORMATED_DISCOUNT_PRICE'] = number_format($curItem['ITEM_PRICES'][0]['PRICE'], 0, '', ' ');
			$item['FORMATED_DISCOUNT_DIFF'] = number_format($curItem['ITEM_PRICES'][0]['DISCOUNT'], 0, '', ' ');
			$item['DISCOUNT_DIFF'] = round(($curItem['ITEM_PRICES'][0]['PRICE'] * 100) / $curItem['ITEM_PRICES'][0]['BASE_PRICE']) - 100;
		}
	?>
	<div class="catalog-content__card-mark-wrapper">
		<?if($curItem['ITEM_PRICES'][0]['PRICE'] < $curItem['ITEM_PRICES'][0]['BASE_PRICE']):?>
			<div class="catalog-content__card-mark catalog-content__card-mark--discount">
				<?=$item['DISCOUNT_DIFF']?>%
			</div>
		<?endif?>
		<?if($item['PROPERTIES']['NOVINKA']['VALUE_XML_ID'] == 'true'):?>
			<div class="catalog-content__card-mark catalog-content__card-mark--new">
				новинка
			</div>
		<?endif?>
	</div>

	<?//if($userId):?>
		<favorites-add-product-component product-id='<?= $item['ID'] ?>' user-id='<?= $userId ?>' ip='<?=$_SERVER['REMOTE_ADDR']?>'></favorites-add-product-component>
	<?//endif?>

	<a href="<?=$item['DETAIL_PAGE_URL']?>" class="catalog-content__card-img" >
		<img
				src="<?=$item['PREVIEW_PICTURE']['SRC']?>"
				data-src="<?=$item['DETAIL_PICTURE']['SRC']?>"
				class="lozad"
				alt="<?=$item['PREVIEW_PICTURE']['ALT']?>"
				title="<?=$item['PREVIEW_PICTURE']['TITLE']?>"
		/>
	</a>
	<div class="catalog-content__card-info">
		<a href="<?=$item['DETAIL_PAGE_URL']?>" class="catalog-content__card-title" >
			<?=$item['NAME']?>
		</a>
		<div class="catalog-content__card-subtitle">100% шерсть</div>

		<div class="catalog-content__card-availability">
			<?
				if ((int) $quantity['QUANTITY'] > 0) {
					echo "<span style='color: #8a9b6e'>Есть в наличии</span>";
				} else {
					echo "<span style='color: #E49B9B'>Нет в наличии</span>";
				}
			?>
		</div>
		<div class="catalog-content__card-info-bottom">
			<?if($priceExists) {?>
				<div class="catalog-content__card-price-wrap">
					<div class="catalog-content__card-price"><?= $item['FORMATED_DISCOUNT_PRICE'] ?> руб.</div>
					<div class="catalog-content__card-price--discount">
						<?= $item['FORMATED_PRICE'] ?> руб.
					</div>
				</div>
			<?}?>
			<?if($priceExists):?>
				<basket-add-product-component product-id='<?= $curItem['ID'] ?>' :quantity='<?= json_encode($quantity) ?>' is-offer='<?=$isOffer?>' detail-page='<?=$item['DETAIL_PAGE_URL']?>' />
			<?endif?>
		</div>
	</div>
</div>