<?php

IncludeModuleLangFile(__FILE__);
if ($APPLICATION->GetGroupRight("dolyame.payment") != "D") {
		$aMenu = [
			"parent_menu" => "global_menu_store",
			"section"     => "dolyame_payment",
			"sort"        => 100,
			"text"        => GetMessage("DOLYAME.PAYMENT_MENU_TITLE"),
			"title"       => GetMessage("DOLYAME.PAYMENT_MENU_TITLE"),
			"icon"        => "dolyame_payment_menu_icon",
			"page_icon"   => "dolyame_payment_menu_icon",
			"items_id"    => "menu_dolyame_payment",
			"url"         => "dolyame_payment.php?lang=" . LANGUAGE_ID,
		];
		return $aMenu;
}

return false;
