<?php
/**
 * Created by PhpStorm.
 * User: Maxim Masalov
 * Date: 08.08.2019
 * Time: 12:03
 */

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

class FavoritesController
{
    
    public function __construct($action, $answer)
    {
        if (method_exists($this, $action)) {
            $this->$action($answer);
            return true;
        }
        return false;
    }

    // Проверить наличие товара в избранном
    public function inFavs($data) {
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(6)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entityDataClass = $entity->getDataClass();
        $ob_res[$data['product_id']] = $entityDataClass::getList(array(
            "select" => array("*"),
            'filter' => ['UF_NAME' => $data['userId'], 'UF_XML_ID' => $data['product_id']]
        ))->Fetch();

        echo json_encode($ob_res);
    }

    // Добавить в избранное
    public function setFavs($data) {
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(6)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entityDataClass = $entity->getDataClass();

        if($data['checked'] == true) {
            $result = $entityDataClass::add(array(
                'UF_NAME' => $data['userId'],
                'UF_XML_ID' => $data['product_id'],
            ));
        } else {
            $highloadData = $entityDataClass::getList(array(
                "select" => array("*"),
                'filter' => ['UF_NAME' => $data['userId'], 'UF_XML_ID' => $data['product_id']]
            ))->Fetch();
            $result = $entityDataClass::delete($highloadData['ID']);
        }

        echo json_encode($result);
    }

    // Получить избранные товары
    public function getFavs($data) {
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(6)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entityDataClass = $entity->getDataClass();
        $prods = $entityDataClass::getList(array(
            "select" => array("*"),
            'filter' => ['UF_NAME' => $data['userId']]
        ));
        $ob_res = [];
        $i = 1;
        while ($prod = $prods->Fetch()) {
            $el_res = CIBlockElement::getById($prod['UF_XML_ID'])->GetNextElement();

            $product = new \Simba\Catalog\Product($prod['UF_XML_ID']);
            $quantity = $product->getQuantity();
            $price = CCatalogProduct::GetOptimalPrice($prod['UF_XML_ID']);

            $price['FORMATED_PRICE'] = number_format($price['RESULT_PRICE']['BASE_PRICE'], 0, '', ' ');
            $price['FORMATED_DISCOUNT_PRICE'] = number_format($price['RESULT_PRICE']['DISCOUNT_PRICE'], 0, '', ' ');
            $price['FORMATED_DISCOUNT_DIFF'] = number_format($price['RESULT_PRICE']['DISCOUNT'], 0, '', ' ');
            $price['DISCOUNT_DIFF'] = round(($price['RESULT_PRICE']['DISCOUNT_PRICE'] * 100) / $price['RESULT_PRICE']['BASE_PRICE']) - 100;

            $elementFields = $el_res->GetFields();
            $elementFields['PREVIEW_PICTURE'] = CFile::GetFileArray($elementFields['PREVIEW_PICTURE']);

            if($data['avaliable'] == true) {
                if($quantity['QUANTITY'] == 0)
                    continue;
            }
            
            $ob_res[] = array_merge(
                $elementFields, 
                [
                    'PROPERTIES' => $el_res->GetProperties(), 
                    'PRICE' => $price,
                    'QUANTITY' => $quantity
                ]
            );
        }
        if($data['sort'] !== false && $data['order'] !== false) {
            switch ($data['sort']) {
                case 'date':
                    usort($ob_res, 'sortByDate');
                    break;
                case 'price':
                    if($data['order'] == 'asc')
                        usort($ob_res, 'sortByPriceAsc');
                    if($data['order'] == 'desc')
                        usort($ob_res, 'sortByPriceDesc');
                    break;
                case 'avaliable':
                    if($data['order'] == 'asc')
                        usort($ob_res, 'sortByAvaliableAsc');
                    if($data['order'] == 'desc')
                        usort($ob_res, 'sortByAvaliableDesc');
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        $ob_res = array_chunk($ob_res, 8);

        echo json_encode($ob_res);
    }
}

function sortByDate($a, $b) {
    if ($a['CREATED_DATE'] > $b['CREATED_DATE']) {
        return 1;
    } elseif ($a['CREATED_DATE'] < $b['CREATED_DATE']) {
        return -1;
    }
    return 0;
}
function sortByPriceAsc($a, $b) {
    if ($a['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'] > $b['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE']) {
        return 1;
    } elseif ($a['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'] < $b['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE']) {
        return -1;
    }
    return 0;
}
function sortByPriceDesc($a, $b) {
    if ($a['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'] > $b['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE']) {
        return -1;
    } elseif ($a['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE'] < $b['PRICE']['RESULT_PRICE']['DISCOUNT_PRICE']) {
        return 1;
    }
    return 0;
}
function sortByAvaliableAsc($a, $b) {
    if ($a['QUANTITY']['QUANTITY'] > $b['QUANTITY']['QUANTITY']) {
        return -1;
    } elseif ($a['QUANTITY']['QUANTITY'] < $b['QUANTITY']['QUANTITY']) {
        return 1;
    }
    return 0;
}
function sortByAvaliableDesc($a, $b) {
    if ($a['QUANTITY']['QUANTITY'] > $b['QUANTITY']['QUANTITY']) {
        return 1;
    } elseif ($a['QUANTITY']['QUANTITY'] < $b['QUANTITY']['QUANTITY']) {
        return -1;
    }
    return 0;
}

$action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';

$answer = json_decode(file_get_contents('php://input'), true);
header('Content-type: application/json');
// Выполняем метод класса
new FavoritesController($action, $answer);
