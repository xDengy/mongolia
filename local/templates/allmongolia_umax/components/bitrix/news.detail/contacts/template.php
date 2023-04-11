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

<section class="contact-info">
    <div class="wrap">
        <div class="contact-info__item">
            <div
                    class="contact-info__item-icon contact-info__item-icon--address"
            >
                <svg
                        width="29"
                        height="36"
                        viewBox="0 0 29 36"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M27 14.5C27 21.4036 14.5 33.25 14.5 33.25C14.5 33.25 2 21.4036 2 14.5C2 7.59644 7.59644 2 14.5 2C21.4036 2 27 7.59644 27 14.5Z"
                            stroke="#8A9B6E"
                            stroke-width="3"
                    />
                    <path
                            d="M14.5 16.0625C15.363 16.0625 16.0625 15.363 16.0625 14.5C16.0625 13.6371 15.363 12.9375 14.5 12.9375C13.637 12.9375 12.9375 13.6371 12.9375 14.5C12.9375 15.363 13.637 16.0625 14.5 16.0625Z"
                            stroke="#8A9B6E"
                            stroke-width="3"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                </svg>
            </div>
            <div class="contact-info__item-content">
                <div class="contact-info__item-text">
                    <div class="contact-info__item-title">НАХОДИМСЯ ПО АДРЕСУ:</div>
                    <?=$arResult['PROPERTIES']['ADDRESS']['VALUE']?>
                </div>
            </div>
        </div>
        <div class="contact-info__items">
            <div class="contact-info__item">
                <div
                        class="contact-info__item-icon contact-info__item-icon--phone"
                >
                    <svg
                            width="33"
                            height="33"
                            viewBox="0 0 33 33"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M25.3157 20.6002L19.2852 21.7687C15.2118 19.7242 12.6956 17.3757 11.2313 13.7148L12.3588 7.66688L10.2275 2H4.73486C3.08373 2 1.78352 3.36445 2.03012 4.99705C2.64575 9.0728 4.46092 16.4626 9.76695 21.7687C15.3391 27.3408 23.3644 29.7588 27.7814 30.7198C29.487 31.091 31 29.7604 31 28.0149V22.7662L25.3157 20.6002Z"
                                stroke="#8A9B6E"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                    </svg>
                </div>
                <div class="contact-info__item-content">
                    <div class="contact-info__item-title">ОФИСНЫЙ ТЕЛЕФОН:</div>
                    <a href="tel:<?=$arResult['PROPERTIES']['PHONE']['VALUE']?>" class="contact-info__item-text contact-info__item-text--link">
                        <?=$arResult['PROPERTIES']['PHONE']['VALUE']?>
                    </a>
                </div>
            </div>
            <div class="contact-info__item">
                <div
                        class="contact-info__item-icon contact-info__item-icon--mail"
                >
                    <svg
                            width="34"
                            height="33"
                            viewBox="0 0 34 33"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M25.4374 31H8.69641C4.99808 31 2 28.0019 2 24.3036V13.7695C2 11.4279 3.22312 9.25634 5.22564 8.04269L13.5962 2.96966C15.7295 1.67678 18.4044 1.67678 20.5377 2.96966L28.9082 8.04269C30.9107 9.25634 32.1338 11.4279 32.1338 13.7695V24.3036C32.1338 28.0019 29.1357 31 25.4374 31Z"
                                stroke="#8A9B6E"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                        <path
                                d="M12.0444 24.3037H22.089"
                                stroke="#8A9B6E"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                    </svg>
                </div>
                <div class="contact-info__item-content">
                    <div class="contact-info__item-title">КОРПОРАТИВНЫЙ EMAIL:</div>
                    <a href="mailto:<?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>" class="contact-info__item-text contact-info__item-text--link">
                        <?=$arResult['PROPERTIES']['EMAIL']['VALUE']?>
                    </a>
                </div>
            </div>
            <div class="contact-info__item">
                <div
                        class="contact-info__item-icon contact-info__item-icon--time"
                >
                    <svg
                            width="34"
                            height="37"
                            viewBox="0 0 34 37"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M25.3333 20.3333H17V12"
                                stroke="#8A9B6E"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                        <path
                                d="M5.3335 4.5L8.66683 2"
                                stroke="#8A9B6E"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                        <path
                                d="M28.6663 4.5L25.333 2"
                                stroke="#8A9B6E"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                        <path
                                d="M17 35.3333C25.2843 35.3333 32 28.6176 32 20.3333C32 12.049 25.2843 5.33325 17 5.33325C8.71573 5.33325 2 12.049 2 20.3333C2 28.6176 8.71573 35.3333 17 35.3333Z"
                                stroke="#8A9B6E"
                                stroke-width="3"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                    </svg>
                </div>
                <div class="contact-info__item-content">
                    <div class="contact-info__item-title">ВРЕМЯ РАБОТЫ:</div>
                    <div class="contact-info__item-time">
                        <p><span>Пн - Пт:</span> <?=$arResult['PROPERTIES']['WORK_TIME_WEEK']['VALUE']?></p>
                        <p><span>Сб - Вс:</span> <?=$arResult['PROPERTIES']['WORK_TIME_END']['VALUE']?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-mapblock">
    <div class="wrap">
        <div class="contact-map" id="map"></div>
    </div>
