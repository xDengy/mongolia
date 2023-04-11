<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>
<?
    $product = new \Simba\Catalog\Product($arResult['CURRENT_ITEM']['ID']);
    $quantity = $product->getQuantity();
    global $USER;

    $photos = $arResult['CURRENT_ITEM']['PROPERTIES']['MORE_PHOTO']['VALUE'];
    if(empty($arResult['CURRENT_ITEM']['PROPERTIES']['MORE_PHOTO']['VALUE'])) {
        $photos = $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'];
    }
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
                        <?foreach ($photos as $key => $value):?>
                            <div class="swiper-slide">
                                <div class="product-page__photo-slide--small">
                                    <?
                                        $arFile = CFile::GetById($value['ID'])->Fetch();
                                    ?>
                                    <img
                                        src="/upload/<?=$arFile['SUBDIR']?>/lazy_<?=$arFile['FILE_NAME']?>"
                                        data-src="/upload/<?=$arFile['SUBDIR']?>/<?=$arFile['FILE_NAME']?>"
                                        class="lozad">
                                </div>
                            </div>
                        <?endforeach?>
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
                    <?foreach ($photos as $key => $value):?>
                        <div class="swiper-slide">
                            <div class="product-page__photo-slide--big">
                                <?
                                    $arFile = CFile::GetById($value['ID'])->Fetch();
                                ?>
                                <img
                                    src="/upload/<?=$arFile['SUBDIR']?>/lazy_<?=$arFile['FILE_NAME']?>"
                                    data-src="/upload/<?=$arFile['SUBDIR']?>/<?=$arFile['FILE_NAME']?>"
                                    class="lozad">
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
        </div>
        <div class="product-page__content">
            <div class="product-page__title">
                <?=$arResult['NAME']?>
            </div>
            <div class="product-page__inf">
                <div class="product-page__price-wrap <?if($arResult['CURRENT_ITEM']['FORMATED_PRICE'] !== $arResult['CURRENT_ITEM']['FORMATED_DISCOUNT_PRICE']):?>product-page__price-wrap--discount<?endif?>">
                    <div class="product-page__price"><?=$arResult['CURRENT_ITEM']['FORMATED_PRICE']?> руб.</div>
                    <div class="product-page__price-discount">
                        <div
                                class="product-page__price product-page__price--discount"
                        >
                            <?=$arResult['CURRENT_ITEM']['FORMATED_DISCOUNT_PRICE']?> руб.
                        </div>
                        <div class="product-page__price-discount-subtitle">
                            Ваша скидка <?=$arResult['CURRENT_ITEM']['FORMATED_DISCOUNT_DIFF']?> руб.
                        </div>
                    </div>
                </div>
                <div class="product-page__estimation">
                    <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:iblock.vote",
                            "detail",
                            Array(
                                "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                                "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                                "ELEMENT_ID" => $arResult['ID'],
                                "ELEMENT_CODE" => $arResult['CODE'],
                                "MAX_VOTE" => "5",
                                "VOTE_NAMES" => array("0","1","2","3","4"),
                                "SET_STATUS_404" => "N",
                                "MESSAGE_404" => "",
                                "CACHE_TYPE" => "N",
                                "CACHE_TIME" => "3600",
                                'SHOW_RATING' => 'Y'
                            )
                        );
                    ?>
                </div>
            </div>
            <form class="product-page__form">
                <div class="product-page__form-wrap">
                    <div class="product-page__form-title">
                            Размер
                    </div>
                    <div class="product-page__form-cards sizes">
                        <?if(!empty($arResult['OFFERS'])):?>
                            <?foreach ($arResult['OFFERS'] as $key => $size):?>
                                <?
                                    $sizeVal = $arResult['OFFERS_PROPERTIES']['SIZE'][$size['PROPERTIES']['RAZMER_OBSHCHIY']['VALUE']]['SIZE'];
                                ?>
                                <?if($sizeVal):?>
                                    <div class="product-page__form-card">
                                        <input <?if($key == 0):?>checked<?endif?> type="radio" value="<?=$sizeVal['UF_XML_ID']?>" id="product-page__form-size--<?=$key?>" name="product-page__form-size">
                                        <label for="product-page__form-size--<?=$key?>"><?=$sizeVal['UF_NAME']?></label>
                                    </div>
                                <?endif?>
                            <?endforeach?>
                        <?else:?>
                            <?
                                $sizeVal = $arResult['OFFERS_PROPERTIES']['SIZE'][$arResult['PROPERTIES']['RAZMER_OBSHCHIY']['VALUE']]['SIZE'];                                
                            ?>
                            <?if($sizeVal):?>
                                <div class="product-page__form-card">
                                    <input checked type="radio" value="<?=$sizeVal['UF_XML_ID']?>" id="product-page__form-size--0" name="product-page__form-size">
                                    <label for="product-page__form-size--0"><?=$sizeVal['UF_NAME']?></label>
                                </div>
                            <?endif?>
                        <?endif?>
                    </div>
                    <div class="product-page__form-text-wrapper">
                        <div class="product-page__form-text">
                            Таблица размеров
                        </div>
                        <?
                            if ((int) $quantity['QUANTITY'] > 0) {
                                echo "<span style='color: #8a9b6e'>Есть в наличии</span>";
                            } else {
                                echo "<span style='color: #E49B9B'>Нет в наличии</span>";
                            }
                        ?>
                    </div>
                </div>
                <div class="product-page__form-wrap">
                    <div class="product-page__form-title">Цвета</div>
                    <div class="product-page__form-colors">
                        <?foreach ($arResult['OFFERS_PROPERTIES']['COLOR'] as $key => $color):?>
                            <a href="<?=$color['ELEMENT']['DETAIL_PAGE_URL']?>" class="product-page__form-color <?if($color['COLOR']['UF_XML_ID'] == $arResult['PROPERTIES']['TSVET']['VALUE']):?>active<?endif?> <?if(!array_key_exists($color['COLOR']['UF_XML_ID'], $arResult['OFFERS_PROPERTIES']['COLOR'])):?>product-page__form-card--non<?endif?>">
                                <label for="product-page__form-color--<?=$key?>" style="background: <?=$color['COLOR']['UF_DESCRIPTION']?>; <?if(in_array($color['COLOR']['UF_DESCRIPTION'], ['#fff', 'white', 'rgb(255,255,255)', 'rgba(255,255,255,1)'])):?>border: 1px solid;<?endif?>"></label>
                            </a>
                        <?endforeach?>
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
                <basket-add-product-detail-component product-id='<?= $arResult['CURRENT_ITEM']['ID'] ?>' quantity='<?= json_encode($arResult['CURRENT_ITEM']['QUANTITY']) ?>' price='<?= $arResult['CURRENT_ITEM']['ITEM_PRICES'][0]['BASE_PRICE'] ?>' size='<?= $arResult['CURRENT_ITEM']['PROPERTIES']['RAZMER_OBSHCHIY']['VALUE'] ?>'></basket-add-product-detail-component>
                <favorites-add-product-detail-component product-id='<?= $arResult['ID'] ?>' user-id='<?= $USER->GetId() ?>' ip='<?=$_SERVER['REMOTE_ADDR']?>'></favorites-add-product-detail-component>
            </div>
        </div>
    </div>
