<?php

 $token = $_REQUEST['token'];
 $ssid = $_REQUEST['ssid'];
 $wsid = $_REQUEST['wsid'];
 
 $url = 'https://spreadsheets.google.com/feeds/list/' . $ssid . '/' . $wsid . '/private/full';

$xml = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:batch="http://schemas.google.com/gdata/batch" xmlns:gsx="http://schemas.google.com/spreadsheets/2006/extended">';
$xml .= '<gsx:hours>10</gsx:hours>';
$xml .= '</entry>';

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url );
 
 curl_setopt($ch, CURLOPT_HTTPHEADER,  array( 'Content-type: application/atom+xml', 'Authorization: Bearer ' . $token ) );
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml );
 $google_sheet = curl_exec($ch);
 
 var_dump($google_sheet);
?>