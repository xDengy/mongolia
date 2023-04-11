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



<div class="swiper index_big_top_slider">
    <div class="swiper-wrapper">
        <?
            foreach ($arResult['PROPERTIES']['IMAGES_LAZY']['VALUE'] as $slideId) {

                $rsFile = CFile::GetByID($slideId);
                $arFile = $rsFile->Fetch();
        ?>
            <div class="swiper-slide">
                <section class="banner">
                    <div class="banner__image">
                        <img src="/upload/<?= $arFile['SUBDIR'] ?>/lazy_<?= $arFile['FILE_NAME'] ?>"
                             class="lozad"
                             data-src="/upload/<?= $arFile['SUBDIR'] ?>/<?= $arFile['FILE_NAME'] ?>"
                        >
                    </div>
                </section>
            </div>
        <? } ?>
    </div>
</div>
