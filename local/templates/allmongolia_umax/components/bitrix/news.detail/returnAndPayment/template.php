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

<section class="return">
    <div class="return__decor">
        <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>" title="<?=$arResult['DETAIL_PICTURE']['TITLE']?>" />
    </div>
    <div class="wrap">
        <h2 class="return__subtitle">
            <?=$arResult['PROPERTIES']['H2']['VALUE']?>
        </h2>
        <?foreach($arResult['PROPERTIES']['TEXT_H2']['VALUE'] as $text):?>
            <div class="return__text">
                <?=html_entity_decode($text['TEXT'])?>
            </div>
        <?endforeach?>
        <div class="return__text return__text--long return__text--lite">
            <?=$arResult['PROPERTIES']['H3']['VALUE']?>
            <?=html_entity_decode($arResult['PROPERTIES']['TEXT_H3']['VALUE']['TEXT'])?>
        </div>
    </div>
    <div class="return__card-wrap">
        <div class="return__card">
            <div class="return__card-title"><?=$arResult['PROPERTIES']['CARD_TEXT']['DESCRIPTION']?></div>
            <div class="return__card-text">
                <?=html_entity_decode($arResult['PROPERTIES']['CARD_TEXT']['VALUE']['TEXT'])?>
            </div>
        </div>
    </div>
</section>