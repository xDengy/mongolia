<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arMenu = GetMenuTypes($site);

$arComponentParameters = array(
	"PARAMETERS" => array(
		"FORM_LABEL" => Array(
			"NAME"=>'Заголовок формы',
			"TYPE" => "STRING",
			"DEFAULT"=>'Будьте всегда в курсе событий!',
		),
		"FORM_DESC" => Array(
			"NAME"=>'Текст формы',
			"TYPE" => "STRING",
		),
		"POLICY_LINK" => Array(
			"NAME"=>'Ссылка на Политику конфиденциальности',
			"TYPE" => "STRING",
			"DEFAULT"=>'/policy/',
		),
	)
);
?>
