<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Zeppelin U Availability</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<meta charset="utf-8">
<style>
body {
font-family: arial, 'sans serif';
font-size: 10px;
}

table,th,td {
border-spacing:0px;
border: 0px;
padding: 5px;
vertical-align: top;}


th {
background: #CCC;
}

tr:nth-child(even) {
background: #FFF;
}

tr:nth-child(odd) {
background: #EDEDED;
}

</style>
</head>
<body>


<table border="0" width="">
	<tr>
		<th>Standort</th>
		<th>Signatur</th>
		<th>Standardleihe</th>
		<th>Präsenzbestand</th>
		<th>Fernleihe</th>
		<th>OpenAccess</th>
	</tr>

<?php

$an = $_GET['ppn'];
$pre = $_GET['pre'];
$ppn = substr($an,$pre);
$bibid = $_GET['bibid'];
$url = 'https://daia.ibs-bw.de/isil/'.$bibid.'?id=ppn:'.$ppn.'&format=json';
$json_a = mycurl($url);

if($json_a == NULL) {
echo $ppn;
echo 'There was a problem with the DAIA server not providing a response';
exit;
}
else {

//var_dump($json_a);
foreach($json_a[document] as $document) {
foreach($document[item] as $item) {
$standort = $item[storage][content];
$signatur = $item[label];

unset($loan_available);
unset($presentation_available);
unset($interloan_available);
unset($openaccess_available);
unset($loan_unavailable);
unset($presentation_unavailable);
unset($interloan_unavailable);
unset($openaccess_unavailable);

if (isset($item[available])){
	foreach($item[available] as $available){
		if ($available[service] == 'loan') {
		$loan_available = '<span style="color:green">verfügbar</span>';
    	}
		elseif ($available[service] == 'presentation') {
		$presentation_available = '<span style="color:green">verfügbar</span>';
		}
		elseif ($available[service] == 'interloan') {
		$interloan_available = '<span style="color:green">verfügbar</span>';
		}
		elseif ($available[service] == 'openaccess') {
		$openaccess_available = '<span style="color:green">verfügbar</span>';
		}
	}
}

if (isset($item[unavailable])){
	foreach($item[unavailable] as $unavailable) {
		if ($unavailable[service] == 'loan') {
		$loan_unavailable = '<span style="color:red">nicht verfügbar</span>';
			if(isset($unavailable[expected])) {
			$loan_expected = 'erwartet: '.$unavailable[expected];
			}
    	}
		elseif ($unavailable[service] == 'presentation') {
		$presentation_unavailable = '<span style="color:red">nicht verfügbar</span>';
			if(isset($unavailable[expected])) {
			$presentation_expected = 'erwartet: '.$unavailable[expected];
			}
		}
		elseif ($unavailable[service] == 'interloan') {
		$interloan_unavailable = '<span style="color:red">nicht verfügbar</span>';
			if(isset($unavailable[expected])) {
			$interloan_expected = 'erwartet: '.$unavailable[expected];
			}
		}
		elseif ($unavailable[service] == 'openaccess') {
		$openaccess_unavailable = '<span style="color:red">nicht verfügbar</span>';
			if(isset($unavailable[expected])) {
			$openaccess_expected = 'erwartet: '.$unavailable[expected];
			}
		}
	}
}	



echo '	<tr>';
echo '		<td>'.$item[storage][content].'</td>';
echo '		<td>'.$item[label].'</td>';
echo '		<td>';
	if(isset($loan_available)) {
		echo $loan_available;
		} 
		else {
		echo $loan_unavailable.'<br>'.$loan_expected;
		}
	echo '</td>';
echo '		<td>';
	if(isset($presentation_available)) {
		echo $presentation_available;
		} 
		else {
		echo $presentation_unavailable.'<br>'.$presentation_expected;
		}
	echo '</td>';
echo '		<td>';
	if(isset($interloan_available)) {
		echo $interloan_available;
		} 
		else {
		echo $interloan_unavailable.'<br>'.$interloan_expected;
		}
	echo '</td>';
echo '		<td>';
	if(isset($openaccess_available)) {
		echo $openaccess_available;
		} 
		else {
		echo $openaccess_unavailable.'<br>'.$openaccess_expected;
		}
	echo '</td>';
echo '	</tr>';
	
} // item
} // document
echo '</table>';
}  //if null on $json_a check

function mycurl($url)
{
$ch = curl_init();
$timeout = 10; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
ob_start();
curl_exec($ch);
curl_close($ch);
//start attempt at improved error handling
	$errno          = @curl_errno($ch);
	$error          = @curl_error($ch);
	if( $errno != CURLE_OK) {
		die($errno." - ".$error);
		}
//end attempt at improved error handling
$file_contents = ob_get_contents();
ob_end_clean();
return $json_response = json_decode($file_contents, true);
};




?>

</table>
</body>
</html>