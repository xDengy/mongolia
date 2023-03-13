<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$siteSettings = getSiteSettings();

use ST\GRecaptcha\GRecaptchaClass;

use ST\Personal\PersonalClass;

if (!empty($_POST['grecaptchaToken'])) {
    $GRecaptcha = new GRecaptchaClass();

    $grecapthcaResult = $GRecaptcha->returnReCaptcha($_POST['grecaptchaToken'], $siteSettings["RECAPTCHA_SECRET_KEY"]["VALUE"]);

    if (intval($grecapthcaResult['success'])) {
        global $USER;

        $authClass = new PersonalClass();

        $arData = $_POST;
        $arData['phone'] = "+" . preg_replace('/[^0-9]/', '', $arData['phone']);

        $result = $authClass->updateUser($arData);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }

    echo json_encode([
        'success' => 0,
        'msg' => 'При авторизации возникла ошибка, перезагрузите страницу и повторите попытку',
    ], JSON_UNESCAPED_UNICODE);
    exit();
}