</section>
<section class="product-items">
    <div class="product-items__tabs">
        <div class="product-items__tab <?if(!$_GET['sort'] && !$_GET['photo']):?>product-items__tab--active<?endif?>" data-id="1">ОПИСАНИЕ</div>
        <div class="product-items__tab" data-id="2">Характеристики</div>
        <div class="product-items__tab" data-id="3">Доставка и оплата</div>
        <div class="product-items__tab" data-id="4">гарантии и возврат</div>
        <div class="product-items__tab <?if($_GET['sort'] || $_GET['photo']):?>product-items__tab--active<?endif?>" data-id="5">отзывы</div>
    </div>
    <div class="product-items__bottom">
        <div
                class="product-items__bottom-item product-items__acc <?if(!$_GET['sort'] && !$_GET['photo']):?>product-items__bottom-item--active<?endif?>"
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
                <?=htmlspecialchars_decode($arResult['CURRENT_ITEM']['~DETAIL_TEXT'])?>
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
                <?if(is_array($arResult['CURRENT_ITEM']['PROPERTIES']['CHARS']['~VALUE'])):?>
                    <?=htmlspecialchars_decode($arResult['CURRENT_ITEM']['PROPERTIES']['CHARS']['~VALUE']['TEXT'])?>
                <?endif?>
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
                    <?$APPLICATION->IncludeFile("/includes/productDelivery.php");?>
                </div>
                <div
                        class="product-items__bottom-item-content-textwrap product-items__bottom-item-content-textwrap--right"
                >
                    <?$APPLICATION->IncludeFile("/includes/productPayment.php");?>

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
            <div class="product-items__bottom-item-content product-items__acc-bottom">
                <?$APPLICATION->IncludeFile("/includes/productGarant.php");?>
            </div>
        </div>
        <div class="product-items__bottom-item product-items__acc <?if($_GET['sort'] || $_GET['photo']):?>product-items__bottom-item--active<?endif?>" data-id="5">
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
            <div class="product-items__bottom-item-content product-items__bottom-item-content--feedback product-items__acc-bottom">
                <?
                global $GLOBALS;
                $GLOBALS['elementReviews'] = [
                    'PROPERTY' => [
                        'ELEMID' => $arResult['ID']
                    ]
                ];
                if($_GET['photo'] == 'photo') {
                    $GLOBALS['elementReviews']['PROPERTY']['!=FILES'] = false;
                }

                $sort1 = 'ACTIVE_FROM';
                $order1 = 'DESC';
                if($_GET['sort']) {
                    switch ($_GET['sort']) {
                        case 'new':
                            $sort1 = 'DATE_CREATE';
                            break;
                        case 'top':
                            $sort1 = 'PROPERTY_RATING';
                            $order1 = 'DESC';
                            break;
                        case 'low':
                            $sort1 = 'PROPERTY_RATING';
                            $order1 = 'ASC';
                            break;
                        default:
                            # code...
                            break;
                    }
                }
                ?>
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
                            <?
                                $get = '';
                                if($_GET['photo']) {
                                    $get .= '&photo=' . $_GET['photo'];
                                }
                            ?>
                            <div class="product-items__bottom-selector-content">
                                <a href="<?=$APPLICATION->GetCurPage()?>?sort=new<?=$get?>" class="product-items__bottom-selector-content-item">
                                    Сначала новые
                                </a>
                                <a href="<?=$APPLICATION->GetCurPage()?>?sort=top<?=$get?>" class="product-items__bottom-selector-content-item">
                                    Сначала с высокой оценкой
                                </a>
                                <a href="<?=$APPLICATION->GetCurPage()?>?sort=low<?=$get?>" class="product-items__bottom-selector-content-item">
                                    Сначала с низкой оценкой
                                </a>
                            </div>
                        </div>
                        <?
                            $get = '';
                            $delimeter = '?';
                            if($_GET['sort']) {
                                $get .= '?sort=' . $_GET['sort'];
                                $delimeter = '&';
                            }
                            $get .= $delimeter . 'photo=';
                            if($_GET['photo'] == 'photo') {
                                $get .= 'nophoto';
                            } else {
                                $get .= 'photo';
                            }
                        ?>
                        <form class="product-items__bottom-check">
                            <input
                                    type="checkbox"
                                    id="product-items__bottom-check"
                                    name="product-items__bottom-check"
                                    <?if($_GET['photo'] == 'photo'):?>checked<?endif?>
                                    onchange="window.location.href = '<?=$APPLICATION->GetCurPage()?><?=$get?>'"
                            />
                            <label for="product-items__bottom-check">
                                Только с фото
                            </label>
                        </form>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "reviews",
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
                            "FILTER_NAME" => "elementReviews",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "5",
                            "IBLOCK_TYPE" => "catalog",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "10",
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
                            "PROPERTY_CODE" => array("RATING", "ELEMID", "FILES"),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => $sort1,
                            "SORT_BY2" => 'SORT',
                            "SORT_ORDER1" => $order1,
                            "SORT_ORDER2" => 'ASC',
                            "STRICT_SECTION_CHECK" => "N",
                            "FIELD_CODE" => array("ELEMID", "RATING"),
                            'FILTER_AR' => $GLOBALS['elementReviews']
                        )
                    );?>
                </div>
                <?

                    $authUserName = $USER->GetFullName();

                    $siteSettings = getSiteSettings();

                    $grecaptchaSiteKey = $siteSettings["RECAPTCHA_SITE_KEY"]["VALUE"];

                    $ELEMENT_ID = $arResult['ID'];
                    // $ELEMENT_GROUP_ID = $arResult['CURRENT_ITEM']['PROPERTIES']['GROUP_ID']['VALUE'];
                    // group='<?=$ELEMENT_GROUP_ID'
                    $REVIEWS_IBLOCK_ID = 5;
                ?>
                <form-reviews-component auth-user-name='<?= $authUserName ?>' grecaptcha-site-key='<?= $grecaptchaSiteKey ?>' iblock_review='<?=$REVIEWS_IBLOCK_ID?>' element='<?=$ELEMENT_ID?>' />
            </div>
        </div>
    </div>
