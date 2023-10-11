<?php

$q = getVar( "q", "get" );
	
$q = str_replace( " ", "+", $q );
$url_1 = "http://eit.ebscohost.com/Services/SearchService.asmx/AuthoritySearch?prof=webdes.eit.mesh_demo&pwd=ebsco&authType=&ipprof=&query=" . $q . "&db=2011mesh&format=list&sort=relevance";
$xml_data_1 = curl_get( $url_1 );
$xml_eds1 = new DOMDocument();
$xml_eds1->loadXML( $xml_data_1);

$itemnodes = $xml_eds1->getElementsByTagName( "rec" );
$j = 0;
while( $j < 5 )
{
	$tagval = "";
	$tag = "";
	$nodes = $itemnodes->item($j)->getElementsByTagName( "*" );
	for ( $i = 0; $i < $nodes->length; $i++ ) 
	{
		$tag = $nodes->item( $i )->nodeName;
		$tagval = $nodes->item( $i )->nodeValue;
		if( $tag == "browseTerm" ) {
			if( strlen($tagval) > 1 ) {
				print $tagval . "\r\n<br>";
			}
		}
		if( $tag == "useTerm" ) {
			if( $tagval > "A" ) {
				print "..<b>USE:</b> <font color='blue'>" . $tagval . "</font>\r\n<br>";
			}
		}
		$tagval = "";
		$tag = "";
	}
	print "<br>";
	$j++;
}

function curl_get( $url )
{
	$rest_con = curl_init();	
	curl_setopt ($rest_con, CURLOPT_URL, $url );
	curl_setopt ($rest_con, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($rest_con, CURLOPT_CONNECTTIMEOUT, 0);
	$result = curl_exec($rest_con);
	curl_close($rest_con); 
	return $result;
}

function getVar( $var_name, $method = "post" )
{
	switch( $method )
	{
		case "post":
			return ( !isset( $_POST[ $var_name ] ) ? null : $_POST[ $var_name ] );
		case "get":
			return ( !isset( $_GET[ $var_name ] ) ? null : $_GET[ $var_name ] );
		case "cookie":
			return ( !isset( $_COOKIE[ $var_name ] ) ? null : $_COOKIE[ $var_name ] );
		default:
			return null;
			
	}
}

?>