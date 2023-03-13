<?php
/**
 * Created by PhpStorm.
 * User: maksim
 * Date: 2019-08-13
 * Time: 15:23
 */

namespace Simba\Catalog;

use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Entity;


class CollectionsTable extends Entity\DataManager
{

    public static $collections = [];


    public static function getTableName()
    {
        return 'b_hlbd_collections';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
            ]),
            new Entity\TextField('UF_NAME'),
            new Entity\IntegerField('UF_SORT'),
            new Entity\TextField('UF_XML_ID'),
            new Entity\TextField('UF_LINK'),
            new Entity\TextField('UF_DESCRIPTION'),
            new Entity\TextField('UF_FULL_DESCRIPTION'),
            new Entity\TextField('UF_DEF'),
            new Entity\IntegerField('UF_FILE'),
        ];
    }


    /**
     * @param $xml_id
     * @return array|mixed
     */
    public static function getCollection($xml_id)
    {
        if (array_key_exists($xml_id, self::$collections)) {
            return self::$collections[$xml_id];
        }

        $params = [
            'filter' => [
                '=UF_XML_ID' => $xml_id,
            ],
        ];

        $res = CollectionsTable::getList($params);

        if ($arr = $res->fetch()) {
            self::$collections[$xml_id] = $arr;
            return $arr;
        }

        return [];
    }


}