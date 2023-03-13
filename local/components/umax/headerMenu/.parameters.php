<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arMenu = GetMenuTypes($site);

$arComponentParameters = array(
	"PARAMETERS" => array(
		"SHOW_NEWS" => Array(
			"NAME"=>'Показывать страницу Новости',
			"TYPE" => "CHECKBOX",
			"DEFAULT"=>'Y',
		),
		"NEWS_NAME" => Array(
			"NAME"=>'Текст ссылки на Новости',
			"TYPE" => "STRING",
			"DEFAULT"=>'Новости',
		),
		"NEWS_LINK" => Array(
			"NAME"=>'Ссылка на Новости',
			"TYPE" => "STRING",
			"DEFAULT"=>'/news/',
		),
		"SHOW_CONTACT" => Array(
			"NAME"=>'Показывать страницу Контакты',
			"TYPE" => "CHECKBOX",
			"DEFAULT"=>'Y',
		),
		"CONTACT_NAME" => Array(
			"NAME"=>'Текст ссылки на Контакты',
			"TYPE" => "STRING",
			"DEFAULT"=>'Контакты',
		),
		"CONTACT_LINK" => Array(
			"NAME"=>'Ссылка на Контакты',
			"TYPE" => "STRING",
			"DEFAULT"=>'/contacts/',
		),
		"PHONE" => Array(
			"NAME"=>'Номер телефона',
			"TYPE" => "STRING",
		),
		"EMAIL" => Array(
			"NAME"=>'Электронная почта',
			"TYPE" => "STRING",
		),
		"ADDRESS" => Array(
			"NAME"=>'Адрес',
			"TYPE" => "STRING",
		),
		"WHATSAPP" => Array(
			"NAME"=>'WhatsApp',
			"TYPE" => "STRING",
		),
		"TELEGRAM" => Array(
			"NAME"=>'Telegram',
			"TYPE" => "STRING",
		),
	)
);
?>
