function showDolyameReturnForm(order_number) {
	new BX.CAdminDialog({
		content_url: "/bitrix/admin/dolyame_payment_items.php?bxpublic=Y&lang=" + BX.message('LANGUAGE_ID') + "&order_number=" + order_number + "&sessid=" + BX.bitrix_sessid(),
		width: "920",
		height: "400",
		buttons: [
			new BX.CWindowButton({
				title: BX.message('DOLYAME.PAYMENT_JS_REFUND'),
				name: "refund",
				id: "refund_form",
				action: refundDolyameOrder,
			}),
			BX.CAdminDialog.btnCancel,
		],
	}).Show();
}

function showDolyameCommitForm(order_number) {
	new BX.CAdminDialog({
		content_url: "/bitrix/admin/dolyame_payment_items_commit.php?bxpublic=Y&lang=" + BX.message('LANGUAGE_ID') + "&order_number=" + order_number + "&sessid=" + BX.bitrix_sessid(),
		width: "920",
		height: "400",
		buttons: [
			new BX.CWindowButton({
				title: BX.message('DOLYAME.PAYMENT_JS_COMMIT'),
				name: "commit",
				id: "commit_form",
				action: commitDolyameOrder,
			}),
			BX.CAdminDialog.btnCancel,
		],
	}).Show();
}

function refundDolyameOrder()
{
	BX('dolyame_payment_return_form').submit();
}

function commitDolyameOrder()
{
	BX('dolyame_payment_return_form').submit();
}

function dolyamePaymentUpdateTotal()
{
	var sum = 0;
	document.querySelectorAll('.dolyame_payment_return_position:checked').forEach(function(el){
		sum += BX('dolyame_payment_return_quantity_' + el.value).value * BX('dolyame_payment_return_price_' + el.value).value
	});
	sum -= BX('refunded_prepaid_amount').value;
	BX('dolyame_payment_return_sum').innerHTML = sum.toFixed(2);
}