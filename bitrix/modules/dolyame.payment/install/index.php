<?php

IncludeModuleLangFile(__FILE__);

class dolyame_payment extends CModule
{
	const MODULE_ID = 'dolyame.payment';
	public $MODULE_ID = 'dolyame.payment';
	public $MODULE_VERSION;
	public $MODULE_VERSION_DATE;
	public $MODULE_NAME;
	public $MODULE_DESCRIPTION;

	public $strError = '';

	public function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__) . "/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("DOLYAME.PAYMENT_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("DOLYAME.PAYMENT_MODULE_DESC");
		$this->PARTNER_NAME = GetMessage("DOLYAME.PAYMENT_PARTNER_NAME");
		$this->PARTNER_URI = "https://dolyame.ru/";
	}


	public function InstallFiles()
	{
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/sale_payment/dolyame/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/sale_payment/dolyame/", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/tools/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/");
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin/");
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/js/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/images/dolyame.png", $_SERVER["DOCUMENT_ROOT"]."/bitrix/images/sale/sale_payments/dolyame.png");
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/themes/.default", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default", true, true);
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/tools/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/");
		return true;
	}

	public function UnInstallFiles()
	{
		DeleteDirFilesEx("/bitrix/php_interface/include/sale_payment/dolyame");
		DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/themes/.default", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default");
		DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/tools/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/");
		DeleteDirFilesEx("/bitrix/js/dolyame.payment/");
		DeleteDirFilesEx("/bitrix/images/sale/sale_payments/dolyame.png");
		DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/tools/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/");
		return true;
	}

	public function DoInstall()
	{
		$this->InstallFiles();
		RegisterModule(self::MODULE_ID);
		$this->InstallDB();
	}

	public function DoUninstall()
	{
		global $APPLICATION, $DB;

		UnRegisterModule(self::MODULE_ID);
		$this->UnInstallFiles();
		$this->UnInstallDB();
	}

	function InstallDB()
	{
		global $DB, $DBType, $APPLICATION;
		if(!$DB->Query("SELECT 'x' FROM dolyame_payment WHERE 1=0", true)){
            $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/dolyame.payment/install/db/".$DBType."/install.sql");
        }
		return true;
	}

	function UnInstallDB($arParams = array())
	{
		global $DB, $DBType, $APPLICATION;
		$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/dolyame.payment/install/db/".$DBType."/uninstall.sql");
		return true;
	}
}


