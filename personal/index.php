<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

use Bitrix\Main\Page\Asset;

global $USER, $APPLICATION;

$APPLICATION->SetPageProperty("title", "Личный кабинет");
$APPLICATION->SetTitle("Личный кабинет");

if(!$USER->IsAuthorized()) {
    LocalRedirect('/signin/');
} else {
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/fastregistration.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/personal.css");
    $userAr = CUser::GetById($USER->GetId())->GetNext();

    $userAr['PHONE_NUMBER'] = \Bitrix\Main\UserPhoneAuthTable::GetList([
        'filter' => [
            'USER_ID' => $USER->GetId()
        ]
    ])->Fetch()['PHONE_NUMBER'];

    $siteSettings = getSiteSettings();

    $grecaptchaSiteKey = $siteSettings["RECAPTCHA_SITE_KEY"]["VALUE"];
?>
    <div class="wrapper personal">
        <personal-component grecaptcha-site-key='<?= $grecaptchaSiteKey ?>' :user-data='<?= json_encode($userAr) ?>' />
    </div>
<?
}
?>
<?require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');?>
