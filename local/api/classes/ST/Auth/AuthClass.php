<?

namespace ST\Auth;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

class AuthClass {

    public function __construct() {}

    public function signIn($phone, $password)
    {
        \CModule::IncludeModule("main");

        global $USER, $APPLICATION;

        if (!is_object($USER)) $USER = new \CUser;

        $arAuthResult = $USER->Login($phone, $password, "Y");

        $APPLICATION->arAuthResult = $arAuthResult;

        if ($arAuthResult === true) {
            return [
                'success' => 1,
                'msg' => 'Авторизация выполнена успешно'
            ];
        } else {
            return [
                'success' => 0,
                'msg' => 'Неверный логин или пароль'
            ];
        }
    }

    public function signUp($firstname, $lastname, $email, $phone, $password, $passwordConfirm, $userId)
    {
        \CModule::IncludeModule("main");

        $user = new \CUser;

        $arFields = Array(
            "NAME"              => $firstname,
            "LAST_NAME"         => $lastname,
            "EMAIL"             => $email,
            "LOGIN"             => "+" . preg_replace('/[^0-9]/', '', $phone),
            "PHONE_NUMBER"      => "+" . preg_replace('/[^0-9]/', '', $phone),
            "LID"               => "ru",
            "ACTIVE"            => "Y",
            "GROUP_ID"          => [2],
            "PASSWORD"          => $password,
            "CONFIRM_PASSWORD"  => $passwordConfirm,
        );

        $ID = $user->Add($arFields);

        if (intval($ID) > 0) {
            if($userId !== '') {
                \ST\Bonuses\Bonuses::addExpiredBonuses(intval($userId), 1000);
            }

            return [
                'success' => 1,
                'userID' => $ID,
                'msg' => 'Регистрация выполнена успешно'
            ];
        } else {
            return [
                'success' => 0,
                'userID' => null,
                'msg' => strip_tags($user->LAST_ERROR)
            ];
        }
    }

    public function generateResetCode()
    {
        $code = rand(10000, 99999);

        return [
            'code' => $code,
            'hash_code' => sha1($code)
        ];
    }

    public function sendResetCode($phone)
    {
        \CModule::IncludeModule("main");

        $resetCodeData = $this->generateResetCode();

        $rsUser = \CUser::GetByLogin("+" . preg_replace('/[^0-9]/', '', $phone));

        if ($arUser = $rsUser->Fetch()) {
            $arFields = [
                'LOGIN' => $arUser['LOGIN'],
                'NAME' => $arUser['NAME'],
                'LAST_NAME' => $arUser['LAST_NAME'],
                'EMAIL' => $arUser['EMAIL'],
                'RESET_CODE' => $resetCodeData['code']
            ];

            $resSendEmail = \CEvent::SendImmediate
            (
                'UMAX_USER_PASS_RESET',
                ['s1'],
                $arFields,
                $Duplicate = "N"
            );

            if ($resSendEmail === "Y")
            {
                return [
                    'success' => 1,
                    'hash_code' => $resetCodeData['hash_code'],
                    'msg' => 'На вашу почту отправлено письмо с кодом',
                    'step' => 2,
                ];
            } else {
                return [
                    'success' => 0,
                    'hash_code' => null,
                    'msg' => 'Произошла ошибка при отправке email',
                    'step' => 1,
                ];
            }
        } else {
            return [
                'success' => 0,
                'hash_code' => null,
                'msg' => 'Введенный логин не найден',
                'step' => 1,
            ];
        }
    }

    public function checkResetCode($code, $hash_code)
    {
        if (hash_equals(sha1($code), $hash_code)) {
            return [
                'success' => 1,
                'msg' => null,
                'step' => 3,
            ];
        } else {
            return [
                'success' => 0,
                'msg' => 'Введен не действительный код',
                'step' => 2,
            ];
        }
    }

    public function resetPassword($phone, $password, $passwordConfirm)
    {
        \CModule::IncludeModule("main");

        if (empty($password)) {
            return [
                'success' => 0,
                'msg' => 'Поле пароль не может быть пустым'
            ];
        }

        if (empty($passwordConfirm)) {
            return [
                'success' => 0,
                'msg' => 'Поле повтор пароля не может быть пустым'
            ];
        }

        if (!hash_equals(sha1($password), sha1($passwordConfirm))) {
            return [
                'success' => 0,
                'msg' => 'Поля пароль и повтор пароля должны совпадать'
            ];
        }

        $rsUser = \CUser::GetByLogin("+" . preg_replace('/[^0-9]/', '', $phone));

        if ($arUser = $rsUser->Fetch()) {
            $user = new \CUser;

            $fields = Array(
                "PASSWORD"          => $password,
                "CONFIRM_PASSWORD"  => $passwordConfirm,
            );

            if ($user->Update($arUser['ID'], $fields)) {
                return [
                    'success' => 1,
                    'userID' => $arUser['ID'],
                    'msg' => 'Пароль успешно изменен',
                    'step' => 4,
                ];
            } else {
                return [
                    'success' => 0,
                    'userID' => null,
                    'msg' => strip_tags($user->LAST_ERROR),
                    'step' => 3,
                ];
            }
        }

        return [
            'success' => 0,
            'msg' => 'Произошла ошибка при смене пароля, попробуйте ещё раз',
            'step' => 1
        ];
    }

    public function logout() {
        \CModule::IncludeModule("main");

        global $USER, $APPLICATION;

        $USER->Logout();

        return [
            'success' => 1,
            'msg' => 'Вы вышли из аккаунта'
        ];
    }
}
