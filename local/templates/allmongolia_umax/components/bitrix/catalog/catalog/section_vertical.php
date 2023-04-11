<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<section class="catalog">
	<aside class="catalog-nav">
		<div class="catalog-nav__form">
			<?
			$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "catalog_filter", array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => $arCurSection['ID'],
					"FILTER_NAME" => $arParams["FILTER_NAME"],
					"PRICE_CODE" => $arParams["~PRICE_CODE"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SAVE_IN_SESSION" => "N",
					"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
					"XML_EXPORT" => "N",
					"SECTION_TITLE" => "NAME",
					"SECTION_DESCRIPTION" => "DESCRIPTION",
					'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
					"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					"SEF_MODE" => $arParams["SEF_MODE"],
					"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
					"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
					"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
					"INSTANT_RELOAD" => 'Y',
				),
				false
			);
			?>
		</div>
	</aside>
	<div class="catalog-content">
		<div class="catalog-content-top">
			<form action="<?=$APPLICATION->GetCurPage(true)?>" method="GET" class="catalog-content-top__search">
				<input value="<?=$_GET['q']?>" type="text" name="q" placeholder="Поиск..." />
				<button>НАЙТИ</button>
			</form>
			<?
				$qQuery = '';
				if($_GET['set_filter']) {
					$getQuery = [];
					foreach($_GET as $getKey => $getValue) {
						if(!in_array($getKey, ['q', 'sort', 'order'])) {
							$getQuery[] = $getKey . '=' . $getValue;
						}
					}
					$qQuery = '&' . implode('&', $getQuery);
				}
				if($_GET['q']) {
					$GLOBALS[$arParams["FILTER_NAME"]]['%NAME'] = $_GET['q'];
					$qQuery .= '&q=' . $_GET['q'];
				}
			?>
			<div class="catalog-content-top__sort">
				<div class="catalog-content-top__sort-top">
					<div class="catalog-content-top__sort-top-text">
						<?
							switch ($_GET['sort']) {
								case 'new':
									echo 'Новые поступления';
									break;

								case 'quantity':
									echo 'В наличии';
									break;

								case 'price':
									if($_GET['order'] == 'asc')
										echo 'Цена по возрастанию';
									else if($_GET['order'] == 'desc')
										echo 'Цена по убыванию';
									break;

								case 'popular':
									echo 'Популярные';
									break;
								
								default:
									echo 'СОРТИРОВАТЬ ПО';
									break;
							}
						?>
					</div>
					<svg
							width="16"
							height="9"
							viewBox="0 0 16 9"
							fill="none"
							xmlns="http://www.w3.org/2000/svg"
					>
						<path
								d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928932 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
								fill="black"
						/>
					</svg>
				</div>
				<div class="catalog-content-top__sort-bottom">
					<a href="?sort=popular<?=$qQuery?>" class="catalog-content-top__sort-item">
						Популярные	
					</a>
					<a href="?sort=price&order=desc<?=$qQuery?>" class="catalog-content-top__sort-item">
						Цена по убыванию
					</a>
					<a href="?sort=price&order=asc<?=$qQuery?>" class="catalog-content-top__sort-item">
						Цена по возрастанию
					</a>
					<a href="?sort=new<?=$qQuery?>" class="catalog-content-top__sort-item">
						Новые поступления
					</a>
					<a href="?sort=quantity<?=$qQuery?>" class="catalog-content-top__sort-item">
						В наличии
					</a>
				</div>
			</div>
		</div>
		<?
		$catalogSectionParams = array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
			"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
			"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
			"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"])?$arParams["LIST_PROPERTY_CODE"]:[]),
			"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
			"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
			"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
			"BROWSER_TITLE" => "",
			"SET_LAST_MODIFIED" => "N",
			"INCLUDE_SUBSECTIONS" => $arParams['INCLUDE_SUBSECTIONS'],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => $arParams['CACHE_TYPE'],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "N",
			"SET_TITLE" => $arParams['SET_TITLE'],
			"MESSAGE_404" => $arParams["~MESSAGE_404"],
			"SET_STATUS_404" => "N",
			'SECTION_USER_FIELDS' => [
				'UF_SEO',
				'UF_MSK_SEO'
			],
			"SHOW_404" => "N",
			"FILE_404" => $arParams["FILE_404"],
			"DISPLAY_COMPARE" => "N",
			"PAGE_ELEMENT_COUNT" => $arParams['PAGE_ELEMENT_COUNT'],
			"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
			"PRICE_CODE" => $arParams['PRICE_CODE'],
			"USE_PRICE_COUNT" => "N",
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => "Y",
			"USE_PRODUCT_QUANTITY" => "N",
			"ADD_PROPERTIES_TO_BASKET" => "N",
			"PARTIAL_PRODUCT_PROPERTIES" => "N",
			"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"])?$arParams["PRODUCT_PROPERTIES"]:[]),
			"DISPLAY_TOP_PAGER" => "Y",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"LAZY_LOAD" => "N",
			"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
			"LOAD_ON_SCROLL" => "N",
			"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"])?$arParams["OFFERS_CART_PROPERTIES"]:[]),
			"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"])?$arParams["LIST_OFFERS_PROPERTY_CODE"]:[]),

			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			
			"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
			"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
			"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"])?$arParams["LIST_OFFERS_LIMIT"]:0),
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"USE_MAIN_ELEMENT_SECTION" => "Y",
			"CONVERT_CURRENCY" => "N",
			"CURRENCY_ID" => $arParams["CURRENCY_ID"],
			"HIDE_NOT_AVAILABLE" => $arParams['HIDE_NOT_AVAILABLE'],
			"HIDE_NOT_AVAILABLE_OFFERS" => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
			"LABEL_PROP" => $arParams["LABEL_PROP"],
			"LABEL_PROP_MOBILE" => $arParams["LABEL_PROP_MOBILE"],
			"LABEL_PROP_POSITION" => $arParams["LABEL_PROP_POSITION"],
			"ADD_PICT_PROP" => $arParams["ADD_PICT_PROP"],
			"PRODUCT_DISPLAY_MODE" => $arParams["PRODUCT_DISPLAY_MODE"],
			"PRODUCT_BLOCKS_ORDER" => $arParams["LIST_PRODUCT_BLOCKS_ORDER"],
			"PRODUCT_ROW_VARIANTS" => "[]",
			"ENLARGE_PRODUCT" => "STRICT",
			"ENLARGE_PROP" => isset($arParams["LIST_ENLARGE_PROP"])?$arParams["LIST_ENLARGE_PROP"]:"",
			"SHOW_SLIDER" => "N",
			"SLIDER_INTERVAL" => isset($arParams["LIST_SLIDER_INTERVAL"])?$arParams["LIST_SLIDER_INTERVAL"]:"",
			"SLIDER_PROGRESS" => isset($arParams["LIST_SLIDER_PROGRESS"])?$arParams["LIST_SLIDER_PROGRESS"]:"",
			"OFFER_ADD_PICT_PROP" => $arParams["OFFER_ADD_PICT_PROP"],
			"OFFER_TREE_PROPS" => (isset($arParams["OFFER_TREE_PROPS"])?$arParams["OFFER_TREE_PROPS"]:[]),
			"PRODUCT_SUBSCRIPTION" => "N",
			"SHOW_DISCOUNT_PERCENT" => "N",
			"DISCOUNT_PERCENT_POSITION" => $arParams["DISCOUNT_PERCENT_POSITION"],
			"SHOW_OLD_PRICE" => "N",
			"SHOW_MAX_QUANTITY" => "N",
			"MESS_SHOW_MAX_QUANTITY" => (isset($arParams["~MESS_SHOW_MAX_QUANTITY"])?$arParams["~MESS_SHOW_MAX_QUANTITY"]:""),
			"RELATIVE_QUANTITY_FACTOR" => (isset($arParams["RELATIVE_QUANTITY_FACTOR"])?$arParams["RELATIVE_QUANTITY_FACTOR"]:""),
			"MESS_RELATIVE_QUANTITY_MANY" => (isset($arParams["~MESS_RELATIVE_QUANTITY_MANY"])?$arParams["~MESS_RELATIVE_QUANTITY_MANY"]:""),
			"MESS_RELATIVE_QUANTITY_FEW" => (isset($arParams["~MESS_RELATIVE_QUANTITY_FEW"])?$arParams["~MESS_RELATIVE_QUANTITY_FEW"]:""),
			"MESS_BTN_BUY" => (isset($arParams["~MESS_BTN_BUY"])?$arParams["~MESS_BTN_BUY"]:""),
			"MESS_BTN_ADD_TO_BASKET" => (isset($arParams["~MESS_BTN_ADD_TO_BASKET"])?$arParams["~MESS_BTN_ADD_TO_BASKET"]:""),
			"MESS_BTN_SUBSCRIBE" => (isset($arParams["~MESS_BTN_SUBSCRIBE"])?$arParams["~MESS_BTN_SUBSCRIBE"]:""),
			"MESS_BTN_DETAIL" => (isset($arParams["~MESS_BTN_DETAIL"])?$arParams["~MESS_BTN_DETAIL"]:""),
			"MESS_NOT_AVAILABLE" => $arParams["~MESS_NOT_AVAILABLE"]??"",
			"MESS_NOT_AVAILABLE_SERVICE" => $arParams["~MESS_NOT_AVAILABLE_SERVICE"]??"",
			"MESS_BTN_COMPARE" => (isset($arParams["~MESS_BTN_COMPARE"])?$arParams["~MESS_BTN_COMPARE"]:""),
			"USE_ENHANCED_ECOMMERCE" => "N",
			"DATA_LAYER_NAME" => (isset($arParams["DATA_LAYER_NAME"])?$arParams["DATA_LAYER_NAME"]:""),
			"BRAND_PROPERTY" => (isset($arParams["BRAND_PROPERTY"])?$arParams["BRAND_PROPERTY"]:""),
			"TEMPLATE_THEME" => (isset($arParams["TEMPLATE_THEME"])?$arParams["TEMPLATE_THEME"]:""),
			"ADD_SECTIONS_CHAIN" => "Y",
			"ADD_TO_BASKET_ACTION" => "ADD",
			"SHOW_CLOSE_POPUP" => "N",
			"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
			"COMPARE_NAME" => $arParams["COMPARE_NAME"],
			"USE_COMPARE_LIST" => "Y",
			"BACKGROUND_IMAGE" => (isset($arParams["SECTION_BACKGROUND_IMAGE"])?$arParams["SECTION_BACKGROUND_IMAGE"]:""),
			"COMPATIBLE_MODE" => "N",
			"DISABLE_INIT_JS_IN_COMPONENT" => "N",
			"SHOW_ALL_WO_SECTION" => "N",
			"COMPONENT_TEMPLATE" => "elements",
			"RCM_TYPE" => "personal",
			"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
			"SHOW_FROM_SECTION" => "N",
			"SEF_MODE" => $arParams['SEF_MODE'],
			"AJAX_MODE" => $arParams['AJAX_MODE'],
			"AJAX_OPTION_JUMP" => $arParams['AJAX_OPTION_JUMP'],
			"AJAX_OPTION_STYLE" => $arParams['AJAX_OPTION_STYLE'],
			"AJAX_OPTION_HISTORY" => $arParams['AJAX_OPTION_HISTORY'],
			"AJAX_OPTION_ADDITIONAL" => $arParams['AJAX_OPTION_ADDITIONAL'],
			"SET_BROWSER_TITLE" => $arParams['SET_BROWSER_TITLE'],
			"SET_META_KEYWORDS" => $arParams['SET_META_KEYWORDS'],
			"SET_META_DESCRIPTION" => $arParams['SET_META_DESCRIPTION'],
		);

		if($arResult["VARIABLES"]["SECTION_ID"]) {
			$catalogSectionParams["SECTION_ID"] = $arResult["VARIABLES"]["SECTION_ID"];
			$catalogSectionParams["SECTION_CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
		} else {
			$catalogSectionParams["SECTION_ID"] = 0;
		}

		if($_GET['sort']) {
			switch ($_GET['sort']) {
				case 'new':
					$catalogSectionParams['ELEMENT_SORT_FIELD'] = 'DATE_CREATE';
					$catalogSectionParams['ELEMENT_SORT_ORDER'] = 'ASC';
					break;

				case 'quantity':
					$quantityAr = getQuantityArray($arResult['VARIABLES']['SECTION_ID'], $arParams['IBLOCK_ID'], $GLOBALS[$arParams['FILTER_NAME']]);
					$catalogSectionParams["CUSTOM_ELEMENT_SORT"] = [
						"ID" => $quantityAr
					];
					break;

				case 'price':
					$catalogSectionParams['ELEMENT_SORT_FIELD'] = 'CATALOG_PRICE_1';
					if($_GET['order'] == 'asc' || $_GET['order'] == 'desc') {
						$catalogSectionParams['ELEMENT_SORT_ORDER'] = strtoupper($_GET['order']);
					}
					break;

				case 'popular':
					$catalogSectionParams['ELEMENT_SORT_FIELD'] = 'SHOW';
					$catalogSectionParams['ELEMENT_SORT_ORDER'] = 'DESC';
					break;
				
				default:
					
					break;
			}
		}
		?>
		<?
			$intSectionID = $APPLICATION->IncludeComponent(
				"bitrix:catalog.section", 
				"elements",
				$catalogSectionParams,
				false
			);

			$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
		?>
	</div>
</div>