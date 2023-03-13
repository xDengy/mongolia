<?php
/**
 * Created by PhpStorm.
 * User: maksim
 * Date: 2019-08-01
 * Time: 11:51
 */

namespace Simba\Catalog;

use Adbar\Dot;
use Simba\Main\Photos;

class Product
{


    public $id = 0;

    /**
     * @var array - Идентификаторы фотографий
     */
    public $photo_ids = [];

    /**
     * @var array|Photos
     */
    public $photos = [];

    /**
     * @var array|Prices
     */
    public $prices = [];


    /**
     * @var array Массив фотогрфий
     */
    public $photo_arr = [];

    /**
     * @var Dot|array
     */
    public $product = [];


    public function __construct($product_array)
    {
        $this->photos = new Photos();
        $this->prices = new CatalogPrice();

        if (is_array($product_array)) {
            $this->product = new Dot($product_array ?? []);
            $this->id = $this->product->get('ID', 0);
        } else {
            $this->product = new Dot([]);
            $this->id = intval($product_array);
        }

    }


    /**
     * Загрузка данных элемента
     */
    public function load()
    {
        if (!empty($this->id)) {
            $filter = [
                'IBLOCK_ID' => config('iblocks.catalog'),
                'ID' => $this->id,
            ];

            $res_element = \CIBlockElement::GetList([], $filter);

            $product_array = [];
            if ($arr_element = $res_element->GetNextElement()) {
                $product_array = $arr_element->GetFields();
                $product_array['PROPERTIES'] = $arr_element->GetProperties();
            }

            $this->product = new Dot($product_array ?? []);
        }
    }


    /**
     * Метод для загрузки параметров товара
     */
    private function loadProduct()
    {
        if (!empty($this->id)) {
            $res = \Bitrix\Catalog\Model\Product::getList([
                'filter' => [
                    '=ID' => $this->id,
                ],
            ]);
            $arr_product = $res->fetch();

            if (!empty($arr_product)) {
                $this->product->set('PRODUCT', $arr_product);
            }
        }
    }


    /**
     * Сбор и ресайз фотографий
     *
     * @param bool $detail - Получить только детальное фото
     * @param array $sizes - Размеры, которые необходимо получить (ключи из конфига)
     * @return array
     */
    public function getPhotos(bool $detail = null, array $sizes = []): array
    {
        // Получаем идентификаторы фотографий
        $this->getPhotosIds($detail);

        // Задаем размеры
        $this->photos->getSizes($sizes);

        // Выполняем обработку
        $this->photo_arr = $this->photos->resizeProductPhotos($this->photo_ids);

        return $detail ? $this->photo_arr[0] ?? [] : $this->photo_arr;
    }


    /**
     * Собираем идентификаторы детального и дополнительных изображений
     *
     * @param bool $only_detail
     */
    private function getPhotosIds(bool $only_detail = null)
    {

        // Если нет картинок, пытаемся получить
        if ($this->product->isEmpty('PROPERTIES') && $this->product->isEmpty('DETAIL_PICTURE')) {
            $this->load();
        }

        $detail_picture = $this->product->get('DETAIL_PICTURE');
        if (!empty($detail_picture)) {
            $this->photo_ids[] = $detail_picture;
        }

        if (!$only_detail) {
            $more_photo = $this->product->get('PROPERTIES.MORE_PHOTO.VALUE');
            if (!empty($more_photo) && is_array($more_photo)) {
                $this->photo_ids = array_merge($this->photo_ids, $more_photo);
            } elseif (intval($more_photo) > 0) {
                $this->photo_ids[] = $more_photo;
            }
        }

    }


    /**
     * Получение цен на товар
     *
     * @return array
     */
    public function getPrices()
    {
        $price_array = $this->product->get('ITEM_PRICES', []);
        $product_id = $this->product->get('ID');

        $price = $this->prices->getPrices($product_id, $price_array);

        return $price;
    }


    /**
     * Метод получает количество товара на складе
     *
     * @return mixed
     */
    public function getQuantity()
    {
        // Если параметры товара не найдены, пытаемся получить
        if ($this->product->isEmpty('PRODUCT')) {
            $this->loadProduct();
        }

        $default_params = [
            'QUANTITY' => 0,
            'AVAILABLE' => 'N',
            'MEASURE' => 0,
            'ERROR' => 'Параметры товара получить не удалось!',
        ];

        return $this->product->get('PRODUCT', $default_params);
    }


    /**
     * Метод получает бэйджи товара
     *
     * @return array
     */
    public function getBadges()
    {
        $conf_badges = \config('catalog.badges');

        // Если свойств, считаем что товар не загружен
        if ($this->product->isEmpty('PROPERTIES')) {
            $this->load();
        }

        $badges = [];
        foreach ($conf_badges as $badge) {
            $prop_value = $this->product->get('PROPERTIES.'.$badge['property_code'].'.VALUE');
            if (!empty($prop_value)) {
                $badges[] = $badge;
            }
        }

        return $badges;
    }


    /**
     * Метод получает массив тегов товара
     *
     * @return array
     */
    public function getTagsArray()
    {
        $tags = $this->product->get('TAGS');

        $tags_array = [];

        if (!empty($tags)) {
            $arr = explode(',', $tags);
            $tags_array = array_map('trim', $arr);
            $tags_array = array_map('htmlspecialchars', $tags_array);
        }

        return $tags_array;
    }


}