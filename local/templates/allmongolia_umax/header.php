<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$siteSettings = getSiteSettings();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet"
          href="/local/templates/allmongolia_umax/dist/css/umax.webpack.css"/>

    <link rel="stylesheet"
          href="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.css"/>

    <link rel="stylesheet"
          href="/local/templates/allmongolia_umax/assets/css/normalize.css"/>

    <link rel="stylesheet"
          href="/local/templates/allmongolia_umax/assets/css/reset.css"/>
    <link rel="stylesheet"
          href="/local/templates/allmongolia_umax/assets/css/main.css"/>
    <link rel="stylesheet"
          href="/local/templates/allmongolia_umax/assets/css/global.css"/>
    <link rel="stylesheet"
          href="/local/templates/allmongolia_umax/assets/css/style.css"/>
    <link rel="stylesheet"
          href="/local/templates/allmongolia_umax/assets/css/fancybox.css"/>

    <script src='https://www.google.com/recaptcha/api.js?render=<?= $siteSettings['RECAPTCHA_SITE_KEY']['VALUE'] ?>'></script>

    <? $APPLICATION->ShowHead(); ?>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $APPLICATION->ShowTitle(); ?></title>

    <? $APPLICATION->ShowPanel(); ?>
</head>
<body>
<div id="root">
    <header class="header <?= (in_array($APPLICATION->GetCurPage(),
            ['/', '/categories/']) || CHTTP::GetLastStatus() === '404') ? "" : "header--black"; ?>">
        <a href="/" class="logo">
            <svg
                    width="255"
                    height="28"
                    viewBox="0 0 255 28"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <path
                        d="M13.9792 0C21.6943 0 27.9584 6.26376 27.9584 13.9792C27.9584 21.6946 21.6943 27.9584 13.9792 27.9584C6.26375 27.9584 0 21.6946 0 13.9792C0 6.26376 6.26375 0 13.9792 0ZM12.4736 10.5029V2.7728C7.32017 3.45972 3.25964 7.6235 2.73143 12.8247H6.29715V15.1336H2.73143C3.25933 20.3349 7.32017 24.499 12.4736 25.1856V17.4554H6.53552C7.16086 18.7904 8.13455 19.9301 9.33987 20.7571V19.4237C8.92625 19.0716 8.55339 18.6739 8.22892 18.2376H10.9092V23.7875C7.33948 22.6698 4.60498 19.6556 3.88834 15.9272H24.0697C23.3543 19.6492 20.6281 22.6594 17.0672 23.7817V18.2376H19.7475C19.4231 18.6739 19.0502 19.0716 18.6366 19.4237V20.7445C19.833 19.9188 20.8003 18.7839 21.4225 17.4554H15.5028V25.1831C20.6474 24.4888 24.6987 20.329 25.2266 15.1336H21.6793V12.8247H25.2266C24.6993 7.62994 20.6477 3.46922 15.5028 2.77525V10.5029H21.4225C20.8003 9.17443 19.833 8.03958 18.6366 7.21387V8.52305C19.0502 8.87509 19.4231 9.27309 19.7475 9.70907H17.0672V4.17666C20.6281 5.29896 23.3543 8.3092 24.0697 12.0312H3.88834C4.60498 8.30276 7.33948 5.28854 10.9092 4.17084V9.70907H8.22892C8.55339 9.27309 8.92625 8.87509 9.33987 8.52305V7.2013C8.13486 8.02793 7.16086 9.16769 6.53552 10.5029H12.4736ZM20.8738 12.8247H7.10264V15.1336H20.8738V12.8247Z"
                        fill="black"
                />
                <path
                        d="M48.5666 19.5906H39.4485L37.709 23.7989H33.0518L41.8051 4.15991H46.2941L55.0755 23.7989H50.306L48.5666 19.5906ZM47.1357 16.1397L44.0215 8.62077L40.9074 16.1397H47.1357ZM57.1128 4.15991H61.6578V20.0956H71.5054V23.7989H57.1128V4.15991ZM74.0455 4.15991H78.5905V20.0956H88.4381V23.7989H74.0455V4.15991ZM108.849 23.7989L108.821 12.0155L103.041 21.7228H100.993L95.2416 12.268V23.7989H90.9771V4.15991H94.7366L102.087 16.3642L109.326 4.15991H113.057L113.113 23.7989H108.849ZM127.283 24.1356C125.245 24.1356 123.402 23.6964 121.756 22.817C120.129 21.9375 118.848 20.7311 117.913 19.1978C116.997 17.645 116.538 15.9055 116.538 13.9794C116.538 12.0533 116.997 10.3225 117.913 8.78911C118.848 7.23633 120.129 6.0213 121.756 5.14186C123.402 4.26242 125.245 3.82324 127.283 3.82324C129.322 3.82324 131.155 4.26242 132.782 5.14186C134.41 6.0213 135.69 7.23633 136.626 8.78911C137.562 10.3225 138.029 12.0533 138.029 13.9794C138.029 15.9055 137.562 17.645 136.626 19.1978C135.69 20.7311 134.41 21.9375 132.782 22.817C131.155 23.6964 129.322 24.1356 127.283 24.1356ZM127.283 20.2639C128.443 20.2639 129.49 20.0017 130.426 19.4783C131.361 18.9356 132.091 18.1878 132.614 17.2339C133.157 16.28 133.428 15.1955 133.428 13.9794C133.428 12.7633 133.157 11.6788 132.614 10.725C132.091 9.77106 131.361 9.0319 130.426 8.50855C129.49 7.96578 128.443 7.69493 127.283 7.69493C126.123 7.69493 125.077 7.96578 124.141 8.50855C123.206 9.0319 122.468 9.77106 121.925 10.725C121.401 11.6788 121.139 12.7633 121.139 13.9794C121.139 15.1955 121.401 16.28 121.925 17.2339C122.468 18.1878 123.206 18.9356 124.141 19.4783C125.077 20.0017 126.123 20.2639 127.283 20.2639ZM159.457 4.15991V23.7989H155.725L145.934 11.8752V23.7989H141.445V4.15991H145.205L154.968 16.0836V4.15991H159.457ZM177.374 13.6708H181.526V21.6386C180.46 22.4425 179.225 23.0598 177.823 23.4903C176.42 23.9209 175.007 24.1356 173.586 24.1356C171.547 24.1356 169.714 23.705 168.087 22.845C166.46 21.9656 165.178 20.7592 164.244 19.2258C163.326 17.6731 162.869 15.925 162.869 13.9794C162.869 12.0339 163.326 10.2944 164.244 8.76105C165.178 7.20827 166.469 6.00188 168.115 5.14186C169.761 4.26242 171.613 3.82324 173.67 3.82324C175.39 3.82324 176.953 4.11351 178.356 4.69297C179.758 5.27243 180.937 6.1141 181.891 7.21799L178.973 9.91134C177.57 8.43409 175.877 7.69493 173.895 7.69493C172.641 7.69493 171.528 7.95715 170.556 8.48049C169.583 9.00384 168.825 9.743 168.284 10.6969C167.741 11.6508 167.47 12.745 167.47 13.9794C167.47 15.1955 167.741 16.28 168.284 17.2339C168.825 18.1878 169.574 18.9356 170.528 19.4783C171.5 20.0017 172.604 20.2639 173.839 20.2639C175.148 20.2639 176.326 19.9833 177.374 19.4222V13.6708ZM195.258 24.1356C193.22 24.1356 191.378 23.6964 189.731 22.817C188.104 21.9375 186.823 20.7311 185.888 19.1978C184.971 17.645 184.513 15.9055 184.513 13.9794C184.513 12.0533 184.971 10.3225 185.888 8.78911C186.823 7.23633 188.104 6.0213 189.731 5.14186C191.378 4.26242 193.22 3.82324 195.258 3.82324C197.298 3.82324 199.13 4.26242 200.757 5.14186C202.384 6.0213 203.666 7.23633 204.601 8.78911C205.536 10.3225 206.003 12.0533 206.003 13.9794C206.003 15.9055 205.536 17.645 204.601 19.1978C203.666 20.7311 202.384 21.9375 200.757 22.817C199.13 23.6964 197.298 24.1356 195.258 24.1356ZM195.258 20.2639C196.418 20.2639 197.466 20.0017 198.4 19.4783C199.336 18.9356 200.065 18.1878 200.589 17.2339C201.131 16.28 201.402 15.1955 201.402 13.9794C201.402 12.7633 201.131 11.6788 200.589 10.725C200.065 9.77106 199.336 9.0319 198.4 8.50855C197.466 7.96578 196.418 7.69493 195.258 7.69493C194.099 7.69493 193.051 7.96578 192.116 8.50855C191.181 9.0319 190.442 9.77106 189.9 10.725C189.376 11.6788 189.114 12.7633 189.114 13.9794C189.114 15.1955 189.376 16.28 189.9 17.2339C190.442 18.1878 191.181 18.9356 192.116 19.4783C193.051 20.0017 194.099 20.2639 195.258 20.2639ZM209.42 4.15991H213.965V20.0956H223.812V23.7989H209.42V4.15991ZM226.351 4.15991H230.896V23.7989H226.351V4.15991ZM248.491 19.5906H239.373L237.633 23.7989H232.976L241.729 4.15991H246.218L255 23.7989H250.23L248.491 19.5906ZM247.06 16.1397L243.946 8.62077L240.831 16.1397H247.06Z"
                        fill="black"
                />
            </svg>
        </a>
        <nav class="header__nav">
            <ul class="header__nav-list">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "",
                    [
                        "ALLOW_MULTI_SELECT"    => "N",
                        "CHILD_MENU_TYPE"       => "top",
                        "DELAY"                 => "N",
                        "MAX_LEVEL"             => "3",
                        "MENU_CACHE_GET_VARS"   => [""],
                        "MENU_CACHE_TIME"       => "3600",
                        "MENU_CACHE_TYPE"       => "N",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "ROOT_MENU_TYPE"        => "top",
                        "USE_EXT"               => "Y",
                    ]
                ); ?>
                <? $APPLICATION->IncludeComponent(
                    "umax:headerMenu",
                    ".default",
                    [
                        "COMPONENT_TEMPLATE" => ".default",
                        "SHOW_NEWS"          => "Y",
                        "NEWS_NAME"          => "Новости",
                        "NEWS_LINK"          => "/news/",
                        "SHOW_CONTACT"       => "Y",
                        "CONTACT_NAME"       => "Контакты",
                        "CONTACT_LINK"       => "/contacts/",
                        "PHONE"              => "8 (999) 333-74-31",
                        "EMAIL"              => "service@allmongolia.ru",
                        "ADDRESS"            => "Россия, г.Улан-удэ, ул. Моховая 8 \"а\", помещ. I",
                        "WHATSAPP"           => "https://whatsapp.com",
                        "TELEGRAM"           => "https://telegram.com",
                    ],
                    false
                ); ?>
            </ul>
            <!--
                <li>
                    <a class="header__nav-link" href="#">Новинки</a>
                    <div class="header__nav-additionally">
                        <ul class="header__list-category">
                            <li>одежда</li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Джемперы и кардиганы</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Бриджи</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Водолазки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Жилетки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Лосины</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Пальто</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Платья</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Туника</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Футболки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шорты</a>
                            </li>
                        </ul>
                        <ul class="header__list-category">
                            <li>аксессуары</li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Согревающие пояса и наколенники</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Варежки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Гетры</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Гольфы</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Жилетка унисекс</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Комплекты</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Манишка</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Наушники</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Носки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Палантины</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Перчатки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Платки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шапки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шарфы</a>
                            </li>
                        </ul>
                        <ul class="header__list-category">
                            <li>обувь</li>
                            <li>
                                <a class="header__list-category-link" href="#">Сапоги</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Стельки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Тапочки</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="header__nav-link" href="#">для мужчин</a>
                    <div class="header__nav-additionally">
                        <ul class="header__list-category">
                            <li>одежда</li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Джемперы и кардиганы</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Бриджи</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Водолазки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Жилетки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Лосины</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Пальто</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Платья</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Туника</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Футболки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шорты</a>
                            </li>
                        </ul>
                        <ul class="header__list-category">
                            <li>аксессуары</li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Согревающие пояса и наколенники</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Варежки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Гетры</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Гольфы</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Жилетка унисекс</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Комплекты</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Манишка</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Наушники</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Носки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Палантины</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Перчатки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Платки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шапки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шарфы</a>
                            </li>
                        </ul>
                        <ul class="header__list-category">
                            <li>обувь</li>
                            <li>
                                <a class="header__list-category-link" href="#">Сапоги</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Стельки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Тапочки</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="header__nav-link" href="#">для женщин</a>
                    <div class="header__nav-additionally">
                        <ul class="header__list-category">
                            <li>одежда</li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Джемперы и кардиганы</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Бриджи</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Водолазки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Жилетки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Лосины</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Пальто</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Платья</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Туника</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Футболки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шорты</a>
                            </li>
                        </ul>
                        <ul class="header__list-category">
                            <li>аксессуары</li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Согревающие пояса и наколенники</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Варежки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Гетры</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Гольфы</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Жилетка унисекс</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Комплекты</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Манишка</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Наушники</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Носки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Палантины</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Перчатки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Платки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шапки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шарфы</a>
                            </li>
                        </ul>
                        <ul class="header__list-category">
                            <li>обувь</li>
                            <li>
                                <a class="header__list-category-link" href="#">Сапоги</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Стельки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Тапочки</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="header__nav-link" href="#">аксессуары</a>
                    <div class="header__nav-additionally">
                        <ul class="header__list-category">
                            <li>аксессуары</li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Согревающие пояса и наколенники</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Варежки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Гетры</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Гольфы</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#"
                                >Жилетка унисекс</a
                                >
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Комплекты</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Манишка</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Наушники</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Носки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Палантины</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Перчатки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Платки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шапки</a>
                            </li>
                            <li>
                                <a class="header__list-category-link" href="#">Шарфы</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a class="header__nav-link header__nav-link--news" href="#"
                    >новости</a
                    >
                </li>
                <li>
                    <a class="header__nav-link header__nav-link--contact" href="#"
                    >контакты</a
                    >
                    <div class="header__nav-additionally header__nav-contact">
                        <div class="header__nav-block">
                            <p class="header__nav-title">Позвоните нам</p>
                            <a class="header__nav-phone" href="#">8 (999) 333-74-31</a>
                        </div>
                        <div class="header__nav-block">
                            <p class="header__nav-title">email</p>
                            <a class="" href="#">service@allmongolia.ru</a>
                        </div>
                        <div class="header__nav-block">
                            <p class="header__nav-title">адрес</p>
                            <p>Россия, г.Улан-удэ, ул. Моховая 8 "а", помещ. I</p>
                        </div>
                        <div class="header__nav-block">
                            <p class="header__nav-title">соцсети</p>
                            <div class="header__nav-social">
                                <a class="header__nav-whatsapp" href="#">
                                    <svg
                                            width="30"
                                            height="30"
                                            viewBox="0 0 30 30"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M13.195 0.0895175C6.30205 0.941314 0.884665 6.46991 0.17131 13.3807C0.0656018 14.4049 0.129627 16.3442 0.301551 17.3231C0.573675 18.873 1.02398 20.2367 1.72388 21.6301L2.07555 22.3304L1.02767 26.1575C0.45132 28.2625 -0.0110035 29.9916 0.000199382 29.9999C0.0114649 30.0082 1.76682 29.5537 3.901 28.9899C7.0079 28.1691 7.8125 27.9767 7.9378 28.0244C8.02386 28.0572 8.43223 28.2373 8.8453 28.4246C10.1869 29.0329 11.5958 29.4364 13.0782 29.6368C14.1085 29.7761 15.9167 29.7753 16.9189 29.6351C20.2085 29.1746 23.1475 27.7201 25.464 25.4059C26.6753 24.1959 27.4808 23.0891 28.2477 21.581C28.9382 20.2228 29.4255 18.7423 29.6978 17.1746C29.8569 16.2584 29.8567 13.566 29.6974 12.6059C29.4282 10.9837 29.0128 9.68765 28.3029 8.25612C26.2828 4.18233 22.5524 1.27834 18.092 0.30738C16.7016 0.00471342 14.628 -0.0875385 13.195 0.0895175ZM17.1067 2.67983C18.902 3.01185 20.3907 3.61161 21.8632 4.59603C24.377 6.27671 26.2275 8.88655 26.959 11.7828C27.4961 13.9097 27.4539 16.3255 26.8438 18.3707C25.8574 21.6774 23.5063 24.461 20.4297 25.9645C18.641 26.8385 16.9859 27.2197 14.9787 27.2197C12.6782 27.2197 10.6388 26.6615 8.55746 25.462L8.20698 25.26L5.90363 25.8652C4.63676 26.198 3.59064 26.4608 3.57887 26.449C3.5671 26.4373 3.82702 25.446 4.15648 24.2462C4.48587 23.0463 4.7578 22.0205 4.76074 21.9667C4.76369 21.9127 4.60171 21.601 4.40081 21.274C1.44913 16.4701 2.22276 10.1348 6.25029 6.12819C8.25373 4.13514 10.7901 2.91033 13.6331 2.56298C14.401 2.46916 16.3157 2.53357 17.1067 2.67983ZM9.13614 8.14071C8.7742 8.3199 8.11285 9.10097 7.83635 9.67582C7.29323 10.805 7.3043 12.2284 7.86645 13.5464C8.55728 15.166 10.3648 17.4657 12.1491 18.9951C13.3998 20.067 14.4448 20.6952 15.9801 21.2977C17.5485 21.9133 17.8493 21.9842 18.8904 21.9837C19.7092 21.9834 19.8391 21.9678 20.2198 21.8244C20.8458 21.5886 21.313 21.2915 21.7785 20.8333C22.1396 20.4777 22.2123 20.3665 22.3305 19.9884C22.478 19.5169 22.5622 18.7582 22.4963 18.4955C22.4618 18.3582 22.285 18.2467 21.3959 17.8016C19.7668 16.9859 19.1101 16.7052 18.831 16.7052C18.6024 16.7052 18.5634 16.7333 18.287 17.0964C17.655 17.9265 17.0752 18.5693 16.9241 18.6072C16.7432 18.6526 16.3876 18.5224 15.5664 18.11C14.2368 17.4422 13.1521 16.5493 12.2195 15.3549C11.7119 14.7049 11.2549 13.9642 11.2549 13.7916C11.2549 13.7177 11.4902 13.3502 11.7778 12.9751C12.3415 12.2398 12.5066 11.9654 12.5066 11.7634C12.5066 11.6926 12.3843 11.3462 12.235 10.9937C12.0856 10.6411 11.7843 9.91621 11.5654 9.38267C11.2941 8.72139 11.1037 8.34781 10.9671 8.20918L10.7667 8.00578L10.0876 8.00584C9.51841 8.00584 9.36451 8.02768 9.13614 8.14071Z"
                                                fill="black"
                                        />
                                    </svg>
                                </a>
                                <a class="header__nav-telega" href="#">
                                    <svg
                                            width="29"
                                            height="30"
                                            viewBox="0 0 29 30"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M12.3586 0.0359213C9.08782 0.321096 6.50225 1.0896 4.64448 2.3287C2.67951 3.63934 1.46093 6.06594 1.01127 9.56386C0.765616 11.4749 0.750252 15.1255 0.980597 16.8648C1.57634 21.3638 3.52806 24.1054 6.97824 25.2897L7.46198 25.4558L7.46204 27.1604C7.46204 28.5171 7.48028 28.9265 7.55147 29.1661C7.71003 29.7 8.07408 30.0012 8.5597 30C9.07381 29.9987 9.60487 29.5148 11.2922 27.5102L12.2283 26.398L14.4925 26.3938C16.9028 26.3892 17.5118 26.3443 19.2784 26.0406C20.2226 25.8782 21.9929 25.4069 22.6796 25.135C25.2437 24.1196 26.9844 22.0406 27.7134 19.1225C28.2408 17.0116 28.4656 13.1528 28.2156 10.5021C27.8897 7.04649 26.9384 4.58183 25.3242 3.01135C23.8124 1.54032 21.1758 0.576305 17.4018 0.114736C16.5654 0.0124646 13.2264 -0.0397266 12.3586 0.0359213ZM17.2552 2.23094C20.5712 2.64437 22.9704 3.53836 24.0547 4.7645C25.1254 5.97516 25.779 7.77077 26.0897 10.3555C26.2155 11.4018 26.2326 14.3509 26.1203 15.6333C25.9296 17.8113 25.6623 18.9128 25.0278 20.135C24.3533 21.434 23.2332 22.4706 21.907 23.0226C21.355 23.2524 19.7368 23.6813 18.7213 23.8669C17.2611 24.1339 16.3418 24.2124 14.4697 24.2299L12.7105 24.2464L12.0993 24.9977C11.1609 26.151 9.26287 28.4134 8.97206 28.7251C8.79403 28.9158 8.66531 29.0036 8.56339 29.0036C8.25165 29.0036 8.2537 29.0226 8.2537 26.1462V23.4835L7.90185 23.3653C6.89181 23.0257 5.96544 22.4639 5.2584 21.7623C4.0407 20.554 3.37078 19.0422 3.02309 16.7182C2.87045 15.6979 2.87138 11.5421 3.02456 10.3026C3.23133 8.6287 3.52014 7.55931 4.0634 6.45585C4.77601 5.00833 5.62104 4.17099 7.08087 3.466C8.44769 2.80587 10.3301 2.34312 12.4466 2.14697C13.2877 2.06903 16.3913 2.12322 17.2552 2.23094ZM14.1273 5.45788C14.0576 5.52761 14.0295 5.63058 14.0415 5.77273C14.0642 6.04266 14.2285 6.13127 14.7086 6.13244C14.9045 6.13291 15.3129 6.17595 15.616 6.22802C17.7097 6.58767 19.368 7.78766 20.3209 9.63283C20.8322 10.6228 21.092 11.6267 21.1827 12.9627C21.2386 13.7871 21.2782 13.874 21.5968 13.874C21.8343 13.874 21.9466 13.7071 21.9466 13.354C21.9466 12.8867 21.8347 11.9714 21.7024 11.3558C20.9597 7.89979 18.3146 5.57804 14.9074 5.39138C14.3083 5.35854 14.219 5.36617 14.1273 5.45788ZM9.14224 6.28051C8.5007 6.44342 7.42773 7.40491 7.08837 8.12116C6.93725 8.44017 6.90494 8.58056 6.90494 8.9188C6.90494 9.30525 6.93526 9.39972 7.42269 10.5315C8.35873 12.705 9.29876 14.35 10.3716 15.6919C11.17 16.6905 12.4571 17.8811 13.6194 18.6962C14.7493 19.4886 16.648 20.541 17.783 21.0041C18.6323 21.3506 19.0267 21.3763 19.5618 21.1203C20.3238 20.7556 21.3131 19.5587 21.4427 18.8448C21.5109 18.4689 21.396 18.2056 20.9935 17.8145C20.3694 17.2085 19.3327 16.4398 18.5261 15.9854C18.2645 15.838 18.1132 15.7924 17.881 15.7911C17.3978 15.7882 17.1988 15.9114 16.7336 16.5011C16.309 17.0393 16.2619 17.077 15.9075 17.1616C15.5489 17.2473 14.564 16.8545 13.7111 16.2857C12.6181 15.5568 11.5623 14.1451 11.0071 12.6702C10.7467 11.9786 10.8389 11.7096 11.5379 11.121C12.1132 10.6366 12.2413 10.3901 12.2019 9.84429C12.1813 9.56023 12.1215 9.40952 11.8347 8.91869C11.4133 8.19751 11.0938 7.7387 10.498 6.99922C9.90148 6.25893 9.6831 6.14317 9.14224 6.28051ZM14.8069 7.39623C14.6534 7.50384 14.6248 7.83405 14.7575 7.9667C14.8029 8.01208 15.0675 8.08105 15.3457 8.11993C17.7197 8.45207 19.0955 9.94158 19.2792 12.3787C19.3222 12.949 19.4022 13.1117 19.6393 13.1117C19.7149 13.1117 19.8296 13.0589 19.8941 12.9944C20.0413 12.8472 20.0526 12.3078 19.9239 11.5697C19.5639 9.50528 18.1948 8.01859 16.1922 7.51732C15.3982 7.31859 14.971 7.28123 14.8069 7.39623ZM15.32 9.4759C15.2555 9.54041 15.2028 9.65411 15.2028 9.72859C15.2028 9.9767 15.3309 10.0674 15.7954 10.1481C16.7719 10.3176 17.2427 10.8187 17.3687 11.8226C17.4262 12.2797 17.5405 12.4666 17.7628 12.4666C17.9548 12.4666 18.1348 12.2668 18.1348 12.0537C18.1348 11.733 17.9528 10.9845 17.8027 10.6884C17.6055 10.2992 17.1731 9.84751 16.8324 9.67487C16.5235 9.51836 15.9218 9.36084 15.6279 9.3595C15.5146 9.35897 15.3898 9.40618 15.32 9.4759Z"
                                                fill="black"
                                        />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <div class="header__nav-contact">
                    <div class="header__nav-block">
                        <p class="header__nav-title">Позвоните нам</p>
                        <a class="header__nav-phone" href="#">8 (999) 333-74-31</a>
                    </div>
                    <div class="header__nav-block">
                        <p class="header__nav-title">email</p>
                        <a class="" href="#">service@allmongolia.ru</a>
                    </div>
                    <div class="header__nav-block">
                        <p class="header__nav-title">адрес</p>
                        <p>Россия, г.Улан-удэ, ул. Моховая 8 "а", помещ. I</p>
                    </div>
                    <div class="header__nav-block">
                        <p class="header__nav-title">соцсети</p>
                        <div class="header__nav-social">
                            <a class="header__nav-whatsapp" href="#">
                                <svg
                                        width="30"
                                        height="30"
                                        viewBox="0 0 30 30"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M13.195 0.0895175C6.30205 0.941314 0.884665 6.46991 0.17131 13.3807C0.0656018 14.4049 0.129627 16.3442 0.301551 17.3231C0.573675 18.873 1.02398 20.2367 1.72388 21.6301L2.07555 22.3304L1.02767 26.1575C0.45132 28.2625 -0.0110035 29.9916 0.000199382 29.9999C0.0114649 30.0082 1.76682 29.5537 3.901 28.9899C7.0079 28.1691 7.8125 27.9767 7.9378 28.0244C8.02386 28.0572 8.43223 28.2373 8.8453 28.4246C10.1869 29.0329 11.5958 29.4364 13.0782 29.6368C14.1085 29.7761 15.9167 29.7753 16.9189 29.6351C20.2085 29.1746 23.1475 27.7201 25.464 25.4059C26.6753 24.1959 27.4808 23.0891 28.2477 21.581C28.9382 20.2228 29.4255 18.7423 29.6978 17.1746C29.8569 16.2584 29.8567 13.566 29.6974 12.6059C29.4282 10.9837 29.0128 9.68765 28.3029 8.25612C26.2828 4.18233 22.5524 1.27834 18.092 0.30738C16.7016 0.00471342 14.628 -0.0875385 13.195 0.0895175ZM17.1067 2.67983C18.902 3.01185 20.3907 3.61161 21.8632 4.59603C24.377 6.27671 26.2275 8.88655 26.959 11.7828C27.4961 13.9097 27.4539 16.3255 26.8438 18.3707C25.8574 21.6774 23.5063 24.461 20.4297 25.9645C18.641 26.8385 16.9859 27.2197 14.9787 27.2197C12.6782 27.2197 10.6388 26.6615 8.55746 25.462L8.20698 25.26L5.90363 25.8652C4.63676 26.198 3.59064 26.4608 3.57887 26.449C3.5671 26.4373 3.82702 25.446 4.15648 24.2462C4.48587 23.0463 4.7578 22.0205 4.76074 21.9667C4.76369 21.9127 4.60171 21.601 4.40081 21.274C1.44913 16.4701 2.22276 10.1348 6.25029 6.12819C8.25373 4.13514 10.7901 2.91033 13.6331 2.56298C14.401 2.46916 16.3157 2.53357 17.1067 2.67983ZM9.13614 8.14071C8.7742 8.3199 8.11285 9.10097 7.83635 9.67582C7.29323 10.805 7.3043 12.2284 7.86645 13.5464C8.55728 15.166 10.3648 17.4657 12.1491 18.9951C13.3998 20.067 14.4448 20.6952 15.9801 21.2977C17.5485 21.9133 17.8493 21.9842 18.8904 21.9837C19.7092 21.9834 19.8391 21.9678 20.2198 21.8244C20.8458 21.5886 21.313 21.2915 21.7785 20.8333C22.1396 20.4777 22.2123 20.3665 22.3305 19.9884C22.478 19.5169 22.5622 18.7582 22.4963 18.4955C22.4618 18.3582 22.285 18.2467 21.3959 17.8016C19.7668 16.9859 19.1101 16.7052 18.831 16.7052C18.6024 16.7052 18.5634 16.7333 18.287 17.0964C17.655 17.9265 17.0752 18.5693 16.9241 18.6072C16.7432 18.6526 16.3876 18.5224 15.5664 18.11C14.2368 17.4422 13.1521 16.5493 12.2195 15.3549C11.7119 14.7049 11.2549 13.9642 11.2549 13.7916C11.2549 13.7177 11.4902 13.3502 11.7778 12.9751C12.3415 12.2398 12.5066 11.9654 12.5066 11.7634C12.5066 11.6926 12.3843 11.3462 12.235 10.9937C12.0856 10.6411 11.7843 9.91621 11.5654 9.38267C11.2941 8.72139 11.1037 8.34781 10.9671 8.20918L10.7667 8.00578L10.0876 8.00584C9.51841 8.00584 9.36451 8.02768 9.13614 8.14071Z"
                                            fill="black"
                                    />
                                </svg>
                            </a>
                            <a class="header__nav-telega" href="#">
                                <svg
                                        width="29"
                                        height="30"
                                        viewBox="0 0 29 30"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M12.3586 0.0359213C9.08782 0.321096 6.50225 1.0896 4.64448 2.3287C2.67951 3.63934 1.46093 6.06594 1.01127 9.56386C0.765616 11.4749 0.750252 15.1255 0.980597 16.8648C1.57634 21.3638 3.52806 24.1054 6.97824 25.2897L7.46198 25.4558L7.46204 27.1604C7.46204 28.5171 7.48028 28.9265 7.55147 29.1661C7.71003 29.7 8.07408 30.0012 8.5597 30C9.07381 29.9987 9.60487 29.5148 11.2922 27.5102L12.2283 26.398L14.4925 26.3938C16.9028 26.3892 17.5118 26.3443 19.2784 26.0406C20.2226 25.8782 21.9929 25.4069 22.6796 25.135C25.2437 24.1196 26.9844 22.0406 27.7134 19.1225C28.2408 17.0116 28.4656 13.1528 28.2156 10.5021C27.8897 7.04649 26.9384 4.58183 25.3242 3.01135C23.8124 1.54032 21.1758 0.576305 17.4018 0.114736C16.5654 0.0124646 13.2264 -0.0397266 12.3586 0.0359213ZM17.2552 2.23094C20.5712 2.64437 22.9704 3.53836 24.0547 4.7645C25.1254 5.97516 25.779 7.77077 26.0897 10.3555C26.2155 11.4018 26.2326 14.3509 26.1203 15.6333C25.9296 17.8113 25.6623 18.9128 25.0278 20.135C24.3533 21.434 23.2332 22.4706 21.907 23.0226C21.355 23.2524 19.7368 23.6813 18.7213 23.8669C17.2611 24.1339 16.3418 24.2124 14.4697 24.2299L12.7105 24.2464L12.0993 24.9977C11.1609 26.151 9.26287 28.4134 8.97206 28.7251C8.79403 28.9158 8.66531 29.0036 8.56339 29.0036C8.25165 29.0036 8.2537 29.0226 8.2537 26.1462V23.4835L7.90185 23.3653C6.89181 23.0257 5.96544 22.4639 5.2584 21.7623C4.0407 20.554 3.37078 19.0422 3.02309 16.7182C2.87045 15.6979 2.87138 11.5421 3.02456 10.3026C3.23133 8.6287 3.52014 7.55931 4.0634 6.45585C4.77601 5.00833 5.62104 4.17099 7.08087 3.466C8.44769 2.80587 10.3301 2.34312 12.4466 2.14697C13.2877 2.06903 16.3913 2.12322 17.2552 2.23094ZM14.1273 5.45788C14.0576 5.52761 14.0295 5.63058 14.0415 5.77273C14.0642 6.04266 14.2285 6.13127 14.7086 6.13244C14.9045 6.13291 15.3129 6.17595 15.616 6.22802C17.7097 6.58767 19.368 7.78766 20.3209 9.63283C20.8322 10.6228 21.092 11.6267 21.1827 12.9627C21.2386 13.7871 21.2782 13.874 21.5968 13.874C21.8343 13.874 21.9466 13.7071 21.9466 13.354C21.9466 12.8867 21.8347 11.9714 21.7024 11.3558C20.9597 7.89979 18.3146 5.57804 14.9074 5.39138C14.3083 5.35854 14.219 5.36617 14.1273 5.45788ZM9.14224 6.28051C8.5007 6.44342 7.42773 7.40491 7.08837 8.12116C6.93725 8.44017 6.90494 8.58056 6.90494 8.9188C6.90494 9.30525 6.93526 9.39972 7.42269 10.5315C8.35873 12.705 9.29876 14.35 10.3716 15.6919C11.17 16.6905 12.4571 17.8811 13.6194 18.6962C14.7493 19.4886 16.648 20.541 17.783 21.0041C18.6323 21.3506 19.0267 21.3763 19.5618 21.1203C20.3238 20.7556 21.3131 19.5587 21.4427 18.8448C21.5109 18.4689 21.396 18.2056 20.9935 17.8145C20.3694 17.2085 19.3327 16.4398 18.5261 15.9854C18.2645 15.838 18.1132 15.7924 17.881 15.7911C17.3978 15.7882 17.1988 15.9114 16.7336 16.5011C16.309 17.0393 16.2619 17.077 15.9075 17.1616C15.5489 17.2473 14.564 16.8545 13.7111 16.2857C12.6181 15.5568 11.5623 14.1451 11.0071 12.6702C10.7467 11.9786 10.8389 11.7096 11.5379 11.121C12.1132 10.6366 12.2413 10.3901 12.2019 9.84429C12.1813 9.56023 12.1215 9.40952 11.8347 8.91869C11.4133 8.19751 11.0938 7.7387 10.498 6.99922C9.90148 6.25893 9.6831 6.14317 9.14224 6.28051ZM14.8069 7.39623C14.6534 7.50384 14.6248 7.83405 14.7575 7.9667C14.8029 8.01208 15.0675 8.08105 15.3457 8.11993C17.7197 8.45207 19.0955 9.94158 19.2792 12.3787C19.3222 12.949 19.4022 13.1117 19.6393 13.1117C19.7149 13.1117 19.8296 13.0589 19.8941 12.9944C20.0413 12.8472 20.0526 12.3078 19.9239 11.5697C19.5639 9.50528 18.1948 8.01859 16.1922 7.51732C15.3982 7.31859 14.971 7.28123 14.8069 7.39623ZM15.32 9.4759C15.2555 9.54041 15.2028 9.65411 15.2028 9.72859C15.2028 9.9767 15.3309 10.0674 15.7954 10.1481C16.7719 10.3176 17.2427 10.8187 17.3687 11.8226C17.4262 12.2797 17.5405 12.4666 17.7628 12.4666C17.9548 12.4666 18.1348 12.2668 18.1348 12.0537C18.1348 11.733 17.9528 10.9845 17.8027 10.6884C17.6055 10.2992 17.1731 9.84751 16.8324 9.67487C16.5235 9.51836 15.9218 9.36084 15.6279 9.3595C15.5146 9.35897 15.3898 9.40618 15.32 9.4759Z"
                                            fill="black"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            -->
        </nav>
        <div class="header__menu">
            <ul class="header__menu-list">
                <li>
                    <a class="header__menu-link" href="#">
                        <box-icon class="header__icon" name='search-alt-2' ></box-icon>
                        <span>поиск</span>
                    </a>
                    <div class="search">
                        <form action="/catalog/search/" method="get">
                            <input name="q" placeholder="Поиск..."/>
                            <button type="submit">Найти</button>
                        </form>
                    </div>
                </li>
                <li>
                    <? if (!$USER->IsAuthorized()) { ?>
                        <a class="header__menu-link" href="/signin/">
                            <box-icon class="header__icon" name='user'></box-icon>
                            <span>войти</span>
                        </a>
                    <? } else { ?>
                        <personal-menu-component />
                    <? } ?>
                </li>
                <li>
                    <a class="header__menu-link" href="/favorite/">
                        <div class="header__icon icon-lg">
                            <svg
                                    viewBox="0 0 30 21"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                        d="M5.20049 1.91183L1.9137 6.43116C1.66552 6.77241 1.65825 7.23271 1.89551 7.58164L9.71424 19.0798C9.893 19.3426 10.1903 19.5 10.5082 19.5C10.817 19.5 11.1069 19.3515 11.2874 19.1009L19.5513 7.6232C19.8159 7.25567 19.8005 6.75617 19.5137 6.40566L15.8001 1.86676C15.6101 1.63463 15.3261 1.5 15.0261 1.5H6.00922C5.68929 1.5 5.38867 1.65308 5.20049 1.91183Z"
                                        stroke="white"
                                        stroke-width="1.5"
                                />
                                <path
                                        opacity="0.5"
                                        d="M13.7449 2.53825L10.9137 6.43116C10.6655 6.77241 10.6582 7.23271 10.8955 7.58164L18.7142 19.0798C18.893 19.3426 19.1903 19.5 19.5082 19.5C19.817 19.5 20.1069 19.3515 20.2874 19.1009L28.5513 7.6232C28.8159 7.25567 28.8005 6.75617 28.5137 6.40566L25.2669 2.4373C24.8691 1.95113 24.1268 1.94778 23.7247 2.43035L20.2682 6.57813C19.8684 7.05789 19.1316 7.05789 18.7318 6.57814L15.3219 2.48624C14.9048 1.98573 14.1281 2.01135 13.7449 2.53825Z"
                                        stroke="white"
                                        stroke-width="1.5"
                                />
                            </svg>
                        </div>
                        <span>избранное</span>
                    </a>
                </li>
                <li>
                    <header-cart-component />
                </li>
                <li>
                    <a class="header__menu-link menu" href="#">
                        <div class="header__icon">
                            <svg
                                class="line"
                                viewBox="0 0 21 15"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M6.58334 0.527845C6.16296 0.654625 5.85852 1.11986 5.90451 1.56533C5.9402 1.91103 6.143 2.208 6.46067 2.37975L6.61724 2.46437H13.4083H20.1993L20.3559 2.37975C20.7157 2.18525 20.9005 1.88304 20.9025 1.48583C20.9046 1.08546 20.7176 0.769153 20.3651 0.576459C20.2456 0.511171 19.8605 0.506944 13.467 0.500642C9.74269 0.497002 6.64503 0.509214 6.58334 0.527845ZM1.66583 6.51912C1.43505 6.56453 1.20654 6.72786 1.05158 6.95817C0.831764 7.28489 0.831764 7.70323 1.05158 8.02995C1.21508 8.27294 1.4383 8.42391 1.70666 8.47303C1.85038 8.49933 5.00276 8.50923 11.0419 8.50242C19.2996 8.49315 20.1731 8.48626 20.2972 8.42962C20.4998 8.33709 20.6766 8.1743 20.797 7.96943C20.8878 7.81506 20.9039 7.74331 20.9039 7.49406C20.9039 7.24481 20.8878 7.17306 20.797 7.01869C20.6766 6.81382 20.4998 6.65103 20.2972 6.5585C20.173 6.50182 19.3023 6.4954 11.0011 6.4902C5.81671 6.48695 1.76552 6.49951 1.66583 6.51912ZM10.5856 12.5582C9.71744 12.8684 9.67106 14.0384 10.5118 14.4189C10.6858 14.4977 10.7442 14.4987 15.3878 14.4995C20.6231 14.5005 20.3064 14.5168 20.6006 14.2313C20.8268 14.0118 20.9042 13.8249 20.9024 13.5023C20.9012 13.2991 20.8789 13.1865 20.8159 13.0667C20.698 12.8423 20.4121 12.601 20.2013 12.5479C19.9322 12.4801 10.7765 12.4899 10.5856 12.5582Z"
                                    fill="white"
                                />
                            </svg>

                            <svg class="cross" viewBox="0 0 24 24">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                            </svg>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <main class="main">
        <? if ($APPLICATION->GetCurPage() !== '/' && CHTTP::GetLastStatus() !== '404'): ?>
            <div class="wrapper">
                <h1 class="title h1-black"><?= $APPLICATION->ShowTitle(true) ?></h1>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "",
                    [
                        "PATH"       => "",
                        "SITE_ID"    => "s1",
                        "START_FROM" => "0",
                    ],
                    false
                ); ?>
            </div>
        <? endif ?>