<?php
//date_default_timezone_set('America/New_York');
// http://sim.plified.com/2008/09/14/accessing-google-spreadsheet-with-php/

 $token = $_REQUEST['token'];
 $ssid = $_REQUEST['ssid'];
 $wsid = $_REQUEST['wsid'];
 $sheetHeader = $_REQUEST['sheetHeader'];
 $colNumber = $_REQUEST['colNumber'];
 
 
 $url = 'https://spreadsheets.google.com/feeds/cells/' . $ssid . '/' . $wsid . '/private/full';

 $xml = '<entry xmlns="http://www.w3.org/2005/Atom" xmlns:gs="http://schemas.google.com/spreadsheets/2006">';
 $xml .= '<id>' . $url . '/R1C' . $colNumber . '</id>';
 $xml .= '<link rel="edit" type="application/atom+xml" href="' . $url . '/R1C' . $colNumber . '"/>';                    
 $xml .= '<gs:cell row="1" col="' . $colNumber . '" inputValue="' . $sheetHeader . '"/>';
 $xml .= '</entry>';
 
 echo  $url ;
 echo  $xml ;
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url );
 
 curl_setopt($ch, CURLOPT_HTTPHEADER,  array( 'Content-type: application/atom+xml', 'Authorization: Bearer ' . $token ) );
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml );
 $google_sheet = curl_exec($ch);
 
 var_dump($google_sheet);
?>