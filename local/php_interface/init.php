<?require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

use Bitrix\Main\Loader;

Loader::includeModule("iblock");
Loader::includeModule("highloadblock");
Loader::includeModule("sale");


$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler('sale', 'onSalePaySystemRestrictionsClassNamesBuildList', 'payRestrictFunction');
function payRestrictFunction()
{
    return new \Bitrix\Main\EventResult(
        \Bitrix\Main\EventResult::SUCCESS,
        array(
            '\ST\PayRestrictFunctions\PayWithBonusesRestrict' => '/local/php_interface/include/restrictions/PayWithBonusesRestrict.php',
        )
    );
}


$eventManager->addEventHandler('sale', 'onSaleDeliveryHandlersClassNamesBuildList', 'addCustomDeliveryServices');
function addCustomDeliveryServices(\Bitrix\Main\Event $event)
{
    $result = new \Bitrix\Main\EventResult(
        \Bitrix\Main\EventResult::SUCCESS,
        array(
            '\ST\CustomDelivery\RuPostDelivery' => '/local/php_interface/include/sale_delivery/RuPostDelivery.php',
            '\ST\CustomDelivery\CdekPVZDelivery' => '/local/php_interface/include/sale_delivery/CdekPVZDelivery.php',
            '\ST\CustomDelivery\CdekCourierDelivery' => '/local/php_interface/include/sale_delivery/CdekCourierDelivery.php'
        )
    );

    return $result;
}

$eventManager->AddEventHandler("sale", "OnSaleStatusOrder", "applyBonusesAfterPayFunc");
function applyBonusesAfterPayFunc($orderId, $status)
{
    \ST\Bonuses\Bonuses::applyBonusesAfterPay($orderId, $status);
}


AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("GenLazyImages", "generate"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("GenLazyImages", "generate"));
class GenLazyImages
{
    static function generate(&$arFields)
    {
        if($arFields['ID']) {
            $rsElem = CIBlockElement::GetByID($arFields['ID']);

            $arProps = $rsElem->GetNextElement()->GetProperties();

            if (!empty($arProps['IMAGES_LAZY'])) {
                foreach ($arProps['IMAGES_LAZY']['VALUE'] as $imgId) {
                    $rsFile = CFile::GetByID($imgId);
                    $arFile = $rsFile->Fetch();

                    $fullpath = $_SERVER['DOCUMENT_ROOT'] . CFile::GetPath($imgId);
                    $fileExtention = pathinfo($arFile['FILE_NAME'], PATHINFO_EXTENSION);

                    $imagickSrc = new \Imagick($fullpath);

                    $imagickDst = new \Imagick();
                    $imagickDst->setCompression(Imagick::COMPRESSION_BZIP);
                    $imagickDst->setCompressionQuality(30);
                    $imagickDst->newPseudoImage(
                        $imagickSrc->getImageWidth(),
                        $imagickSrc->getImageHeight(),
                        'canvas:white'
                    );

                    $imagickDst->compositeImage(
                        $imagickSrc,
                        Imagick::COMPOSITE_ATOP,
                        0,
                        0
                    );

                    $imagickDst->setImageFormat($fileExtention);
                    $imagickDst->writeImage($_SERVER['DOCUMENT_ROOT'] . "/upload/" . $arFile['SUBDIR'] . "/lazy_" . pathinfo($arFile['FILE_NAME'], PATHINFO_FILENAME) . "." . $fileExtention);
                }
            }
        }
        CleanUpUpload();
    }
}

