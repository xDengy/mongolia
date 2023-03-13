<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$siteSettings = getSiteSettings();

use ST\GRecaptcha\GRecaptchaClass;

use ST\Auth\AuthClass;

if (!empty($_POST['grecaptchaToken'])) {
    $GRecaptcha = new GRecaptchaClass();

    $grecapthcaResult = $GRecaptcha->returnReCaptcha($_POST['grecaptchaToken'], $siteSettings["RECAPTCHA_SECRET_KEY"]["VALUE"]);

    // Отправка кода на майл
    if (intval($grecapthcaResult['success']) && !empty($_POST['step']) && intval($_POST['step']) === 1) {
        global $USER;

        $authClass = new AuthClass();

        $result = $authClass->sendResetCode("+" . preg_replace('/[^0-9]/', '', $_POST['phone']));

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }

    // Проверка кода восстановления
    if (intval($grecapthcaResult['success']) && !empty($_POST['step']) && intval($_POST['step']) === 2) {
        global $USER;

        $authClass = new AuthClass();

        $result = $authClass->checkResetCode($_POST['code'], $_POST['hash_code']);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }

    // Восстановление пароля
    if (intval($grecapthcaResult['success']) && !empty($_POST['step']) && intval($_POST['step']) === 3) {
        global $USER;

        $authClass = new AuthClass();

        $result = $authClass->resetPassword($_POST['phone'], $_POST['password'], $_POST['passwordConfirm']);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }

    echo json_encode([
        'success' => 0,
        'msg' => 'При авторизации возникла ошибка, перезагрузите страницу и повторите попытку',
    ], JSON_UNESCAPED_UNICODE);
    exit();
}
