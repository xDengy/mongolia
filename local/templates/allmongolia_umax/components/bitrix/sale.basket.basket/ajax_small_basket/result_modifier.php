<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main;

$collections = [];


// Пробегаем по массиву и причёсываем его
foreach ($arResult["ITEMS"] as $parent_key=>$parent_item) {
    if(!empty($parent_item)) {
        foreach ($parent_item as $key=>$item) {

            // Получаем коллекцию
            $item['collection'] = [];
            if(!empty($item['PROPERTY_COLLECTION_VALUE'])) {
                $collection = \Simba\Catalog\CollectionsTable::getCollection($item['PROPERTY_COLLECTION_VALUE']);
                $item['collection'] = $collection;
            }

            // Обрабатываем фотографию
            $photos = new \Simba\Main\Photos();
            $photos->getSizes(['small']);
            $arr_photos = $photos->resizeProductPhotos([$item['DETAIL_PICTURE']]);

            $item['picture'] = $arr_photos[0]['small'];
            $item['SUM_PRICE'] = trim(str_replace('руб.', '', $item['SUM']));
            $item['check'] = 'no';

            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(10)->fetch();
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entityDataClass = $entity->getDataClass();

            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(8)->fetch();
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entityDataClassColor = $entity->getDataClass();

            $prodProps = CIBlockElement::GetList([], ['ID' => $item['PRODUCT_ID']], false, false, [])->GetNextElement()->GetProperties();

            $ob_size = $entityDataClass::getList(array(
                "select" => array("*"),
                'filter' => ['UF_XML_ID' => $prodProps['RAZMER_OBSHCHIY']['VALUE']]
            ))->Fetch();

            $item['RAZMER_OBSHCHIY'] = $ob_size['UF_NAME'];
            $item['CML2_ARTICLE'] = $prodProps['CML2_ARTICLE']['VALUE'];

            $item['PROPERTIES'] = $prodProps;

            if($prodProps['TSVET']['VALUE']) {
                $ob_color = $entityDataClassColor::getList(array(
                    "select" => array("*"),
                    'filter' => ['UF_XML_ID' => $prodProps['TSVET']['VALUE']]
                ))->Fetch();

                $item['TSVET'] = $ob_color['UF_NAME'];
            }

            if($prodProps['CML2_LINK']['VALUE']) {
                $ob_prod = CIBlockElement::GetList([], ['ID' => $prodProps['CML2_LINK']['VALUE']], false, false, []);
                $prop = $ob_prod->GetNextElement();
                $prodProps = $prop->GetProperties();

                $item['NAME'] = $prop->GetFields()['NAME'];

                $ob_color = $entityDataClassColor::getList(array(
                    "select" => array("*"),
                    'filter' => ['UF_XML_ID' => $prodProps['TSVET']['VALUE']]
                ))->Fetch();

                $item['TSVET'] = $ob_color['UF_NAME'];

                $ob_size = $entityDataClass::getList(array(
                    "select" => array("*"),
                    'filter' => ['UF_XML_ID' => $prodProps['RAZMER_OBSHCHIY']['VALUE']]
                ))->Fetch();

                if(!$item['RAZMER_OBSHCHIY']) {
                    $item['RAZMER_OBSHCHIY'] = $ob_size['UF_NAME'];
                }
                if(!$item['CML2_ARTICLE']) {
                    $item['CML2_ARTICLE'] = $prodProps['CML2_ARTICLE']['VALUE'];
                }

                $item['PARENT_PROPERTIES'] = $prodProps;
            }

            $arResult["ITEMS"][$parent_key][$key] = $item;
        }
    }
}

