<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('catalog');

use Bitrix\Main\Loader;

class DaDataClass
{
    public function __construct($action, $answer)
    {
        $siteSettings = getSiteSettings();

        $this->dadata = new \Dadata\DadataClient($siteSettings["DADATA_TOKEN"]["VALUE"], $siteSettings["DADATA_SECRET"]["VALUE"]);

        if (method_exists($this, $action)) {
            $this->$action($answer);
            return true;
        }
        return false;
    }

    public function suggest($array)
    {
        $result = $this->dadata->suggest("address", $array['city']);

        p($result);
    }
}

$action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';

$answer = json_decode(file_get_contents('php://input'), true);
header('Content-type: application/json');
// Выполняем метод класса
new DaDataClass($action, $answer);
