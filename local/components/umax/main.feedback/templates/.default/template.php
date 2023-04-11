<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<form class="product-items__bottom-item-content-form" action="<?=POST_FORM_ACTION_URI?>" method="POST" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<div class="product-items__bottom-item-content-form-title">
		Оставить отзыв
	</div>
	<?if(!empty($arResult["ERROR_MESSAGE"]))
	{
		foreach($arResult["ERROR_MESSAGE"] as $v)
			ShowError($v);
	}
	if($arResult["OK_MESSAGE"] <> '')
	{
		?>
		<div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div>
		<?
	}
	?>
	<input
			type="text"
			id="product-items__form-input--name"
			name="NAME"
			placeholder="Имя*"
			value="<?=$arResult["AUTHOR_NAME"]?>"
			required
	/>
	<input
			type="text"
			id="product-items__form-input--phone"
			name="PHONE"
			placeholder="Телефон"
	/>
	<div class="product-items__bottom-item-content-form-add">
		<input
			type="file"
			id="product-items__form-file"
			name="file[]" multiple accept=".webp"
		/>
		<label for="product-items__form-file"> Добавить фото </label>
	</div>
	<textarea
		name="PREVIEW_TEXT"
		id="product-items__form-text"
		placeholder="Введите текст"
	></textarea>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="hidden" name="element" value="<?=$arParams["ELEMENT_ID"]?>">
	<input type="hidden" name="iblock_review" value="<?=$arParams["REVIEWS_IBLOCK_ID"]?>">
	<input type="hidden" name="group" value="<?=$arParams["ELEMENT_GROUP_ID"]?>">


	<div class="rating-area">
		<input type="radio" id="star-5" name="rating" value="5" />
		<label for="star-5" title="Оценка «5»"></label>
		<input type="radio" id="star-4" name="rating" value="4" />
		<label for="star-4" title="Оценка «4»"></label>
		<input type="radio" id="star-3" name="rating" value="3" />
		<label for="star-3" title="Оценка «3»"></label>
		<input type="radio" id="star-2" name="rating" value="2" />
		<label for="star-2" title="Оценка «2»"></label>
		<input type="radio" id="star-1" name="rating" value="1" checked/>
		<label for="star-1" title="Оценка «1»"></label>
	</div>

	<button type="submit" name="submit" class="product-items__bottom-item-content-form-btn">
		Отправить
		<svg
				width="13"
				height="16"
				viewBox="0 0 13 16"
				fill="none"
				xmlns="http://www.w3.org/2000/svg"
		>
			<path
					d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z"
					fill="black"
			/>
		</svg>
	</button>
</form>