function CleanUpUpload() {

    global $DB;

    define("NO_KEEP_STATISTIC", true);
    define("NOT_CHECK_PERMISSIONS", true);
    $deleteFiles = 'yes'; //Удалять ли найденые файлы yes/no
    $saveBackup = 'yes'; //Создаст бэкап файла yes/no
    //Папка для бэкапа
    $patchBackup = $_SERVER['DOCUMENT_ROOT'] . "/upload/iblock_Backup/";
    //Целевая папка для поиска файлов
    $rootDirPath = $_SERVER['DOCUMENT_ROOT'] . "/upload/iblock";

    $time_start = microtime(true);

    //Создание папки для бэкапа
    if (!file_exists($patchBackup) && $saveBackup === 'yes') {
        CheckDirPath($patchBackup);
    }
    // Получаем записи из таблицы b_file
    $arFilesCache = array();
    $result = $DB->Query('SELECT FILE_NAME, SUBDIR FROM b_file WHERE MODULE_ID = "iblock"');
    while ($row = $result->Fetch()) {
        $arFilesCache[$row['FILE_NAME']] = $row['SUBDIR'];
    }
    $hRootDir = opendir($rootDirPath);
    $count = 0;
    $contDir = 0;
    $countFile = 0;
    $i = 1;
    $removeFile=0;
    while (false !== ($subDirName = readdir($hRootDir))) {
        if ($subDirName == '.' || $subDirName == '..') {
            continue;
        }
        //Счётчик пройденых файлов
        $filesCount = 0;
        $subDirPath = "$rootDirPath/$subDirName"; //Путь до подкатегорий с файлами
        $hSubDir = opendir($subDirPath);
        while (false !== ($fileName = readdir($hSubDir))) {
            if ($fileName == '.' || $fileName == '..') {
                continue;
            }
            $countFile++;
            if (array_key_exists($fileName, $arFilesCache) || array_key_exists(str_replace('lazy_', '', $fileName), $arFilesCache)) { //Файл с диска есть в списке файлов базы - пропуск
                $filesCount++;
                continue;
            }

            $fullPath = "$subDirPath/$fileName"; // полный путь до файла
            $backTrue = false; //для создание бэкапа
            if ($deleteFiles === 'yes') {
                if (!file_exists($patchBackup . $subDirName)) {
                    if (CheckDirPath($patchBackup . $subDirName . '/')) { //создал поддиректорию
                        $backTrue = true;
                    }
                } else {
                    $backTrue = true;
                }
                if ($backTrue) {
                    if ($saveBackup === 'yes') {
                        CopyDirFiles($fullPath, $patchBackup . $subDirName . '/' . $fileName); //копия в бэкап
                    }
                }
                //Удаление файла
                if (unlink($fullPath)) {
                    $removeFile++;
                }
            } else {
                $filesCount++;
            }
            $i++;
            $count++;
            unset($fileName, $backTrue);
        }
        closedir($hSubDir);
        //Удалить поддиректорию, если удаление активно и счётчик файлов пустой - т.е каталог пуст
        if ($deleteFiles && !$filesCount) {
            rmdir($subDirPath);
        }
        $contDir++;
    }
    closedir($hRootDir);
    return "CleanUpUpload();";
}

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("RatingSetter", "set"));
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("RatingSetter", "delete"));
class RatingSetter
{
    static function set(&$arFields)
    {
        if ($arFields['IBLOCK_ID'] == 5) {
            $rsElem = CIBlockElement::GetByID($arFields['ID']);
            $arProps = $rsElem->GetNextElement()->GetProperties();
            $rsElem = CIBlockElement::GetByID($arFields['ID']);
            if($arFields['ACTIVE'] == 'Y' && $rsElem->Fetch()['ACTIVE'] == 'N') {
                $element = new CIBlockElement;
                $el = CIBlockElement::GetList([], ['IBLOCK_ID' => 9, 'ID' => $arProps['ELEMID']['VALUE']], false, false, ['IBLOCK_ID', 'ID', 'PROPERTY_VOTE_COUNT', 'PROPERTY_RATING'])->Fetch();

                $props['VOTE_COUNT'] = intval($el['PROPERTY_VOTE_COUNT_VALUE']) + 1;
                $props['RATING'] = intval($el['PROPERTY_RATING_VALUE']) + $arProps["RATING"]['VALUE'];

                CIBlockElement::SetPropertyValuesEx($arProps['ELEMID']['VALUE'], 9, $props);
            } else if($arFields['ACTIVE'] == 'N' && $rsElem->Fetch()['ACTIVE'] == 'Y') {
                $element = new CIBlockElement;
                $el = CIBlockElement::GetList([], ['IBLOCK_ID' => 9, 'ID' => $arProps['ELEMID']['VALUE']], false, false, ['IBLOCK_ID', 'ID', 'PROPERTY_VOTE_COUNT', 'PROPERTY_RATING'])->Fetch();

                $props['VOTE_COUNT'] = intval($el['PROPERTY_VOTE_COUNT_VALUE']) - 1;
                $props['RATING'] = intval($el['PROPERTY_RATING_VALUE']) - $arProps["RATING"]['VALUE'];


                CIBlockElement::SetPropertyValuesEx($arProps['ELEMID']['VALUE'], 9, $props);
            }
        }
    }
    static function delete(&$arFields)
    {
        $rsElem = CIBlockElement::GetByID($arFields);
        if ($rsElem->Fetch()['IBLOCK_ID'] == 5) {
            $rsElem = CIBlockElement::GetByID($arFields);
            $arProps = $rsElem->GetNextElement()->GetProperties();
            $rsElem = CIBlockElement::GetByID($arFields);

            if($rsElem->Fetch()['ACTIVE'] == 'Y') {
                $element = new CIBlockElement;
                $el = CIBlockElement::GetList([], ['IBLOCK_ID' => 9, 'ID' => $arProps['ELEMID']['VALUE']], false, false, ['IBLOCK_ID', 'ID', 'PROPERTY_VOTE_COUNT', 'PROPERTY_RATING'])->Fetch();

                $props['VOTE_COUNT'] = intval($el['PROPERTY_VOTE_COUNT_VALUE']) - 1;
                $props['RATING'] = intval($el['PROPERTY_RATING_VALUE']) - $arProps["RATING"]['VALUE'];

                CIBlockElement::SetPropertyValuesEx($arProps['ELEMID']['VALUE'], 9, $props);
            }
        }
    }
}

// AddEventHandler("sale", "OnSaleStatusOrder", ["\ST\Bonuses\Bonuses", "applyBonusesAfterPay"]);

// AddEventHandler('sale', 'OnSalePayOrder', 'applyBonusesAfterPayFunc');
