<?
include_once dirname(__FILE__) . "/include.php";
use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

$module_id = 'dolyame.payment';
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/options.php");
IncludeModuleLangFile(__FILE__);

$app     = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

$arAllOptions = [
  ["redirect_exclude_list", Loc::getMessage("DOLYAME.PAYMENT_REDIRECT_LIMIT"), ["textarea", ""], Loc::getMessage("DOLYAME.PAYMENT_REDIRECT_LIMIT_DESC")],
  ["use_file_handler", Loc::getMessage("DOLYAME.PAYMENT_CURL"), ["list", [0 => Loc::getMessage("DOLYAME.PAYMENT_USE_CURL_OPTION"), 1 => Loc::getMessage("DOLYAME.PAYMENT_DONT_USE_CURL_OPTION")]], Loc::getMessage("DOLYAME.PAYMENT_DONT_USE_CURL_DESC")],
];

$aTabs = [
  ["DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => $module_id . "_settings", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")],
];
$tabControl = new CAdminTabControl("tabControl", $aTabs);

if ($_REQUEST['Update'] == 'Y' && $request->isPost() && check_bitrix_sessid()) {
  foreach ($arAllOptions as $arOption) {
    $name = $arOption[0];
    $val  = $request->getPost($name);
    Option::set($module_id, $name, $val);
  }
}

?><form method="post" action="<?echo $APPLICATION->GetCurPage() ?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>" enctype="multipart/form-data"><?
$tabControl->Begin();
$tabControl->BeginNextTab();?>
<?require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/admin/group_rights.php";?>
<?foreach ($arAllOptions as $arOption):
  $val  = Option::get($module_id, $arOption[0]);
  $type = $arOption[2];
  ?>
      <tr>
        <td valign="top" width="50%"><?
  echo $arOption[1]; ?><br><small><?echo $arOption[3] ?></small></td>
        <td valign="top" width="50%">
            <?if ($type[0] == "text"): ?>
              <input type="text" size="<?echo $type[1] ?>" maxlength="255" value="<?echo htmlspecialchars($val) ?>" name="<?echo htmlspecialchars($arOption[0]) ?>">
            <?elseif ($type[0] == "textarea"): ?>
            <textarea style="width:100%;height:300px;" name="<?echo htmlspecialchars($arOption[0]) ?>"><?echo htmlspecialchars($val) ?></textarea>
          <?elseif ($type[0] == "radio"): ?>
            <input type="radio" value="1" name="<?echo htmlspecialchars($arOption[0]) ?>" <?if ($val == 1) {
  echo 'checked="checked"';
}
?>/> <?=Loc::getMessage('DOLYAME.PAYMENT_YES')?> <br/>
            <input type="radio" value="0" name="<?echo htmlspecialchars($arOption[0]) ?>" <?if ($val == 0) {
  echo 'checked="checked"';
}
?>/> <?=Loc::getMessage('DOLYAME.PAYMENT_OPTIONS_NO')?>
          <?elseif ($type[0] == "list"): ?>
            <select name="<?echo htmlspecialchars($arOption[0]) ?>">
            <?foreach ($type[1] as $key => $value): ?>
              <option value="<?=$key?>"  <?if ($val == $key) {
  echo 'selected="selected"';
}
?>><?=$value?></option>
            <?endforeach;?>
            </select>
          <?endif;?>
      </td>
    </tr>
  <?endforeach?>

 <?
echo '<input type="hidden" name="Update" value="Y" />';
$tabControl->Buttons(array(
  "back_url" => $APPLICATION->GetCurPage() . '?lang=' . LANGUAGE_ID,
));
$tabControl->End();
?>

    <?echo bitrix_sessid_post(); ?>
</form>
