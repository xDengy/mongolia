<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss("/local/templates/allmongolia_umax/assets/css/pages/categories.css");
Asset::getInstance()->addJs("/local/templates/allmongolia_umax/assets/js/pages/categories.js");

$APPLICATION->SetPageProperty("title", "Категории");
$APPLICATION->SetTitle("Категории");
?>

<section class="categories-banner">
    <div class="categories-banner__decor">
        <img
                src="/local/templates/allmongolia_umax/assets/images/categories-banner__decor.jpg"
                alt=""
        />
    </div>
    <div class="categories-banner-content">
        <nav aria-label="Breadcrumb" class="breadcrumb">
            <ul>
                <li><a href="#">Главная </a></li>
                <li><span aria-current="page">Для женщин</span></li>
            </ul>
        </nav>
        <h1 class="categories-banner__title">
            Одежда <br />
            для женщин
        </h1>
    </div>
</section>
<section class="categories-cards">
    <a href="/" class="categories__card categories__card--middle">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-1.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
    <a href="/" class="categories__card categories__card--big">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-2.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
    <a href="/" class="categories__card categories__card--big">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-3.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
    <a href="/" class="categories__card categories__card--middle">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-4.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
    <a href="/" class="categories__card categories__card--small">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-5.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
    <a href="/" class="categories__card categories__card--small">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-6.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
    <a href="/" class="categories__card categories__card--small">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-7.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
    <a href="/" class="categories__card categories__card--big">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-8.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
    <a href="/" class="categories__card categories__card--middle">
        <div class="categories__card-img">
            <img
                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-9.jpg"
                    alt=""
            />
        </div>
        <div class="categories__card-title">Водолазки</div>
        <div class="categories__card-btn">подробнее</div>
    </a>
</section>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
