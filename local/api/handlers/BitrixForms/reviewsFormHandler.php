<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$siteSettings = getSiteSettings();

use ST\GRecaptcha\GRecaptchaClass;
use ST\BitrixForms\BitrixFormsClass;

if (!empty($_POST['grecaptchaToken'])) {
    $GRecaptcha = new GRecaptchaClass();

    $grecapthcaResult = $GRecaptcha->returnReCaptcha($_POST['grecaptchaToken'], $siteSettings["RECAPTCHA_SECRET_KEY"]["VALUE"]);

    if (intval($grecapthcaResult['success'])) {
        if($_FILES['file']) {
            foreach ($_FILES['file']['size'] as $key => $fileVal) {
                if($fileVal > 2500000) {
                    $arResult["ERROR_MESSAGE"][] = 'Одно из изображений превышает размер в 250кб';
                }
            }
        }
        if(empty($arResult["ERROR_MESSAGE"])) {
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

            if($_POST["PREVIEW_TEXT"] == 'undefined') {
                $_POST["PREVIEW_TEXT"] = '';
            }

            $arLoadProductArray = Array( 
                "MODIFIED_BY" => 1,
                "IBLOCK_ID" => $_POST['iblock_review'],
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
                'RATING' => $_POST["rating"],
                'PHONE' => $_POST["PHONE"],
                'DETAIL_URL' => $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://' . $_SERVER['HTTP_HOST'] . '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $_POST['iblock_review'] . '&type=catalog&ID=' . $elementRes
            ];

            if($elementRes) {
                $result['success'] = 'Ваш отзыв отправлен';
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
