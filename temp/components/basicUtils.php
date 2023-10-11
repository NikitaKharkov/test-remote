<?
//Return the first element from $xml corresponding to the given $xpath
function getElement($xpath, $xml) {
	$a = $xml->xpath($xpath);
	return $a[0]->asXML();
}

//Return all element from $xml corresponding to the given $xpath as xml string
function getElements($xpath, $xml) {
	$a = $xml->xpath($xpath);
	//transform elements to xml
	foreach($a as &$ref)
		$ref = $ref->asXML();
		
	unset($ref);
	
	return $a;
}

//Splits string on each delimiter and returns the nth piece
function getPiece($string, $delimiter, $n) {
	$a = explode($delimiter, $string);
	return $a[$n];
}

//Returns an array containing only those values in $hash whose key contains the
//text in $filter
function filterHash($hash, $filter) {
	foreach($hash as $key => $value)
		if(strstr($key, $filter))
			$selected[] = $value;
	return $selected;
}
?>
