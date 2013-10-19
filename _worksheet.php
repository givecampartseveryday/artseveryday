<?php
date_default_timezone_set('America/New_York');
// http://sim.plified.com/2008/09/14/accessing-google-spreadsheet-with-php/
$token = $_REQUEST["token"];
$ssid = $_REQUEST["ssid"];

$url = "https://spreadsheets.google.com/feeds/worksheets/{$ssid}/private/full/?access_token=" . $token;

    $xml ='<entry xmlns="http://www.w3.org/2005/Atom" xmlns:gs="http://schemas.google.com/spreadsheets/2006"  xmlns:gd="http://schemas.google.com/g/2005" >';
    $xml .='<title>Red Team</title>';
    $xml .='<gs:rowCount>2</gs:rowCount>';
    $xml .='<gs:colCount>1</gs:colCount>';
    $xml .='</entry>';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url );

curl_setopt($ch, CURLOPT_HTTPHEADER,  array( "Content-type: application/atom+xml" ) );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml );
$google_sheet = curl_exec($ch);

var_dump($google_sheet);

?>