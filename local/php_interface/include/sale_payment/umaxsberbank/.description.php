<?php
use Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Sale\PaySystem;

Loc::loadMessages(__FILE__);

$isAvailable = PaySystem\Manager::HANDLER_AVAILABLE_TRUE;

//$licensePrefix = Loader::includeModule('bitrix24') ? \CBitrix24::getLicensePrefix() : '';
//$portalZone = Loader::includeModule('intranet') ? CIntranetUtils::getPortalZone() : '';
//
//if (Loader::includeModule('bitrix24'))
//{
//    if ($licensePrefix !== 'ru')
//    {
//        $isAvailable = PaySystem\Manager::HANDLER_AVAILABLE_FALSE;
//    }
//}
//elseif (Loader::includeModule('intranet') && $portalZone !== 'ru')
//{
//    $isAvailable = PaySystem\Manager::HANDLER_AVAILABLE_FALSE;
//}

$data = [
    'NAME' => 'Оплата сбербанк [UMAX]',
    'SORT' => 500,
    'IS_AVAILABLE' => $isAvailable,
    'CODES' => [
//        'SBERBANK_LOGIN' => [
//            'NAME' => 'Логин API Сбербанка',
//            'DESCRIPTION' => 'Логин API Сбербанка',
//            'SORT' => 100,
//            'GROUP' => 'CONNECT_SETTINGS_SBERBANK',
//            'INPUT' => [
//                'TYPE' => 'STRING'
//            ],
//        ],
//        'SBERBANK_PASSWORD' => [
//            'NAME' => 'Пароль API Сбербанка',
//            'DESCRIPTION' => 'Пароль API Сбербанка',
//            'SORT' => 200,
//            'GROUP' => 'CONNECT_SETTINGS_SBERBANK',
//            'INPUT' => [
//                'TYPE' => 'STRING'
//            ],
//        ],
//        'SBERBANK_SECRET_KEY' => [
//            'NAME' => Loc::getMessage('SALE_HPS_SBERBANK_SECRET_KEY'),
//            'DESCRIPTION' => Loc::getMessage('SALE_HPS_SBERBANK_SECRET_KEY_DESC'),
//            'SORT' => 300,
//            'GROUP' => 'CONNECT_SETTINGS_SBERBANK'
//        ],
//        'SBERBANK_RETURN_SUCCESS_URL' => [
//            'NAME' => 'URL успешной оплаты',
//            'DESCRIPTION' => 'URL, на который будет переадресован клиент после успешной оплаты заказа',
//            'SORT' => 400,
//            'GROUP' => 'CONNECT_SETTINGS_SBERBANK',
//            'INPUT' => [
//                'TYPE' => 'STRING'
//            ],
//        ],
//        'SBERBANK_RETURN_FAIL_URL' => [
//            'NAME' => 'URL неудачной оплаты',
//            'DESCRIPTION' => 'URL, на который будет переадресован клиент после неудачной оплаты заказа',
//            'SORT' => 500,
//            'GROUP' => 'CONNECT_SETTINGS_SBERBANK',
//            'INPUT' => [
//                'TYPE' => 'STRING'
//            ],
//        ],
//        'SBERBANK_ORDER_DESCRIPTION' => [
//            'NAME' => Loc::getMessage('SALE_HPS_SBERBANK_ORDER_DESCRIPTION'),
//            'DESCRIPTION' => Loc::getMessage('SALE_HPS_SBERBANK_ORDER_DESCRIPTION_DESC'),
//            'SORT' => 600,
//            'GROUP' => 'CONNECT_SETTINGS_SBERBANK',
//            'DEFAULT' => [
//                'PROVIDER_KEY' => 'VALUE',
//                'PROVIDER_VALUE' => Loc::getMessage('SALE_HPS_SBERBANK_ORDER_DESCRIPTION_TEMPLATE'),
//            ]
//        ],
//        'SBERBANK_TEST_MODE' => [
//            'NAME' => 'Тестовый режим',
//            'DESCRIPTION' => 'Описание поля',
//            'SORT' => 700,
//            'GROUP' => 'CONNECT_SETTINGS_SBERBANK',
//            'INPUT' => [
//                'TYPE' => 'Y/N'
//            ],
//            'DEFAULT' => [
//                'PROVIDER_KEY' => 'INPUT',
//                'PROVIDER_VALUE' => 'N',
//            ]
//        ],
        'PS_CHANGE_STATUS_PAY' => [
            'NAME' => 'Смена статуса',
            'SORT' => 800,
            'GROUP' => 'GENERAL_SETTINGS',
            'INPUT' => [
                'TYPE' => 'Y/N'
            ],
            'DEFAULT' => [
                'PROVIDER_KEY' => 'INPUT',
                'PROVIDER_VALUE' => 'Y',
            ]
        ],
    ]
];
