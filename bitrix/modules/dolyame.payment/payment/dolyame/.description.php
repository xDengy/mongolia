<?php
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$proto   = $request->isHttps() ? 'https' : 'http';

$data = [
	'NAME'  => Loc::getMessage('DOLYAME.PAYMENT_PAYMENT_TITLE'),
	'SORT'  => 500,
	'CODES' => [
		'ORDER_NUMBER'  => [
			'NAME'    => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_ORDER_NUMBER'),
			'SORT'    => 100,
			'DEFAULT' => [
				'PROVIDER_VALUE' => 'ACCOUNT_NUMBER',
				'PROVIDER_KEY'   => 'ORDER',
			],
		],
		'SHOP_NAME'     => [
			'NAME' => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_SHOP_NAME'),
			'SORT' => 200,
		],
		'SHOP_PASSWORD' => [
			'NAME' => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_SHOP_PASSWORD'),
			'SORT' => 300,
		],
		'CERT_PATH'     => [
			'NAME' => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_CERT_PATH'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_CERT_PATH_DESC"),
			'SORT' => 400,
		],
		'KEY_PATH'      => [
			'NAME' => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_KEY_PATH'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_KEY_PATH_DESC"),
			'SORT' => 430,
		],
		'SUCCESS_URL'   => [
			'NAME'        => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_SUCCESS_URL'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_SUCCESS_URL_DESC"),
			'SORT'        => 500,
			'DEFAULT'     => [
				'PROVIDER_KEY'   => 'VALUE',
				'PROVIDER_VALUE' => $proto . '://' . $request->getHttpHost() . '/bitrix/tools/sale_ps_success.php',
			],
		],
		'FAIL_URL'      => [
			'NAME'        => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_FAIL_URL'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_FAIL_URL_DESC"),
			'SORT'        => 600,
			'DEFAULT'     => [
				'PROVIDER_KEY'   => 'VALUE',
				'PROVIDER_VALUE' => $proto . '://' . $request->getHttpHost() . '/bitrix/tools/sale_ps_fail.php',
			],
		],
		'AUTO_REDIRECT' => [
			'NAME'        => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_AUTO_REDIRECT'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_AUTO_REDIRECT_DESC"),
			'SORT'        => 700,
			'INPUT'       => [
				'TYPE' => 'Y/N',
			],
			'DEFAULT'     => [
				'PROVIDER_KEY'   => 'INPUT',
				'PROVIDER_VALUE' => 'Y',
			],
		],
		'AUTO_CANCEL' => [
			'NAME'        => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_AUTO_CANCEL'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_AUTO_CANCEL_DESC"),
			'SORT'        => 800,
			'INPUT'       => [
				'TYPE' => 'Y/N',
			],
			'DEFAULT'     => [
				'PROVIDER_KEY'   => 'INPUT',
				'PROVIDER_VALUE' => 'N',
			],
		],
		'AUTO_COMMIT' => [
			'NAME'        => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_AUTO_COMMIT'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_AUTO_COMMIT_DESC"),
			'SORT'        => 700,
			'INPUT'       => [
				'TYPE' => 'Y/N',
			],
			'DEFAULT'     => [
				'PROVIDER_KEY'   => 'INPUT',
				'PROVIDER_VALUE' => 'Y',
			],
		],
		'FISCALISATION' => [
			'NAME'        => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_FISCALISATION'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_FISCALISATION_DESC"),
			'GROUP'       => Loc::getMessage("DOLYAME.PAYMENT_GROUP_FISCALISATION"),
			'SORT'        => 900,
			'INPUT'       => [
				'TYPE' => 'Y/N',
			],
			'DEFAULT'     => [
				'PROVIDER_KEY'   => 'INPUT',
				'PROVIDER_VALUE' => 'N',
			],
		],

		"PRODUCT_NDS"              => [
			"NAME"        => Loc::getMessage("DOLYAME.PAYMENT_PRODUCT_NDS"),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_PRODUCT_NDS_DESC"),
			'SORT'        => 1000,
			'GROUP'       => Loc::getMessage("DOLYAME.PAYMENT_GROUP_FISCALISATION"),
			"INPUT"       => [
				'TYPE'    => 'ENUM',
				'OPTIONS' => [
					'0' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_CATALOG"),
					'none' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_NONE"),
					'vat0' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT0"),
					'vat10' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT10"),
					'vat20' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT20"),
					'vat110' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT110"),
					'vat120' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT120"),
				],
			],
		],
		"DELIVERY_NDS"             => [
			"NAME"        => Loc::getMessage("DOLYAME.PAYMENT_DELIVERY_NDS"),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_DELIVERY_NDS_DESC"),
			'SORT'        => 1100,
			'GROUP'       => Loc::getMessage("DOLYAME.PAYMENT_GROUP_FISCALISATION"),
			"INPUT"       => [
				'TYPE'    => 'ENUM',
				'OPTIONS' => [
					'0' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_SETTINGS"),
					'none' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_NONE"),
					'vat0' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT0"),
					'vat10' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT10"),
					'vat20' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT20"),
					'vat110' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT110"),
					'vat120' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_NDS_VAT120"),
				],
			],
		],
		"PAYMENT_MODE"             => [
			"NAME"        => Loc::getMessage("DOLYAME.PAYMENT_PAYMENT_MODE"),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_PAYMENT_MODE_DESC"),
			'SORT'        => 1200,
			'GROUP'       => Loc::getMessage("DOLYAME.PAYMENT_GROUP_FISCALISATION"),
			"INPUT"       => [
				'TYPE'    => 'ENUM',
				'OPTIONS' => [
					'full_prepayment'    => Loc::getMessage("DOLYAME.PAYMENT_OPTION_MODE_FULL_PREPAYMENT"),
					'full_payment'       => Loc::getMessage("DOLYAME.PAYMENT_OPTION_MODE_FULL_PAYMENT"),
				],
			],
		],
		'FISCALISATION_FFD12' => [
			'NAME'        => Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_FISCALISATION_FFD12'),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_OPTIONS_FISCALISATION_FFD12_DESC"),
			'GROUP'       => Loc::getMessage("DOLYAME.PAYMENT_GROUP_FISCALISATION"),
			'SORT'        => 1250,
			'INPUT'       => [
				'TYPE' => 'Y/N',
			],
			'DEFAULT'     => [
				'PROVIDER_KEY'   => 'INPUT',
				'PROVIDER_VALUE' => 'N',
			],
		],
		"PAYMENT_SUBJECT"          => [
			"NAME"        => Loc::getMessage("DOLYAME.PAYMENT_PAYMENT_SUBJECT"),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_PAYMENT_SUBJECT_DESC"),
			'SORT'        => 1300,
			'GROUP'       => Loc::getMessage("DOLYAME.PAYMENT_GROUP_FISCALISATION"),
			"INPUT"       => [
				'TYPE'    => 'ENUM',
				'OPTIONS' => [
					'commodity'             => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_COMMODITY"),
					'excise'                => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_USN_EXCISE"),
					'job'                   => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_USN_INCOME_JOB"),
					'service'               => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_SERVICE"),
					'gambling_bet'          => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_GAMBLING_BET"),
					'gambling_prize'        => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_GAMBLING_PRIZE"),
					'lottery'               => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_LOTTERY"),
					'lottery_prize'         => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_LOTTERY_PRIZE"),
					'intellectual_activity' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_INTELLECTUAL_ACTIVITY"),
					'payment'               => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_PAYMENT"),
					'agent_commission'      => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_AGENT_COMMISSION"),
					'composite'             => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_COMPOSITE"),
					'another'               => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_ANOTHER"),
				],
			],
		],
		"PAYMENT_SUBJECT_DELIVERY" => [
			"NAME"        => Loc::getMessage("DOLYAME.PAYMENT_PAYMENT_SUBJECT_DELIVERY"),
			"DESCRIPTION" => Loc::getMessage("DOLYAME.PAYMENT_PAYMENT_SUBJECT_DELIVERY_DESC"),
			'SORT'        => 1400,
			'GROUP'       => Loc::getMessage("DOLYAME.PAYMENT_GROUP_FISCALISATION"),
			"INPUT"       => [
				'TYPE'    => 'ENUM',
				'OPTIONS' => [
					'commodity'             => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_COMMODITY"),
					'excise'                => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_USN_EXCISE"),
					'job'                   => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_USN_INCOME_JOB"),
					'service'               => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_SERVICE"),
					'gambling_bet'          => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_GAMBLING_BET"),
					'gambling_prize'        => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_GAMBLING_PRIZE"),
					'lottery'               => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_LOTTERY"),
					'lottery_prize'         => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_LOTTERY_PRIZE"),
					'intellectual_activity' => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_INTELLECTUAL_ACTIVITY"),
					'payment'               => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_PAYMENT"),
					'agent_commission'      => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_AGENT_COMMISSION"),
					'composite'             => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_COMPOSITE"),
					'another'               => Loc::getMessage("DOLYAME.PAYMENT_OPTION_SUBJECT_ANOTHER"),
				],
			],
		],
	],
];
