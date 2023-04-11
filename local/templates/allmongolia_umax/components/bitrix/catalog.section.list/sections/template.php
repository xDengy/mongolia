<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>

<section class="categories-cards">
	<?foreach($arResult['SECTIONS'] as $key => $section):?>
		<?$class = '';?>
		<?switch ($key) {
			case 0:
			case 3:
			case 8:
				$class = 'middle';
				break;
			case 1:
			case 2:
			case 7:
				$class = 'big';
				break;
			default:
				$class = 'small';
				break;
		}?>
		<a href="<?=$section['SECTION_PAGE_URL']?>" class="categories__card categories__card--<?=$class?>">
			<div class="categories__card-img">
				<img
						src="<?=$section['PICTURE']['SRC']?>"
						alt="<?=$section['PICTURE']['ALT']?>"
						title="<?=$section['PICTURE']['TITLE']?>"
				/>
			</div>
			<div class="categories__card-title"><?=$section['NAME']?></div>
			<div class="categories__card-btn">подробнее</div>
		</a>
	<?endforeach?>
</section>