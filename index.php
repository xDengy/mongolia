<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$APPLICATION->SetPageProperty("title", "Главная");
$APPLICATION->SetTitle("Главная");
?>

<div class="cookies">
    Этот сайт использует Cookies
    <div class="cookies__button">
        OK
    </div>
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"index_big_top_slider",
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "Y",
		"SHARE_HIDE" => "N",
		"SHARE_TEMPLATE" => "",
		"SHARE_HANDLERS" => array(
		),
		"SHARE_SHORTEN_URL_LOGIN" => "",
		"SHARE_SHORTEN_URL_KEY" => "",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "pages_content",
		"IBLOCK_ID" => "1",
		"ELEMENT_ID" => "1",
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "DESCRIPTION",
			2 => "",
		),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
		"DETAIL_URL" => "",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "Y",
		"GROUP_PERMISSIONS" => array(
			0 => "2",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Страница",
		"PAGER_TEMPLATE" => "",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "Y",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "index_big_top_slider",
		"AJAX_OPTION_ADDITIONAL" => "",
		"FILE_404" => ""
	),
	false
);?>

<section class="products">
    <div class="swiper-container products-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="#" class="products__item">
                    <div class="products__item-image">
                        <img
                             data-src="/local/templates/allmongolia_umax/assets/images/products-image-1.jpg"
                             class="lozad">
                    </div>
                    <div class="products__item-title">
                        Водолазка Из Кашемира красная
                    </div>
                    <div class="products__item-price">
                        9.940 ₽ <span>10.899 ₽</span>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="products__item">
                    <div class="products__item-image">
                        <img data-src="/local/templates/allmongolia_umax/assets/images/products-image-2.jpg" class="lozad">
                    </div>
                    <div class="products__item-title">
                        Водолазка Из Кашемира серая
                    </div>
                    <div class="products__item-price">
                        9.899 ₽
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="products__item">
                    <div class="products__item-image">
                        <img data-src="/local/templates/allmongolia_umax/assets/images/products-image-3.jpg" class="lozad">
                    </div>
                    <div class="products__item-title">
                        Кардиган Кашемир На Пуговицах
                    </div>
                    <div class="products__item-price">
                        9.940 ₽
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="products__item">
                    <div class="products__item-image">
                        <img data-src="/local/templates/allmongolia_umax/assets/images/products-image-4.jpg"
                             class="lozad"
                        >
                    </div>
                    <div class="products__item-title">
                        Кардиган Из Шерсти Яка И Кашемира
                    </div>
                    <div class="products__item-price">
                        9.899 ₽ <span>10.899 ₽</span>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="products__item">
                    <div class="products__item-image">
                        <img data-src="/local/templates/allmongolia_umax/assets/images/products-image-5.jpg"
                             class="lozad">
                    </div>
                    <div class="products__item-title">
                        Кардиган На Молнии С Капюшоном
                    </div>
                    <div class="products__item-price">
                        9.940 ₽ <span>10.899 ₽</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "index_big_bottom_slider",
    array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "Y",
        "SHARE_HIDE" => "N",
        "SHARE_TEMPLATE" => "",
        "SHARE_HANDLERS" => array(
        ),
        "SHARE_SHORTEN_URL_LOGIN" => "",
        "SHARE_SHORTEN_URL_KEY" => "",
        "AJAX_MODE" => "Y",
        "IBLOCK_TYPE" => "pages_content",
        "IBLOCK_ID" => "1",
        "ELEMENT_ID" => "4",
        "ELEMENT_CODE" => "",
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => array(
            0 => "ID",
            1 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "DESCRIPTION",
            2 => "",
        ),
        "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
        "DETAIL_URL" => "",
        "SET_TITLE" => "Y",
        "SET_CANONICAL_URL" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_STATUS_404" => "Y",
        "SET_LAST_MODIFIED" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "USE_PERMISSIONS" => "Y",
        "GROUP_PERMISSIONS" => array(
            0 => "2",
        ),
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Страница",
        "PAGER_TEMPLATE" => "",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_BASE_LINK_ENABLE" => "Y",
        "SHOW_404" => "Y",
        "MESSAGE_404" => "",
        "STRICT_SECTION_CHECK" => "Y",
        "PAGER_BASE_LINK" => "",
        "PAGER_PARAMS_NAME" => "arrPager",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "COMPONENT_TEMPLATE" => "index_big_top_slider",
        "AJAX_OPTION_ADDITIONAL" => "",
        "FILE_404" => ""
    ),
    false
);?>

<section class="catalog">
    <div class="swiper-container catalog-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="#" class="catalog__item">
                    <div class="catalog__item-image">
                        <img data-src="/local/templates/allmongolia_umax/assets/images/catalog-image-1.jpg"
                             class="lozad">
                    </div>
                    <div class="catalog__item-btn">
                        пальто
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="catalog__item">
                    <div class="catalog__item-image">
                        <img data-src="/local/templates/allmongolia_umax/assets/images/catalog-image-2.jpg"
                             class="lozad">
                    </div>
                    <div class="catalog__item-btn">
                        водолазки
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#" class="catalog__item">
                    <div class="catalog__item-image">
                        <img data-src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg"
                             class="lozad">
                    </div>
                    <div class="catalog__item-btn">
                        джемперы
                    </div>
                </a>
            </div>
        </div>
    </div>
</section> <br>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>
