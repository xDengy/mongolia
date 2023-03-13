<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/cart.css");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/cart.js");

$APPLICATION->SetPageProperty("title", "Корзина");
$APPLICATION->SetTitle("Корзина");

?>

<div class="cart cart-wrap">
    <h1 class="page-title">Корзина</h1>
    <div class="bread" id="Bread">
        <a href="/" class="bread__link"
        ><svg
                    width="15"
                    height="15"
                    viewBox="0 0 15 15"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <path
                        d="M7.49969 3.94104L2.15001 8.35128C2.15001 8.35751 2.14845 8.36666 2.14532 8.37914C2.14225 8.39153 2.14062 8.40052 2.14062 8.40691V12.8727C2.14062 13.034 2.19958 13.1737 2.31745 13.2914C2.43528 13.4091 2.57482 13.4684 2.7361 13.4684H6.30868V9.89561H8.69073V13.4685H12.2633C12.4245 13.4685 12.5643 13.4094 12.6819 13.2914C12.7998 13.1739 12.8589 13.034 12.8589 12.8727V8.40691C12.8589 8.38214 12.8556 8.36344 12.8496 8.35128L7.49969 3.94104Z"
                        fill="black"
                />
                <path
                        d="M14.8965 7.34643L12.8591 5.65311V1.85708C12.8591 1.7703 12.8312 1.69894 12.7752 1.64308C12.7197 1.58729 12.6483 1.5594 12.5613 1.5594H10.775C10.6881 1.5594 10.6168 1.58729 10.5609 1.64308C10.5051 1.69894 10.4773 1.77034 10.4773 1.85708V3.67133L8.20717 1.77327C8.00891 1.61199 7.77317 1.53137 7.50021 1.53137C7.22729 1.53137 6.99159 1.61199 6.79313 1.77327L0.103386 7.34643C0.0413718 7.39596 0.00738296 7.46264 0.00106097 7.54639C-0.00522844 7.63007 0.0164423 7.70317 0.0661384 7.76515L0.642971 8.45366C0.692667 8.50945 0.757712 8.54357 0.838366 8.55605C0.912829 8.56231 0.987292 8.54054 1.06175 8.49094L7.50002 3.1224L13.9383 8.49091C13.9881 8.53418 14.0531 8.55579 14.1337 8.55579H14.1617C14.2422 8.54354 14.3071 8.50919 14.3571 8.45353L14.934 7.76512C14.9836 7.703 15.0053 7.63004 14.9989 7.54626C14.9925 7.46274 14.9584 7.39606 14.8965 7.34643Z"
                        fill="black"
                />
            </svg>
        </a>
        <div class="bread__items">
            <div class="bread__separator">/</div>
            <a class="bread__page">Корзина</a>
        </div>
    </div>
    <section class="cart-products">
        <div class="cart-products-left accordion2 is-active">
            <div class="cart-products__top accordion__header2">
                <div class="cart-products__top-title">Товары, 2 шт</div>
                <div class="cart-products__top-button">
                    Очистить корзину
                    <svg
                            width="16"
                            height="9"
                            viewBox="0 0 16 9"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 2V1H7V2H9Z"
                                fill="black"
                        />
                    </svg>
                </div>
            </div>
            <div class="cart-products__cards accordion__description2">
                <div class="cart-products__card">
                    <div class="cart-products__card-img">
                        <img
                                src="/local/templates/allmongolia_umax/assets/images/"
                                alt=""
                        />
                    </div>
                    <div class="cart-products__card-wrap">
                        <div class="cart-products__card-info">
                            <div class="cart-products__card-info-top">
                                <div class="cart-products__card-name">
                                    Жилет Удлиненный Из Шерсти Яка
                                </div>
                                <div class="cart-products__card-model">Модель: kf30</div>
                            </div>
                            <div class="cart-products__card-parameters">
                                Цвет: Коричневый | Размер: 52
                                <!-- <div class="cart-products__card-color">Цвет: Коричневый </div>
                                <div class="cart-products__card-size">| Размер: 52</div> -->
                            </div>
                        </div>
                        <div class="cart-products__card-cont">
                            <div class="cart-products__card-counter">
                                <div
                                        class="cart-products__card-button cart-products__card-button--minus"
                                >
                                    -
                                </div>
                                <input
                                        type="text"
                                        class="cart-products__card-number"
                                        value="1"
                                />
                                <div
                                        class="cart-products__card-button cart-products__card-button--plus"
                                >
                                    +
                                </div>
                            </div>
                            <div class="cart-products__card-right">
                                <div class="cart-products__card-price">1.210 руб</div>
                                <div class="cart-products__card-delete">
                                    <svg
                                            width="17"
                                            height="20"
                                            viewBox="0 0 17 20"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M6.42995 0.0382218C6.1316 0.0967502 5.72108 0.319807 5.49416 0.546731C5.11509 0.925837 4.94568 1.40864 4.94384 2.11524L4.94306 2.41804L3.76116 2.41882C2.4313 2.41968 2.13882 2.44855 1.78515 2.61378C1.46801 2.76194 1.09113 3.13554 0.945824 3.44572C0.619776 4.14189 0.759534 4.94711 1.29934 5.48261C1.48586 5.66765 1.92678 5.93443 2.0461 5.93443C2.07759 5.93443 2.09229 7.58143 2.09994 11.9611L2.11041 17.9878L2.21684 18.3004C2.3643 18.7333 2.57352 19.068 2.87292 19.35C3.17991 19.6391 3.50658 19.8193 3.91143 19.9228C4.20372 19.9976 4.36048 20 8.88924 20C13.418 20 13.5748 19.9976 13.867 19.9228C14.8174 19.6797 15.499 18.8911 15.6477 17.8622C15.6714 17.6985 15.6863 15.3681 15.6868 11.7688L15.6876 5.94049L15.8341 5.89266C16.3933 5.71012 16.8793 5.11417 16.9803 4.48693C17.0866 3.8269 16.7567 3.09068 16.1924 2.72857C15.7665 2.45531 15.6993 2.44515 14.1989 2.4273L12.8471 2.41124L12.8225 1.95415C12.7952 1.44771 12.7151 1.15483 12.5211 0.852423C12.2597 0.445147 11.7873 0.12492 11.3159 0.0355259C11.0576 -0.0134692 6.68126 -0.0110468 6.42995 0.0382218ZM11.3711 1.01762C11.7212 1.20973 11.861 1.47932 11.8884 2.01522L11.9089 2.41804H8.89053H5.87213L5.88651 1.99802C5.89933 1.6249 5.91288 1.55758 6.00822 1.39496C6.06721 1.29432 6.17056 1.17273 6.23784 1.12483C6.50551 0.934238 6.49434 0.93498 8.94784 0.944201C11.0101 0.951976 11.2655 0.959712 11.3711 1.01762ZM15.5899 3.4594C15.7891 3.56657 15.9015 3.68781 15.9833 3.88351C16.1337 4.24359 16.0099 4.67521 15.6919 4.8987L15.5246 5.01626L8.97379 5.02775C4.40044 5.0358 2.3793 5.02665 2.27822 4.99743C1.88908 4.8849 1.63961 4.43528 1.73822 4.02413C1.81238 3.715 2.0613 3.47131 2.38391 3.392C2.44838 3.37614 5.41094 3.3659 8.96738 3.36922L15.4336 3.37528L15.5899 3.4594ZM14.7409 11.7365C14.7481 15.655 14.7383 17.5668 14.7099 17.7534C14.6276 18.2937 14.3488 18.6928 13.8989 18.9143L13.638 19.0428L8.99176 19.0533C3.95113 19.0648 4.08417 19.0698 3.74225 18.854C3.42234 18.652 3.1572 18.2581 3.0725 17.8589C3.04113 17.7109 3.02858 15.9873 3.02858 11.8126V5.97323L8.87947 5.98315L14.7304 5.99304L14.7409 11.7365ZM5.81099 7.37771C5.74781 7.44089 5.6849 7.54857 5.67123 7.61702C5.65756 7.68548 5.64634 9.73538 5.64634 12.1724C5.64634 16.8966 5.64083 16.7552 5.83146 16.9248C5.94942 17.0298 6.15911 17.0505 6.32192 16.9732C6.60108 16.8408 6.58405 17.1558 6.58405 12.1291C6.58405 7.22342 6.59503 7.47305 6.37252 7.32723C6.31836 7.29176 6.19603 7.26285 6.10003 7.26285C5.95938 7.26285 5.90374 7.28496 5.81099 7.37771ZM8.60964 7.35095C8.5526 7.3992 8.48665 7.47707 8.46313 7.524C8.43293 7.58432 8.42038 8.93438 8.42038 12.1285C8.42038 17.1559 8.40335 16.8408 8.68251 16.9732C8.84532 17.0505 9.05501 17.0298 9.17297 16.9248C9.3636 16.7552 9.35809 16.8966 9.35809 12.1724C9.35809 9.73538 9.34688 7.68548 9.3332 7.61702C9.31953 7.54857 9.25662 7.44089 9.19344 7.37771C9.04368 7.22795 8.76999 7.21537 8.60964 7.35095ZM11.3273 7.39569L11.1944 7.52853V12.1057C11.1944 16.0363 11.2025 16.6984 11.2513 16.7929C11.3135 16.913 11.522 17.0306 11.6732 17.0306C11.8192 17.0306 12.0284 16.8696 12.0811 16.7167C12.1425 16.5384 12.1526 7.8266 12.0917 7.60722C12.0334 7.39717 11.8559 7.26285 11.6368 7.26285C11.4879 7.26285 11.4392 7.28379 11.3273 7.39569Z"
                                                fill="black"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-products__card">
                    <div class="cart-products__card-img">
                        <img
                                src="/local/templates/allmongolia_umax/assets/images/"
                                alt=""
                        />
                    </div>
                    <div class="cart-products__card-wrap">
                        <div class="cart-products__card-info">
                            <div class="cart-products__card-info-top">
                                <div class="cart-products__card-name">
                                    Жилет Удлиненный Из Шерсти Яка
                                </div>
                                <div class="cart-products__card-model">Модель: kf30</div>
                            </div>
                            <div class="cart-products__card-parameters">
                                Цвет: Коричневый | Размер: 52
                                <!-- <div class="cart-products__card-color">Цвет: Коричневый </div>
                                <div class="cart-products__card-size">| Размер: 52</div> -->
                            </div>
                        </div>
                        <div class="cart-products__card-cont">
                            <div class="cart-products__card-counter">
                                <div
                                        class="cart-products__card-button cart-products__card-button--minus"
                                >
                                    -
                                </div>
                                <input
                                        type="text"
                                        class="cart-products__card-number"
                                        value="1"
                                />
                                <div
                                        class="cart-products__card-button cart-products__card-button--plus"
                                >
                                    +
                                </div>
                            </div>
                            <div class="cart-products__card-right">
                                <div class="cart-products__card-price">1.210 руб</div>
                                <div class="cart-products__card-delete">
                                    <svg
                                            width="17"
                                            height="20"
                                            viewBox="0 0 17 20"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M6.42995 0.0382218C6.1316 0.0967502 5.72108 0.319807 5.49416 0.546731C5.11509 0.925837 4.94568 1.40864 4.94384 2.11524L4.94306 2.41804L3.76116 2.41882C2.4313 2.41968 2.13882 2.44855 1.78515 2.61378C1.46801 2.76194 1.09113 3.13554 0.945824 3.44572C0.619776 4.14189 0.759534 4.94711 1.29934 5.48261C1.48586 5.66765 1.92678 5.93443 2.0461 5.93443C2.07759 5.93443 2.09229 7.58143 2.09994 11.9611L2.11041 17.9878L2.21684 18.3004C2.3643 18.7333 2.57352 19.068 2.87292 19.35C3.17991 19.6391 3.50658 19.8193 3.91143 19.9228C4.20372 19.9976 4.36048 20 8.88924 20C13.418 20 13.5748 19.9976 13.867 19.9228C14.8174 19.6797 15.499 18.8911 15.6477 17.8622C15.6714 17.6985 15.6863 15.3681 15.6868 11.7688L15.6876 5.94049L15.8341 5.89266C16.3933 5.71012 16.8793 5.11417 16.9803 4.48693C17.0866 3.8269 16.7567 3.09068 16.1924 2.72857C15.7665 2.45531 15.6993 2.44515 14.1989 2.4273L12.8471 2.41124L12.8225 1.95415C12.7952 1.44771 12.7151 1.15483 12.5211 0.852423C12.2597 0.445147 11.7873 0.12492 11.3159 0.0355259C11.0576 -0.0134692 6.68126 -0.0110468 6.42995 0.0382218ZM11.3711 1.01762C11.7212 1.20973 11.861 1.47932 11.8884 2.01522L11.9089 2.41804H8.89053H5.87213L5.88651 1.99802C5.89933 1.6249 5.91288 1.55758 6.00822 1.39496C6.06721 1.29432 6.17056 1.17273 6.23784 1.12483C6.50551 0.934238 6.49434 0.93498 8.94784 0.944201C11.0101 0.951976 11.2655 0.959712 11.3711 1.01762ZM15.5899 3.4594C15.7891 3.56657 15.9015 3.68781 15.9833 3.88351C16.1337 4.24359 16.0099 4.67521 15.6919 4.8987L15.5246 5.01626L8.97379 5.02775C4.40044 5.0358 2.3793 5.02665 2.27822 4.99743C1.88908 4.8849 1.63961 4.43528 1.73822 4.02413C1.81238 3.715 2.0613 3.47131 2.38391 3.392C2.44838 3.37614 5.41094 3.3659 8.96738 3.36922L15.4336 3.37528L15.5899 3.4594ZM14.7409 11.7365C14.7481 15.655 14.7383 17.5668 14.7099 17.7534C14.6276 18.2937 14.3488 18.6928 13.8989 18.9143L13.638 19.0428L8.99176 19.0533C3.95113 19.0648 4.08417 19.0698 3.74225 18.854C3.42234 18.652 3.1572 18.2581 3.0725 17.8589C3.04113 17.7109 3.02858 15.9873 3.02858 11.8126V5.97323L8.87947 5.98315L14.7304 5.99304L14.7409 11.7365ZM5.81099 7.37771C5.74781 7.44089 5.6849 7.54857 5.67123 7.61702C5.65756 7.68548 5.64634 9.73538 5.64634 12.1724C5.64634 16.8966 5.64083 16.7552 5.83146 16.9248C5.94942 17.0298 6.15911 17.0505 6.32192 16.9732C6.60108 16.8408 6.58405 17.1558 6.58405 12.1291C6.58405 7.22342 6.59503 7.47305 6.37252 7.32723C6.31836 7.29176 6.19603 7.26285 6.10003 7.26285C5.95938 7.26285 5.90374 7.28496 5.81099 7.37771ZM8.60964 7.35095C8.5526 7.3992 8.48665 7.47707 8.46313 7.524C8.43293 7.58432 8.42038 8.93438 8.42038 12.1285C8.42038 17.1559 8.40335 16.8408 8.68251 16.9732C8.84532 17.0505 9.05501 17.0298 9.17297 16.9248C9.3636 16.7552 9.35809 16.8966 9.35809 12.1724C9.35809 9.73538 9.34688 7.68548 9.3332 7.61702C9.31953 7.54857 9.25662 7.44089 9.19344 7.37771C9.04368 7.22795 8.76999 7.21537 8.60964 7.35095ZM11.3273 7.39569L11.1944 7.52853V12.1057C11.1944 16.0363 11.2025 16.6984 11.2513 16.7929C11.3135 16.913 11.522 17.0306 11.6732 17.0306C11.8192 17.0306 12.0284 16.8696 12.0811 16.7167C12.1425 16.5384 12.1526 7.8266 12.0917 7.60722C12.0334 7.39717 11.8559 7.26285 11.6368 7.26285C11.4879 7.26285 11.4392 7.28379 11.3273 7.39569Z"
                                                fill="black"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="cart-products__card">
                  <div class="cart-products__card-img"><img src="/local/templates/allmongolia_umax/assets/images/" alt=""></div>
                  <div class="cart-products__card-wrap">
                    <div class="cart-products__card-info">
                      <div class="cart-products__card-info-top">
                        <div class="cart-products__card-name">Жилет Удлиненный Из Шерсти Яка</div>
                        <div class="cart-products__card-model">Модель: kf30</div>
                      </div>
                      <div class="cart-products__card-parameters">
                        <div class="cart-products__card-color">Цвет: Коричневый </div>
                        <div class="cart-products__card-size">| Размер: 52</div>
                      </div>
                    </div>
                    <div class="cart-products__card-counter">
                      <div
                      class="cart-products__card-button cart-products__card-button--minus"
                    >
                      -
                    </div>
                    <input
                      type="text"
                      class="cart-products__card-number cart-products__card-number--dark"
                      value="1"
                    />
                    <div
                      class="cart-products__card-button cart-products__card-button--plus"
                    >
                      +
                    </div>
                    </div>
                    <div class="cart-products__card-right">
                      <div class="cart-products__card-price">1.210 руб</div>
                      <div class="cart-products__card-delete"><svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.42995 0.0382218C6.1316 0.0967502 5.72108 0.319807 5.49416 0.546731C5.11509 0.925837 4.94568 1.40864 4.94384 2.11524L4.94306 2.41804L3.76116 2.41882C2.4313 2.41968 2.13882 2.44855 1.78515 2.61378C1.46801 2.76194 1.09113 3.13554 0.945824 3.44572C0.619776 4.14189 0.759534 4.94711 1.29934 5.48261C1.48586 5.66765 1.92678 5.93443 2.0461 5.93443C2.07759 5.93443 2.09229 7.58143 2.09994 11.9611L2.11041 17.9878L2.21684 18.3004C2.3643 18.7333 2.57352 19.068 2.87292 19.35C3.17991 19.6391 3.50658 19.8193 3.91143 19.9228C4.20372 19.9976 4.36048 20 8.88924 20C13.418 20 13.5748 19.9976 13.867 19.9228C14.8174 19.6797 15.499 18.8911 15.6477 17.8622C15.6714 17.6985 15.6863 15.3681 15.6868 11.7688L15.6876 5.94049L15.8341 5.89266C16.3933 5.71012 16.8793 5.11417 16.9803 4.48693C17.0866 3.8269 16.7567 3.09068 16.1924 2.72857C15.7665 2.45531 15.6993 2.44515 14.1989 2.4273L12.8471 2.41124L12.8225 1.95415C12.7952 1.44771 12.7151 1.15483 12.5211 0.852423C12.2597 0.445147 11.7873 0.12492 11.3159 0.0355259C11.0576 -0.0134692 6.68126 -0.0110468 6.42995 0.0382218ZM11.3711 1.01762C11.7212 1.20973 11.861 1.47932 11.8884 2.01522L11.9089 2.41804H8.89053H5.87213L5.88651 1.99802C5.89933 1.6249 5.91288 1.55758 6.00822 1.39496C6.06721 1.29432 6.17056 1.17273 6.23784 1.12483C6.50551 0.934238 6.49434 0.93498 8.94784 0.944201C11.0101 0.951976 11.2655 0.959712 11.3711 1.01762ZM15.5899 3.4594C15.7891 3.56657 15.9015 3.68781 15.9833 3.88351C16.1337 4.24359 16.0099 4.67521 15.6919 4.8987L15.5246 5.01626L8.97379 5.02775C4.40044 5.0358 2.3793 5.02665 2.27822 4.99743C1.88908 4.8849 1.63961 4.43528 1.73822 4.02413C1.81238 3.715 2.0613 3.47131 2.38391 3.392C2.44838 3.37614 5.41094 3.3659 8.96738 3.36922L15.4336 3.37528L15.5899 3.4594ZM14.7409 11.7365C14.7481 15.655 14.7383 17.5668 14.7099 17.7534C14.6276 18.2937 14.3488 18.6928 13.8989 18.9143L13.638 19.0428L8.99176 19.0533C3.95113 19.0648 4.08417 19.0698 3.74225 18.854C3.42234 18.652 3.1572 18.2581 3.0725 17.8589C3.04113 17.7109 3.02858 15.9873 3.02858 11.8126V5.97323L8.87947 5.98315L14.7304 5.99304L14.7409 11.7365ZM5.81099 7.37771C5.74781 7.44089 5.6849 7.54857 5.67123 7.61702C5.65756 7.68548 5.64634 9.73538 5.64634 12.1724C5.64634 16.8966 5.64083 16.7552 5.83146 16.9248C5.94942 17.0298 6.15911 17.0505 6.32192 16.9732C6.60108 16.8408 6.58405 17.1558 6.58405 12.1291C6.58405 7.22342 6.59503 7.47305 6.37252 7.32723C6.31836 7.29176 6.19603 7.26285 6.10003 7.26285C5.95938 7.26285 5.90374 7.28496 5.81099 7.37771ZM8.60964 7.35095C8.5526 7.3992 8.48665 7.47707 8.46313 7.524C8.43293 7.58432 8.42038 8.93438 8.42038 12.1285C8.42038 17.1559 8.40335 16.8408 8.68251 16.9732C8.84532 17.0505 9.05501 17.0298 9.17297 16.9248C9.3636 16.7552 9.35809 16.8966 9.35809 12.1724C9.35809 9.73538 9.34688 7.68548 9.3332 7.61702C9.31953 7.54857 9.25662 7.44089 9.19344 7.37771C9.04368 7.22795 8.76999 7.21537 8.60964 7.35095ZM11.3273 7.39569L11.1944 7.52853V12.1057C11.1944 16.0363 11.2025 16.6984 11.2513 16.7929C11.3135 16.913 11.522 17.0306 11.6732 17.0306C11.8192 17.0306 12.0284 16.8696 12.0811 16.7167C12.1425 16.5384 12.1526 7.8266 12.0917 7.60722C12.0334 7.39717 11.8559 7.26285 11.6368 7.26285C11.4879 7.26285 11.4392 7.28379 11.3273 7.39569Z" fill="black"/>
                        </svg>
                        </div>
                    </div>
                  </div>
                </div> -->
            </div>
        </div>
        <div class="cart-products-order-wrap">
            <div class="cart-products-order">
                <div class="cart-products-order__title">Ваш заказ</div>
                <div class="cart-products-order__table">
                    <div class="cart-products-order__line">
                        <div
                                class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--products"
                        >
                            Товары, 2шт.
                        </div>
                        <div
                                class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--productsPrice"
                        >
                            2.420 руб
                        </div>
                    </div>
                    <div class="cart-products-order__line">
                        <div
                                class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--delivery"
                        >
                            Доставка
                        </div>
                        <div
                                class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--deliveryPrice"
                        >
                            500 руб
                        </div>
                    </div>
                    <div class="cart-products-order__line">
                        <div
                                class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--total"
                        >
                            Итого:
                        </div>
                        <div
                                class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--totalPrice"
                        >
                            2.920 руб
                        </div>
                    </div>
                </div>
            </div>
            <form class="discounts-form">
                <div class="discounts-form__input">
                    <div class="discounts-form__input-wrap">
                        <input
                                type="text"
                                name="discounts"
                                id="discounts"
                                placeholder="Введите промокод"
                        />
                        <button>
                            <svg
                                    width="12"
                                    height="9"
                                    viewBox="0 0 12 9"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M11.0235 0.0319455C10.9654 0.0529771 10.8862 0.09159 10.8475 0.117715C10.8088 0.14384 9.1954 1.74539 7.26225 3.67671L3.74744 7.18819L2.46207 5.90697C1.45011 4.89828 1.15172 4.61388 1.05933 4.56987C0.889649 4.48905 0.592178 4.4898 0.425568 4.57151C0.275929 4.64489 0.135139 4.78568 0.0617635 4.93532C-0.0198983 5.10186 -0.0206964 5.39935 0.06005 5.56908C0.104437 5.66236 0.43883 6.01023 1.68967 7.26422C3.48001 9.05913 3.40408 8.99524 3.74697 8.99524C3.92745 8.99524 3.95998 8.98794 4.08798 8.91888C4.20687 8.85476 4.84146 8.23 8.05732 5.01111C11.198 1.86752 11.895 1.15859 11.94 1.06231C12.0203 0.89058 12.0199 0.592875 11.9391 0.428542C11.8649 0.277565 11.7235 0.136986 11.5751 0.0665914C11.422 -0.00608031 11.1719 -0.0217837 11.0235 0.0319455Z"
                                        fill="white"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="recipient">
        <div class="cart-container">
            <div class="cart__title-wrap">
                <div class="cart__title-number">1</div>
                <div class="cart__title">Данные получателя</div>
            </div>
            <!-- <div class="recipient__check">
              <div class="recipient__check-title">Получать буду не я</div>
              <div class="recipient__check-wrap">
                <input type="checkbox" id="recipient1" name="recipient">
                <label for="recipient1">
                  <div class="recipient__check-round"></div>
                </label>
              </div>
            </div>
            <div class="recipient-content--1">
              <div class="recipient__user">
                 <div class="recipient__user-img">
                  <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M7.59066 0.0690954C6.37896 0.274677 5.18454 0.936779 4.41733 1.82818C2.53743 4.01242 2.64026 7.16776 4.65711 9.18465C6.66771 11.1952 9.83171 11.3023 12.0033 9.43328C12.6731 8.85675 13.2918 7.92178 13.5719 7.06285C14.3845 4.57053 13.2781 1.83842 10.9687 0.63466C9.90819 0.0817939 8.70404 -0.119795 7.59066 0.0690954ZM9.04849 1.5908C11.1098 1.90975 12.5594 3.86205 12.2592 5.91498C11.8576 8.66199 8.80154 10.1031 6.44857 8.65507C5.10334 7.82721 4.38371 6.22282 4.67645 4.7041C5.07742 2.6239 6.9781 1.27045 9.04849 1.5908ZM13.5202 10.0074C13.4084 10.0628 13.2759 10.1764 13.2258 10.2599C12.9815 10.6668 13.05 10.9298 13.5385 11.4603C14.6204 12.6352 15.2609 14.1257 15.3647 15.7097C15.4058 16.3368 15.362 16.4632 14.979 16.8214C13.5075 18.198 9.18 18.8419 5.5464 18.225C3.97577 17.9584 2.5836 17.4242 1.96364 16.8502C1.55748 16.4742 1.50981 16.3469 1.54709 15.7383C1.64329 14.166 2.28913 12.6344 3.33147 11.5067C3.72031 11.0861 3.80843 10.9146 3.77731 10.6388C3.71925 10.1238 3.13695 9.79231 2.69404 10.0223C2.50986 10.1179 1.98259 10.6785 1.63574 11.1474C0.655978 12.472 0.0929626 14.0637 0.00739197 15.7509C-0.039073 16.6666 0.126344 17.1408 0.708167 17.7599C2.7724 19.9564 9.14541 20.6996 13.55 19.2576C14.7559 18.8627 15.6363 18.3649 16.2122 17.752C16.7861 17.1413 16.9518 16.663 16.9056 15.7509C16.8025 13.7189 15.9909 11.7984 14.6416 10.3936C14.1597 9.89187 13.9202 9.80943 13.5202 10.0074Z" fill="#E60304"/>
                  </svg>
                </div>
                <div class="recipient__user-name">Андрей</div>
                <div class="recipient__user-phone">+7 (928) 123-45-67</div>
                <div class="recipient__user-sl">|</div>
                <div class="recipient__user-mail">info@mail.ru</div>
              </div>
            </div>-->
            <form
                    class="recipient-content--2 recipient-content--2--notauthor active"
            >
                <div class="recipient-content__input-wrap">
                    <div class="recipient-content__input">
                        <label for="host-name">Имя*</label>
                        <input
                                type="text"
                                id="host-name"
                                name="host"
                                placeholder="Введите имя"
                        />
                    </div>
                    <div class="recipient-content__input">
                        <label for="host-surname">Фамилия*</label>
                        <input
                                type="text"
                                id="host-surname"
                                name="host"
                                placeholder="Введите фамилия"
                                required
                        />
                    </div>
                </div>
                <div class="recipient-content__input-wrap">
                    <div class="recipient-content__input">
                        <label for="host-phone">Номер телефона*</label>
                        <input
                                type="text"
                                id="host-phone"
                                name="host"
                                placeholder="Введите номер телефона"
                                required
                        />
                    </div>
                    <div class="recipient-content__input">
                        <label for="host-mail">E-mail*</label>
                        <input
                                type="text"
                                id="host-mail"
                                name="host"
                                placeholder="Введите E-mail"
                                required
                        />
                    </div>
                </div>
            </form>
            <form class="recipient__msg">
                <label for="recipient__msg">Комментарий к заказу</label>
                <textarea
                        name="recipient__msg"
                        id="recipient__msg"
                        placeholder="Введите комментарий"
                ></textarea>
            </form>
        </div>
    </section>
    <section class="obtaining">
        <div class="cart-container">
            <div class="cart__title-wrap">
                <div class="cart__title-number">2</div>
                <div class="cart__title-block">
                    <div class="cart__title">Выберите способ получения</div>
                    <div class="cart__subtitle">
                        Стоимость доставки <span> 500руб</span>. При заказе
                        <span> от 5 000 руб</span> доставка <span> бесплатная</span>
                    </div>
                </div>
            </div>
            <div class="obtaining-tabs">
                <div class="obtaining__tab obtaining__tab--active" data-id="1">
                    Самовывоз
                </div>
                <div class="obtaining__tab" data-id="2">Курьером</div>
            </div>
            <form class="obtaining__content-wrap">
                <div class="obtaining__content-top">
                    <div class="recipient-content__input">
                        <label for="obtaining-sity">Город</label>
                        <input
                                type="text"
                                id="obtaining-sity"
                                name="obtaining"
                                placeholder="Ростов-на-Дону"
                        />
                    </div>
                </div>
                <div
                        class="obtaining__content obtaining__content--active"
                        data-id="1"
                >
                    <div class="obtaining__content-wrap">
                        <div class="obtaining__content-title">
                            СДЭК, пункт выдачи и приема
                        </div>
                        <div class="obtaining__content-card">
                            <div class="obtaining__content-address">
                                Адрес: пер. Халтуринский, 99а, Ростов-на-Дону, Ростовская
                                обл., 344011
                            </div>
                            <div class="obtaining__content-date">
                                15 сентября с 10:00 до 19:00
                            </div>
                            <div class="obtaining__content-button">Выбрать</div>
                        </div>
                    </div>
                    <div class="obtaining__content-wrap">
                        <div class="obtaining__content-title">Почта России</div>
                        <div class="obtaining__content-card">
                            <div class="obtaining__content-address">
                                Адрес: Соборный пер., 52, Ростов-на-Дону, Ростовская обл.,
                                344002
                            </div>
                            <div class="obtaining__content-date">
                                15 сентября с 10:00 до 20:00
                            </div>
                            <div class="obtaining__content-button">Выбрать</div>
                        </div>
                    </div>
                    <div class="obtaining__content-wrap">
                        <div class="obtaining__content-title">Почта России</div>
                        <div class="obtaining__content-card">
                            <div class="obtaining__content-address">
                                Адрес: пр. Ленина, 90, Ростов-на-Дону, Ростовская обл.,
                                344023
                            </div>
                            <div class="obtaining__content-date">
                                15 сентября с 10:00 до 19:00
                            </div>
                            <div class="obtaining__content-button">Выбрать</div>
                        </div>
                    </div>
                </div>
                <div class="obtaining__content" data-id="2">
                    <div
                            class="recipient-content__input recipient-content__input--nomargin"
                    >
                        <label for="obtaining-sity">Улица</label>
                        <input
                                type="text"
                                id="obtaining-sity"
                                name="obtaining"
                                placeholder="Введите улицу"
                                required
                        />
                    </div>
                    <div class="recipient-content__input-wrap">
                        <div class="recipient-content__input">
                            <label for="obtaining-home">Дом</label>
                            <input
                                    type="text"
                                    id="obtaining-home"
                                    name="obtaining"
                                    placeholder="Введите дом"
                                    required
                            />
                        </div>
                        <div class="recipient-content__input">
                            <label for="obtaining-kv">Кв./офис</label>
                            <input
                                    type="text"
                                    id="obtaining-kv"
                                    name="obtaining"
                                    placeholder="Квартира/офис"
                                    required
                            />
                        </div>
                    </div>
                    <div class="recipient-content__input-wrap">
                        <div class="recipient-content__input">
                            <label for="obtaining-entrance">Подъезд</label>
                            <input
                                    type="text"
                                    id="obtaining-entrance"
                                    name="obtaining"
                                    required
                            />
                        </div>
                        <div class="recipient-content__input">
                            <label for="obtaining-floor">Этаж</label>
                            <input
                                    type="text"
                                    id="obtaining-floor"
                                    name="obtaining"
                                    required
                            />
                        </div>
                        <div class="recipient-content__input">
                            <label for="obtaining-intercom">Домофон</label>
                            <input
                                    type="text"
                                    id="obtaining-intercom"
                                    name="obtaining"
                                    required
                            />
                        </div>
                    </div>
                    <div
                            class="recipient-content__input recipient-content__input--nomargin"
                    >
                        <label for="obtaining-sity">Дата и время доставки</label>
                        <input
                                type="text"
                                id="obtaining-sity"
                                name="obtaining"
                                placeholder="Завтра с 9:00 до 18:00"
                        />
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- <section class="discounts">
      <div class="cart-container">
        <div class="cart__title-wrap">
          <div class="cart__title-number">3</div>
          <div class="cart__title">Ваши скидки</div>
        </div>
        <form class="discounts-form">
          <div class="discounts-form__img">
            <svg width="28" height="21" viewBox="0 0 28 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.54182 0.965459C1.63315 1.21015 0.895281 1.98003 0.708875 2.87787C0.670574 3.06235 0.656315 3.93657 0.666046 5.50276C0.680201 7.78153 0.683792 7.85527 0.787923 7.99468C0.990358 8.26571 1.13893 8.33617 1.60823 8.38373C2.33626 8.45753 2.83985 8.69478 3.2989 9.1801C4.19658 10.1293 4.19658 11.6244 3.2989 12.5736C2.83985 13.0589 2.33626 13.2962 1.60823 13.37C1.13893 13.4175 0.990358 13.488 0.787923 13.759C0.683792 13.8984 0.680201 13.9722 0.666046 16.251C0.656315 17.8171 0.670574 18.6914 0.708875 18.8758C0.897675 19.7853 1.63825 20.5497 2.56409 20.7909C3.01471 20.9083 24.9389 20.9083 25.3895 20.7909C26.3153 20.5497 27.0559 19.7853 27.2447 18.8758C27.283 18.6914 27.2973 17.8171 27.2875 16.251C27.2734 13.9722 27.2698 13.8984 27.1657 13.759C26.9653 13.4908 26.8132 13.4172 26.3656 13.3721C25.6577 13.3007 25.2419 13.1202 24.7619 12.6758C23.7139 11.7055 23.7139 10.0482 24.7619 9.07789C25.2419 8.63352 25.6577 8.453 26.3656 8.3816C26.8132 8.33648 26.9653 8.26295 27.1657 7.99468C27.2698 7.85527 27.2734 7.78153 27.2875 5.50276C27.2973 3.93657 27.283 3.06235 27.2447 2.87787C27.0559 1.96842 26.3153 1.20401 25.3895 0.962857C24.9534 0.849254 2.96392 0.851752 2.54182 0.965459ZM25.2494 2.68381C25.3284 2.74283 25.4414 2.85575 25.5004 2.93475C25.6034 3.0726 25.6083 3.15306 25.6226 4.94807C25.6366 6.71341 25.6322 6.81786 25.5445 6.81947C25.3491 6.82311 24.5472 7.16985 24.2006 7.4006C23.2308 8.04615 22.5971 8.99791 22.3768 10.1399C22.005 12.0671 23.1332 14.0501 25.0072 14.7634C25.2516 14.8564 25.4934 14.9333 25.5445 14.9342C25.6322 14.9359 25.6366 15.0403 25.6226 16.8056C25.6083 18.6007 25.6034 18.6811 25.5004 18.819C25.4414 18.898 25.3284 19.0109 25.2494 19.0699L25.1057 19.1772H13.9768H2.84792L2.70419 19.0699C2.62514 19.0109 2.51221 18.898 2.4532 18.819C2.35021 18.6811 2.34532 18.6006 2.33106 16.8169L2.31618 14.9585L2.54349 14.8978C3.24113 14.7111 3.89074 14.3396 4.39459 13.8391C5.38215 12.858 5.82938 11.4572 5.57668 10.1364C5.27178 8.54277 4.09682 7.27143 2.54531 6.85647L2.31987 6.79616V5.01499C2.31987 3.1681 2.3321 3.04835 2.54453 2.81709C2.80025 2.53857 2.12753 2.55335 14.038 2.56532L25.1057 2.57651L25.2494 2.68381ZM15.5965 4.18339C13.6818 9.28132 10.7522 17.1138 10.7403 17.1665C10.7215 17.2499 12.2 17.8285 12.2611 17.7617C12.2821 17.7388 13.4008 14.7811 14.7471 11.1891C16.0935 7.59705 17.2088 4.62287 17.2258 4.57983C17.2498 4.51889 17.084 4.43688 16.4766 4.2092L15.6966 3.91679L15.5965 4.18339ZM9.63146 6.19832C8.62632 6.34445 7.73513 7.2539 7.57438 8.29745C7.39209 9.48084 8.14609 10.68 9.29794 11.0384C9.67294 11.1552 10.2929 11.1677 10.6723 11.0662C11.7602 10.7752 12.5209 9.78751 12.519 8.6687C12.5164 7.12 11.1765 5.97361 9.63146 6.19832ZM10.4639 7.95638C10.5497 8.00582 10.6747 8.12702 10.7417 8.22564C10.8423 8.37353 10.8601 8.4557 10.8434 8.69457C10.809 9.18572 10.5018 9.47178 10.0086 9.47178C9.70187 9.47178 9.45718 9.30567 9.30138 8.99182C9.13958 8.66574 9.1809 8.39393 9.43507 8.11261C9.71754 7.79995 10.0937 7.74281 10.4639 7.95638ZM18.0231 11.4016C17.4461 11.5377 16.7242 12.1025 16.4593 12.6252C16.2214 13.0947 16.1467 13.4497 16.1745 13.9796C16.1961 14.3941 16.2254 14.515 16.3861 14.8534C17.0026 16.1516 18.469 16.6742 19.7435 16.0501C20.7027 15.5804 21.2729 14.4961 21.1069 13.4572C20.9572 12.5198 20.2733 11.7205 19.3842 11.4438C19.0451 11.3382 18.3794 11.3176 18.0231 11.4016ZM19.082 13.1276C19.3374 13.2969 19.513 13.675 19.4658 13.9542C19.3885 14.4119 18.8881 14.7394 18.446 14.6215C17.9234 14.4823 17.678 13.9401 17.9132 13.4445C18.1089 13.0322 18.6972 12.8727 19.082 13.1276Z" fill="#E60304"/>
            </svg>
          </div>
          <div class="discounts-form__input">
            <label for="discounts">Мои промокоды</label>
            <div class="discounts-form__input-wrap">
              <input type="text" name="discounts" id="discounts" placeholder="Введите промокод">
              <button>
                <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0235 0.0319455C10.9654 0.0529771 10.8862 0.09159 10.8475 0.117715C10.8088 0.14384 9.1954 1.74539 7.26225 3.67671L3.74744 7.18819L2.46207 5.90697C1.45011 4.89828 1.15172 4.61388 1.05933 4.56987C0.889649 4.48905 0.592178 4.4898 0.425568 4.57151C0.275929 4.64489 0.135139 4.78568 0.0617635 4.93532C-0.0198983 5.10186 -0.0206964 5.39935 0.06005 5.56908C0.104437 5.66236 0.43883 6.01023 1.68967 7.26422C3.48001 9.05913 3.40408 8.99524 3.74697 8.99524C3.92745 8.99524 3.95998 8.98794 4.08798 8.91888C4.20687 8.85476 4.84146 8.23 8.05732 5.01111C11.198 1.86752 11.895 1.15859 11.94 1.06231C12.0203 0.89058 12.0199 0.592875 11.9391 0.428542C11.8649 0.277565 11.7235 0.136986 11.5751 0.0665914C11.422 -0.00608031 11.1719 -0.0217837 11.0235 0.0319455Z" fill="white"/>
                </svg>
               </button>
            </div>
          </div>
        </form>
      </div>
    </section> -->
    <section class="pay">
        <div class="cart-container">
            <div class="cart__title-wrap">
                <div class="cart__title-number">3</div>
                <div class="cart__title">Способ оплаты</div>
            </div>
            <form class="pay__form">
                <div class="pay__form-wrap">
                    <div class="pay__form-check-wrap">
                        <div class="pay__form-check">
                            <input
                                    type="radio"
                                    id="pay__online"
                                    class="online-pay"
                                    name="pay"
                                    checked
                            />
                            <label for="pay__online">
                                <div class="pay__form-img">
                                    <svg
                                            width="28"
                                            height="25"
                                            viewBox="0 0 28 25"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M17.6646 1.34527C15.9345 2.08504 14.4345 2.75701 14.3314 2.83864C14.2282 2.92021 14.1131 3.07186 14.0757 3.17559C13.9905 3.41132 13.9733 7.43784 14.0535 8.34468C14.221 10.2362 14.703 11.7425 15.5629 13.0617C16.5136 14.5203 17.9945 15.846 20.0544 17.0824C20.9963 17.6478 21.0073 17.6478 21.9492 17.0824C25.1675 15.1506 26.9259 13.0647 27.6189 10.3566C27.9356 9.11924 28.0044 8.25157 27.9998 5.55254C27.9957 3.14522 27.9887 3.08718 27.6723 2.84121C27.3985 2.6284 21.2183 -0.000382915 20.9927 4.18373e-08C20.8768 0.000164166 19.664 0.490403 17.6646 1.34527ZM23.6687 2.9672L26.2538 4.0746L26.2537 5.88041C26.2537 6.87358 26.2287 7.95696 26.1981 8.28795C25.9209 11.2902 24.6856 13.1991 21.7741 15.1243C21.3855 15.3813 21.0397 15.5915 21.0057 15.5915C20.9717 15.5915 20.6969 15.4312 20.3949 15.2352C18.5256 14.0222 17.2566 12.7249 16.5963 11.3522C16.1815 10.4898 15.9125 9.44754 15.8055 8.28795C15.7749 7.95696 15.7499 6.87358 15.7499 5.88041L15.7498 4.0746L18.3074 2.97256C19.7141 2.36645 20.9142 1.86812 20.9743 1.86516C21.0344 1.86215 22.2469 2.35808 23.6687 2.9672ZM1.21389 5.35308C0.820972 5.48947 0.517342 5.71267 0.320447 6.00996C-0.0270586 6.53461 -0.00895016 6.01488 0.00686048 14.9924L0.0212487 23.1686L0.164584 23.4741C0.346762 23.8626 0.640161 24.156 1.02864 24.3382L1.33424 24.4815H13.9992H26.6641L26.9697 24.3382C27.3582 24.156 27.6516 23.8626 27.8338 23.4741L27.9771 23.1686V19.7397C27.9771 16.3618 27.9754 16.3085 27.8643 16.1596C27.65 15.8726 27.4751 15.783 27.1291 15.783C26.7831 15.783 26.6083 15.8725 26.3939 16.1596C26.2834 16.3076 26.2808 16.3757 26.2662 19.5345L26.2513 22.7582H13.9979H1.74455V17.5071V12.256L6.71358 12.2415L11.6826 12.2269L11.8893 12.0693C12.3799 11.6951 12.3589 11.0279 11.8445 10.6438C11.6949 10.532 11.6464 10.5308 6.719 10.5164L1.74455 10.5019V8.75297V7.004L6.71358 6.98951L11.6826 6.97495L11.8893 6.81729C12.3799 6.44308 12.3589 5.77592 11.8445 5.39181C11.6948 5.27999 11.6494 5.27889 6.5959 5.26669C1.80523 5.2551 1.48124 5.26029 1.21389 5.35308ZM23.251 5.34236C23.1246 5.40669 22.6155 5.99869 21.6499 7.20429C20.8713 8.1764 20.2161 8.97125 20.194 8.97065C20.1719 8.96999 19.9083 8.59782 19.6082 8.14352C18.9583 7.15959 18.8139 7.02966 18.3704 7.02966C17.8446 7.02966 17.5278 7.34757 17.5278 7.87523V8.19308L18.5126 9.66293C19.5644 11.2329 19.6984 11.376 20.1182 11.3781C20.5279 11.38 20.6045 11.3011 22.5447 8.87513C23.5651 7.59928 24.4231 6.49434 24.4515 6.41967C24.7174 5.72055 23.9175 5.00284 23.251 5.34236ZM4.0122 15.8315C3.64533 15.9936 3.44165 16.4103 3.52142 16.8356C3.56907 17.0896 3.91225 17.4328 4.165 17.4791C4.26299 17.4971 5.20681 17.5044 6.26229 17.4954L8.18145 17.4789L8.38803 17.3212C8.87854 16.947 8.85759 16.28 8.34323 15.8958C8.19792 15.7872 8.11668 15.7825 6.18565 15.7704C4.60075 15.7605 4.144 15.7733 4.0122 15.8315Z"
                                                fill="#8A9B6E"
                                        />
                                    </svg>
                                </div>
                                <div class="pay__form-textblock">
                                    <div class="pay__form-title">Онлайн на сайте</div>
                                    <div class="pay__form-subtitle">Быстро и удобно</div>
                                </div>
                            </label>
                            <div class="pay__form-check-decor">Скидка 5%</div>
                        </div>
                        <div class="pay__form-check">
                            <input type="radio" id="pay__offline" name="pay" />
                            <label for="pay__offline">
                                <div class="pay__form-img">
                                    <svg
                                            width="28"
                                            height="28"
                                            viewBox="0 0 28 28"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M7.98189 0.0862174C7.78663 0.215282 1.98943 5.99668 1.80067 6.2506C1.69473 6.39311 1.6422 6.52896 1.6422 6.66026C1.6422 6.84804 1.87972 7.0943 6.98606 12.2006L12.3299 17.5444H12.5743H12.8188L15.6633 14.7018L18.5078 11.8593H18.974C19.732 11.8593 20.4369 11.6191 21.1245 11.1266C21.4692 10.8797 22.1037 10.2514 22.2753 9.98697L22.3729 9.83664H24.9606C27.7397 9.83664 27.769 9.83385 27.913 9.55539C28.029 9.33093 28.029 2.36122 27.913 2.13677C27.7736 1.86732 27.6839 1.85551 25.7774 1.85551H24.0064L23.853 1.98737C23.7199 2.10184 23.696 2.16869 23.6723 2.49302L23.645 2.86682L22.7604 2.8818L21.8758 2.89683L21.7354 3.06367C21.6515 3.16343 21.595 3.29791 21.595 3.39811V3.56572L21.2807 3.53259C20.7911 3.48104 20.4191 3.32694 19.3982 2.75268C18.1593 2.05575 16.48 1.23145 15.9645 1.06729C15.3554 0.873342 14.612 0.798561 14.019 0.871648C13.5151 0.933802 13.311 0.996941 11.5639 1.63155L10.5253 2.00885L9.56866 1.06336C9.04251 0.543383 8.55828 0.0906453 8.49263 0.0574088C8.32382 -0.0281423 8.13911 -0.0177013 7.98189 0.0862174ZM8.87081 1.95025C9.19448 2.27294 9.45933 2.55282 9.45933 2.57218C9.45933 2.59153 9.33016 2.66576 9.17234 2.7371C8.92372 2.84944 8.80122 2.86682 8.2567 2.86682C7.71218 2.86682 7.58967 2.84944 7.34105 2.7371C7.18323 2.66576 7.05406 2.59235 7.05406 2.57398C7.05406 2.53418 8.21537 1.36353 8.25489 1.36353C8.26993 1.36353 8.54708 1.62756 8.87081 1.95025ZM15.4603 2.05761C15.8329 2.15016 17.8341 3.11407 18.7546 3.64427C19.927 4.31955 20.3877 4.50765 21.1285 4.61349L21.5677 4.67624L21.582 6.8587L21.5963 9.04121L21.3953 9.33301C21.0839 9.7852 20.5393 10.2501 20.0189 10.5079C19.5849 10.723 19.5251 10.7376 19.0004 10.757C17.978 10.7949 17.2175 10.4909 16.4838 9.75131L16.0465 9.31043L14.8985 8.92373C11.5896 7.80922 11.4319 7.74991 11.1754 7.52414C10.9049 7.28602 10.7986 7.11322 10.7442 6.82322C10.6665 6.40902 10.963 5.86565 11.3563 5.70127C11.7191 5.54968 11.9504 5.60211 14.5281 6.42006C15.9019 6.85602 17.0965 7.21271 17.1827 7.21271C17.4281 7.21271 17.6591 6.94835 17.6591 6.66775C17.6591 6.3092 17.5346 6.22934 16.4249 5.87593C15.8861 5.70433 14.9897 5.41821 14.433 5.24006L13.4209 4.91622L12.395 3.88928L11.3692 2.86234L11.6579 2.7611C11.8167 2.70539 12.3353 2.51609 12.8104 2.34045C13.2855 2.16475 13.8266 1.99781 14.013 1.96949C14.4224 1.90728 14.9958 1.94221 15.4603 2.05761ZM26.8976 5.84608V8.74334H25.8316H24.7656V5.84608V2.94882H25.8316H26.8976V5.84608ZM6.5448 3.54713C6.9936 3.8215 7.4535 3.94619 8.12233 3.97467C8.83844 4.00512 9.37569 3.88518 9.9441 3.5679L10.2922 3.37357L10.8608 3.94017C11.3955 4.473 11.422 4.50973 11.3053 4.55614C10.5675 4.84986 10.3174 5.0238 10.0244 5.44697C9.88042 5.65497 9.78186 5.74057 9.65717 5.76616C9.25248 5.84914 8.59179 6.2277 8.24314 6.57635C7.63799 7.1815 7.32739 7.93167 7.32739 8.78794C7.32739 9.61093 7.5912 10.2943 8.13621 10.8832C9.39122 12.2391 11.4161 12.2408 12.6986 10.8868C12.9854 10.5841 13.3952 9.87868 13.3952 9.68784C13.3952 9.58157 13.4619 9.59601 14.3905 9.9035L15.2528 10.1891L15.2205 10.7098C15.1782 11.392 15.2845 11.9022 15.5986 12.5248L15.8378 12.999L15.2315 13.6016L14.6252 14.2042L14.1332 13.9587C13.0766 13.4313 11.9708 13.445 10.9386 13.9984L10.532 14.2165L7.75591 11.4389L4.97979 8.66134L5.14296 8.40069C5.23278 8.25731 5.37283 7.94982 5.45423 7.71738C5.58285 7.35003 5.60242 7.20883 5.60385 6.63872C5.60565 5.89134 5.49047 5.43248 5.16986 4.90988L4.98968 4.61611L5.59734 4.00113C5.93151 3.66291 6.22216 3.38614 6.24321 3.38614C6.26426 3.38614 6.39999 3.45857 6.5448 3.54713ZM23.6723 6.3654V8.74334H23.1803H22.6883V6.3654V3.98746H23.1803H23.6723V6.3654ZM4.43193 5.94672C4.60402 6.50392 4.54613 7.2161 4.28816 7.71497L4.20092 7.88373L3.57751 7.26207L2.95411 6.64047L3.56915 6.02369C4.2681 5.32266 4.23995 5.32517 4.43193 5.94672ZM18.7248 6.90735C18.5525 7.07971 18.505 7.28449 18.5898 7.48926C18.7397 7.85125 19.1863 7.93522 19.4673 7.65424C19.6767 7.44482 19.6835 7.17887 19.4855 6.94359C19.3665 6.80212 19.3053 6.77539 19.1004 6.77539C18.9158 6.77539 18.8249 6.80731 18.7248 6.90735ZM9.69685 7.14438C9.77869 7.65561 10.2566 8.29142 10.7987 8.61012C10.9489 8.6984 11.367 8.8724 11.7278 8.99677C12.4673 9.25156 12.4501 9.22548 12.2053 9.71862C12.0172 10.0976 11.568 10.5059 11.1675 10.6621C10.7337 10.8312 10.0992 10.8316 9.66695 10.663C9.25827 10.5036 8.86714 10.145 8.63514 9.71709C8.4559 9.38647 8.44802 9.34788 8.44802 8.798C8.44802 8.1149 8.53899 7.86574 8.94816 7.42831C9.17032 7.19079 9.50705 6.95053 9.63 6.94179C9.64869 6.94048 9.67881 7.03166 9.69685 7.14438ZM16.6127 11.2584C16.7597 11.3488 16.9569 11.4496 17.0509 11.4824C17.1449 11.5151 17.2218 11.5589 17.2218 11.5795C17.2218 11.6001 17.0913 11.7459 16.9319 11.9034L16.6419 12.1897L16.542 11.9835C16.3874 11.6643 16.2444 11.0939 16.319 11.0939C16.3336 11.0939 16.4658 11.168 16.6127 11.2584ZM13.3864 14.8131C13.5531 14.8716 13.7149 14.9449 13.7459 14.9759C13.7845 15.0146 13.6099 15.2246 13.189 15.6454L12.5759 16.2586L11.9743 15.6588C11.6434 15.3289 11.3726 15.0405 11.3726 15.0178C11.3726 14.9575 11.7377 14.8059 12.0833 14.7226C12.4541 14.6332 12.9783 14.6697 13.3864 14.8131ZM8.2146 17.0494C7.38593 17.2745 6.52977 17.8448 5.93162 18.5701L5.62784 18.9384L2.9745 18.9657L0.321158 18.9931L0.160552 19.1729L0 19.3527L0.0147596 23.0179L0.0295739 26.6831L0.182965 26.815L0.336355 26.9469H2.18442H4.03255L4.1767 26.8028C4.30221 26.6773 4.3208 26.6137 4.3208 26.3108V25.9629H5.14351C6.19587 25.9629 6.39808 25.8746 6.39808 25.4147V25.242L6.68507 25.2809C7.21057 25.3523 7.62039 25.5192 8.50269 26.0208C9.62721 26.6601 11.5694 27.6151 12.0348 27.7574C12.9211 28.0285 13.8803 28.0448 14.6826 27.8022C14.9216 27.7299 16.3595 27.2236 17.8778 26.6769C19.3961 26.1302 21.3272 25.4365 22.169 25.1354C23.8624 24.5297 24.1085 24.4148 24.5244 24.0353C25.3563 23.2763 25.533 22.284 25.0082 21.3197C24.5993 20.5686 23.7019 20.1491 22.7839 20.2801C22.596 20.3068 21.5093 20.5879 20.369 20.9046C19.2286 21.2212 18.2891 21.4803 18.2813 21.4803C18.2733 21.4803 18.1876 21.3317 18.0908 21.1501C17.891 20.7751 17.4031 20.2941 17.0486 20.1225C16.7976 20.001 15.5077 19.5486 13.684 18.9425L12.5788 18.5752L12.1724 18.1828C11.3462 17.385 10.4529 17.0144 9.24067 16.9664C8.72928 16.9461 8.53789 16.9617 8.2146 17.0494ZM9.81466 18.1184C10.0251 18.1624 10.3978 18.2973 10.6428 18.418C10.9998 18.594 11.1667 18.7215 11.4821 19.0592L11.8757 19.4807L14.1798 20.2627C15.6227 20.7525 16.565 21.1012 16.7009 21.1958C17.0001 21.4038 17.2145 21.7293 17.2561 22.039C17.3053 22.404 17.0873 22.8477 16.7668 23.0356C16.3022 23.3077 16.3504 23.317 13.4879 22.4086C11.647 21.8245 10.8337 21.5896 10.7363 21.6141C10.4991 21.6736 10.334 21.8857 10.334 22.1308C10.334 22.5586 10.314 22.5492 13.1766 23.4603C15.6274 24.2404 15.7977 24.2867 16.2105 24.2868C17.1462 24.287 17.9406 23.7234 18.2318 22.8527L18.316 22.601L20.1878 22.0853C23.1878 21.2588 23.0018 21.3013 23.3344 21.3665C23.7267 21.4434 23.9333 21.6042 24.0958 21.9592C24.3371 22.4863 24.1713 22.9755 23.6176 23.3702C23.4394 23.4972 22.2045 23.9635 19.1351 25.0626C16.805 25.897 14.7263 26.6426 14.5159 26.7195C14.1892 26.8387 14.0412 26.8593 13.5046 26.86C13.0714 26.8606 12.7654 26.8308 12.5206 26.7641C12.0941 26.6481 10.0801 25.6623 8.94001 25.0116C8.03825 24.4969 7.53178 24.3016 6.84907 24.2054L6.39808 24.1419L6.39862 21.9501L6.39912 19.7584L6.67824 19.3868C6.97829 18.9873 7.45596 18.5699 7.87262 18.3432C8.42146 18.0444 9.09083 17.967 9.81466 18.1184ZM3.22749 22.9563V25.8536H2.16152H1.09555V22.9563V20.059H2.16152H3.22749V22.9563ZM5.30477 22.4664V24.8739L4.82645 24.8581L4.34813 24.8423L4.33386 22.519C4.32599 21.2412 4.3314 20.165 4.34583 20.1274C4.36393 20.0801 4.51573 20.059 4.83842 20.059H5.30477V22.4664ZM8.52581 21.1481C8.15464 21.5193 8.47973 22.1545 8.99167 22.0585C9.25292 22.0095 9.42954 21.7949 9.42954 21.5263C9.42954 21.3459 9.39685 21.2759 9.2522 21.1468C9.00955 20.9299 8.74355 20.9304 8.52581 21.1481Z"
                                                fill="#8A9B6E"
                                        />
                                    </svg>
                                </div>
                                <div class="pay__form-textblock">
                                    <div class="pay__form-title">При получении</div>
                                    <div class="pay__form-subtitle">
                                        Наличными или картой
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="pay__form-wrap pay__form-wrap--online">
                    <div class="pay__form-wrap-title">Мы принимаем</div>
                    <div class="pay__form-check-wrap">
                        <div class="pay__form-check pay__form-check--center">
                            <input
                                    type="radio"
                                    id="pay__online2"
                                    name="pay-online"
                                    checked
                            />
                            <label for="pay__online2">
                                <div class="pay__form-img">
                                    <svg
                                            width="28"
                                            height="23"
                                            viewBox="0 0 28 23"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M5.61716 0.0842329C5.03936 0.239504 4.56018 0.63612 4.27834 1.19228C4.10685 1.5306 4.10713 1.52918 3.86693 3.77683L3.67084 5.61225L2.65725 5.64436C1.53912 5.67981 1.35361 5.7221 0.87662 6.05029C0.544983 6.27854 0.341498 6.52739 0.146724 6.9429L0 7.25591V13.943V20.6301L0.206992 21.0489C0.447679 21.5359 0.711541 21.7914 1.23275 22.042L1.58887 22.2132H11.9439C20.1539 22.2132 22.3464 22.1988 22.5279 22.1437C23.0784 21.9765 23.6448 21.4397 23.871 20.8709C23.9784 20.6007 23.993 20.4444 24.013 19.3576L24.0352 18.1456L24.7012 18.1522C25.2803 18.158 25.4082 18.1423 25.6821 18.0317C26.2619 17.7976 26.7792 17.2007 26.9253 16.5974C27.0233 16.1923 28.036 3.84252 27.999 3.50289C27.929 2.86005 27.4622 2.18472 26.8858 1.89264C26.7364 1.81693 26.4568 1.72784 26.2646 1.69464C25.9217 1.63541 6.33802 -0.007045 6.0593 2.27444e-05C5.98112 0.00199514 5.78218 0.0399089 5.61716 0.0842329ZM16.0257 1.91423C21.495 2.36701 26.0684 2.76461 26.1887 2.7977C26.4757 2.8766 26.8526 3.25135 26.9002 3.50524C26.9198 3.61011 26.6986 6.54092 26.4086 10.0183C25.8502 16.7117 25.8682 16.5644 25.5765 16.8282C25.339 17.0429 25.0698 17.1038 24.5353 17.0638L24.0283 17.0257L24.0129 12.1682L23.9975 7.3107L23.8655 6.98197C23.6831 6.52772 23.1368 5.98136 22.6825 5.79903L22.3538 5.66704L13.5739 5.65236L4.79401 5.63767V5.51385C4.79401 5.27974 5.17255 1.88114 5.21052 1.77436C5.3179 1.47241 5.76186 1.10166 6.02676 1.09273C6.05689 1.09174 10.5564 1.4614 16.0257 1.91423ZM22.1882 6.79651C22.4675 6.87409 22.7904 7.19701 22.868 7.47633C22.9013 7.59615 22.9286 7.95929 22.9288 8.2832L22.9291 8.87218H11.9987H1.06838L1.06871 8.25581C1.06904 7.51161 1.11999 7.30621 1.36232 7.07133C1.72689 6.71794 1.0114 6.74041 11.9713 6.7381C19.1044 6.73663 22.0327 6.75339 22.1882 6.79651ZM22.9165 11.1322L22.9313 12.2691H11.9998H1.06838V11.1184V9.96768L11.985 9.98154L22.9017 9.99535L22.9165 11.1322ZM22.9288 16.7755C22.9286 18.9863 22.9083 20.2589 22.871 20.393C22.8394 20.5068 22.7397 20.684 22.6496 20.7866C22.3077 21.176 23.1431 21.1492 11.8852 21.1325L1.74519 21.1175L1.55249 20.9854C1.44653 20.9128 1.30041 20.7667 1.22782 20.6607L1.09577 20.4681L1.08093 16.9165L1.06602 13.3649H11.9976H22.9291L22.9288 16.7755ZM14.9676 15.1622L14.8204 15.3158V17.2484V19.1809L14.9805 19.341L15.1406 19.5012H17.9701C19.8059 19.5012 20.8365 19.4814 20.9049 19.4448C21.1604 19.3081 21.1758 19.1833 21.1758 17.2549C21.1758 15.3265 21.1604 15.2016 20.9049 15.0649C20.8365 15.0283 19.8019 15.0085 17.9572 15.0085H15.1148L14.9676 15.1622ZM20.0801 17.2549V18.4054H17.9981H15.9161V17.2549V16.1043H17.9981H20.0801V17.2549Z"
                                                fill="black"
                                        />
                                    </svg>
                                </div>
                                <div class="pay__form-textblock">
                                    <div class="pay__form-title">Банковской картой</div>
                                    <div class="pay__form-subtitle">Быстро и удобно</div>
                                </div>
                            </label>
                        </div>
                        <div class="pay__form-check pay__form-check--center">
                            <input type="radio" id="pay__online1" name="pay-online" />
                            <label for="pay__online1">
                                <div class="pay__form-img">
                                    <svg
                                            width="29"
                                            height="16"
                                            viewBox="0 0 29 16"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                    >
                                        <rect
                                                x="0.5"
                                                width="28"
                                                height="16"
                                                fill="url(#pattern0)"
                                        />
                                        <defs>
                                            <pattern
                                                    id="pattern0"
                                                    patternContentUnits="objectBoundingBox"
                                                    width="1"
                                                    height="1"
                                            >
                                                <use
                                                        xlink:href="#image0_194_971"
                                                        transform="translate(0 -0.4375) scale(0.00333333 0.00583333)"
                                                />
                                            </pattern>
                                            <image
                                                    id="image0_194_971"
                                                    width="300"
                                                    height="300"
                                                    xlink:href="data:image/png;base64,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"
                                            />
                                        </defs>
                                    </svg>
                                </div>
                                <div class="pay__form-textblock">
                                    <div class="pay__form-title">СБП</div>
                                    <div class="pay__form-subtitle">Мгновенная оплата</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div
                        class="cart-products-order-wrap cart-products-order-wrap--mob"
                >
                    <div class="cart-products-order">
                        <div class="cart-products-order__title">Ваш заказ</div>
                        <div class="cart-products-order__table">
                            <div class="cart-products-order__line">
                                <div
                                        class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--products"
                                >
                                    Товары, 2шт.
                                </div>
                                <div
                                        class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--productsPrice"
                                >
                                    2.420 руб
                                </div>
                            </div>
                            <div class="cart-products-order__line">
                                <div
                                        class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--delivery"
                                >
                                    Доставка
                                </div>
                                <div
                                        class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--deliveryPrice"
                                >
                                    500 руб
                                </div>
                            </div>
                            <div class="cart-products-order__line">
                                <div
                                        class="cart-products-order__col cart-products-order__col--1 cart-products-order__col--total"
                                >
                                    Итого:
                                </div>
                                <div
                                        class="cart-products-order__col cart-products-order__col--2 cart-products-order__col--totalPrice"
                                >
                                    2.920 руб
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="discounts-form">
                        <div class="discounts-form__input">
                            <div class="discounts-form__input-wrap">
                                <input
                                        type="text"
                                        name="discounts"
                                        id="discounts"
                                        placeholder="Введите промокод"
                                />
                                <button>
                                    <svg
                                            width="12"
                                            height="9"
                                            viewBox="0 0 12 9"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M11.0235 0.0319455C10.9654 0.0529771 10.8862 0.09159 10.8475 0.117715C10.8088 0.14384 9.1954 1.74539 7.26225 3.67671L3.74744 7.18819L2.46207 5.90697C1.45011 4.89828 1.15172 4.61388 1.05933 4.56987C0.889649 4.48905 0.592178 4.4898 0.425568 4.57151C0.275929 4.64489 0.135139 4.78568 0.0617635 4.93532C-0.0198983 5.10186 -0.0206964 5.39935 0.06005 5.56908C0.104437 5.66236 0.43883 6.01023 1.68967 7.26422C3.48001 9.05913 3.40408 8.99524 3.74697 8.99524C3.92745 8.99524 3.95998 8.98794 4.08798 8.91888C4.20687 8.85476 4.84146 8.23 8.05732 5.01111C11.198 1.86752 11.895 1.15859 11.94 1.06231C12.0203 0.89058 12.0199 0.592875 11.9391 0.428542C11.8649 0.277565 11.7235 0.136986 11.5751 0.0665914C11.422 -0.00608031 11.1719 -0.0217837 11.0235 0.0319455Z"
                                                fill="white"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="pay__button">оформить заказ</button>
            </form>
        </div>
    </section>
</div>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
