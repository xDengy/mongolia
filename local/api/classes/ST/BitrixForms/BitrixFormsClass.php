<?

namespace ST\BitrixForms;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

class BitrixFormsClass {

    public function __construct() {}

    public function feedback($firstname, $phone, $message) {
        \CModule::IncludeModule("form");

        // ID веб-формы
        $FORM_ID = 1;

        // Массив значений ответов
        $arValues = array (
            "form_text_1"                 => $firstname,
            "form_text_2"                 => $phone,
            "form_text_3"                 => $message,
        );

        // Сохраняем результат
        if ($RESULT_ID = \CFormResult::Add($FORM_ID, $arValues))
        {
            return [
                'success' => 1,
                'msg' => 'Спасибо, ваша заявка принята',
                'resultID' => $RESULT_ID
            ];
        } else {
            return [
                'success' => 0,
                'msg' => 'Произошла ошибка при отправки формы',
                'resultID' => null
            ];
        }
    }
}
