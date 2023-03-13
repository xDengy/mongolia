<?php
/**
 * Created by PhpStorm.
 * User: Maxim Masalov
 * Date: 15.12.2017
 * Time: 18:41
 * Project: dev.green-spark.ru
 */

namespace Simba\Catalog;

/**
 * Базовый класс для работы с цеными
 */
abstract class Prices
{

    /** @var int Идентификатор типа цены */
    public $price_type_id = 0;

    /** @var int Базовый тип цены без учета */
    public $base_price = 0;

    /** @var int Размер скидки на товар */
    public $discount = 0;

    /** @var float Процент скидки */
    public $discount_percent = 0;


    public function __construct()
    {
        $this->getPriceType();
    }


    /**
     * Метод возвращает тип цены
     */
    public function getPriceType()
    {
        $this->price_type_id = config('price_type_id');
    }


    /**
     * Форматирование цен
     *
     * @param float $price
     * @return bool|mixed|string|string[]|null
     */
    public function format(float $price)
    {
        return \CCurrencyLang::CurrencyFormat($price, 'RUB');
    }


    /**
     * Насоедник должен реализовать получение типа цены из массива
     *
     * @param array $prices
     * @return mixed
     */
    abstract public function getFromArray(array $prices);


    /**
     * Получение цены по id товара
     *
     * @param int $product_id
     */
    public function getByProduct(int $product_id)
    {
        // TODO: Реализовать метод для получения цены по id товара
    }


    /**
     * Получение цены товара
     *
     * @param int $product_id - идентификатор товара
     * @param array $price_array - массив цен если они уже есть
     * @return array
     */
    public function getPrices(int $product_id, array $price_array = []): array
    {
        if (!empty($price_array)) {
            $this->getFromArray($price_array);
        }

        if (empty($this->getPrice())) {
            $this->getByProduct($product_id);
        }

        return $this->preparePriceArray();
    }


    /**
     * Сбор итогового массива с ценами
     *
     * @return array
     */
    public function preparePriceArray(): array
    {
        $prices = [
            'price' => $this->getPrice(),
            'formatted_price' => $this->format($this->base_price),
            'discount_price' => $this->getDiscountPrice(),
            'formatted_discount_price' => $this->format($this->getDiscountPrice()),
            'discount_percent' => $this->getDiscountPercent(),
            'discount_value' => $this->getDiscount(),
            'formatted_discount_value' => $this->format($this->getDiscount()),
        ];

        return $prices;
    }


    /**
     * Цена без учета скидок
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->base_price;
    }


    /**
     * Цена с учетом скидок
     *
     * @return float
     */
    public function getDiscountPrice(): float
    {
        return $this->base_price - $this->discount;
    }


    /**
     * Размер скидки
     *
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }


    /**
     * Размер скидки в процентах
     *
     * @return float
     */
    public function getDiscountPercent(): float
    {
        return $this->discount_percent;
    }


}