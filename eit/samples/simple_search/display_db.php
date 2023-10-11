<?php

require( "profile.php" );
require( "service.php" );
require( "functions.php" );

// Setup profile parameters
$params = array(
	"prof" => $profile,
	"pwd"  => $password 
); 
// Request Database Information
$xmlDoc = new DataService;
$xmlDoc->connect( "http://eit.ebscohost.com/Services/SearchService.asmx/" );
$xmlDoc->send( "Info", $params );

$xml = $xmlDoc->recieve();
$xml = str_replace( '<?xml version="1.0"?>', '', $xml );

// Display XML header with XSL stylesheet information
xml_header( "display_db.xsl" );
echo $xml;

?>