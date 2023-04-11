<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

?>
<section class="blogPage">
	<div class="blogPage-img">
		<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
	</div>

	<div class="blogPage__content">
		<div class="blogPage__info">
			<div class="blogPage__block">
				<div class="blogPage__block-text">
					<?=html_entity_decode($arResult['DETAIL_TEXT'])?>
				</div>
			</div>
			<?foreach($arResult['PROPERTIES']['TEXT']['VALUE'] as $key => $text):?>
				<div class="blogPage__block" id="link<?=$key?>">
					<p class="blogPage__block-title"><?=html_entity_decode($arResult['PROPERTIES']['TEXT']['DESCRIPTION'][$key])?></p>
					<div class="blogPage__block-text">
						<?=html_entity_decode($text['TEXT'])?>
					</div>
				</div>
			<?endforeach?>
		</div>
		<div class="blogPage__description">
			<div class="blogPage__description-info">
				<div class="blogPage__description-block">
					<p class="blogPage__description-name">дата публикации</p>
					<div class="blogPage__description-data">
						<svg width="23" height="26" viewBox="0 0 23 26" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M2.96387 10.6013H20.0452" stroke="#182225" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
							<path fill-rule="evenodd" clip-rule="evenodd"
								d="M6.49316 14.6729C6.49316 14.2586 6.82895 13.9229 7.24316 13.9229H7.25204C7.66626 13.9229 8.00204 14.2586 8.00204 14.6729C8.00204 15.0871 7.66626 15.4229 7.25204 15.4229H7.24316C6.82895 15.4229 6.49316 15.0871 6.49316 14.6729ZM11.5047 13.9229C11.0905 13.9229 10.7547 14.2587 10.7547 14.6729C10.7547 15.0871 11.0905 15.4229 11.5047 15.4229H11.5136C11.9278 15.4229 12.2636 15.0871 12.2636 14.6729C12.2636 14.2587 11.9278 13.9229 11.5136 13.9229H11.5047ZM15.7573 13.9229C15.3431 13.9229 15.0073 14.2587 15.0073 14.6729C15.0073 15.0871 15.3431 15.4229 15.7573 15.4229H15.7662C16.1804 15.4229 16.5162 15.0871 16.5162 14.6729C16.5162 14.2587 16.1804 13.9229 15.7662 13.9229H15.7573ZM15.7573 17.9746C15.3431 17.9746 15.0073 18.3104 15.0073 18.7246C15.0073 19.1388 15.3431 19.4746 15.7573 19.4746H15.7662C16.1804 19.4746 16.5162 19.1388 16.5162 18.7246C16.5162 18.3104 16.1804 17.9746 15.7662 17.9746H15.7573ZM10.7547 18.7246C10.7547 18.3104 11.0905 17.9746 11.5047 17.9746H11.5136C11.9278 17.9746 12.2636 18.3104 12.2636 18.7246C12.2636 19.1388 11.9278 19.4746 11.5136 19.4746H11.5047C11.0905 19.4746 10.7547 19.1388 10.7547 18.7246ZM7.24316 17.9745C6.82895 17.9745 6.49316 18.3103 6.49316 18.7245C6.49316 19.1388 6.82895 19.4745 7.24316 19.4745H7.25204C7.66626 19.4745 8.00204 19.1388 8.00204 18.7245C8.00204 18.3103 7.66626 17.9745 7.25204 17.9745H7.24316Z"
								fill="#182225" />
							<path d="M15.3752 2.88232V6.313" stroke="#182225" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
							<path d="M7.63372 2.88232V6.313" stroke="#182225" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
							<path fill-rule="evenodd" clip-rule="evenodd"
								d="M15.5617 4.52881H7.44717C4.63285 4.52881 2.875 6.23429 2.875 9.36922V18.8036C2.875 21.9878 4.63285 23.7327 7.44717 23.7327H15.5528C18.376 23.7327 20.125 22.0174 20.125 18.8824V9.36922C20.1338 6.23429 18.3849 4.52881 15.5617 4.52881Z"
								stroke="#182225" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" />
						</svg>
						<p><?=explode(' ', $arResult['DATE_CREATE'])[0]?></p>
					</div>
				</div>
				<div class="blogPage__description-block">
					<p class="blogPage__description-name">Просмотры</p>
					<div class="blogPage__description-data">
						<svg width="24" height="27" viewBox="0 0 24 27" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<rect y="0.885254" width="24" height="26.1081" rx="12" fill="white" />
							<path fill-rule="evenodd" clip-rule="evenodd"
								d="M21.8701 13.3954C21.2301 12.1879 17.7101 6.12865 11.7301 6.32447C6.20007 6.47676 3.00007 11.7637 2.13007 13.3954C1.95144 13.732 1.95144 14.1467 2.13007 14.4832C2.76007 15.669 6.13007 21.5542 12.0201 21.5542H12.2701C17.8001 21.4019 21.0101 16.115 21.8701 14.4832C22.0487 14.1467 22.0487 13.732 21.8701 13.3954ZM12.0001 17.7468C10.0671 17.7468 8.50007 16.0421 8.50007 13.9393C8.50007 11.8365 10.0671 10.1319 12.0001 10.1319C13.9331 10.1319 15.5001 11.8365 15.5001 13.9393C15.5001 16.0421 13.9331 17.7468 12.0001 17.7468ZM12.0001 15.5711C12.8285 15.5711 13.5001 14.8405 13.5001 13.9393C13.5001 13.0381 12.8285 12.3076 12.0001 12.3076C11.1716 12.3076 10.5001 13.0381 10.5001 13.9393C10.5001 14.8405 11.1716 15.5711 12.0001 15.5711Z"
								fill="#182225" />
						</svg>
						<p><?=$arResult['SHOW_COUNTER'] ?? 0?></p>
					</div>
				</div>
				<div class="blogPage__description-block">
					<p class="blogPage__description-name">Время чтения</p>
					<div class="blogPage__description-data">
						<svg width="20" height="25" viewBox="0 0 20 25" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path d="M14.5333 13.5403H9.69995V8.28247" stroke="black" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
							<path d="M2.93347 3.55026L4.8668 1.9729" stroke="black" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
							<path d="M16.4664 3.55026L14.5331 1.9729" stroke="black" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
							<path
									d="M9.69999 23.0045C14.5049 23.0045 18.4 18.7673 18.4 13.5404C18.4 8.31343 14.5049 4.07617 9.69999 4.07617C4.89512 4.07617 1 8.31343 1 13.5404C1 18.7673 4.89512 23.0045 9.69999 23.0045Z"
									stroke="black" stroke-width="2" stroke-linecap="round"
									stroke-linejoin="round" />
						</svg>
						<p><?=$arResult['PROPERTIES']['READING_TIME']['VALUE']?></p>
					</div>
				</div>
			</div>
			<p class="blogPage__description-title">содержание</p>
			<ol class="blogPage__description-list">
				<?foreach($arResult['PROPERTIES']['TEXT']['DESCRIPTION'] as $key => $text):?>
					<li>
						<span>
							<a class="blogPage__description-link" href="#link<?=$key?>">
								<?=$text?>
							</a>
						</span>
					</li>
				<?endforeach?>
			</ol>
		</div>
	</div>
	<?
	$GLOBALS['blogFilter'] = [
		'!=ID' => $arResult['ID']
	];
	?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"blog-slider", 
		array(
			"IBLOCK_TYPE" => "pages_content",
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SORT_BY1" => $arParams["SORT_BY1"],
			"SORT_ORDER1" => $arParams["SORT_ORDER1"],
			"SORT_BY2" => $arParams["SORT_BY2"],
			"SORT_ORDER2" => $arParams["SORT_ORDER2"],
			"FIELD_CODE" => $arParams["FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"SET_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => "N",
			"SHOW_404" => "N",
			"FILE_404" => $arParams["FILE_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => "N",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME" => 'blogFilter',
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"CHECK_DATES" => "N",
			"STRICT_SECTION_CHECK" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"COMPONENT_TEMPLATE" => "blog",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"SET_BROWSER_TITLE" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_META_DESCRIPTION" => "N",
			"INCLUDE_SUBSECTIONS" => "N"
		),
		false
	);?>

	<div class="wrapper">
		<div class="blogPage__comment">
			<?
				global $GLOBALS;
				$GLOBALS['elementComments'] = [
					'PROPERTY' => [
						'BLOG' => $arResult['ID']
					]
				];

			?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"comments",
				Array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "N",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "N",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FILTER_NAME" => "elementComments",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "15",
					"IBLOCK_TYPE" => "pages_content",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => "2",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "show-more",
					"PAGER_TITLE" => "Отзывы",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array("ELEMID"),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => 'ACTIVE_FROM',
					"SORT_BY2" => 'SORT',
					"SORT_ORDER1" => 'DESC',
					"SORT_ORDER2" => 'ASC',
					"STRICT_SECTION_CHECK" => "N",
					"FIELD_CODE" => array("ELEMID", "RATING"),
				)
			);?>
			<?
				global $USER;

				$authUserName = $USER->GetFullName();

				$siteSettings = getSiteSettings();

				$grecaptchaSiteKey = $siteSettings["RECAPTCHA_SITE_KEY"]["VALUE"];

				$ELEMENT_ID = $arResult['ID'];
				$COMMENTS_IBLOCK_ID = 15;
			?>
			<form-blog-component auth-user-name='<?= $authUserName ?>' grecaptcha-site-key='<?= $grecaptchaSiteKey ?>' iblock_comment='<?=$COMMENTS_IBLOCK_ID?>' element='<?=$ELEMENT_ID?>' />
		</div>
	</div>
</section>