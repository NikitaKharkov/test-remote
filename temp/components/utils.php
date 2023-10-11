<?
require('components/basicUtils.php');
require('components/logUtils.php');

//Fix a couple issues with the REQUEST parameters generated  by PHP
function fixRequest() {
	//By default PHP converts "+" to " " in query string parameters.
	//This causes interoperability issues with links that have "+"s in them.
	//So force "+"s in the url to be encoded instead of just ignored
	$queryString = rawurldecode($_SERVER["QUERY_STRING"]);
	$queryString = str_replace("+", "%2b", $queryString);
	
	//Replace the existing values in $_GET with these corrected values
	parse_str(str_replace("+", "%2b", $queryString), $_GET);
	
	//Update the $_REQUEST array with the new $_GET values
	foreach($_GET as $key=>$value)
		$_REQUEST[$key] = $value;
	
	//Undo the slashes added by magic_quotes_gpc if necessary
	//(see http://www.php.net/magic_quotes)
	if(get_magic_quotes_gpc()) {
		foreach($_GET as $key=>$value)
			$_GET[$key] = stripslashes($value);
			
		foreach($_POST as $key=>$value)
			$_POST[$key] = stripslashes($value);
			
		foreach($_REQUEST as $key=>$value)
			$_REQUEST[$key] = stripslashes($value);
	}
}
?>
