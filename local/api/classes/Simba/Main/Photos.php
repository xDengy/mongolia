<?php
/**
 * Created by PhpStorm.
 * User: maksim
 * Date: 2019-08-01
 * Time: 13:40
 */

namespace Simba\Main;


class Photos
{

    public $photos = [];

    public $sizes = [];

    public function __construct()
    {
    }


    /**
     * Изменяем размеры изображений
     *
     * @param array $photo_ids
     * @return array
     */
    public function resizeProductPhotos(array $photo_ids): array
    {

        if (empty($this->sizes)) {
            $this->getSizes();
        }

        $sizes = $this->sizes;

        if (!empty($photo_ids) && !empty($sizes)) {

            foreach ($photo_ids as $id) {

                $photos = [];

                // Изменяем размеры картинок
                foreach ($sizes as $size_name => $size) {
                    $photos[$size_name] = \CFile::ResizeImageGet(
                        $id,
                        $size['size'],
                        $size['resize_type'] ?? BX_RESIZE_IMAGE_PROPORTIONAL,
                        true,
                        $size['watermark'] ?? false
                    );
                }

                $this->photos[] = $photos;
            }

        }

        // Если фотографий нет, отдаем заглушки
        if (empty($this->photos) && !empty($sizes)) {
            $photos = [];
            foreach ($sizes as $size_name => $size) {
                $photos[$size_name] = config('photos.no_photos.'.$size_name);
            }
            $this->photos[] = $photos;
        }

        return $this->photos;

    }


    /**
     * Получем размеры фотографий
     *
     * @param array $only_sizes
     */
    public function getSizes(array $only_sizes = [])
    {
        $sizes = config('photos.sizes');

//        p($sizes);
//        exit();

        $sizes = array_filter($sizes, function ($k) use ($only_sizes) {
            return in_array($k, $only_sizes);
        }, ARRAY_FILTER_USE_KEY);

        $this->sizes = $sizes;

    }


}
