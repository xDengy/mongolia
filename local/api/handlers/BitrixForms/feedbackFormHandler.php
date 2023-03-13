<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$siteSettings = getSiteSettings();

use ST\GRecaptcha\GRecaptchaClass;
use ST\BitrixForms\BitrixFormsClass;

if (!empty($_POST['grecaptchaToken'])) {
    $GRecaptcha = new GRecaptchaClass();

    $grecapthcaResult = $GRecaptcha->returnReCaptcha($_POST['grecaptchaToken'], $siteSettings["RECAPTCHA_SECRET_KEY"]["VALUE"]);

    if (intval($grecapthcaResult['success'])) {

        $bitrixFormsClass = new BitrixFormsClass();

        $result = $bitrixFormsClass->feedback($_POST['firstname'], "+" . preg_replace('/[^0-9]/', '', $_POST['phone']), $_POST['message']);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }

    echo json_encode([
        'success' => 0,
        'msg' => 'При отправки формы произошла ошибка',
    ], JSON_UNESCAPED_UNICODE);
    exit();
}
