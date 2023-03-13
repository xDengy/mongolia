<?

declare(strict_types=1);

namespace ST\GRecaptcha;

class GRecaptchaClass {
    public function returnReCaptcha($token, $secret_key) {
        // URL куда отправлять токин и секретный ключ
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        // Параметры отправленных данных
        $params = [
            'secret' => $secret_key, // Секретный ключ
            'response' => $token, // Токин
            'remoteip' => $_SERVER['REMOTE_ADDR'], // IP-адрес пользователя
        ];

        // Делаем запрос
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Отправляем запрос
        $response = curl_exec($ch);

        // Возвращаем массив полученных данных
        return json_decode($response, true);
    }
}
