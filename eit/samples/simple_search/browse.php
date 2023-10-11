<?php
/**
* Displays the browse functionality.
* 
* PHP version 5
*
* LICENSE: This source file is subject to version 3.01 of the PHP license
* that is available through the world-wide-web at the following URI:
* http://www.php.net/license/3_01.txt.  If you did not receive a copy of
* the PHP License and are unable to obtain it through the web, please
* send a note to license@php.net so we can mail you a copy immediately.
*
* @category  Simple_Search
* @package   PackageName
* @author    EBSCO Publishing's <author@example.com>
* @author    Persistent System Limited <minal@persistent.co.in>
* @copyright 1997-2005 The PHP Group
* @license   http://www.php.net/license/3_01.txt  PHP License 3.01
* @link      http://pear.php.net/package/PackageName
*/		   	
require "profile.php" ; // Profile Information
require "rest.php" ;    // DataService Class
require "functions.php" ;  // Misc. Functions

$db=(isset($_GET['db']))?$_GET['db']:null;
$index=(isset($_GET['index']))?$_GET['index']:null;
$browse=(isset($_GET['browse']))?$_GET['browse']:null;
if(!$index || !$browse || !$db) {
    die(header("Location: search.php?db=" . $db));
}  

// Setup profile parameters
$params = array(
    "prof" => $profile,
    "pwd"  => $password,
    "index" => $_GET['index'],
    "term" => str_replace(" ", "+", $_GET['browse']),
    "db" => $_GET['db']
);

// Request Database Information through Browse Method
$xmlDoc = new DataService;
$xmlDoc->connect("http://eit.ebscohost.com/Services/SearchService.asmx/");
$xmlDoc->send("Browse", $params);

//save the response obtained  XML form in $xml
$xml = $xmlDoc->recieve();
$xml = str_replace('<?xml version="1.0"?>', '', $xml);

// Display XML header with XSL stylesheet information
xml_header("browse.xsl");

// This wrapper enables the script to insert our own information
// in to the XML document.  We are passing the selected database
// to the document.
echo "<wrapper>\n";
echo "	<dbSelect>" . $_GET["db"] . "</dbSelect>\n";
echo "  <index>" . $_GET["index"] . "</index>\n" . $xml;
echo "\n</wrapper>";
?>