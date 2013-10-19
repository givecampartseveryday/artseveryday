<?php
date_default_timezone_set('America/New_York');

$token = $_REQUEST["token"];
$sheetkey = $_REQUEST["sheetkey"];

$urlBatch = "https://spreadsheets.google.com/feeds/list/{$sheetid}/{$sheetkey}/private/full";

$xmlBatch = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:batch="http://schemas.google.com/gdata/batch" xmlns:gsx="http://schemas.google.com/spreadsheets/2006/extended">';
$xmlBatch += '<gsx:hours>10</gsx:hours>';
$xmlBatch += '</entry >';

$optionsBatch = array(
    'http' => array(
        'header'  => "Content-type: application/atom+xml;\r\n" . "Authorization: Bearer {$token}\r\n",
        'method'  => 'POST',
        'content' => $xml
    )
);

$contextBatch  = stream_context_create($optionsBatch);
$resultBatch = file_get_contents($urlBatch, false, $contextBatch);

var_dump($resultBatch);
?>
