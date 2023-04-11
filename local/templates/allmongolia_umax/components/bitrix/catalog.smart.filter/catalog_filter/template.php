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

$templateData = array(
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	// $this->addExternalCss($templateData['TEMPLATE_THEME']);
}
$sect = CIBlockSection::GetList([], ['ID' => $arParams['SECTION_ID']], false, [],  false)->Fetch();
?>
<div class="smart-filter">
	<div class="smart-filter-section">

		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="catalog-nav__form smart-filter-form">

			<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach;?>

			<div class="row">
				<?if($APPLICATION->GetCurPage() !== '/catalog/search/'):?>
					<?if($APPLICATION->GetCurPage() !== '/catalog/novinki/'):?>
						<a href="<?=str_replace('clear', 'novinka-is-true', $arResult['SEF_DEL_FILTER_URL'])?>" class="catalog-nav__new">новинки</a>
					<?endif?>
					<div class="catalog-nav__item accordion-catalog">
						<div class="catalog-nav__item-top accordion-catalog__header">
							Категории
							<svg
									width="16"
									height="9"
									viewBox="0 0 16 9"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
							>
								<path
										d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z"
										fill="black"
								/>
							</svg>
						</div>
						<div class="catalog-nav__item accordion-catalog">
						<?
							$APPLICATION->IncludeComponent(
								"bitrix:catalog.section.list",
								"filter",
								array(
									"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									'SECTION_ID' => $sect['IBLOCK_SECTION_ID'],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
									"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
									"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
									"ADD_SECTIONS_CHAIN" => 'N',
								),
								false
							);
						?>
						</div>
					</div>
				<?endif?>

				<?foreach($arResult["ITEMS"] as $key => $arItem)//prices
				{
					$key = $arItem["ENCODED_ID"];
					if(isset($arItem["PRICE"])):
						if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
							continue;

						$step_num = 4;
						$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
						$prices = array();
						if (Bitrix\Main\Loader::includeModule("currency"))
						{
							for ($i = 0; $i < $step_num; $i++)
							{
								$prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
							}
							$prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
						}
						else
						{
							$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
							for ($i = 0; $i < $step_num; $i++)
							{
								$prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
							}
							$prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
						}
						?>
						<div class="catalog-nav__item accordion-catalog">

							<div class="bx-active <?if(strpos(json_encode($arItem["VALUES"]), 'HTML_VALUE') > 0):?>is-active<?endif?>">
								<span class="smart-filter-container-modef"></span>

								<div class="catalog-nav__item-top accordion-catalog__header" <?//onclick="smartFilter.hideFilterProps(this)"?>>
									<?=$arItem["NAME"]?>

									<svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z" fill="black"></path>
									</svg>
								</div>

								<div class="catalog-nav__item-bottom catalog-nav__item-bottom--price accordion-catalog__description smart-filter-block" data-role="bx_filter_block">
									<div class="range-slider range-slider__price smart-filter-slider-track-container">
										<div class="smart-filter-slider-track" id="drag_track_<?=$key?>">
											<div class="smart-filter-slider-price-bar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
											<div class="smart-filter-slider-price-bar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
											<div class="smart-filter-slider-price-bar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
											<div class="smart-filter-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0; right: 0;">
												<a class="smart-filter-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
												<a class="smart-filter-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
											</div>
										</div>
									</div>
									<div class="extra-controls extra-controls__price">
										<input
											class="min-price js-input-from js-input-from__price form-control form-control-sm"
											type="number"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
											placeholder="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
											onkeyup="smartFilter.keyup(this)"
										/>
										<span></span>
										<input
											class="max-price js-input-from js-input-from__price form-control form-control-sm"
											type="number"
											name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
											placeholder="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"
											onkeyup="smartFilter.keyup(this)"
										/>
									</div>
								</div>
							</div>
						</div>
							<?

							$arJsParams = array(
								"leftSlider" => 'left_slider_'.$key,
								"rightSlider" => 'right_slider_'.$key,
								"tracker" => "drag_tracker_".$key,
								"trackerWrap" => "drag_track_".$key,
								"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
								"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
								"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
								"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
								"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
								"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
								"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
								"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
								"precision" => $precision,
								"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
								"colorAvailableActive" => 'colorAvailableActive_'.$key,
								"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
							);
							?>
							<script type="text/javascript">
								BX.ready(function(){
									window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
								});
							</script>
					<?endif;
				}
				?>
				<?

				CModule::IncludeModule('highloadblock');
				$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(8)->fetch();
				$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
				$entityDataClass = $entity->getDataClass();

				//not prices
				foreach($arResult["ITEMS"] as $key=>$arItem)
				{
					if($arItem['CODE'] == 'NOVINKA')
						continue;
					
					if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]) || $arItem['CODE'] == 'COLOR' || $arItem['CODE'] == 'SIZE')
						continue;

					if ($arItem["DISPLAY_TYPE"] == "A" && ( $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
						continue;
					?>

					<?if($arItem['CODE'] !== 'TSVET'):?>
						<div class="catalog-nav__item accordion-catalog">
							<div class="bx-active <?if(strpos(json_encode($arItem["VALUES"]), 'CHECKED') > 0):?>is-active<?endif?>">
								<span class="smart-filter-container-modef"></span>

								<div class="catalog-nav__item-top accordion-catalog__header" <?//onclick="smartFilter.hideFilterProps(this)"?>>

									<?=$arItem["NAME"]?>

									<svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z" fill="black"></path>
									</svg>
								</div>

								<div class="smart-filter-block catalog-nav__item-bottom catalog-nav__item-bottom--price accordion-catalog__description" data-role="bx_filter_block">
									<?
									$arCur = current($arItem["VALUES"]);
									switch ($arItem["DISPLAY_TYPE"])
									{
										//region NUMBERS_WITH_SLIDER +
										case "A":
										?>
											<div class="catalog-nav__item-bottom catalog-nav__item-bottom--price accordion-catalog__description smart-filter-block" data-role="bx_filter_block">
												<div class="smart-filter-slider-track-container">
													<div class="smart-filter-slider-track" id="drag_track_<?=$key?>">
														<div class="smart-filter-slider-price-bar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
														<div class="smart-filter-slider-price-bar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
														<div class="smart-filter-slider-price-bar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
														<div class="smart-filter-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0; right: 0;">
															<a class="smart-filter-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
															<a class="smart-filter-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
														</div>
													</div>
												</div>
												<div class="extra-controls extra-controls__price">
													<input
														class="min-price js-input-from js-input-from__price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
														placeholder="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
														onkeyup="smartFilter.keyup(this)"
													/>
													<span></span>
													<input
														class="max-price js-input-from js-input-from__price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
														placeholder="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>

											<?
												$arJsParams = array(
												"leftSlider" => 'left_slider_'.$key,
												"rightSlider" => 'right_slider_'.$key,
												"tracker" => "drag_tracker_".$key,
												"trackerWrap" => "drag_track_".$key,
												"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
												"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
												"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
												"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
												"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
												"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
												"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
												"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
												"precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
												"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
												"colorAvailableActive" => 'colorAvailableActive_'.$key,
												"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
											);
											?>
												<script type="text/javascript">
													BX.ready(function(){
														window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
													});
												</script>
											<?

										break;

										//endregion

										//region NUMBERS +
										case "B":
										?>
											<div class="smart-filter-input-group-number">
												<div class="d-flex justify-content-between">
													<div class="form-group" style="width: calc(50% - 10px);">
														<div class="smart-filter-input-container">
															<input
																class="min-price form-control form-control-sm"
																type="number"
																name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
																id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
																value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
																size="5"
																placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
																onkeyup="smartFilter.keyup(this)"
																/>
														</div>
													</div>

													<div class="form-group" style="width: calc(50% - 10px);">
													<div class="smart-filter-input-container">
														<input
															class="max-price form-control form-control-sm"
															type="number"
															name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
															size="5"
															placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
															onkeyup="smartFilter.keyup(this)"
															/>
													</div>
												</div>
												</div>
											</div>
										<?
										break;
										//endregion

										//region CHECKBOXES_WITH_PICTURES +
										case "G":
										?>
											<div class="smart-filter-input-group-checkbox-pictures">
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="checkbox"
														name="<?=$ar["CONTROL_NAME"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<?=$ar["HTML_VALUE"]?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
													<?
														$class = "";
														if ($ar["CHECKED"])
															$class.= " bx-active";
														if ($ar["DISABLED"])
															$class.= " disabled";
													?>
													<label for="<?=$ar["CONTROL_ID"]?>"
														data-role="label_<?=$ar["CONTROL_ID"]?>"
														class="smart-filter-checkbox-label<?=$class?>"
														onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
														<span class="smart-filter-checkbox-btn bx-color-sl">
															<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																<span class="smart-filter-checkbox-btn-image" style="background-image: url('<?=$ar["FILE"]["SRC"]?>');"></span>
															<?endif?>
														</span>
													</label>
												<?endforeach?>
												<div style="clear: both;"></div>
											</div>
										<?
										break;
										//endregion

										//region CHECKBOXES_WITH_PICTURES_AND_LABELS +
										case "H":
										?>
											<div class="smart-filter-input-group-checkbox-pictures-text">
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="checkbox"
													name="<?=$ar["CONTROL_NAME"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<?=$ar["HTML_VALUE"]?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												/>
												<?
													$class = "";
													if ($ar["CHECKED"])
														$class.= " bx-active";
													if ($ar["DISABLED"])
														$class.= " disabled";
												?>
												<label for="<?=$ar["CONTROL_ID"]?>"
													data-role="label_<?=$ar["CONTROL_ID"]?>"
													class="smart-filter-checkbox-label<?=$class?>"
													onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
													<span class="smart-filter-checkbox-btn">
														<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
															<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
														<?endif?>
													</span>
													<span class="smart-filter-checkbox-text" title="<?=$ar["VALUE"];?>">
														<?=$ar["VALUE"];
														if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
															?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
														endif;?>
													</span>
												</label>
											<?endforeach?>
											</div>
										<?
										break;
										//endregion

										//region DROPDOWN +
										case "P":
										?>
											<? $checkedItemExist = false; ?>
											<div class="smart-filter-input-group-dropdown">
												<div class="smart-filter-dropdown-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
													<div class="smart-filter-dropdown-text" data-role="currentOption">
														<?foreach ($arItem["VALUES"] as $val => $ar)
														{
															if ($ar["CHECKED"])
															{
																echo $ar["VALUE"];
																$checkedItemExist = true;
															}
														}
														if (!$checkedItemExist)
														{
															echo GetMessage("CT_BCSF_FILTER_ALL");
														}
														?>
													</div>
													<div class="smart-filter-dropdown-arrow"></div>
													<input
														style="display: none"
														type="radio"
														name="<?=$arCur["CONTROL_NAME_ALT"]?>"
														id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
														value=""
													/>
													<?foreach ($arItem["VALUES"] as $val => $ar):?>
														<input
															style="display: none"
															type="radio"
															name="<?=$ar["CONTROL_NAME_ALT"]?>"
															id="<?=$ar["CONTROL_ID"]?>"
															value="<? echo $ar["HTML_VALUE_ALT"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
														/>
													<?endforeach?>

													<div class="smart-filter-dropdown-popup" data-role="dropdownContent" style="display: none;">
														<ul>
															<li>
																<label for="<?="all_".$arCur["CONTROL_ID"]?>"
																	class="smart-filter-dropdown-label"
																	data-role="label_<?="all_".$arCur["CONTROL_ID"]?>"
																	onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																	<?=GetMessage("CT_BCSF_FILTER_ALL"); ?>
																</label>
															</li>
															<?foreach ($arItem["VALUES"] as $val => $ar):
																$class = "";
																if ($ar["CHECKED"])
																	$class.= " selected";
																if ($ar["DISABLED"])
																	$class.= " disabled";
															?>
																<li>
																	<label for="<?=$ar["CONTROL_ID"]?>"
																		class="smart-filter-dropdown-label<?=$class?>"
																		data-role="label_<?=$ar["CONTROL_ID"]?>"
																		onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																		<?=$ar["VALUE"]?>
																	</label>
																</li>
															<?endforeach?>
														</ul>
													</div>
												</div>
											</div>
										<?
										break;
										//endregion

										//region DROPDOWN_WITH_PICTURES_AND_LABELS
										case "R":
											?>
												<div class="smart-filter-input-group-dropdown">
													<div class="smart-filter-dropdown-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
														<div class="smart-filter-input-group-dropdown-flex" data-role="currentOption">
															<?
															$checkedItemExist = false;
															foreach ($arItem["VALUES"] as $val => $ar):
																if ($ar["CHECKED"])
																{
																?>
																	<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																		<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																	<?endif?>
																	<span class="smart-filter-dropdown-text"><?=$ar["VALUE"]?></span>
																<?
																	$checkedItemExist = true;
																}
															endforeach;
															if (!$checkedItemExist)
															{
																?>
																	<span class="smart-filter-checkbox-btn-image all"></span>
																	<span class="smart-filter-dropdown-text"><?=GetMessage("CT_BCSF_FILTER_ALL");?></span>
																<?
															}
															?>
														</div>

														<div class="smart-filter-dropdown-arrow"></div>

														<input
															style="display: none"
															type="radio"
															name="<?=$arCur["CONTROL_NAME_ALT"]?>"
															id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
															value=""
														/>
														<?foreach ($arItem["VALUES"] as $val => $ar):?>
															<input
																style="display: none"
																type="radio"
																name="<?=$ar["CONTROL_NAME_ALT"]?>"
																id="<?=$ar["CONTROL_ID"]?>"
																value="<?=$ar["HTML_VALUE_ALT"]?>"
																<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															/>
														<?endforeach?>

														<div class="smart-filter-dropdown-popup" data-role="dropdownContent" style="display: none">
															<ul>
																<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
																	<label for="<?="all_".$arCur["CONTROL_ID"]?>"
																		class="smart-filter-param-label"
																		data-role="label_<?="all_".$arCur["CONTROL_ID"]?>"
																		onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																		<span class="smart-filter-checkbox-btn-image all"></span>
																		<span class="smart-filter-dropdown-text"><?=GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
																	</label>
																</li>
															<?
															foreach ($arItem["VALUES"] as $val => $ar):
																$class = "";
																if ($ar["CHECKED"])
																	$class.= " selected";
																if ($ar["DISABLED"])
																	$class.= " disabled";
															?>
																<li>
																	<label for="<?=$ar["CONTROL_ID"]?>"
																		data-role="label_<?=$ar["CONTROL_ID"]?>"
																		class="smart-filter-param-label<?=$class?>"
																		onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																		<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																			<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																		<?endif?>
																		<span class="smart-filter-dropdown-text"><?=$ar["VALUE"]?></span>
																	</label>
																</li>
															<?endforeach?>
															</ul>
														</div>
													</div>
												</div>
											<?
											break;
										//endregion

										//region CALENDAR
										case "U":
											?>
											<div class="col">
												<div class=""><div class="smart-filter-input-container smart-filter-calendar-container">
													<?$APPLICATION->IncludeComponent(
														'bitrix:main.calendar',
														'',
														array(
															'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
															'SHOW_INPUT' => 'Y',
															'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
															'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
															'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
															'SHOW_TIME' => 'N',
															'HIDE_TIMEBAR' => 'Y',
														),
														null,
														array('HIDE_ICONS' => 'Y')
													);?>
												</div></div>
												<div class=""><div class="smart-filter-input-container smart-filter-calendar-container">
													<?$APPLICATION->IncludeComponent(
														'bitrix:main.calendar',
														'',
														array(
															'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
															'SHOW_INPUT' => 'Y',
															'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
															'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
															'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
															'SHOW_TIME' => 'N',
															'HIDE_TIMEBAR' => 'Y',
														),
														null,
														array('HIDE_ICONS' => 'Y')
													);?>
												</div></div>
											</div>
											<div class="w-100"></div>
											<?
											break;
										//endregion

										//region CHECKBOXES +
										default:
											?>
											<div class="smart-filter-input-group-checkbox-list">
												<?foreach($arItem["VALUES"] as $val => $ar):?>
													<div class="catalog-nav__item-description <?echo $ar["DISABLED"] ? 'disabled': ''?>">
														<input type="checkbox" 
															value="<? echo $ar["HTML_VALUE"] ?>"
															name="<? echo $ar["CONTROL_NAME"] ?>"
															id="<? echo $ar["CONTROL_ID"] ?>"
															name="catalog__material"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															<? echo $ar["DISABLED"] ? 'disabled': '' ?>
															<?if(!$ar["DISABLED"]):?>onclick="smartFilter.click(this)"<?else:?>disabled<?endif?>
														>
														<label for="<? echo $ar["CONTROL_ID"] ?>"><?=$ar["VALUE"];?></label>
													</div>
												<?endforeach;?>
											</div>
									<?
										//endregion
									}
									?>
								</div>
							</div>
						</div>
					<?else:?>
						<div class="catalog-nav__item accordion-catalog">
							<div class="bx-active <?if(strpos(json_encode($arItem["VALUES"]), 'CHECKED') > 0):?>is-active<?endif?>">
								<span class="smart-filter-container-modef"></span>

								<div class="catalog-nav__item-top accordion-catalog__header" <?//onclick="smartFilter.hideFilterProps(this)"?>>

									<?=$arItem["NAME"]?>

									<svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.29289 8.70711C7.68342 9.09763 8.31658 9.09763 8.70711 8.70711L15.0711 2.34315C15.4616 1.95262 15.4616 1.31946 15.0711 0.928932C14.6805 0.538408 14.0474 0.538408 13.6569 0.928932L8 6.58579L2.34315 0.928932C1.95262 0.538408 1.31946 0.538408 0.928933 0.928932C0.538408 1.31946 0.538408 1.95262 0.928932 2.34315L7.29289 8.70711ZM7 7L7 8L9 8L9 7L7 7Z" fill="black"></path>
									</svg>
								</div>
								<div class="catalog-nav__item-bottom catalog-nav__item-bottom--color accordion-catalog__description">
									<?foreach($arItem["VALUES"] as $val => $ar):?>
										<?
											$result = $entityDataClass::getList(array(
												"select" => array("*"),
												"filter" => Array("UF_XML_ID"=>$val),
											))->Fetch();
										?>
										<div class="catalog-nav__item-color <?echo $ar["DISABLED"] ? 'disabled': ''?>">
											<input
												type="checkbox"
												value="<? echo $ar["HTML_VALUE"] ?>"
												name="<? echo $ar["CONTROL_NAME"] ?>"
												id="<? echo $ar["CONTROL_ID"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												<?if(!$ar["DISABLED"]):?>onclick="smartFilter.click(this)"<?else:?>disabled<?endif?>
											/>
											<label data-role="label_<?=$ar["CONTROL_ID"]?>" style="background: <?=$result['UF_DESCRIPTION']?>; <?if(in_array($result['UF_DESCRIPTION'], ['#fff', 'white', 'rgb(255,255,255)', 'rgba(255,255,255,1)'])):?>border: 1px solid;<?endif?>" for="<? echo $ar["CONTROL_ID"] ?>">
												<!-- <span class="smart-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
													<span class="smart-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
													if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
														?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
													endif;?></span>
												</span> -->
											</label>
										</div>
									<?endforeach;?>
								</div>
							</div>
						</div>
					<?endif?>
				<?
				}
				?>
			</div><!--//row-->

			<div class="row">
				<div class="col smart-filter-button-box">
					<div class="smart-filter-block">
						<div class="smart-filter-parameters-box-container">
							<input
								class="btn btn-primary"
								type="submit"
								id="set_filter"
								name="set_filter"
								value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
							/>
							<div class="smart-filter-popup-result" id="modef">
								<div class="modef_num-wrapper">
									<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
									<span class="arrow"></span>
									<input
										class="btn btn-link"
										type="submit"
										id="del_filter"
										name="del_filter"
										value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
									/>
								</div>
								<?//$arResult["FILTER_URL"]?>
								<a class="filter-btn submit-filter" href="<?=$_SERVER['REQUEST_URI']?>" rel="nofollow" target=""><?echo GetMessage("CT_BCSF_SET_FILTER")?></a>
								<a class="filter-btn delete-filter" href="<?=explode('filter/' . $arParams['SMART_FILTER_PATH'] . '/apply/', $APPLICATION->GetCurPage())[0]?>" rel="nofollow" target=""><?echo GetMessage("CT_BCSF_DEL_FILTER")?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>