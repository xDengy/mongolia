<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$siteSettings = getSiteSettings();

use ST\GRecaptcha\GRecaptchaClass;
use ST\BitrixForms\BitrixFormsClass;

if (!empty($_POST['grecaptchaToken'])) {
    $GRecaptcha = new GRecaptchaClass();

    $grecapthcaResult = $GRecaptcha->returnReCaptcha($_POST['grecaptchaToken'], $siteSettings["RECAPTCHA_SECRET_KEY"]["VALUE"]);

    if (intval($grecapthcaResult['success'])) {
        if(empty($arResult["ERROR_MESSAGE"])) {
            $arFields = Array(
                "BLOG" => $_POST["element"],
            );

            if($_POST["PREVIEW_TEXT"] == 'undefined') {
                $_POST["PREVIEW_TEXT"] = '';
            }

            $arLoadProductArray = Array( 
                "MODIFIED_BY" => 1,
                "IBLOCK_ID" => $_POST['iblock_comment'],
                "NAME" => ($_POST["NAME"] !== '' && $_POST["NAME"]) ? $_POST["NAME"] : 'Аноним',
                "ACTIVE" => "N", 
                "PREVIEW_TEXT" => htmlspecialcharsbx($_POST["PREVIEW_TEXT"]),
                "PROPERTY_VALUES" => $arFields,
            );

            CModule::IncludeModule("iblock"); 
            $element = new CIBlockElement; 
            $elementRes = $element->Add($arLoadProductArray);

            $mailFields = [
                'TEXT' => $arLoadProductArray['PREVIEW_TEXT'],
                'AUTHOR' => $arLoadProductArray['NAME'],
                'DETAIL_URL' => $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'] . '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $_POST['iblock_comment'] . '&type=catalog&ID=' . $elementRes
            ];

            if($elementRes) {
                $result['success'] = 'Ваш комментарий отправлен';
            } else {
                $result['msg'] = $element->LAST_ERROR;
            }

            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            echo json_encode([
                'success' => 0,
                'msg' => 'При отправки формы произошла ошибка',
            ], JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    echo json_encode([
        'success' => 0,
        'msg' => 'При отправки формы произошла ошибка',
    ], JSON_UNESCAPED_UNICODE);
    exit();
}
