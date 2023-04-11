<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

class SubscribeController
{

    public function __construct($action, $answer)
    {
        if (method_exists($this, $action)) {
            $this->$action($answer);
            return true;
        }
        return false;
    }

    public function subscribe($data) {
        CModule::IncludeModule("subscribe");
        $EMAIL = $data["email"];

        /* получим значение пользователя */
        $USER = $data["userId"];

        /* определим рубрики активные рубрики подписок */
        $RUB_ID = array();
        $rub = CRubric::GetList(array(), array("ACTIVE"=>"Y"));
        while($rub->ExtractFields("r_")):
            $RUB_ID = array($r_ID) ;
        endwhile;

        /* создадим массив на подписку */
        $subscr = new CSubscription;
        $arFields = Array(
            "USER_ID" => $USER,
            "FORMAT" => "html/text",
            "EMAIL" => $EMAIL,
            "ACTIVE" => "Y",
            "RUB_ID" => $RUB_ID,
            "SEND_CONFIRM" => "N"
        );
        $idsubrscr = $subscr->Add($arFields);

        $res = [];

        if($idsubrscr) {
            $res['popuptitle'] = 'Удачно';
            $res['popupStatus'] = true;
            $res['popuptext'] = $EMAIL .' подписан на рассылку';
        }
        else {
            $res['popuptitle'] = 'Ошибка';
            $res['popupStatus'] = false;
            $res['popuptext'] = $EMAIL .' уже был подписан на рассылку';
        }
        /* если ajax не подключен */
        // if ($_POST["action"] != "ajax") {
        //     header('Location: '.$_SERVER['HTTP_REFERER']);
        // }

        echo json_encode($res);
    }
}


$action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';

$answer = json_decode(file_get_contents('php://input'), true);
header('Content-type: application/json');
// Выполняем метод класса
new SubscribeController($action, $answer);
