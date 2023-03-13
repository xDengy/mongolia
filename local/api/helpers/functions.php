<?php

function p($mVar = false, $in_file = false, $file_name = '/p.log')
{
    if ($in_file) {
        $file = fopen($_SERVER['DOCUMENT_ROOT'] . $file_name, "a");
        if (!$file) {
            print '';
        } else {
            fputs($file, print_r($mVar, true));
            fputs($file, "\r\n");
            fclose($file);
        }
    }
    if (!$in_file) {
        ?>
        <pre style="color: #000000;"><?php print_r($mVar); ?></pre><?php
    }
}

function getSiteSettings() {
    $dbEl = CIBlockElement::GetList(Array(), Array("IBLOCK_TYPE" => "pages_content", "IBLOCK_ID"=>3));

    if ($obEl = $dbEl->GetNextElement())
    {
        return $obEl->GetProperties();
    }
}