</section>

<?if($_GET['sort'] || $_GET['photo']):?>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            setTimeout(() => {
                document.querySelector('.product-page__btns').scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
            }, 500);
        })
    </script>
<?endif?>

<?
    $offers = json_encode(unserialize(str_replace(array('NAN;','INF;'),'0;',serialize($arResult['OFFERS']))));
    $countOffers = count($arResult['OFFERS']);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let sizes = document.querySelectorAll(".sizes input")

        <?if($countOffers > 0):?>
            document.dispatchEvent(new CustomEvent("product_set_size", {
                detail: {
                    size: sizes[0].value,
                    sizeText: sizes[0].parentNode.querySelector('label').textContent,
                    element: JSON.parse('<?=$offers?>')[0]
                }
            }));
        <?endif?>

        for (let i = 0; i < sizes.length; i++) {
            sizes[i].addEventListener('change', () => {
                document.dispatchEvent(new CustomEvent("product_set_size", {
                    detail: {
                        size: sizes[i].value,
                        sizeText: sizes[0].parentNode.querySelector('label').textContent,
                        element: JSON.parse('<?=$offers?>')[i]
                    }
                }));
            })
        }

        document.addEventListener("product_set_size", (event) => {
            let offer = event.detail.element;

            document.querySelector('.product-page__price').textContent = offer.FORMATED_PRICE + ' руб.'
            document.querySelector('.product-page__price-discount-subtitle').textContent = offer.FORMATED_DISCOUNT_PRICE + ' руб.'
            document.querySelector('.product-page__price.product-page__price--discount').textContent = offer.FORMATED_DISCOUNT_DIFF + ' руб.'
            
            let priceWrap = document.querySelector('.product-page__price-wrap')
            if(offer.FORMATED_PRICE !== offer.FORMATED_DISCOUNT_PRICE) {
                priceWrap.classList.add('product-page__price-wrap--discount')
            } else {
                priceWrap.classList.remove('product-page__price-wrap--discount')
            }

            let quantity = document.querySelector('.product-page__form-text-wrapper span')
            if(offer.QUANTITY.QUANTITY > 0) {
                quantity.style.color = 'rgb(138, 155, 110)';
                quantity.textContent = 'Есть в наличии'
            } else {
                quantity.style.color = 'rgb(228, 155, 155)';
                quantity.textContent = 'Нет в наличии'
            }
            document.querySelector('.product-items__bottom-item-content.product-items__acc-bottom').innerHTML = offer['~DETAIL_TEXT']

            if(offer.PROPERTIES.MORE_PHOTO.VALUE.length > 0) {
                let swiperBig = document.querySelector('.product-page__photo-swiper--big').swiper;
                let swiperSmall = document.querySelector('.product-page__photo-swiper--small').swiper;

                swiperBig.removeAllSlides();
                swiperSmall.removeAllSlides();

                for (let i = 0; i < offer.PROPERTIES.MORE_PHOTO.VALUE.length; i++) {
                    let photoVal = offer.PROPERTIES.MORE_PHOTO.VALUE[i];
                    swiperBig.appendSlide(`<div class="swiper-slide"><div class="product-page__photo-slide--big"><img src="${photoVal.PATH}" data-src="${photoVal.PATH}" class="lozad" data-loaded="true"></div></div>`);
                    swiperSmall.appendSlide(`<div class="swiper-slide"><div class="product-page__photo-slide--small"><img src="${photoVal.PATH}" data-src="${photoVal.PATH}" class="lozad" data-loaded="true"></div></div>`);
                }
            }
        });
    })
</script>
