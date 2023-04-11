<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$siteSettings = getSiteSettings();

use ST\GRecaptcha\GRecaptchaClass;

use ST\Auth\AuthClass;

if (!empty($_POST['grecaptchaToken'])) {
    $GRecaptcha = new GRecaptchaClass();

    $grecapthcaResult = $GRecaptcha->returnReCaptcha($_POST['grecaptchaToken'], $siteSettings["RECAPTCHA_SECRET_KEY"]["VALUE"]);

    if (intval($grecapthcaResult['success']) && (hash_equals(sha1($_POST['password']), sha1($_POST['passwordConfirm'])))) {

        $authClass = new AuthClass();

        $result = $authClass->signUp($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['passwordConfirm'], $_POST['userId']);

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }

    echo json_encode([
        'success' => 0,
        'msg' => 'При регистрации возникла ошибка, перезагрузите страницу и повторите попытку',
    ], JSON_UNESCAPED_UNICODE);
    exit();
}
