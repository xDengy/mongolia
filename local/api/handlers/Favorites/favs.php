<?php

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

    public function prepareHighLoad()
    {
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(6)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entityDataClass = $entity->getDataClass();   
        return $entityDataClass;     
    }

    // Проверить наличие товара в избранном
    public function inFavs($data) {
        $entityDataClass = self::prepareHighLoad();

        $res = $entityDataClass::getList(array(
            "select" => array("*"),
            'filter' => ['UF_NAME' => $data['userId']]
        ));
        while($elem = $res->Fetch()) {
            $ob_res[$elem['UF_XML_ID']] = $elem;
        }

        echo json_encode($ob_res);
    }

    // Добавить в избранное
    public function setFavs($data) {
        $entityDataClass = self::prepareHighLoad();

        if($data['checked'] == true || $data['checked'] == 1) {
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
        $entityDataClass = self::prepareHighLoad();

        $prods = $entityDataClass::getList(array(
            "select" => array("*"),
            'filter' => ['UF_NAME' => $data['userId']]
        ));
        $ob_res = [];
        while ($prod = $prods->Fetch()) {
            $el_res = CIBlockElement::getById($prod['UF_XML_ID'])->GetNextElement();
            $elementFields = $el_res->GetFields();
            $elProps = $el_res->GetProperties();

            $sku_res = CCatalogSKU::GetProductInfo($elementFields['ID'], $elementFields['IBLOCK_ID']);
            if(!empty($sku_res)) {
                $product = new \Simba\Catalog\Product($elementFields['ID']);
                $quantity = $product->getQuantity();
                $price = CCatalogProduct::GetOptimalPrice($elementFields['ID']);
                    
                $par_res = CIBlockElement::getById($sku_res['ID'])->GetNextElement();
                $parFields = $par_res->GetFields();
                $parProps = $par_res->GetProperties();
                
                $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(10)->fetch();
                $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
                $entityDataClass = $entity->getDataClass();

                $ob_size = $entityDataClass::getList(array(
                    "select" => array("*"),
                    'filter' => ['UF_XML_ID' => $elProps['RAZMER_OBSHCHIY']['VALUE']]
                ))->Fetch();

                $elementFields['NAME'] = $parFields['NAME'] . ' Размер: ' . $ob_size['UF_NAME'];

                $elementFields['PREVIEW_PICTURE'] = $parFields['PREVIEW_PICTURE'];
                $elProps['NOVINKA'] = $parProps['NOVINKA'];
            } else {
                $product = new \Simba\Catalog\Product($prod['UF_XML_ID']);
                $quantity = $product->getQuantity();
                $price = CCatalogProduct::GetOptimalPrice($prod['UF_XML_ID']);
            }

            $price['FORMATED_PRICE'] = number_format($price['RESULT_PRICE']['BASE_PRICE'], 0, '', ' ');
            $price['FORMATED_DISCOUNT_PRICE'] = number_format($price['RESULT_PRICE']['DISCOUNT_PRICE'], 0, '', ' ');
            $price['FORMATED_DISCOUNT_DIFF'] = number_format($price['RESULT_PRICE']['DISCOUNT'], 0, '', ' ');
            $price['DISCOUNT_DIFF'] = round(($price['RESULT_PRICE']['DISCOUNT_PRICE'] * 100) / $price['RESULT_PRICE']['BASE_PRICE']) - 100;

            $elementFields['PREVIEW_PICTURE'] = CFile::GetFileArray($elementFields['PREVIEW_PICTURE']);

            if($data['avaliable'] == true) {
                if($quantity['QUANTITY'] == 0)
                    continue;
            }

            $ob_res[$prod['UF_XML_ID']] = array_merge(
                $elementFields,
                [
                    'PROPERTIES' => $elProps,
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

        $res['favorites'] = $ob_res;
        $res['chunks'] = array_chunk($ob_res, 8);

        echo json_encode($res);
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
