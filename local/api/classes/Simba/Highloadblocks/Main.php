<?php

namespace Simba\Highloadblocks;

use Bitrix\Main\Loader;

class Main {

    public static function getAllCollection($hlbl)
    {
        if (!$hlbl) return null;

        Loader::includeModule("highloadblock");
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($hlbl)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array("")
        ));
        $collectionArr = array();
        while ($collectionXMLId = $rsData->Fetch()) {
            $collectionArr[] = $collectionXMLId;
        };

        return $collectionArr;
    }

    public static function getFiltredCollection($hlbl, $filter_arr) {
        if (!$hlbl || !$filter_arr) return null;

        Loader::includeModule("highloadblock");
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($hlbl)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => $filter_arr
        ));
        $collectionArr = array();
        while ($collectionXMLId = $rsData->Fetch()) {
            $collectionArr[] = $collectionXMLId;
        };

        return $collectionArr;
    }

}