<?php
date_default_timezone_set('America/New_York');
// http://sim.plified.com/2008/09/14/accessing-google-spreadsheet-with-php/
$token = $_REQUEST["token"];
$sheetkey = $_REQUEST["sheetkey"];

$url = "https://spreadsheets.google.com/feeds/worksheets/{$sheetkey}/private/full/?access_token=" . $token;

    $xml ='<entry xmlns="http://www.w3.org/2005/Atom" xmlns:gs="http://schemas.google.com/spreadsheets/2006"  xmlns:gd="http://schemas.google.com/g/2005" >';
    $xml .='<title>Blue Team</title>';
    $xml .='<gs:rowCount>2</gs:rowCount>';
    $xml .='<gs:colCount>1</gs:colCount>';
    $xml .='</entry>';

//$options = array(
//    'http' => array(
//        'header'  => "Content-type: application/atom+xml",
//        'method'  => 'POST',
//        'content' => $xml
//    )
//);
//
//$context  = stream_context_create($options);
//$result = file_get_contents($url, false, $context);
//
//var_dump($result);
//print_r($result);

//var_dump($result);
//print_r($result);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url );

curl_setopt($ch, CURLOPT_HTTPHEADER,  array( "Content-type: application/atom+xml" ) );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,  $xml );
$google_sheet = curl_exec($ch);

var_dump($google_sheet);
//    $doc = new DOMDocument();
//      $doc->loadXML($google_sheet); 
//      
//      $nodes = $doc->getElementsByTagName("cell");
//          
//      if($nodes->length > 0)  {
//          foreach($nodes as $node) {
//              echo($node);
//          }
//      }
//
?>