<?php
/**
 * Created by PhpStorm.
 * User: maksim
 * Date: 2019-08-01
 * Time: 13:50
 */


// Пример массива настроек размеров
/*
$sizes = [
    'sizes' => [

        // Основное фото (максимальный размер)
        'big' => [

            // Размеры
            'size' => [
                'width' => 1280,
                'height' => 1280,
            ],

            // Тип изменения размера
            'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL,

            // Водяные знаки
            'watermark' => [
                [
                    'name' => 'watermark',
                    'position' => 'center',
                    'size' => 'real',
                    'type' => 'image',
                    'alpha_level' => '100',
                    'file' => $_SERVER['DOCUMENT_ROOT'].'/local/watermarks/watermark_big.png',
                ],
            ],

        ],
    ],
];
*/


return [
    // Размеры изображений
    'sizes' => [

        // Основное фото (максимальный размер)
        'big' => [
            'size' => [
                'width' => 1500,
                'height' => 1650,
            ],
            'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL,
            'watermark' => [],
        ],

        // Изображение в слайдере на детальной
        'medium' => [
            'size' => [
                'width' => 350,
                'height' => 450,
            ],
            'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL,
            'watermark' => [],
        ],

        // Изображения в списке
        'small' => [
            'size' => [
                'width' => 102,
                'height' => 150,
            ],
            'resize_type' => BX_RESIZE_IMAGE_EXACT,
            'watermark' => [],
        ],

        // Изображение предпросмотра в слайдере на детальной
        'x_small' => [
            'size' => [
                'width' => 90,
                'height' => 60,
            ],
            'resize_type' => BX_RESIZE_IMAGE_PROPORTIONAL,
            'watermark' => [],
        ],

    ],


    // Заглушки для отсутствующих фотографий. Необходимо добавлять для всех указанных разрешений
    'no_photos' => [
        'big' => [
            'src' => '/local/templates/allmongolia_umax/assets/images/camel.jpg',
        ],
        'medium' => [
            'src' => '/local/templates/allmongolia_umax/assets/images/camel.jpg',
        ],

        'small' => [
            'src' => '/local/templates/allmongolia_umax/assets/images/camel.jpg',
        ],
        'x_small' => [
            'src' => '/local/templates/allmongolia_umax/assets/images/camel.jpg',
        ],
    ],


];
