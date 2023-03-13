<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */


$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

if($_SERVER["REQUEST_METHOD"] == "POST" && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			if(mb_strlen($_POST["rating"]) < 1)
				$arResult["ERROR_MESSAGE"][] = 'Поставьте оценку';		
			if(mb_strlen($_POST["NAME"]) < 1)
				$arResult["ERROR_MESSAGE"][] = "Заполните имя";
		}
		if($arParams["USE_CAPTCHA"] == "Y")
		{
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if ($captcha_word <> '' && $captcha_code <> '')
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");

		}		
		if(empty($arResult["ERROR_MESSAGE"]))
		{	
			if($_FILES['file']) {
				foreach ($_FILES['file']['size'] as $key => $fileVal) {
					if($fileVal > 2500000) {
						$arResult["ERROR_MESSAGE"][] = 'Одно из изображений превышает размер в 250кб';
					}
				}
			}
			$arFields = Array(
				"RATING" => $_POST["rating"],
				"PHONE" => $_POST["PHONE"],
				"ELEMID" => $_POST["element"],
				"GROUPID" => $_POST["group"],
				'FILES' => []
			);
			$file_array = array();
			if($_FILES['file']) {
				$filesPrep = [];
				foreach ($_FILES['file'] as $key => $fileVal) {
					foreach ($fileVal as $valKey => $valValue) {
						$filesPrep[$valKey][$key] = $valValue;
					}
				}
				$filesPrep = array_reverse($filesPrep);

				foreach ($filesPrep as $key => $prepValue) {
					$file = array_merge($prepValue, array('del' => 'Y', 'MODULE_ID' => 'umax:main.feedback'));
					$fid = CFile::SaveFile($file, 'file');
					$file_path = '';
					if (intval($fid) > 0) {
						$file_path = CFile::GetPath($fid);
						$file_array = CFile::MakeFileArray($file_path);
						$arFields['FILES'][] = $file_array;
					}
				}
			}

			$arLoadProductArray = Array( 
				"MODIFIED_BY" => 1,
				"IBLOCK_ID" => $_POST['iblock_review'],
				"NAME" => ($_POST["NAME"] !== '' && $_POST["NAME"]) ? $_POST["NAME"] : 'Аноним',
				"ACTIVE" => "N", 
				'PREVIEW_PICTURE' => $file_array,
				"PREVIEW_TEXT" => htmlspecialcharsbx($_POST["PREVIEW_TEXT"]),
				"PROPERTY_VALUES" => $arFields,
			);

			CModule::IncludeModule("iblock"); 
			$element = new CIBlockElement; 
			$elementRes = $element->Add($arLoadProductArray);

			$mailFields = [
				'TEXT' => $arLoadProductArray['PREVIEW_TEXT'],
				'AUTHOR' => $arLoadProductArray['NAME'],
				'RATING' => $_POST["rating"],
				'PHONE' => $_POST["PHONE"],
				'DETAIL_URL' => $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'] . '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $_POST['iblock_review'] . '&type=catalog&ID=' . $elementRes
			];

			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(intval($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $mailFields, "N", intval($v));
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $mailFields);
			$_SESSION["MF_NAME"] = htmlspecialcharsbx($_POST["NAME"]);
			$_SESSION["MF_PHONE"] = htmlspecialcharsbx($_POST["PHONE"]);
			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
		}
		
		$arResult["MESSAGE"] = htmlspecialcharsbx($_POST["MESSAGE"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["NAME"]);
		$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_POST["PHONE"]);
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if($USER->IsAuthorized())
	{
		$arResult["AUTHOR_NAME"] = $USER->GetFormattedName(false);
		$arResult["AUTHOR_PHONE"] = $USER->GetLogin();
	}
	else
	{
		if($_SESSION["MF_NAME"] <> '')
			$arResult["AUTHOR_NAME"] = htmlspecialcharsbx($_SESSION["MF_NAME"]);
		if($_SESSION["MF_PHONE"] <> '')
			$arResult["AUTHOR_PHONE"] = htmlspecialcharsbx($_SESSION["MF_PHONE"]);
	}
}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
