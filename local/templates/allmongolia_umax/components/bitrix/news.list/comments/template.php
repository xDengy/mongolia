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

<div class="blogPage__comment-block">
    <p class="blogPage__comment-title">Комментарии</p>
    <?foreach($arResult['ITEMS'] as $comment):?>
        <div class="blogPage__comment-item">
            <div class="blogPage__comment-item-data">
                <p class="blogPage__comment-item-name"><?=$comment['NAME']?></p>
                <p class="blogPage__comment-item-date"><?=explode(' ', $comment['TIMESTAMP_X'])[0]?></p>
            </div>
            <div class="blogPage__comment-item-text">
                <?=$comment['~PREVIEW_TEXT']?>
            </div>
        </div>
    <?endforeach?>
    <?=$arResult['NAV_STRING']?>
</div>