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
<?
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/blog.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/blog.js");
?>
<section class="blog">
    <div class="blog__sort">
        <div class="blog__sort-top">
            <div class="blog__sort-top-text">
                <?switch ([$_GET['SORT'], $_GET['ORDER']]):
                    case ['DATE_CREATE', 'ASC']:
                        echo 'От новых к старым';
                        break;
                    case ['DATE_CREATE', 'DESC']:
                        echo 'От старых к новым';
                        break;
                    case ['SHOW_COUNTER', 'DESC']:
                        echo 'По популярности';
                        break;
                    default:
                        echo 'Сортировать по';
                        break;
                endswitch?>
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
                        fill="#838383"
                />
            </svg>
        </div>
        <div class="blog__sort-bottom">
            <a href="?SORT=DATE_CREATE&ORDER=ASC" class="blog__sort-item">От новых к старым</a>
            <a href="?SORT=DATE_CREATE&ORDER=DESC" class="blog__sort-item">От старых к новым</a>
            <a href="?SORT=SHOW_COUNTER&ORDER=DESC" class="blog__sort-item">По популярности</a>
        </div>
    </div>

    <?
    
    if($_GET['SORT'] && $_GET['ORDER']) {
        $arParams["SORT_BY1"] = $_GET['SORT'];
        $arParams["SORT_ORDER1"] = $_GET['ORDER'];
    }
    
    ?>

    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list", 
        "blog", 
        array(
            "IBLOCK_TYPE" => "pages_content",
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "NEWS_COUNT" => $arParams["NEWS_COUNT"],
            "SORT_BY1" => $arParams["SORT_BY1"],
            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
            "SORT_BY2" => $arParams["SORT_BY2"],
            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
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
            "DISPLAY_TOP_PAGER" => $arParams['DISPLAY_TOP_PAGER'],
            "DISPLAY_BOTTOM_PAGER" => $arParams['DISPLAY_BOTTOM_PAGER'],
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "PAGER_SHOW_ALWAYS" => $arParams['PAGER_SHOW_ALWAYS'],
            "PAGER_DESC_NUMBERING" => $arParams['PAGER_DESC_NUMBERING'],
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
            "FILTER_NAME" => $arParams["FILTER_NAME"],
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

    <!-- <div class="blog__pagination">
        <div
                class="blog__pagination__item-nav blog__pagination__item-nav--prev"
        >
            <svg
                    width="20"
                    height="12"
                    viewBox="0 0 20 12"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <path
                        d="M0.469669 5.46967C0.176777 5.76256 0.176777 6.23744 0.469669 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.469669 5.46967ZM20 5.25H1V6.75H20V5.25Z"
                        fill="#838383"
                />
            </svg>
            Назад
        </div>
        <div class="blog__pagination__item-wrap">
            <div class="blog__pagination__item">1</div>
            <div class="blog__pagination__item">2</div>
            <div class="blog__pagination__item active">3</div>
            <div class="blog__pagination__item">4</div>
        </div>
        <div class="blog__pagination__item-nav">
            Далее<svg
                    width="20"
                    height="12"
                    viewBox="0 0 20 12"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <path
                        d="M19.5303 5.46967C19.8232 5.76256 19.8232 6.23744 19.5303 6.53033L14.7574 11.3033C14.4645 11.5962 13.9896 11.5962 13.6967 11.3033C13.4038 11.0104 13.4038 10.5355 13.6967 10.2426L17.9393 6L13.6967 1.75736C13.4038 1.46447 13.4038 0.989593 13.6967 0.696699C13.9896 0.403806 14.4645 0.403806 14.7574 0.696699L19.5303 5.46967ZM0 5.25H19V6.75H0V5.25Z"
                        fill="#838383"
                />
            </svg>
        </div>
    </div> -->
</section>