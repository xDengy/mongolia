<?php
use \Bitrix\Sale\Order;
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sale/include.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sale/general/admin_tool.php";

IncludeModuleLangFile(__FILE__);

$saleModulePermissions = $APPLICATION->GetGroupRight("dolyame.payment");
if ($saleModulePermissions == "D") {
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}
ClearVars("l_");

CModule::IncludeModule("dolyame.payment");
CModule::IncludeModule("sale");
\CJSCore::RegisterExt('dolyame_payment', array(
	'js' => '/bitrix/js/dolyame.payment/admin/script.js',
	'lang' => '/bitrix/modules/dolyame.payment/lang/' . LANGUAGE_ID . '/admin/js/script.php',
));

\CUtil::InitJSCore(array('window','dolyame_payment'));

$arUserGroups = $USER->GetUserGroupArray();
$intUserID    = intval($USER->GetID());

$sTableID = "dolyame_payment";

$oSort  = new CAdminSorting($sTableID, "order_number", "desc");
$lAdmin = new CAdminList($sTableID, $oSort);


$action_success = false;
if (!empty($_POST) && check_bitrix_sessid()) {
	$result = CDolyamePayment::processAction($_POST);
	if (!$result->isSuccess()) {
		$lAdmin->AddUpdateError(implode(", ",$result->getErrorMessages()));
	}
}

$arFilterFields = [
	"filter_order_number",
	"filter_date"   => GetMessage("DOLYAME.PAYMENT_DATE"),
];

$lAdmin->InitFilter($arFilterFields);
$arFilter = [];
if ($filter_order_number != '') {
	$arFilter["order_number"] = $filter_order_number;
}
if (strval(trim($filter_date_from)) != '') {
	if ($arDate = ParseDateTime($filter_date_from, CSite::GetDateFormat("SHORT", SITE_ID))) {
		$arFilter["date>"] = date('Y-m-d H:i:s', mktime(0, 0, 0, $arDate["MM"], $arDate["DD"], $arDate["YYYY"]));
	} else {
		$filter_date_to = "";
	}
}

if (strval(trim($filter_date_to)) != '') {
	if ($arDate = ParseDateTime($filter_date_to, CSite::GetDateFormat("SHORT", SITE_ID))) {
		$arFilter["date<"] = date('Y-m-d H:i:s', mktime(23, 59, 59, $arDate["MM"], $arDate["DD"], $arDate["YYYY"]));
	} else {
		$filter_date_to = "";
	}
}


$arFilterFieldsTmp = [
	"filter_order_number" => GetMessage("DOLYAME.PAYMENT_ORDER_NUMBER"),
	"filter_date"         => GetMessage("DOLYAME.PAYMENT_DATE"),
];

$oFilter = new CAdminFilter(
	$sTableID . "_filter",
	$arFilterFieldsTmp
);

$arHeaders = array(
	array("id" => "order_number", "content" => GetMessage('DOLYAME.PAYMENT_ORDER_NUMBER'), "sort" => 'order_id', "default" => true),
	array("id" => "amount", "content" => GetMessage('DOLYAME.PAYMENT_ORDER_SUM'), "sort" => false, "default" => true),
	array("id" => "date", "content" => GetMessage('DOLYAME.PAYMENT_DATE'), "sort" => 'order_id', "default" => true),
	array("id" => "status", "content" => GetMessage('DOLYAME.PAYMENT_STATUS'), "sort" => false, "default" => true),
	array("id" => "ACTION", "content" => GetMessage('DOLYAME.PAYMENT_ACTION'), "sort" => false, "default" => true),
);

$lAdmin->AddHeaders($arHeaders);

//array("nPageSize"=>CAdminResult::GetNavSize($sTableID))
$arFilterOrder = array();

if(!empty($by))
{
	if(!isset($order) || !is_string($order))
		$order = "DESC";

	$arFilterOrder[$by] = $order;
}

if ($del_filter == 'Y') {
  $arFilter = [];
}

$dbOrderList = CDolyamePayment::getTransactionList($arFilter, $arFilterOrder);

$dbOrderList = new CAdminResult($dbOrderList, $sTableID);
$dbOrderList->NavStart();

$lAdmin->NavText($dbOrderList->GetNavPrint(""));

while ($arOrder = $dbOrderList->NavNext(true, "f_")) {
	$order = Order::load($arOrder['order_id']);

	$orderAr = CSaleOrder::GetByID($arOrder['order_id']);


	$row = &$lAdmin->AddRow($f_ID, $arOrder, "sale_order_view.php?ID=" . $arOrder['order_id'] . "&lang=" . LANGUAGE_ID . GetFilterParams("filter_"));

	$idTmp = '<a href="/bitrix/admin/sale_order_view.php?ID=' . $arOrder["order_id"] . '" title="' . GetMessage("DOLYAME.PAYMENT_VIEW_ORDER") . '">' . $arOrder['order_number'] . '</a>';

	$row->AddField("order_number", $idTmp);
	$status = GetMessage('DOLYAME.PAYMENT_STATUS_' . strtoupper($arOrder["status"]));
	$row->AddField("status", $status);

	$action = '';

	if (in_array($arOrder["status"], array("committed"))) {
		$action .= '
			<button class="adm-btn" type="button" value="return" onclick="showDolyameReturnForm(\''.$arOrder['id'].'\')">' . GetMessage("DOLYAME.PAYMENT_RETURN_ACTION") . '</button>';
	}
	if (in_array($arOrder["status"], array("waiting_for_commit", "wait_for_commit"))) {
		$action .= '
			<button class="adm-btn" type="button" value="return" onclick="showDolyameCommitForm(\''.$arOrder['id'].'\')">' . GetMessage("DOLYAME.PAYMENT_COMMIT_ACTION") . '</button>';
	}
	$row->AddField('ACTION', $action);

}

$lAdmin->CheckListMode();
require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sale/prolog.php";

$APPLICATION->SetTitle(GetMessage("DOLYAME.PAYMENT_TRANSACTION_TITLE"));

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php";
?>
<form name="find_form" method="GET" action="<?echo $APPLICATION->GetCurPage() ?>?">
<?
$oFilter->Begin();
?>
<tr>
	<td><?=GetMessage("DOLYAME.PAYMENT_ORDER_NUMBER")?>:</td>
	<td>
		<input type="text" name="filter_order_number" value="<?echo htmlspecialcharsbx($filter_order_number) ?>" size="40">
	</td>
</tr>
<tr>
    <td><?=GetMessage("DOLYAME.PAYMENT_DATE")?>:</td>
    <td>
        <?echo CalendarPeriod("filter_date_from", $filter_date_from, "filter_date_to", $filter_date_to, "find_form", "Y") ?>
    </td>
</tr>
<?
$oFilter->Buttons(
	array(
		"table_id" => $sTableID,
		"url"      => $APPLICATION->GetCurPage(),
		"form"     => "find_form",
	)
);
$oFilter->End();
?>
</form>
<?
$lAdmin->DisplayList();
?>
<?
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php";
?>