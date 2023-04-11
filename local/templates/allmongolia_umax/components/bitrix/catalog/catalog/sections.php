<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

$arCurSection = CIBlock::GetByID($arParams["IBLOCK_ID"])->Fetch();

$arCurSection['PICTURE'] = CFile::GetFileArray($arCurSection['PICTURE']);
$arCurSectionId = 0;
include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_horizontal.php");