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
?>
<div class="blog__cards">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="blog__card-item">
		<div class="blog__card-info">
			<div class="blog__card-img">
				<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" />
			</div>
			<div class="blog__card-date">
				<svg
						width="24"
						height="24"
						viewBox="0 0 24 24"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
				>
					<path
							d="M3.09277 9.40421H20.9167"
							stroke="#8A9B6E"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
					/>
					<path
							fill-rule="evenodd"
							clip-rule="evenodd"
							d="M6.80811 13.3096C6.80811 12.8954 7.14389 12.5596 7.55811 12.5596H7.56737C7.98158 12.5596 8.31737 12.8954 8.31737 13.3096C8.31737 13.7238 7.98158 14.0596 7.56737 14.0596H7.55811C7.14389 14.0596 6.80811 13.7238 6.80811 13.3096ZM12.005 12.5596C11.5907 12.5596 11.255 12.8954 11.255 13.3096C11.255 13.7238 11.5907 14.0596 12.005 14.0596H12.0142C12.4284 14.0596 12.7642 13.7238 12.7642 13.3096C12.7642 12.8954 12.4284 12.5596 12.0142 12.5596H12.005ZM16.4425 12.5596C16.0282 12.5596 15.6925 12.8954 15.6925 13.3096C15.6925 13.7238 16.0282 14.0596 16.4425 14.0596H16.4517C16.8659 14.0596 17.2017 13.7238 17.2017 13.3096C17.2017 12.8954 16.8659 12.5596 16.4517 12.5596H16.4425ZM16.4425 16.4461C16.0282 16.4461 15.6925 16.7819 15.6925 17.1961C15.6925 17.6103 16.0282 17.9461 16.4425 17.9461H16.4517C16.8659 17.9461 17.2017 17.6103 17.2017 17.1961C17.2017 16.7819 16.8659 16.4461 16.4517 16.4461H16.4425ZM11.255 17.1961C11.255 16.7819 11.5907 16.4461 12.005 16.4461H12.0142C12.4284 16.4461 12.7642 16.7819 12.7642 17.1961C12.7642 17.6103 12.4284 17.9461 12.0142 17.9461H12.005C11.5907 17.9461 11.255 17.6103 11.255 17.1961ZM7.55811 16.446C7.14389 16.446 6.80811 16.7818 6.80811 17.196C6.80811 17.6103 7.14389 17.946 7.55811 17.946H7.56737C7.98158 17.946 8.31737 17.6103 8.31737 17.196C8.31737 16.7818 7.98158 16.446 7.56737 16.446H7.55811Z"
							fill="#8A9B6E"
					/>
					<path
							d="M16.0438 2V5.29078"
							stroke="#8A9B6E"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
					/>
					<path
							d="M7.96564 2V5.29078"
							stroke="#8A9B6E"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
					/>
					<path
							fill-rule="evenodd"
							clip-rule="evenodd"
							d="M16.2383 3.5791H7.77096C4.83427 3.5791 3 5.21504 3 8.22213V17.2718C3 20.3261 4.83427 21.9999 7.77096 21.9999H16.229C19.175 21.9999 21 20.3545 21 17.3474V8.22213C21.0092 5.21504 19.1842 3.5791 16.2383 3.5791Z"
							stroke="#8A9B6E"
							stroke-width="1.5"
							stroke-linecap="round"
							stroke-linejoin="round"
					/>
				</svg>
				<p><?=explode(' ', $arItem['TIMESTAMP_X'])[0]?></p>
			</div>
			<div class="blog__card-views">
				<svg
						width="24"
						height="24"
						viewBox="0 0 24 24"
						fill="none"
						xmlns="http://www.w3.org/2000/svg"
				>
					<rect width="24" height="24" rx="12" fill="white" />
					<path
							fill-rule="evenodd"
							clip-rule="evenodd"
							d="M21.8701 11.5001C21.2301 10.3901 17.7101 4.82012 11.7301 5.00012C6.20007 5.14012 3.00007 10.0001 2.13007 11.5001C1.95144 11.8095 1.95144 12.1907 2.13007 12.5001C2.76007 13.5901 6.13007 19.0001 12.0201 19.0001H12.2701C17.8001 18.8601 21.0101 14.0001 21.8701 12.5001C22.0487 12.1907 22.0487 11.8095 21.8701 11.5001ZM12.0001 15.5001C10.0671 15.5001 8.50007 13.9331 8.50007 12.0001C8.50007 10.0671 10.0671 8.50012 12.0001 8.50012C13.9331 8.50012 15.5001 10.0671 15.5001 12.0001C15.5001 13.9331 13.9331 15.5001 12.0001 15.5001ZM12.0001 13.5001C12.8285 13.5001 13.5001 12.8285 13.5001 12.0001C13.5001 11.1717 12.8285 10.5001 12.0001 10.5001C11.1716 10.5001 10.5001 11.1717 10.5001 12.0001C10.5001 12.8285 11.1716 13.5001 12.0001 13.5001Z"
							fill="black"
					/>
				</svg>
				<p><?=$arItem['SHOW_COUNTER'] ?? 0?></p>
			</div>
		</div>
		<p class="blog__card-title">
			<?=$arItem['NAME']?>
		</p>
		<p class="blog__card-text">
			<?=html_entity_decode($arItem['PREVIEW_TEXT'])?>
		</p>
		<a class="button button--blog" href="<?=$arItem['DETAIL_PAGE_URL']?>">читать подробнее</a>
	</div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
