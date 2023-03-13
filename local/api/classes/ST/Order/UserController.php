<?php


namespace BM\Checkout;


class UserController
{
    public static function userRegister(array $props)
    {
        global $USER;

        if ($USER->IsAuthorized()) return;

        $email = $props['props']['EMAIL']['value'];
        $userId = false;

        $obUser = \CUser::GetList(($by = "id"), ($order = "desc"), ['EMAIL' => $email]);
        $resUser = $obUser->fetch();
        if (!empty($resUser)) {
            $userId = $resUser['ID'];
        } else {
            list($lastName, $firstName, $secondName) = explode(' ', trim(strval($props['props']['F_FIO']['value'])));
            $password = md5($email);
            $res = $USER->Register($email, $firstName, $lastName, $password, $password, $email);

            if (!empty($res['ID'])) {
                $userId = $res['ID'];
                $USER->Authorize($res['ID']);

                \Bitrix\Main\Mail\Event::send(array(
                    "EVENT_NAME" => "NEW_USER",
                    "LID" => "s1",
                    "C_FIELDS" => array(
                        "EMAIL" => $USER->GetEmail(),
                        "USER_ID" => $USER->GetId()
                    ),
                ));

                \Bitrix\Main\Mail\Event::send(array(
                    "EVENT_NAME" => "NEW_USER_ORDER",
                    "LID" => "s1",
                    "C_FIELDS" => array(
                        "EMAIL" => $USER->GetEmail(),
                        "USER_ID" => $USER->GetId(),
                        "LOGIN" => $USER->GetLogin(),
                        "PASSWORD" => $password
                    ),
                ));
            } else throw new \Exception('Произошла системная ошибка при регистрации, попробуйте авторизоваться');
        }
        return $userId;
    }
}