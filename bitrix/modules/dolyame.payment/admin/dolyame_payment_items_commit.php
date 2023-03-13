<?
use Bitrix\Main;
use \Bitrix\Main\Localization\Loc;

define("STOP_STATISTICS", true);
define("BX_SECURITY_SHOW_MESSAGE", true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

$saleModulePermissions = $APPLICATION->GetGroupRight("dolyame.payment");
if ($saleModulePermissions == "D") {
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}

CModule::IncludeModule("dolyame.payment");
$orderNumber = $_GET['order_number'];
$items = CDolyamePayment::getOrderItems($orderNumber);
if (!$items) {
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
	ShowError(GetMessage("DOLYAME.PAYMENT_ORDER_NOT_FOUND"));
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
	die();
}
$transaction = CDolyamePayment::getTransactionList(['id' => $orderNumber])->fetch();
$prepaidSum = CDolyamePayment::calcPrepaidAmount($transaction['amount'], $items);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<form method="POST" id="dolyame_payment_return_form" action="">
<?=bitrix_sessid_post()?>
<div class="adm-detail-title-view-tab"><?=Loc::getMessage('DOLYAME.PAYMENT_SELECT_COMMIT_POSITION')?></div>
<div class="adm-list-table-wrap adm-list-table-without-header adm-list-table-without-footer">
<table class="adm-list-table">
	<thead>
		<tr class="adm-list-table-header">
			<td class="adm-list-table-cell"></td>
			<td class="adm-list-table-cell"><div class="adm-list-table-cell-inner">
				<strong><?=Loc::getMessage('DOLYAME.PAYMENT_COMMIT_POSITION_NAME')?></strong>
			</div></td>
			<td class="adm-list-table-cell"><div class="adm-list-table-cell-inner">
				<strong><?=Loc::getMessage('DOLYAME.PAYMENT_COMMIT_POSITION_QUANTITY')?></strong>
			</div></td>
			<td class="adm-list-table-cell"><div class="adm-list-table-cell-inner">
				<strong><?=Loc::getMessage('DOLYAME.PAYMENT_COMMIT_POSITION_PRICE')?></strong>
			</div></td>
		</tr>
	</thead>
	<tbody>
	<?
	foreach($items as $id => $item):?>
		<tr class="adm-list-table-row">
			<td class="adm-list-table-cell">
				<input class="dolyame_payment_return_position" id="dolyame_payment_return_position_<?=$id?>" type="checkbox" name="position[]" value="<?=$id?>" checked>
			</td>
			<td class="adm-list-table-cell">
				<input size="50" type="hidden" name="name[<?=$id?>]" value="<?=htmlspecialcharsbx($item['name'])?>">
				<label for="dolyame_payment_return_position_<?=$id?>"><?=htmlspecialcharsbx($item['name'])?></label>
			</td>
			<td class="adm-list-table-cell">
				<input size="7" id="dolyame_payment_return_quantity_<?=$id?>" class="dolyame_payment_return_quantity" type="text" name="quantity[<?=$id?>]" value="<?=htmlspecialcharsbx($item['quantity'])?>">
			</td>
			<td class="adm-list-table-cell adm-list-table-cell-last" align="right">
				<input size="7" id="dolyame_payment_return_price_<?=$id?>" class="dolyame_payment_return_price" type="text" name="price[<?=$id?>]" value="<?=htmlspecialcharsbx($item['price'])?>">
				<input type="hidden" name="sku[<?=$id?>]" value="<?=htmlspecialcharsbx(@$item['sku'])?>">
				<input type="hidden" name="receipt[<?=$id?>]" value="<?=htmlspecialcharsbx(empty($item['receipt'])?'':Main\Web\Json::encode($item['receipt'], JSON_UNESCAPED_UNICODE))?>">
			</td>
		</tr>
	<?endforeach;?>
	<tr class="adm-list-table-row">
		<td class="adm-list-table-cell" colspan="3"><?=Loc::getMessage('DOLYAME.PAYMENT_PREPAID_SUM')?></td>
		<td class="adm-list-table-cell adm-list-table-cell-last"><input size="7" id="refunded_prepaid_amount" type="text" name="refunded_prepaid_amount" value="<?=htmlspecialcharsbx($prepaidSum)?>"></td>
	</tr>
	<tr class="adm-list-table-row">
		<td class="adm-list-table-cell" colspan="3"><?=Loc::getMessage('DOLYAME.PAYMENT_COMMIT_SUM')?></td>
		<td class="adm-list-table-cell adm-list-table-cell-last" align="right" id="dolyame_payment_return_sum">0</td>
	</tr>
	</tbody>
</table>
</div>
<input type="hidden" name="action" value="commit">
<input type="hidden" name="id" value="<?=htmlspecialcharsbx($orderNumber);?>">
</form>
<script>
BX.ready(function(){
	dolyamePaymentUpdateTotal();
	document.querySelectorAll('.dolyame_payment_return_position').forEach(function(el){
		BX.bind(el, 'change', dolyamePaymentUpdateTotal);
	});
	document.querySelectorAll('.dolyame_payment_return_quantity').forEach(function(el){
		BX.bind(el, 'keyup', dolyamePaymentUpdateTotal);
	});
	document.querySelectorAll('.dolyame_payment_return_price').forEach(function(el){
		BX.bind(el, 'keyup', dolyamePaymentUpdateTotal);
	});
	document.querySelectorAll('#refunded_prepaid_amount').forEach(function(el){
		BX.bind(el, 'keyup', dolyamePaymentUpdateTotal);
	});
});
</script>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");