<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$this->setFrameMode(true);
?>
<?
if(empty($arResult["ITEMS"])) {
    ?>
    Ничего не найдено
    <?
	return;
}
?>

<?foreach($arResult['ITEMS'] as $review):?>
    <div class="product-items__bottom-comment">
        <div class="product-items__bottom-comment-head">
            <div class="product-items__bottom-comment-head-info">
                <div class="product-items__bottom-comment-head-name">
                    <?=$review['NAME']?>
                </div>
                <div class="product-items__bottom-comment-head-data">
                    <?=explode(' ', $review['TIMESTAMP_X'])[0]?>
                </div>
                <div class="product-items__bottom-comment-head-size">
                    Размер: <span> <?=$review['PROPERTIES']['SIZE']['VALUE']?></span>
                </div>
            </div>
            <?
                $VOTE_NAMES = array("1","2","3","4", "5");
                $DISPLAY_VALUE = $review['PROPERTIES']['RATING']['VALUE'];
            ?>
            <div class="rating-mini">
                <?
                foreach ($VOTE_NAMES as $i => $name)
                {
                    $className = "";
                    if (round($DISPLAY_VALUE) > $i)
                        $className = "active";
                    ?>
                        <span class="<?= $className?>"></span>
                    <?
                }
            ?>
            </div>
        </div>
        <?if($review['~PREVIEW_TEXT']):?>
            <div class="product-items__bottom-comment-text">
                <?=$review['~PREVIEW_TEXT']?>
            </div>
        <?endif?>
        <?if(!empty($review['PROPERTIES']['FILES']['VALUE'])):?>
            <div class="product-items__bottom-comment-photo">
                <?foreach($review['PROPERTIES']['FILES']['VALUE'] as $file):?>
                    <?
                        $arFile = CFile::GetById($file)->Fetch();
                    ?>
                    <a href="/upload/<?=$arFile['SUBDIR']?>/<?=$arFile['FILE_NAME']?>" class="product-items__bottom-comment-img" 
                        data-fancybox="product-items__bottom-comment-photo-<?=$review['ID']?>">
                        <img
                            src="/upload/<?=$arFile['SUBDIR']?>/lazy_<?=$arFile['FILE_NAME']?>"
                            data-src="/upload/<?=$arFile['SUBDIR']?>/<?=$arFile['FILE_NAME']?>"
                            class="lozad">
                    </a>
                <?endforeach?>
            </div>
        <?endif?>
    </div>
<?endforeach?>
<?=$arResult['NAV_STRING']?>