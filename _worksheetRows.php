<?php
date_default_timezone_set('America/New_York');

$token = $_REQUEST["token"];
$sheetkey = $_REQUEST["sheetkey"];

$url = "https://spreadsheets.google.com/feeds/worksheets/{$sheetkey}/private/full/";

$xml =  '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:gs="http://schemas.google.com/spreadsheets/2006">';
$xml .='<title>Expenses Test 2 </title> ';
$xml .='<gs:hours>1</gs:hours>';
$xml .='<gs:ipm>1</gsx:ipm>';
$xml .='<gs:items>60</gs:items>';
$xml .='<gs:name>Foo Bar</gs:name>';

$xml .='</entry>';

$options = array(
    'http' => array(
        'header'  => "Content-type: application/atom+xml;\r\n" . "Authorization: Bearer {$token}\r\n",
        'method'  => 'POST',
        'content' => $xml
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

var_dump($result);
?>
