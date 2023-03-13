<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CHTTP::SetStatus("404");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


\Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/error.css");
\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/error.js");
$APPLICATION->SetPageProperty("not_show_nav_chain", "Y");
// $APPLICATION->SetPageProperty("not_show_title", "Y");
$APPLICATION->SetPageProperty("title", "404 Страница не найдена");
// $APPLICATION->SetTitle("404 Страница не найдена");
?>

<!--Error-->
<div class="error">
    <div class="error__img">
        <img
            src="/local/templates/allmongolia_umax/assets/images/error.jpg"
            alt="Ошибка"
        />
    </div>
    <p class="error__number">404</p>
    <p class="error__description">страница не&nbsp;найдена</p>
    <a href="#" class="button"
    >На главную
        <svg
            width="13"
            height="16"
            viewBox="0 0 13 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z"
                fill="white"
            />
        </svg>
    </a>
</div>

<!--Category-->
<div class="category">
    <p class="category__description">Посмотрите&nbsp;следующие категории</p>
    <ul class="category__card-list">
        <li class="category__card-item">
            <a class="category__card-link" href="#">
                <div class="category__card-img">
                    <img
                        src="/local/templates/allmongolia_umax/assets/images/turtlenecks.jpg"
                        alt="Водолазки"
                    />
                </div>
                <p class="category__card-name">Водолазки</p>
            </a>
        </li>
        <li class="category__card-item">
            <a href="#" class="category__card-link">
                <div class="category__card-img">
                    <img
                        src="/local/templates/allmongolia_umax/assets/images/cardigans.jpg"
                        alt="Кардиганы"
                    />
                </div>
                <p class="category__card-name">Джемперы и&nbsp;кардиганы</p>
            </a>
        </li>
        <li class="category__card-item">
            <a href="#" class="category__card-link">
                <div class="category__card-img">
                    <img
                        src="/local/templates/allmongolia_umax/assets/images/coat.jpg"
                        alt="Пальто"
                    />
                </div>
                <p class="category__card-name">пальто</p>
            </a>
        </li>
        <li class="category__card-item">
            <a href="#" class="category__card-link">
                <div class="category__card-img">
                    <img
                        src="/local/templates/allmongolia_umax/assets/images/dresses.jpg"
                        alt="Платья"
                    />
                </div>
                <p class="category__card-name">платья</p>
            </a>
        </li>
    </ul>
</div>

<?
//$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
//	"LEVEL"	=>	"3",
//	"COL_NUM"	=>	"2",
//	"SHOW_DESCRIPTION"	=>	"Y",
//	"SET_TITLE"	=>	"Y",
//	"CACHE_TIME"	=>	"36000000"
//	)
//);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
