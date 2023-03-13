<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($backurl);
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/fastregistration.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/assets/css/pages/fastregistration-2.css");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/assets/js/pages/fastregistration.js");

$APPLICATION->SetPageProperty("title", "Регистрация успешна");
$APPLICATION->SetTitle("Регистрация успешна");
?>

<section class="fastregistration">
    <div class="wrap">
        <div class="fastregistration-form-wrap">
            <h2 class="fastregistration-form__title">
                вАША УЧЕТНАЯ ЗАПИСЬ СОЗДАНА!
            </h2>
            <div class="fastregistration-form__subtitle">
                <p>Поздравляем! Ваш личный кабинет был успешно создан.</p>
                <p>
                    Теперь вы можете воспоьзоваться дополнительными возможностями:
                </p>
                <ul>
                    <li>просмотр истории заказов</li>
                    <li>печать счета</li>
                    <li>
                        изменение своей контактной информации и адресов доставки
                    </li>
                </ul>
            </div>
            <a href="/personal/" class="fastregistration-form__btn">
                Продолжить
                <svg
                        width="13"
                        height="16"
                        viewBox="0 0 13 16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289L6.34315 0.928932C5.95262 0.538408 5.31946 0.538408 4.92893 0.928932C4.53841 1.31946 4.53841 1.95262 4.92893 2.34315L10.5858 8L4.92893 13.6569C4.53841 14.0474 4.53841 14.6805 4.92893 15.0711C5.31946 15.4616 5.95262 15.4616 6.34315 15.0711L12.7071 8.70711ZM0 9H12V7H0V9Z"
                            fill="white"
                    />
                </svg>
            </a>
        </div>
    </div>
</section>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
