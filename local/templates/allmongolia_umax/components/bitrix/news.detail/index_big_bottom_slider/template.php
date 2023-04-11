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



<div class="swiper index_big_bottom_slider">
    <div class="swiper-wrapper">
        <?
            foreach ($arResult['PROPERTIES']['IMAGES_LAZY']['VALUE'] as $key => $slideId) {

                $rsFile = CFile::GetByID($slideId);
                $arFile = $rsFile->Fetch();
        ?>
            <div class="swiper-slide">
                <section class="collection">
                    <a href="<?= $arResult['PROPERTIES']['IMAGES_LAZY']['DESCRIPTION'][$key] ?>" class="collection__link">
                        <div class="collection__image">
                            <img src="/upload/<?= $arFile['SUBDIR'] ?>/lazy_<?= $arFile['FILE_NAME'] ?>"
                                 class="lozad"
                                 data-src="/upload/<?= $arFile['SUBDIR'] ?>/<?= $arFile['FILE_NAME'] ?>"
                            >
                        </div>
                        <div class="collection__title">
                            Коллекция осень-зима
                        </div>
                    </a>
                </section>
            </div>
        <? } ?>
    </div>
</div>

