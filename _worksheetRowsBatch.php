<?php

 $token = $_REQUEST['token'];
 $ssid = $_REQUEST['ssid'];
 $wsid = $_REQUEST['wsid'];
 $data = $_REQUEST['data'];
 
 $url = 'https://spreadsheets.google.com/feeds/cells/' . $ssid . '/' . $wsid . '/private/full/batch';

 $xml = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:batch="http://schemas.google.com/gdata/batch" xmlns:gsx="http://schemas.google.com/spreadsheets/2006/extended">';
 $xml .= '<gsx:head1>foo</gsx:head1>';
 $xml .= '<gsx:head2>bar</gsx:head2>';
 $xml .= '</entry>';

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url );
 
 curl_setopt($ch, CURLOPT_HTTPHEADER,  array( 'Content-type: application/atom+xml', 'Authorization: Bearer ' . $token ) );
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml );
 $google_sheet = curl_exec($ch);
 
 var_dump($google_sheet);
?>