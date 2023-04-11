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

// p($arResult['PROPERTIES']['IMAGES_LAZY']['VALUE']);
?>



<!-- <div class="swiper index_big_bottom_slider">
    <div class="swiper-wrapper">
        <?
            // foreach ($arResult['PROPERTIES']['IMAGES_LAZY']['VALUE'] as $slideId) {

            //     // $rsFile = CFile::GetByID($slideId);
            //     // $arFile = $rsFile->Fetch();
            //     p($slideId);

            // }
        ?>
            <div class="swiper-slide">
                <section class="collection">
                    <a href="#" class="collection__link">
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
        <? //} ?>
    </div>
</div> -->

<section class="products">
    <div class="swiper-container products-slider">
        <div class="swiper-wrapper">
        <?
            foreach ($arResult['PROPERTIES']['IMAGES_LAZY']['VALUE'] as $slideId) {

                $rsFile = CFile::GetByID($slideId);
                $arFile = $rsFile->Fetch();

                $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $arFile['ORIGINAL_NAME']);


                $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");

                $arFilter = Array("IBLOCK_ID" => 16, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_ARTICLE" => $fileNameNoExtension);

                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

                if ($ob = $res->GetNextElement()) { 
                    $arFields = $ob->GetFields();  
                    // print_r($arFields);
                    $arProps = $ob->GetProperties();
                    // print_r($arProps);

                    $arPrice = CCatalogProduct::GetOptimalPrice($arFields['ID']);

                    // p(CPrice::GetBasePrice($arFields['ID']));
                    $slide = [
                        'NAME' => $arFields['NAME'],
                        'CML2_ARTICLE' => $arProps['CML2_ARTICLE']['VALUE'],
                        'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
                        'BASE_PRICE' => $arPrice['RESULT_PRICE']['BASE_PRICE'],
                        'DISCOUNT_PRICE' => !empty($arPrice['DISCOUNT_LIST']) ? $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'] : "N",
                        'IMG_ORIGINAL_NAME' => $arFile['ORIGINAL_NAME'],
                        'IMG' => $arFile['SRC']
                    ];
                    // CurrencyFormat(1234.5678, 'RUB');
                }
            ?>
                <div class="swiper-slide">
                    <a href="<?= $slide['DETAIL_PAGE_URL'] ?>" class="products__item">
                        <div class="products__item-image">
                            <img
                                data-src="<?= $slide['IMG'] ?>"
                                class="lozad">
                        </div>
                        <div class="products__item-title">
                            <?= $slide['NAME'] ?>
                        </div>
                        <? if ($slide['DISCOUNT_PRICE'] === "N") { ?>
                            <div class="products__item-price">
                                <?= CurrencyFormat($slide['BASE_PRICE'], 'RUB') ?>
                            </div>
                        <? } else { ?>
                            <div class="products__item-price">
                                <?= CurrencyFormat($slide['DISCOUNT_PRICE'], 'RUB') ?>
                                <span><?= CurrencyFormat($slide['BASE_PRICE'], 'RUB') ?></span>
                            </div>
                        <? } ?>
                    </a>
                </div>
            <? } ?>
        </div>
    </div>
</section>