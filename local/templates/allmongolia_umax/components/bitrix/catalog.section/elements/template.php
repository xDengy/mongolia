<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<div class="catalog-content-cards">
	<?foreach($arResult['ITEMS'] as $item):?>
		<?
			$uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
			$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
		?>
		<?
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.item",
				"catalog_item",
				Array(
                    'RESULT' => array(
                        'ITEM' => $item,
						'AREA_ID' => $areaIds[$item['ID']],
                        'TYPE' =>'card',
                        'BIG_LABEL' => 'N',
                        'BIG_DISCOUNT_PERCENT' => 'N',
                        'BIG_BUTTONS' => 'N',
                        'SCALABLE' => 'N',
                        'SECTION_NAME' => $item['NAME'],
                    ),
					'IS_FAVS' => $arParams['IS_FAVS']
				)
			);
		?>
	<?endforeach?>

	<?=$arResult['NAV_STRING']?>

	
	<?
		$domain = str_replace('-', '.', $_SERVER['HTTP_HOST']);

		$exploded_domain = explode('.', $domain);

		$seo_key = '';

		if (count($exploded_domain) > 3) {
			$seo_key = mb_strtoupper($exploded_domain[0]) . "_";
		}
	?>

	<? if (!empty($arResult['~UF_' . $seo_key . 'SEO'])) { ?>
		<div class="catalog-seo__description">
			<?= $arResult['~UF_' . $seo_key . 'SEO'] ?>
		</div>
	<? } ?>
</div>