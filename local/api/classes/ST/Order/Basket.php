<?php

namespace ST\Order;

use Bitrix\Sale\BasketItem;
use Simba\Catalog\Product;

class Basket
{
    /**
     * @param BasketItem[] $basketItems
     * @return array
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\ArgumentOutOfRangeException
     */
    public static function basketListToArray($basketItems): array
    {
        $arRes = [];
        $arMeasure = [];
        $dbMeasure = \CCatalogMeasure::getList();
        while ($obMeasure = $dbMeasure->Fetch()) {
            $arMeasure[$obMeasure['ID']] = $obMeasure;
        }
        foreach ($basketItems as $item) {
            $product = new Product(['ID' => $item->getProductId()]);
            $iProduct = \CCatalogProduct::GetByID($item->getProductId());

            $picture = $product->getPhotos(true, ['x_small']);

            $arRes[] = [
                "ID"              => $item->getId(),
                "PRODUCT_ID"      => $item->getProductId(),
                "NAME"            => $item->getField('NAME'),
                "IMAGE"           => $picture['x_small']['src'],
                "DETAIL_PAGE_URL" => $item->getField('DETAIL_PAGE_URL'),
                "PRICE"           => $item->getPrice(),
                "FULL_PRICE"      => $item->getFinalPrice(),
                "DISCOUNT_PRICE"  => $item->getDiscountPrice(),
                "BASE_PRICE"      => $item->getBasePrice(),
                "QUANTITY"        => $item->getQuantity(),
                "WEIGHT"          => (float) $item->getWeight(),
                "MEASURE"         => $arMeasure[$iProduct['MEASURE']],
            ];
        }
        return $arRes;
    }
}
