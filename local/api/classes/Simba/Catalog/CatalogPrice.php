<?php
/**
 * Created by PhpStorm.
 * User: maksim
 * Date: 2019-08-02
 * Time: 16:03
 */

namespace Simba\Catalog;


/**
 * Class CatalogPrice - Используется для работы в компоненте catalog.section и других с похожей структурой вывода цен
 *
 * @package Simba\Catalog
 */
class CatalogPrice extends Prices
{


    /**
     * Получаем цены из массива каталога
     *
     * @param array $prices
     */
    public function getFromArray(array $prices)
    {
        $price_id = $this->price_type_id;

        // Получаем только нужный нам тип цены
        $price = array_filter($prices, function ($price) use ($price_id) {
            return ($price['PRICE_TYPE_ID'] == $price_id);
        });

        // Т.к. пока это единственный тип цены, то он будет один в массиве
        if (!empty($price)) {
            $price = $price[array_key_first($price)];

            $this->base_price = $price['BASE_PRICE'] ?? 0;
            $this->discount = $price['DISCOUNT'] ?? 0;
            $this->discount_percent = $price['PERCENT'] ?? 0;

        }

    }


}