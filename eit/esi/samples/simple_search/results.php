<?php

/**
* This file will display the results of a search.
*
* The DataService interface uses cURL to connect to the EIT and request
* the XML file.  See 'service.php'.
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

// Execute search query and return results.

// Initialize limiter variable.  xml_vars holds the limiters which will be passed to
// the XSLT stylesheet via XML
$xml_vars = '';

// Search Terms and set them in XML if not null
$s1 = $_GET["s1"]; 
if ($s1) {
$xml_vars .= "<s1>" .  $s1. "</s1>\n";
}
$s2 = $_GET["s2"];  
if ($s2) {
$xml_vars .= "<s2>" .  $s2. "</s2>\n";
}
$s3 = $_GET["s3"];  
if ($s3) {
$xml_vars .= "<s3>" .  $s3. "</s3>\n";
}
$s4 = $_GET["s4"];  
if ($s4) {
$xml_vars .= "<s4>" .  $s4. "</s4>\n";
}

// Delimiters
$d1 = $_GET["d1"];  
if ($d1) {
$xml_vars .= "<d1>" .  $d1. "</d1>\n";
}
$d2 = $_GET["d2"];  
if ($d2) {
$xml_vars .= "<d2>" .  $d2. "</d2>\n";
}
$d3 = $_GET["d3"];  
if ($d3) {
$xml_vars .= "<d3>" .  $d3. "</d3>\n";
}

// Tags
$t1 = $_GET["t1"];  
if ($t1) {
$xml_vars .= "<t1>" .  $t1. "</t1>\n";
}
$t2 = $_GET["t2"];  
if ($t2) {
$xml_vars .= "<t2>" .  $t2. "</t2>\n";
}
$t3 = $_GET["t3"];  
if ($t3) {
$xml_vars .= "<t3>" .  $t3. "</t3>\n";
}
$t4 = $_GET["t4"];  
if ($t4) {
$xml_vars .= "<t4>" .  $t4. "</t4>\n";
}

// Other
//Selected DB
$db = $_GET["db"];
//Selected sort option
$sort = $_GET["sort"];
$xml_vars .= "<sort>" . $sort . "</sort>\n";
//Records start to be displayed
$start = (isset($_GET["start"]) ? $_GET["start"] : 1);
//whether to display full text
$ft = isset($_GET["ft"]) ? true : false;
$xml_vars .= "<ft>" . $ft . "</ft>\n";
// No search terms, go back to select DB
if (!$s1 && !$s2 && !$s3 && !$s4 || !$db) {
    die(header("Location: search.php?db=" . $db));
}


// The link for 'next' and 'previous' pages
$link = 'results.php?db=' . $db . '&amp;sort=' . $sort . '&amp;s1='
        . $s1 . '&amp;s2=' . $s2 . '&amp;s3=' . $s3 . '&amp;s4=' . $s4 . '&amp;t1=' 
        . $t1 . '&amp;t2=' . $t2 . '&amp;t3=' . $t3 . '&amp;t4=' . $t4 . '&amp;d1=' 
        . $d1 . '&amp;d2=' . $d2 . '&amp;d3=' . $d3 . '&amp;ft=' . $ft;
        
// Query Build Algorithm
//if the term to be searched is not null check for the Tag of the catergory else keep it null
$s1 = str_replace(" ", "+", $s1);
$s1 = ($s1 != null) ? ('(' . $t1 . ($t1 != '' ? '+(' : '') . $s1 . ')' . ($t1 != '' ? ')' : '')) : null;

$s2 = str_replace(" ", "+", $s2);
$s2 = ($s2 != null) ? ('(' . $t2 . ($t2 != '' ? '+(' : '') . $s2 . ')' . ($t2 != '' ? ')' : '')) : null;

$s3 = str_replace(" ", "+", $s3);
$s3 = ($s3 != null) ? ('(' . $t3 . ($t3 != '' ? '+(' : '') . $s3 . ')' . ($t3 != '' ? ')' : '')) : null;

$s4 = str_replace(" ", "+", $s4);
$s4 = ($s4 != null) ? ('(' . $t4 . ($t4 != '' ? '+(' : '') . $s4 . ')' . ($t4 != '' ? ')' : '')) : null;
        
//if term to be searched is not null append database name and connecting term
     
$q='';     
//if not null append to query
if($s1!='') {
$q.=$s1;
}
//if second term not null append connector and term to query else just the term
if($s2!='' && $q!='') {
$q.='+'.$d1.'+'.$s2;
} else {
$q.=$s2;
}

if($s3!='' && $q!='') {
$q.='+'.$d2.'+'.$s3;
} else {
$q.=$s3;
}

if($s4!='' && $q!='') {
$q.='+'.$d3.'+'.$s4;
} else {
$q.=$s4;
}     
     
     
// The query to be sent to the EIT is formatted in $q

// Append the full text modifier if the user has selected fulltext
if (!preg_match('/\+AND\+FT\+Y/', $q) && isset($_GET['ft'])) {
    $q .= '+AND+FT+Y';	 
}

//Create class object to request web service for the response   
$xmlDoc = new DataService;
$xmlDoc->connect("http://eit.ebscohost.com/Services/SearchService.asmx/", $profile, $password);

// Build Parameters
$params = array(
    "prof"		=> $profile,
    "pwd"		=> $password,
    "query" 	=> $q,
    "startrec" 	=> $start,
    "db" 		=> $db,
    "sort" 		=> $sort
);

$xmlDoc->send("Search", $params);
//save the response obtained  XML form in $xml
$xml = $xmlDoc->recieve();
$xml = str_replace('<?xml version="1.0"?>', '', $xml);

xml_header("results.xsl");

// Output information about the search query.
echo "\n<wrapper>\n";
echo "	<dbSelect>" .$db. "</dbSelect>\n";
echo "<start_record>" . $start . "</start_record>\n";
echo "<query>" . $q . "</query>\n";
echo "<prev_page>" . $link . '&amp;start=' . ($start - 10) . "</prev_page>\n";
echo "<next_page>" . $link . '&amp;start=' . ($start + 10) . "</next_page>\n";
echo "<new_search>" . $link . "</new_search>\n";
// Output the variables for the XSL stylesheet.
echo $xml_vars;
// Output Search Results
echo $xml;
echo "\n</wrapper>";

?>