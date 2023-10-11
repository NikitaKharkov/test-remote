<?php

/***************************************************************
  EBSCO
  Claus Wolf (cwolf@ebscohost.com)
  
  Description : 
  
  This script converts fully qualified DAIA to a format designed 
  to work for display in EBSCO Discovery Service.
  
  Version     : 0.7.4
  Date        : 2013-06-20
  
  # attempt at fixing XML format
  # added some error handling for calls without PPN or LIB
  # added some error handling for NULL response for $json_a after curl
  # fixed <list> tag
  # undone the utf8 changes, as rtac doesn't support it after all
  # improved status for "unspecified" items (ebooks, multivolume works)
	
 ***************************************************************/ 

if (!isset($_GET['ppn'])) {
	echo 'Expected Parameter PPN (ILS Record Number) missing';
	exit;
}
else {
	$ppn = $_GET['ppn'];			// the ILS record number
}

if (!isset($_GET['lib'])) {
	echo 'Expected Parameter LIB (Library ID) missing';
	exit;
}
else {
	$bibid = $_GET['lib']; 			// the library identfier used by BSZ
}

$url = 'https://daia.ibs-bw.de/isil/'.$bibid.'?id=ppn:'.$ppn.'&format=json';
$json_a = mycurl($url);

if ($json_a != NULL) {

// the following code will start to create a XML file format with four fields
// for each item

header("content-type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<list>';
foreach($json_a[document] as $document) {
foreach($document[item] as $item) {
echo '<item>';
echo '<location>'.$item[storage][content].'</location>';
echo '<callno>'.$item[label].'</callno>';


// an item is either available for loan or presentation, so we check this first
// the status field of the RTAC XML here will be somewhat abused to not just state
// the actual status, but also show the type of loan for an available item, the 
// actual status (e.g. available) will then be provided in the Due Date column.
$status = '';
$duedate = '';

if (isset($item[available])){
	foreach($item[available] as $available){
			if ($available[service] == 'loan') {
    		$status = 'Standardleihe';
    		break;
   			}
			elseif ($available[service] == 'presentation') {
    		$status =  'Präsenzbestand';
			}
  	}
}

// if an item doesn't have availability information, it might be unavailable
// however we only really care for whether an item is out on loan right now

if (isset($item[unavailable])){
	foreach($item[unavailable] as $unavailable){
			if ($unavailable[service] == 'loan') {
				if(!empty($unavailable[expected])) {
				$status =  'ausgeliehen, erwartet am: ';
				$mydue = $unavailable[expected];
				}
	  		}
	}
}

if (isset($item[message])) {

// Below we are trying to evaluate whether to provide "available" in the Due Date column
// or whether a date should be given; the below contains one problematic statement at this
// time, which however holds true for the vast majority of cases. 

	foreach ($item[message] as $message) {
	if ($message[content] == 'for reference') {
	$duedate = 'Verfügbar';}
	elseif ($message[content] == 'available') {
	$duedate = 'Verfügbar';}
	elseif ($message[content] == 'expected') {
	$duedate = $mydue;}
	elseif ($message[content] == 'unspecified' && empty($available[service])) {
	$status = 'Verfügbarkeit prüfen';
	$duedate = '';}
	elseif ($message[content] == 'transaction') {
	$duedate = 'Geschäftsgang (zum '.$mydue.')';
	}
	else {
	$duedate = 'unbekannter Status';}
	}	
}	

echo '<status>';
echo $status;
echo '</status>';
echo '<duedate>';
echo $duedate;
echo '</duedate>';
echo '</item>';
} 	
}	
echo '</list>';
exit;
}
else {
	echo 'no server response was received';
}

function mycurl($url)
{
$ch = curl_init();
$timeout = 10; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
ob_start();
curl_exec($ch);
curl_close($ch);
	$errno          = @curl_errno($ch);
	$error          = @curl_error($ch);
	if( $errno != CURLE_OK) {
		die($errno." - ".$error);
		}
$file_contents = ob_get_contents();
ob_end_clean();
return $json_response = json_decode($file_contents, true);
};

?>