</section>
<section class="contacts-bottom">
    <div class="wrap">
        <div class="contacts-bottom__requisites">
            <div class="contacts-bottom__requisites-icon">
                <svg
                        width="34"
                        height="40"
                        viewBox="0 0 34 40"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M30.4556 19.7847V8.66666C30.4556 8.38366 30.3432 8.11224 30.1431 7.91211L24.5434 2.31255C24.3433 2.11242 24.0719 2 23.789 2H3.06708C2.47775 2 2 2.47775 2 3.06708V36.5024C2 37.0918 2.47775 37.5695 3.06708 37.5695H14.4493"
                            stroke="#8A9B6E"
                            stroke-width="3"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                    <path
                            d="M9.11426 16.2277H23.3421M9.11426 9.11377H16.2282M9.11426 23.3416H14.4497"
                            stroke="#8A9B6E"
                            stroke-width="3"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                    <path
                            d="M26.8172 28.5694L28.5957 26.7909C29.3745 26.0121 30.6372 26.0121 31.416 26.7909C32.1948 27.5697 32.1948 28.8324 31.416 29.6112L29.6375 31.3897M26.8172 28.5694L21.4976 33.889C21.231 34.1555 21.056 34.5 20.998 34.8724L20.5664 37.6405L23.3342 37.209C23.7068 37.1509 24.0512 36.9759 24.3177 36.7093L29.6375 31.3897M26.8172 28.5694L29.6375 31.3897"
                            stroke="#8A9B6E"
                            stroke-width="3"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                    <path
                            d="M23.3418 2V8.04681C23.3418 8.63615 23.8195 9.1139 24.4089 9.1139H30.4557"
                            stroke="#8A9B6E"
                            stroke-width="3"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                </svg>
            </div>
            <div class="contacts-bottom__requisites-content">
                <h2 class="contacts-bottom__requisites-title">РЕКВИЗИТЫ</h2>
                <div class="contacts-bottom__requisites-items">
                    <div class="contacts-bottom__requisites-item">
                        <span>ИП:</span> <?=$arResult['PROPERTIES']['IP']['VALUE']?>
                    </div>
                    <div class="contacts-bottom__requisites-item">
                        <span>ИНН:</span> <?=$arResult['PROPERTIES']['INN']['VALUE']?>
                    </div>
                    <div class="contacts-bottom__requisites-item">
                        <span>ОГРН:</span> <?=$arResult['PROPERTIES']['OGRN']['VALUE']?>
                    </div>
                </div>
                <div class="contacts-bottom__requisites-items">
                    <div class="contacts-bottom__requisites-item">
                        <span>Расч. счёт:</span> <?=$arResult['PROPERTIES']['RASCH_SCHET']['VALUE']?>
                    </div>
                    <div class="contacts-bottom__requisites-item">
                        <span>Корр. счет: </span> <?=$arResult['PROPERTIES']['KORR_SCHET']['VALUE']?>
                    </div>
                    <div class="contacts-bottom__requisites-item">
                        <span>БИК: </span> <?=$arResult['PROPERTIES']['BIC']['VALUE']?>
                    </div>
                    <div class="contacts-bottom__requisites-item">
                        <span>Юридический адрес: </span> <?=$arResult['PROPERTIES']['UR_ADDRESS']['VALUE']?>
                    </div>
                    <div class="contacts-bottom__requisites-item">
                        <span>Тел./факс: </span> <?=$arResult['PROPERTIES']['TEL_FAX']['VALUE']?>
                    </div>
                </div>
            </div>
        </div>

        <?
            global $USER;

            $authUserName = $USER->GetFullName();

            $siteSettings = getSiteSettings();

            $grecaptchaSiteKey = $siteSettings["RECAPTCHA_SITE_KEY"]["VALUE"];

            $filter = Array
            (
                "ID"                  => "1 | 2",
                "TIMESTAMP_1"         => "04.02.2004", // в формате текущего сайта
                "TIMESTAMP_2"         => "04.02.2005",
                "LAST_LOGIN_1"        => "01.02.2004",
                "ACTIVE"              => "Y",
                "LOGIN"               => "nessy | admin",
                "NAME"                => "Виталий & Соколов",
                "EMAIL"               => "mail@server.com | mail@server.com",
            );
            $rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter); // выбираем пользователей
        ?>

        <form-feedback-component auth-user-name='<?= $authUserName ?>' grecaptcha-site-key='<?= $grecaptchaSiteKey ?>' />
    </div>
</section>