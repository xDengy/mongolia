<?

namespace ST\Personal;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

class PersonalClass {

    public function __construct() {}

    public function updateUser($arData)
    {
        \CModule::IncludeModule("main");

        if (!hash_equals(sha1($arData['password']), sha1($arData['passwordConfirm']))) {
            return [
                'success' => 0,
                'msg' => 'Поля пароль и повтор пароля должны совпадать'
            ];
        }

        $rsUser = \CUser::GetByID($arData['id']);

        if ($arUser = $rsUser->Fetch()) {
            $user = new \CUser;

            $fields = Array(
                "NAME"              => $arData['name'],
                "LAST_NAME"         => $arData['lastname'],
                "LOGIN"             => $arData['phone'],
                "PHONE_NUMBER"      => $arData['phone'],
                "EMAIL"             => $arData['email'],
            );

            if (!empty($arData['password']) && !empty($arData['passwordConfirm'])) {
                $fields['PASSWORD'] = $arData['password'];
                $fields['CONFIRM_PASSWORD'] = $arData['passwordConfirm'];
            }

            if ($user->Update($arUser['ID'], $fields)) {
                return [
                    'success' => 1,
                    'userID' => $arUser['ID'],
                    'msg' => 'Данные пользователя успешно изменены',
                ];
            } else {
                return [
                    'success' => 0,
                    'userID' => null,
                    'msg' => strip_tags($user->LAST_ERROR),
                ];
            }
        }

        return [
            'success' => 0,
            'msg' => 'Произошла ошибка при изменении данных, попробуйте ещё раз',
        ];
    }
}
