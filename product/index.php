<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/productcard.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/productcard.js");

$APPLICATION->SetPageProperty("title", "Детальная товара");
$APPLICATION->SetTitle("Детальная товара");
?>

<section class="product-page">
    <div class="product-page__wrap">
        <div class="product-page__photo">
            <div class="product-page__photo-swiper--small-wrap">
                <div
                        class="swiper product-page__photo-swiper--small"
                        thumbsSlider=""
                >
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="product-page__photo-slide--small">
                                <img
                                        src="/local/templates/allmongolia_umax/assets/images/product-page__photo-slide--small-1.jpg"
                                        alt=""
                                />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-page__photo-slide--small">
                                <img
                                        src="/local/templates/allmongolia_umax/assets/images/product-page__photo-slide--small-2.jpg"
                                        alt=""
                                />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-page__photo-slide--small">
                                <img
                                        src="/local/templates/allmongolia_umax/assets/images/product-page__photo-slide--small-3.jpg"
                                        alt=""
                                />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-page__photo-slide--small">
                                <img
                                        src="/local/templates/allmongolia_umax/assets/images/product-page__photo-slide--small-5.jpg"
                                        alt=""
                                />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="product-page__photo-slide--small">
                                <img
                                        src="/local/templates/allmongolia_umax/assets/images/categories__card-img-2.jpg"
                                        alt=""
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev product-page__photo-button-prev">
                    <svg
                            width="24"
                            height="20"
                            viewBox="0 0 24 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M10.9393 0.939341C11.5251 0.353554 12.4749 0.353554 13.0607 0.939341L22.6066 10.4853C23.1924 11.0711 23.1924 12.0208 22.6066 12.6066C22.0208 13.1924 21.0711 13.1924 20.4853 12.6066L12 4.12132L3.51472 12.6066C2.92893 13.1924 1.97918 13.1924 1.3934 12.6066C0.807611 12.0208 0.807611 11.0711 1.3934 10.4853L10.9393 0.939341ZM10.5 20L10.5 2L13.5 2L13.5 20L10.5 20Z"
                                fill="black"
                        />
                    </svg>
                </div>
                <div class="swiper-button-next product-page__photo-button-next">
                    <svg
                            width="24"
                            height="20"
                            viewBox="0 0 24 20"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M10.9393 19.0607C11.5251 19.6464 12.4749 19.6464 13.0607 19.0607L22.6066 9.51472C23.1924 8.92893 23.1924 7.97919 22.6066 7.3934C22.0208 6.80761 21.0711 6.80761 20.4853 7.3934L12 15.8787L3.51472 7.3934C2.92893 6.80761 1.97918 6.80761 1.3934 7.3934C0.807611 7.97918 0.807611 8.92893 1.3934 9.51472L10.9393 19.0607ZM10.5 -6.5567e-08L10.5 18L13.5 18L13.5 6.5567e-08L10.5 -6.5567e-08Z"
                                fill="black"
                        />
                    </svg>
                </div>
            </div>
            <div class="swiper product-page__photo-swiper--big">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="product-page__photo-slide--big">
                            <img
                                    src="/local/templates/allmongolia_umax/assets/images/product-page__photo-slide--small-1.jpg"
                                    alt=""
                            />
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-page__photo-slide--big">
                            <img
                                    src="/local/templates/allmongolia_umax/assets/images/product-page__photo-slide--small-2.jpg"
                                    alt=""
                            />
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-page__photo-slide--big">
                            <img
                                    src="/local/templates/allmongolia_umax/assets/images/product-page__photo-slide--small-3.jpg"
                                    alt=""
                            />
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-page__photo-slide--big">
                            <img
                                    src="/local/templates/allmongolia_umax/assets/images/product-page__photo-slide--small-5.jpg"
                                    alt=""
                            />
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-page__photo-slide--big">
                            <img
                                    src="/local/templates/allmongolia_umax/assets/images/categories__card-img-2.jpg"
                                    alt=""
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-page__content">
            <h1 class="product-page__title">
                Бежевый пуловер женский из кашемира
            </h1>
            <div class="product-page__inf">
                <!-- "product-page__price-wrap--discount" /// если убрать класс будет без скидки  -->
                <div
                        class="product-page__price-wrap product-page__price-wrap--discount"
                >
                    <div class="product-page__price">14 904 руб.</div>
                    <div class="product-page__price-discount">
                        <div
                                class="product-page__price product-page__price--discount"
                        >
                            11 924 руб.
                        </div>
                        <div class="product-page__price-discount-subtitle">
                            Ваша скидка 2 980 руб.
                        </div>
                    </div>
                </div>
                <div class="product-page__estimation">
                    <div class="rating-mini">
                        <span class="active"></span>
                        <span class="active"></span>
                        <span class="active"></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="product-page__estimation-text">Отзывы (250)</div>
                </div>
            </div>
            <form class="product-page__form">
                <div class="product-page__form-wrap">
                    <div class="product-page__form-title">Размер</div>
                    <div class="product-page__form-cards">
                        <div class="product-page__form-card">
                            <input
                                    type="radio"
                                    id="product-page__form-size--1"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--1">35 - 37</label>
                        </div>
                        <div class="product-page__form-card">
                            <input
                                    type="radio"
                                    id="product-page__form-size--2"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--2">35 - 37</label>
                        </div>
                        <div class="product-page__form-card">
                            <input
                                    type="radio"
                                    id="product-page__form-size--3"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--3">35 - 37</label>
                        </div>
                        <div class="product-page__form-card">
                            <input
                                    type="radio"
                                    id="product-page__form-size--4"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--4">35 - 37</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--5"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--5">35 - 37</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--6"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--6">35 - 37</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--7"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--7">35 - 37</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--8"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--8">35</label>
                        </div>
                        <div class="product-page__form-card">
                            <input
                                    type="radio"
                                    id="product-page__form-size--9"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--9">35</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--10"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--10">35</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--11"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--11">35</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--12"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--12">35</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--13"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--13">35</label>
                        </div>
                        <div
                                class="product-page__form-card product-page__form-card--non"
                        >
                            <input
                                    type="radio"
                                    id="product-page__form-size--14"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--14">35</label>
                        </div>
                        <div class="product-page__form-card">
                            <input
                                    type="radio"
                                    id="product-page__form-size--15"
                                    name="product-page__form-size"
                            />
                            <label for="product-page__form-size--15">Один размер</label>
                        </div>
                    </div>
                    <div class="product-page__form-text">Таблица размеров</div>
                </div>
                <div class="product-page__form-wrap">
                    <div class="product-page__form-title">Цвета</div>
                    <div class="product-page__form-colors">
                        <div class="product-page__form-color">
                            <input
                                    type="radio"
                                    id="product-page__form-color--1"
                                    name="product-page__form-color"
                            />
                            <label for="product-page__form-color--1"></label>
                        </div>
                        <div class="product-page__form-color">
                            <input
                                    type="radio"
                                    id="product-page__form-color--2"
                                    name="product-page__form-color"
                            />
                            <label for="product-page__form-color--2"></label>
                        </div>
                        <div class="product-page__form-color">
                            <input
                                    type="radio"
                                    id="product-page__form-color--3"
                                    name="product-page__form-color"
                            />
                            <label for="product-page__form-color--3"></label>
                        </div>
                        <div class="product-page__form-color">
                            <input
                                    type="radio"
                                    id="product-page__form-color--4"
                                    name="product-page__form-color"
                            />
                            <label for="product-page__form-color--4"></label>
                        </div>
                        <div class="product-page__form-color">
                            <input
                                    type="radio"
                                    id="product-page__form-color--5"
                                    name="product-page__form-color"
                            />
                            <label for="product-page__form-color--5"></label>
                        </div>
                    </div>
                </div>
            </form>
            <div class="product-page__payment">
                <div class="product-page__payment-item">
                    <div class="product-page__payment-img">
                        <svg
                                width="61"
                                height="38"
                                viewBox="0 0 61 38"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    d="M20.2001 35.8006C23.072 35.8006 25.4002 33.4725 25.4002 30.6005C25.4002 27.7285 23.072 25.4004 20.2001 25.4004C17.3282 25.4004 15 27.7285 15 30.6005C15 33.4725 17.3282 35.8006 20.2001 35.8006Z"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-miterlimit="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                            <path
                                    d="M46.2008 35.8006C49.0729 35.8006 51.4009 33.4725 51.4009 30.6005C51.4009 27.7285 49.0729 25.4004 46.2008 25.4004C43.3288 25.4004 41.0007 27.7285 41.0007 30.6005C41.0007 33.4725 43.3288 35.8006 46.2008 35.8006Z"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-miterlimit="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                            <path
                                    d="M25.5305 30.6006H38.4008V3.56003C38.4008 2.69845 37.7024 2 36.8407 2H2"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-linecap="round"
                            />
                            <path
                                    d="M14.0903 30.6006H8.76023C7.89865 30.6006 7.2002 29.9022 7.2002 29.0406V16.3003"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-linecap="round"
                            />
                            <path
                                    d="M4.6001 9.80029H15.0003"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                            <path
                                    d="M38.4006 9.80029H52.9872C53.6037 9.80029 54.1624 10.1634 54.4128 10.7267L59.0666 21.1979C59.1553 21.3976 59.2011 21.6134 59.2011 21.8315V29.0407C59.2011 29.9023 58.5027 30.6007 57.641 30.6007H52.7009"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-linecap="round"
                            />
                            <path
                                    d="M38.4006 30.6006H41.0007"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <div class="product-page__payment-text">
                        Бесплатная доставка по россии
                    </div>
                </div>
                <div class="product-page__payment-item">
                    <div class="product-page__payment-img">
                        <svg
                                width="51"
                                height="47"
                                viewBox="0 0 51 47"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    d="M44.232 44.7285H7.55799C4.66449 44.7285 2.31885 42.3829 2.31885 39.4894V15.9132C2.31885 13.0197 4.66449 10.6741 7.55799 10.6741H44.232C47.1256 10.6741 49.4711 13.0197 49.4711 15.9132V39.4894C49.4711 42.3829 47.1256 44.7285 44.232 44.7285Z"
                                    stroke="black"
                                    stroke-width="3"
                            />
                            <path
                                    d="M37.6833 29.0112C36.9601 29.0112 36.3735 28.4247 36.3735 27.7014C36.3735 26.9781 36.9601 26.3916 37.6833 26.3916C38.4066 26.3916 38.9931 26.9781 38.9931 27.7014C38.9931 28.4247 38.4066 29.0112 37.6833 29.0112Z"
                                    fill="black"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                            <path
                                    d="M41.6124 10.6739V7.01495C41.6124 3.57268 38.3495 1.06577 35.0234 1.95271L6.20805 9.6368C3.91461 10.2484 2.31885 12.3255 2.31885 14.699V15.9131"
                                    stroke="black"
                                    stroke-width="3"
                            />
                        </svg>
                    </div>
                    <div class="product-page__payment-text">
                        Оплата онлайн, наличными, картой
                    </div>
                </div>
                <div class="product-page__payment-item">
                    <div class="product-page__payment-img">
                        <svg
                                width="54"
                                height="39"
                                viewBox="0 0 54 39"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    d="M41.0789 29.9135H15.9567C11.3045 29.9135 2 27.1221 2 15.9567C2 4.79135 11.3045 2 15.9567 2H38.2875C42.9398 2 52.2442 4.79135 52.2442 15.9567C52.2442 20.1278 50.9457 23.1305 49.0761 25.2553"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                            <path
                                    d="M34.1006 22.9353L41.079 29.9137L34.1006 36.892"
                                    stroke="black"
                                    stroke-width="3"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                    <div class="product-page__payment-text">
                        возврат в течение 30 дней
                    </div>
                </div>
            </div>
            <div class="product-page__btns">
                <div class="product-page__btn product-page__btn--big">
                    <svg
                            width="39"
                            height="39"
                            viewBox="0 0 39 39"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M6.73075 6.49999L9.76625 26.221C9.82086 26.614 10.0171 26.9736 10.3181 27.2321C10.6192 27.4906 11.0042 27.6303 11.401 27.625H29.25C29.5996 27.625 29.9399 27.5123 30.2203 27.3036C30.5008 27.0948 30.7064 26.8012 30.8068 26.4664L35.6818 10.2164C35.7544 9.97374 35.7694 9.71747 35.7255 9.46803C35.6815 9.21859 35.5799 8.98287 35.4286 8.77969C35.2774 8.57652 35.0808 8.41151 34.8544 8.29784C34.6281 8.18416 34.3783 8.12497 34.125 8.12499H10.27L9.73375 4.65074C9.67958 4.253 9.47912 3.88973 9.1715 3.63186C8.87197 3.37902 8.49093 3.24335 8.099 3.24999H4.875C4.6616 3.24999 4.45029 3.29202 4.25314 3.37368C4.05599 3.45535 3.87685 3.57504 3.72595 3.72594C3.57506 3.87684 3.45536 4.05597 3.3737 4.25313C3.29203 4.45028 3.25 4.66159 3.25 4.87499C3.25 5.08839 3.29203 5.2997 3.3737 5.49685C3.45536 5.694 3.57506 5.87314 3.72595 6.02404C3.87685 6.17493 4.05599 6.29463 4.25314 6.37629C4.45029 6.45796 4.6616 6.49999 4.875 6.49999H6.73075V6.49999ZM12.7692 24.375L10.7705 11.375H31.941L28.041 24.375H12.7692V24.375ZM16.25 32.5C16.25 33.3619 15.9076 34.1886 15.2981 34.7981C14.6886 35.4076 13.862 35.75 13 35.75C12.138 35.75 11.3114 35.4076 10.7019 34.7981C10.0924 34.1886 9.75 33.3619 9.75 32.5C9.75 31.638 10.0924 30.8114 10.7019 30.2019C11.3114 29.5924 12.138 29.25 13 29.25C13.862 29.25 14.6886 29.5924 15.2981 30.2019C15.9076 30.8114 16.25 31.638 16.25 32.5V32.5ZM30.875 32.5C30.875 33.3619 30.5326 34.1886 29.9231 34.7981C29.3136 35.4076 28.487 35.75 27.625 35.75C26.763 35.75 25.9364 35.4076 25.3269 34.7981C24.7174 34.1886 24.375 33.3619 24.375 32.5C24.375 31.638 24.7174 30.8114 25.3269 30.2019C25.9364 29.5924 26.763 29.25 27.625 29.25C28.487 29.25 29.3136 29.5924 29.9231 30.2019C30.5326 30.8114 30.875 31.638 30.875 32.5V32.5Z"
                                fill="white"
                        />
                    </svg>
                    Добавить в корзину
                </div>
                <div class="product-page__btn product-page__btn--small">
                    <svg
                            width="38"
                            height="38"
                            viewBox="0 0 38 38"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M19 32.9531C18.8488 32.9507 18.7006 32.9098 18.5695 32.8343C18.4063 32.7601 14.725 30.6671 10.9844 27.3124C5.86328 22.696 3.26563 18.1093 3.26563 13.6562C3.26428 11.8138 3.85403 10.0195 4.94818 8.53713C6.04233 7.05477 7.58316 5.96251 9.3442 5.42091C11.1052 4.87931 12.9936 4.91693 14.7316 5.52826C16.4697 6.13958 17.9658 7.29236 19 8.81713C20.0342 7.29236 21.5303 6.13958 23.2684 5.52826C25.0064 4.91693 26.8948 4.87931 28.6558 5.42091C30.4168 5.96251 31.9577 7.05477 33.0518 8.53713C34.146 10.0195 34.7357 11.8138 34.7344 13.6562C34.7344 18.1093 32.1367 22.696 27.0156 27.3124C23.275 30.6671 19.5938 32.7601 19.4305 32.8343C19.2994 32.9098 19.1512 32.9507 19 32.9531Z"
                                fill="white"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-items">
    <div class="product-items__tabs">
        <div
                class="product-items__tab product-items__tab--active"
                data-id="1"
        >
            ОПИСАНИЕ
        </div>
        <div class="product-items__tab" data-id="2">Характеристики</div>
        <div class="product-items__tab" data-id="3">Доставка и оплата</div>
        <div class="product-items__tab" data-id="4">гарантии и возврат</div>
        <div class="product-items__tab" data-id="5">отзывы</div>
    </div>
    <div class="product-items__bottom">
        <div
                class="product-items__bottom-item product-items__acc product-items__bottom-item--active"
                data-id="1"
        >
            <div class="product-items__bottom-item-top product-items__acc-top">
                ОПИСАНИЕ
                <svg
                        width="15"
                        height="9"
                        viewBox="0 0 15 9"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M6.72331 8.70711C7.11384 9.09763 7.747 9.09763 8.13753 8.70711L14.5015 2.34315C14.892 1.95262 14.892 1.31946 14.5015 0.928932C14.111 0.538408 13.4778 0.538408 13.0873 0.928932L7.43042 6.58579L1.77357 0.928932C1.38304 0.538408 0.749877 0.538408 0.359352 0.928932C-0.031172 1.31946 -0.031172 1.95262 0.359352 2.34315L6.72331 8.70711ZM6.43042 7L6.43042 8L8.43042 8L8.43042 7L6.43042 7Z"
                            fill="black"
                    />
                </svg>
            </div>
            <div
                    class="product-items__bottom-item-content product-items__acc-bottom"
            >
                <div class="product-items__bottom-item-content-textwrap">
                    <p>Пуловер из 100% кашемира.</p>
                    <p>Производство "Gobis'Sun"</p>
                </div>
            </div>
        </div>
        <div
                class="product-items__bottom-item product-items__acc"
                data-id="2"
        >
            <div class="product-items__bottom-item-top product-items__acc-top">
                Характеристики
                <svg
                        width="15"
                        height="9"
                        viewBox="0 0 15 9"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M6.72331 8.70711C7.11384 9.09763 7.747 9.09763 8.13753 8.70711L14.5015 2.34315C14.892 1.95262 14.892 1.31946 14.5015 0.928932C14.111 0.538408 13.4778 0.538408 13.0873 0.928932L7.43042 6.58579L1.77357 0.928932C1.38304 0.538408 0.749877 0.538408 0.359352 0.928932C-0.031172 1.31946 -0.031172 1.95262 0.359352 2.34315L6.72331 8.70711ZM6.43042 7L6.43042 8L8.43042 8L8.43042 7L6.43042 7Z"
                            fill="black"
                    />
                </svg>
            </div>
            <div
                    class="product-items__bottom-item-content product-items__acc-bottom"
            >
                <div class="product-items__bottom-item-content-textwrap">
                    <p>Пуловер из 100% кашемира.</p>
                    <p>Производство "Gobis'Sun"</p>
                </div>
            </div>
        </div>
        <div
                class="product-items__bottom-item product-items__acc"
                data-id="3"
        >
            <div class="product-items__bottom-item-top product-items__acc-top">
                Доставка и оплата
                <svg
                        width="15"
                        height="9"
                        viewBox="0 0 15 9"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M6.72331 8.70711C7.11384 9.09763 7.747 9.09763 8.13753 8.70711L14.5015 2.34315C14.892 1.95262 14.892 1.31946 14.5015 0.928932C14.111 0.538408 13.4778 0.538408 13.0873 0.928932L7.43042 6.58579L1.77357 0.928932C1.38304 0.538408 0.749877 0.538408 0.359352 0.928932C-0.031172 1.31946 -0.031172 1.95262 0.359352 2.34315L6.72331 8.70711ZM6.43042 7L6.43042 8L8.43042 8L8.43042 7L6.43042 7Z"
                            fill="black"
                    />
                </svg>
            </div>
            <div
                    class="product-items__bottom-item-content product-items__bottom-item-content--delivery product-items__acc-bottom"
            >
                <div
                        class="product-items__bottom-item-content-textwrap product-items__bottom-item-content-textwrap--left"
                >
                    <div class="product-items__bottom-item-content-title">
                        Доставка по всей России
                        <br />
                        <br />
                    </div>
                    <div class="product-items__bottom-item-content-text">
                        Доставка наших товаров производитсяиз города Улан-Удэ в любую
                        точку России. Доставка рассчитывается индивидуально. Цена
                        доставки от 400 рублей. Сроки от 3 до 10 дней.**
                    </div>
                </div>
                <div
                        class="product-items__bottom-item-content-textwrap product-items__bottom-item-content-textwrap--right"
                >
                    <div class="product-items__bottom-item-content-title">
                        Способы оплаты
                        <br />
                        <br />
                    </div>
                    <div class="product-items__bottom-item-content-title">
                        Наличный расчёт
                    </div>
                    <div class="product-items__bottom-item-content-text">
                        Если товар доставляется курьером, то оплата осуществляется
                        наличными курьеру в руки. При получении товара обязательно
                        проверьте комплектацию товара, наличие гарантийного талона и
                        чека.
                    </div>
                    <div class="product-items__bottom-item-content-title">
                        Банковской картой
                    </div>
                    <div class="product-items__bottom-item-content-text">
                        Для выбора оплаты товара с помощью банковской карты на
                        соответствующей странице необходимо нажать кнопку Оплата
                        заказа банковской картой. Оплата происходит через ПАО СБЕРБАНК
                        с использованием банковских карт следующих платёжных систем:
                    </div>
                    <div class="product-items__bottom-item-content-img">
                        <img
                                src="/local/templates/allmongolia_umax/assets/images/product-items__bottom-item-bottom-img--1.jpg"
                                alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
        <div
                class="product-items__bottom-item product-items__acc"
                data-id="4"
        >
            <div class="product-items__bottom-item-top product-items__acc-top">
                гарантии и возврат
                <svg
                        width="15"
                        height="9"
                        viewBox="0 0 15 9"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M6.72331 8.70711C7.11384 9.09763 7.747 9.09763 8.13753 8.70711L14.5015 2.34315C14.892 1.95262 14.892 1.31946 14.5015 0.928932C14.111 0.538408 13.4778 0.538408 13.0873 0.928932L7.43042 6.58579L1.77357 0.928932C1.38304 0.538408 0.749877 0.538408 0.359352 0.928932C-0.031172 1.31946 -0.031172 1.95262 0.359352 2.34315L6.72331 8.70711ZM6.43042 7L6.43042 8L8.43042 8L8.43042 7L6.43042 7Z"
                            fill="black"
                    />
                </svg>
            </div>
            <div
                    class="product-items__bottom-item-content product-items__acc-bottom"
            >
                <div class="product-items__bottom-item-content-title">
                    Способы оплаты
                </div>
                <div class="product-items__bottom-item-content-textwrap">
                    <p>
                        Доставка наших товаров производитсяиз города Улан-Удэ в любую
                        точку России.
                    </p>
                    <p>Доставка рассчитывается индивидуально.</p>
                    <p>Цена доставки от 400 рублей.</p>
                    <p>Сроки от 3 до 10 дней.**</p>
                </div>
            </div>
        </div>
        <div
                class="product-items__bottom-item product-items__acc"
                data-id="5"
        >
            <div class="product-items__bottom-item-top product-items__acc-top">
                отзывы
                <svg
                        width="15"
                        height="9"
                        viewBox="0 0 15 9"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M6.72331 8.70711C7.11384 9.09763 7.747 9.09763 8.13753 8.70711L14.5015 2.34315C14.892 1.95262 14.892 1.31946 14.5015 0.928932C14.111 0.538408 13.4778 0.538408 13.0873 0.928932L7.43042 6.58579L1.77357 0.928932C1.38304 0.538408 0.749877 0.538408 0.359352 0.928932C-0.031172 1.31946 -0.031172 1.95262 0.359352 2.34315L6.72331 8.70711ZM6.43042 7L6.43042 8L8.43042 8L8.43042 7L6.43042 7Z"
                            fill="black"
                    />
                </svg>
            </div>
            <div
                    class="product-items__bottom-item-content product-items__bottom-item-content--feedback product-items__acc-bottom"
            >
                <div class="product-items__bottom-item-content-left">
                    <div class="product-items__bottom-head">
                        <div class="product-items__bottom-selector">
                            <div class="product-items__bottom-selector-top">
                                <div class="product-items__bottom-selector-top-text">
                                    Сортировать по
                                </div>
                                <svg
                                        width="16"
                                        height="9"
                                        viewBox="0 0 16 9"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                            d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928933 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
                                            fill="#838383"
                                    />
                                </svg>
                            </div>
                            <div class="product-items__bottom-selector-content">
                                <div class="product-items__bottom-selector-content-item">
                                    Сначала новые
                                </div>
                                <div class="product-items__bottom-selector-content-item">
                                    Сначала полезные
                                </div>
                                <div class="product-items__bottom-selector-content-item">
                                    Сначала с высокой оценкой
                                </div>
                                <div class="product-items__bottom-selector-content-item">
                                    Сначала с низкой оценкой
                                </div>
                            </div>
                        </div>
                        <form class="product-items__bottom-check">
                            <input
                                    type="checkbox"
                                    id="product-items__bottom-check"
                                    name="product-items__bottom-check"
                            />
                            <label for="product-items__bottom-check"
                            >Только с фото</label
                            >
                        </form>
                    </div>
                    <div class="product-items__bottom-comment">
                        <div class="product-items__bottom-comment-head">
                            <div class="product-items__bottom-comment-head-info">
                                <div class="product-items__bottom-comment-head-name">
                                    Юлия
                                </div>
                                <div class="product-items__bottom-comment-head-data">
                                    10.12.2022
                                </div>
                                <div class="product-items__bottom-comment-head-size">
                                    Размер: <span> 46</span>
                                </div>
                            </div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div class="product-items__bottom-comment-text">
                            Lorem ipsum dolor sit amet consectetur. Egestas erat
                            scelerisque feugiat mollis vitae pellentesque metus.
                            Fermentum lacinia iaculis feugiat sit a. Purus facilisis
                            faucibus eget laoreet erat nisl. Convallis semper eget duis
                            cursus ligula.
                        </div>
                    </div>
                    <div class="product-items__bottom-comment">
                        <div class="product-items__bottom-comment-head">
                            <div class="product-items__bottom-comment-head-info">
                                <div class="product-items__bottom-comment-head-name">
                                    Юлия
                                </div>
                                <div class="product-items__bottom-comment-head-data">
                                    10.12.2022
                                </div>
                                <div class="product-items__bottom-comment-head-size">
                                    Размер: <span> 46</span>
                                </div>
                            </div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div class="product-items__bottom-comment-text">
                            Lorem ipsum dolor sit amet consectetur. Egestas erat
                            scelerisque feugiat mollis vitae pellentesque metus.
                            Fermentum lacinia iaculis feugiat sit a. Purus facilisis
                            faucibus eget laoreet erat nisl. Convallis semper eget duis
                            cursus ligula.
                        </div>
                    </div>
                    <div class="product-items__bottom-comment">
                        <div class="product-items__bottom-comment-head">
                            <div class="product-items__bottom-comment-head-info">
                                <div class="product-items__bottom-comment-head-name">
                                    Юлия
                                </div>
                                <div class="product-items__bottom-comment-head-data">
                                    10.12.2022
                                </div>
                                <div class="product-items__bottom-comment-head-size">
                                    Размер: <span> 46</span>
                                </div>
                            </div>
                            <div class="rating-mini">
                                <span class="active"></span>
                                <span class="active"></span>
                                <span class="active"></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <div class="product-items__bottom-comment-text">
                            Lorem ipsum dolor sit amet consectetur. Egestas erat
                            scelerisque feugiat mollis vitae pellentesque metus.
                            Fermentum lacinia iaculis feugiat sit a. Purus facilisis
                            faucibus eget laoreet erat nisl. Convallis semper eget duis
                            cursus ligula.
                        </div>
                        <div class="product-items__bottom-comment-photo">
                            <a
                                    href="/local/templates/allmongolia_umax/assets/images/product-items__bottom-comment-img.jpg"
                                    class="product-items__bottom-comment-img"
                                    data-fancybox="product-items__bottom-comment-photo"
                            >
                                <img
                                        src="/local/templates/allmongolia_umax/assets/images/product-items__bottom-comment-img.jpg"
                                        alt=""
                                />
                            </a>
                            <a
                                    href="/local/templates/allmongolia_umax/assets/images/product-items__bottom-comment-img.jpg"
                                    class="product-items__bottom-comment-img"
                                    data-fancybox="product-items__bottom-comment-photo"
                            >
                                <img
                                        src="/local/templates/allmongolia_umax/assets/images/product-items__bottom-comment-img.jpg"
                                        alt=""
                                />
                            </a>
                        </div>
                    </div>
                    <div class="product-items__bottom-btn">показать еще</div>
                </div>
                <form class="product-items__bottom-item-content-form">
                    <div class="product-items__bottom-item-content-form-title">
                        Оставить отзыв
                    </div>
                    <input
                            type="text"
                            id="product-items__form-input--name"
                            name="product-items__form-input"
                            placeholder="Имя*"
                            required
                    />
                    <input
                            type="text"
                            id="product-items__form-input--phone"
                            name="product-items__form-input"
                            placeholder="Телефон"
                    />
                    <div class="product-items__bottom-item-content-form-add">
                        <input
                                type="file"
                                id="product-items__form-file"
                                name="product-items__form-file"
                        />
                        <label for="product-items__form-file"> Добавить фото </label>
                    </div>
                    <textarea
                            name="product-items__form-text"
                            id="product-items__form-text"
                            placeholder="Введите текст"
                    ></textarea>
                    <div class="rating-area">
                        <input type="radio" id="star-5" name="rating" value="5" />
                        <label for="star-5" title="Оценка «5»"></label>
                        <input type="radio" id="star-4" name="rating" value="4" />
                        <label for="star-4" title="Оценка «4»"></label>
                        <input type="radio" id="star-3" name="rating" value="3" />
                        <label for="star-3" title="Оценка «3»"></label>
                        <input type="radio" id="star-2" name="rating" value="2" />
                        <label for="star-2" title="Оценка «2»"></label>
                        <input
                                type="radio"
                                id="star-1"
                                name="rating"
                                value="1"
                                checked
                        />
                        <label for="star-1" title="Оценка «1»"></label>
                    </div>
                    <button class="product-items__bottom-item-content-form-btn">
                        Отправить
                        <svg
                                width="13"
                                height="16"
                                viewBox="0 0 13 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                    d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z"
                                    fill="black"
                            />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="product-recently">
    <h2 class="product-recently__title">вы недавно смотрели</h2>
    <div class="product-recently__cards">
        <div class="catalog-content__card">
            <div
                    class="catalog-content__card-mark catalog-content__card-mark--new"
            >
                новинка
            </div>
            <form class="catalog-content__card-favourites">
                <input type="checkbox" id="catalog__card-favourites--1" />
                <label
                        for="catalog__card-favourites--1"
                        name="catalog__card-favourites"
                >
                </label>
            </form>
            <a href="/" class="catalog-content__card-img">
                <img src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg" alt="" />
            </a>
            <div class="catalog-content__card-info">
                <a href="/" class="catalog-content__card-title">
                    Безрукавка Удлинённая Из Шерсти Яка
                </a>
                <div class="catalog-content__card-subtitle">100% шерсть</div>
                <div class="catalog-content__card-availability">
                    Есть в наличии
                </div>
                <div class="catalog-content__card-info-bottom">
                    <div class="catalog-content__card-price-wrap">
                        <div class="catalog-content__card-price">6 210 руб.</div>
                        <div class="catalog-content__card-price--discount">
                            6 210 руб.
                        </div>
                    </div>
                    <div class="catalog-content__card-basket">
                        <div class="catalog-content__card-basket-icon">
                            <svg
                                    width="25"
                                    height="25"
                                    viewBox="0 0 25 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                                        fill="white"
                                />
                            </svg>
                        </div>
                        <div class="catalog-content__card-basket-counter">123</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog-content__card">
            <div
                    class="catalog-content__card-mark catalog-content__card-mark--new"
            >
                новинка
            </div>
            <form class="catalog-content__card-favourites">
                <input type="checkbox" id="catalog__card-favourites--2" />
                <label
                        for="catalog__card-favourites--2"
                        name="catalog__card-favourites"
                >
                </label>
            </form>
            <a href="/" class="catalog-content__card-img">
                <img src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg" alt="" />
            </a>
            <div class="catalog-content__card-info">
                <a href="/" class="catalog-content__card-title">
                    Безрукавка Удлинённая Из Шерсти Яка
                </a>
                <div class="catalog-content__card-subtitle">100% шерсть</div>
                <div class="catalog-content__card-availability">
                    Есть в наличии
                </div>
                <div class="catalog-content__card-info-bottom">
                    <div class="catalog-content__card-price-wrap">
                        <div class="catalog-content__card-price">6 210 руб.</div>
                        <div class="catalog-content__card-price--discount">
                            6 210 руб.
                        </div>
                    </div>
                    <div class="catalog-content__card-basket">
                        <div class="catalog-content__card-basket-icon">
                            <svg
                                    width="25"
                                    height="25"
                                    viewBox="0 0 25 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                                        fill="white"
                                />
                            </svg>
                        </div>
                        <div class="catalog-content__card-basket-counter">123</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog-content__card">
            <div
                    class="catalog-content__card-mark catalog-content__card-mark--new"
            >
                новинка
            </div>
            <form class="catalog-content__card-favourites">
                <input type="checkbox" id="catalog__card-favourites--3" />
                <label
                        for="catalog__card-favourites--3"
                        name="catalog__card-favourites"
                >
                </label>
            </form>
            <a href="/" class="catalog-content__card-img">
                <img src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg" alt="" />
            </a>
            <div class="catalog-content__card-info">
                <a href="/" class="catalog-content__card-title">
                    Безрукавка Удлинённая Из Шерсти Яка
                </a>
                <div class="catalog-content__card-subtitle">100% шерсть</div>
                <div class="catalog-content__card-availability">
                    Есть в наличии
                </div>
                <div class="catalog-content__card-info-bottom">
                    <div class="catalog-content__card-price-wrap">
                        <div class="catalog-content__card-price">6 210 руб.</div>
                        <div class="catalog-content__card-price--discount">
                            6 210 руб.
                        </div>
                    </div>
                    <div class="catalog-content__card-basket">
                        <div class="catalog-content__card-basket-icon">
                            <svg
                                    width="25"
                                    height="25"
                                    viewBox="0 0 25 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                                        fill="white"
                                />
                            </svg>
                        </div>
                        <div class="catalog-content__card-basket-counter">123</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog-content__card">
            <div
                    class="catalog-content__card-mark catalog-content__card-mark--new"
            >
                новинка
            </div>
            <form class="catalog-content__card-favourites">
                <input type="checkbox" id="catalog__card-favourites--4" />
                <label
                        for="catalog__card-favourites--4"
                        name="catalog__card-favourites"
                >
                </label>
            </form>
            <a href="/" class="catalog-content__card-img">
                <img src="/local/templates/allmongolia_umax/assets/images/catalog-image-3.jpg" alt="" />
            </a>
            <div class="catalog-content__card-info">
                <a href="/" class="catalog-content__card-title">
                    Безрукавка Удлинённая Из Шерсти Яка
                </a>
                <div class="catalog-content__card-subtitle">100% шерсть</div>
                <div class="catalog-content__card-availability">
                    Есть в наличии
                </div>
                <div class="catalog-content__card-info-bottom">
                    <div class="catalog-content__card-price-wrap">
                        <div class="catalog-content__card-price">6 210 руб.</div>
                        <div class="catalog-content__card-price--discount">
                            6 210 руб.
                        </div>
                    </div>
                    <div class="catalog-content__card-basket">
                        <div class="catalog-content__card-basket-icon">
                            <svg
                                    width="25"
                                    height="25"
                                    viewBox="0 0 25 25"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                        d="M4.31475 4.16673L6.26058 16.8084C6.29559 17.0603 6.42139 17.2908 6.61436 17.4566C6.80732 17.6223 7.05416 17.7118 7.3085 17.7084H18.7502C18.9743 17.7084 19.1924 17.6362 19.3722 17.5024C19.5519 17.3686 19.6838 17.1804 19.7481 16.9657L22.8731 6.54903C22.9197 6.3935 22.9293 6.22922 22.9011 6.06932C22.8729 5.90943 22.8078 5.75833 22.7108 5.62808C22.6139 5.49784 22.4878 5.39207 22.3427 5.3192C22.1976 5.24633 22.0375 5.20839 21.8752 5.2084H6.5835L6.23975 2.98132C6.20502 2.72636 6.07652 2.49349 5.87933 2.32819C5.68732 2.16611 5.44306 2.07914 5.19183 2.0834H3.12516C2.98837 2.0834 2.85291 2.11034 2.72653 2.16269C2.60015 2.21504 2.48532 2.29177 2.38859 2.3885C2.29187 2.48523 2.21514 2.60006 2.16279 2.72644C2.11044 2.85282 2.0835 2.98827 2.0835 3.12507C2.0835 3.26186 2.11044 3.39732 2.16279 3.5237C2.21514 3.65008 2.29187 3.76491 2.38859 3.86164C2.48532 3.95837 2.60015 4.03509 2.72653 4.08744C2.85291 4.13979 2.98837 4.16673 3.12516 4.16673H4.31475ZM8.18558 15.6251L6.90433 7.29173H20.4752L17.9752 15.6251H8.18558ZM10.4168 20.8334C10.4168 21.3859 10.1973 21.9158 9.80663 22.3065C9.41593 22.6972 8.88603 22.9167 8.3335 22.9167C7.78096 22.9167 7.25106 22.6972 6.86036 22.3065C6.46966 21.9158 6.25016 21.3859 6.25016 20.8334C6.25016 20.2809 6.46966 19.751 6.86036 19.3603C7.25106 18.9696 7.78096 18.7501 8.3335 18.7501C8.88603 18.7501 9.41593 18.9696 9.80663 19.3603C10.1973 19.751 10.4168 20.2809 10.4168 20.8334ZM19.7918 20.8334C19.7918 21.3859 19.5723 21.9158 19.1816 22.3065C18.7909 22.6972 18.261 22.9167 17.7085 22.9167C17.156 22.9167 16.6261 22.6972 16.2354 22.3065C15.8447 21.9158 15.6252 21.3859 15.6252 20.8334C15.6252 20.2809 15.8447 19.751 16.2354 19.3603C16.6261 18.9696 17.156 18.7501 17.7085 18.7501C18.261 18.7501 18.7909 18.9696 19.1816 19.3603C19.5723 19.751 19.7918 20.2809 19.7918 20.8334Z"
                                        fill="white"
                                />
                            </svg>
                        </div>
                        <div class="catalog-content__card-basket-counter">123</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
