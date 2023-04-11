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


<div class="main__img">
    <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>">
</div>

<!--Delivery-->
<section class="delivery">
    <div class="wrapper">
        <h2 class="subtitle">
            <?=$arResult['PROPERTIES']['H2']['VALUE']?>
        </h2>
        <p class="delivery__description">
            <?=html_entity_decode($arResult['PROPERTIES']['H2_TEXT']['VALUE']['TEXT'])?>
        </p>
        <div class="delivery__info">
            <div class="delivery__contact">
                <p class="delivery__phone">
                    <?=$arResult['PROPERTIES']['PHONE']['VALUE']?>
                </p>
                <?=html_entity_decode($arResult['PROPERTIES']['WORK_TIME']['VALUE']['TEXT'])?>
            </div>
            <div class="delivery__price">
                <p class="delivery__price-title">
                    <?=$arResult['PROPERTIES']['PRICE_TITLE']['VALUE']?>
                </p>
                <p class="delivery__price-text">
                    <?=html_entity_decode($arResult['PROPERTIES']['PRICE_TEXT']['VALUE']['TEXT'])?>
                </p>
            </div>
            <br>
        </div>
        <div class="text">
            <?=html_entity_decode($arResult['PROPERTIES']['TEXT']['VALUE']['TEXT'])?>
        </div>
        <div class="delivery__payment">
            <p class="delivery__payment-title">
                <?=$arResult['PROPERTIES']['PAYMENT_TEXT']['DESCRIPTION']?>
            </p>
            <div class="text">
                <?=html_entity_decode($arResult['PROPERTIES']['PAYMENT_TEXT']['VALUE']['TEXT'])?>
            </div>
        </div>
    </div>
</section>

<!--Courier-->
<section class="courier">
    <div class="wrapper">
        <div class="courier__top">
            <p class="courier__title">
                <?=$arResult['PROPERTIES']['COURIER_TEXT']['DESCRIPTION']?>
            </p>
            <div class="courier__logo">
                <?foreach($arResult['PROPERTIES']['DELIVERY_IMAGES']['VALUE'] as $key => $img):?>
                    <?
                        [$alt, $title] = explode(';', $arResult['PROPERTIES']['DELIVERY_IMAGES']['DESCRIPTION'][$key]);
                        $img = CFile::GetPath($img);
                    ?>
                    <img src="<?=$img?>" alt="<?=$alt?>" title="<?=$title?>">
                <?endforeach?>
            </div>
        </div>
        <div class="text">
            <?=html_entity_decode($arResult['PROPERTIES']['COURIER_TEXT']['VALUE']['TEXT'])?>
        </div>
    </div>
</section>