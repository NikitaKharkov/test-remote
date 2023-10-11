<?php
/**
* This file will display a search screen for a specific search which can be found by using the Search method of
* the SearchService.

* The DataService interface uses cURL to connect to the EIT and request
* the XML file.
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

/*require "profile.php"; // Profile Information*/

// Retrieve the sort option from the form POST request after the user clicks the Search button
$vars["sort"]		= getVar("sort", "get");

// Retrieve the search limiters from the form POST request after the user clicks the Search button
// These limiters are made available to the user via the Search Options screen accessible under
// the main search box.
$vars["query"] 		= getVar("query", "get");
$vars["full_text"] 	= getVar("ft", "get");
$vars["scholarly"]	= getVar("sch", "get");
$vars["from_year"]	= getVar("from_year", "get");
$vars["from_month"]	= getVar("from_month", "get");
$vars["to_year"]	= getVar("to_year", "get");
$vars["to_month"]	= getVar("to_month", "get");
$vars["pubtype"]	= getVar("pubtype", "get");
$vars["searchfield"]= getVar("searchfield", "get");
$vars["s1"]= getVar("s1", "get");
$vars["t1"]= getVar("t1", "get");
$vars["d1"]= getVar("d1", "get");
$vars["s2"]= getVar("s2", "get");
$vars["t2"]= getVar("t2", "get");
$vars["d2"]= getVar("d2", "get");
$vars["s3"]= getVar("s3", "get");
$vars["t3"]= getVar("t3", "get");
$search_type=getVar("search_type", "get");


// Initialize the starting position of the records in the XML returned from the web services API.
// If the starting position parameter doesn't exist, set it to 1
// $start will be referenced on line 163 below
if (!isset($_GET['start'])) {
    $start = 1;
} else {
    $start = $_GET['start'];
}  

 $query = $vars["query"];
 $query_o = $vars["query"];
 $xml_vars = '';
 
if ($vars["searchfield"] != "keyword") {
    if ($vars["searchfield"] == "author") {
        $vars["s1"] = $query;
        $vars["t1"] = "AU";
        $query = "";
    }
    else if ($vars["searchfield"] == "title") {
        $vars["s1"] = $query;
        $vars["t1"] = "TI";
        $query = "";
    }
}

 
if ($query)
{
       
        // Format the Query using the limiters above.
        $query = $vars["query"];
        $query_o = $vars["query"];

        $query_disp = $vars["query"];

        // Remove preceding and trailing blank space
        $query = trim($query);

        // Encode any blank spaces within the query string.  Should be done as a best practice.  
        $query = str_replace(" ", "+", $query);

        // Initialize limiter variable.  xml_vars holds the limiters which will be passed to
        // the XSLT stylesheet via XML
        $xml_vars = '';

        // Add left and right parenthesis around the query string.  This will ensure the search criteria is
        // properly bounded in the query string
        if ($query[0] != '(') {
            $query = '(' . $query;
        }

        // Once the search criteria is added to the query string, append any limiters that were selected via the UI
        // to the query string.  
        if (($query[ (strlen($query) - 1) ])!=')') {
            $query .= ')';
        }

        // User has indicated, via the Search Options screen, that the search must include 
        // articles containing Full Text
        if ($vars["full_text"]) {
            // append to the query, the FT field code and set to a value of Y
            $query .= "+AND+(FT+Y)";
            $xml_vars .= "<ft ft=\"on\" />\n";
        }

        // User has indicated, via the Search Options screen, that the search must include 
        // Scholarly (Peer Reviewed) Journals
        if ($vars["scholarly"]) {
            // append to the query, the RV field code and set to a value of Y
            $query .= "+AND+(RV+Y)";
            $xml_vars .= "<sch sch=\"on\" />\n";
        }


        if ($vars["pubtype"] == "all") {
            $xml_vars .= "<pubtype>all</pubtype>\n";
        } else if ($vars["pubtype"] == "books") {
            $xml_vars .= "<pubtype>books</pubtype>\n";
            $query .= "+AND+(PT+book)";
        } else if ($vars["pubtype"] == "articles") {
            $xml_vars .= "<pubtype>articles</pubtype>\n";
            $query .= "+AND+(ZT+article)";
        }

        // User has chosen to specify From and/or To dates to narrow the scope of the search.  
        if ($vars["from_year"] || $vars["to_year"]) {
            // preface From and/or To date with DT field code
            $query .= "+AND+(DT+";
            
            if ($vars["from_year"]) {
                // append From date to query string
                $query .= $vars["from_year"] . $vars["from_month"];
                $xml_vars .= "<from_year>" . $vars["from_year"] . "</from_year>\n";
                $xml_vars .= "<from_month>" . $vars["from_month"] . "</from_month>\n";
            }
            
            $query .= '-';
            
            if ($vars["to_year"]) {
                // append To date to query string
                $query .= $vars["to_year"] . $vars["to_month"];
                $xml_vars .= "<to_year>" . $vars["to_year"] . "</to_year>\n";
                $xml_vars .= "<to_month>" . $vars["to_month"] . "</to_month>\n";
            }
            // close the date parenthesis in order to properly bound the date parameters 
            $query .= ')';
        }



}

$s1=$vars["s1"];
if ($s1) {
$xml_vars .= "<s1>" .  $s1. "</s1>\n";
}
$t1=$vars["t1"];
if ($t1) {
$xml_vars .= "<t1>" .  $t1. "</t1>\n";
}
$d1=$vars["d1"];
if ($d1) {
$xml_vars .= "<d1>" .  $d1. "</d1>\n";
}
$s2=$vars["s2"];
if ($s2) {
$xml_vars .= "<s2>" .  $s2. "</s2>\n";
}
$t2=$vars["t2"];
if ($t2) {
$xml_vars .= "<t2>" .  $t2. "</t2>\n";
}
$d2=$vars["d2"];
if ($d2) {
$xml_vars .= "<d2>" .  $d2. "</d2>\n";
}
$s3=$vars["s3"];
if ($s3) {
$xml_vars .= "<s3>" .  $s3. "</s3>\n";
}
$t3=$vars["t3"];
if ($t3) {
$xml_vars .= "<t3>" .  $t3. "</t3>\n";
}

// Query Build Algorithm
//if the term to be searched is not null check for the Tag of the catergory else keep it null
$s1 = str_replace(" ", "+", $s1);
$s1 = ($s1 != null) ? ('(' . $t1 . ($t1 != '' ? '+(' : '') . $s1 . ')' . ($t1 != '' ? ')' : '')) : null;

$s2 = str_replace(" ", "+", $s2);
$s2 = ($s2 != null) ? ('(' . $t2 . ($t2 != '' ? '+(' : '') . $s2 . ')' . ($t2 != '' ? ')' : '')) : null;

$s3 = str_replace(" ", "+", $s3);
$s3 = ($s3 != null) ? ('(' . $t3 . ($t3 != '' ? '+(' : '') . $s3 . ')' . ($t3 != '' ? ')' : '')) : null;

$query_adv='';        
//if trem to be searched is not null append database name
if(!$_GET["advset"]){
     
$query_adv='';     

if($s1!='') {
$query_adv.=$s1;
}

if($s2!='' && $query_adv!='') {
$query_adv.='+'.$d1.'+'.$s2;
} else {
$query_adv.=$s2;
}

if($s3!='' && $query_adv!='') {
$query_adv.='+'.$d2.'+'.$s3;
} else {
$query_adv.=$s3;
}
    
}  

if (!$query && !$s1 && !$s2 && !$s3) {
    die(header("Location: index.php"));
}
if ($query) {
    if($query_adv!=''){
    $query .= "+AND+". $query_adv;
    
    
    }
} else if($query_adv!='' && !$query){
        $query=$query_adv;
        $query_o=$query_adv;
}
else {
        die(header("Location: index.php"));
}

$rtbrac=substr_count($query,"(");
$lfbrac=substr_count($query,")");
if($lfbrac>$rtbrac) {
$query=substr($query,0,(strlen($query)-1));
}
// Compose the full EBSCOhost web services API URL
// Number of records to return is defaulted to 10.  
// Valid values 1 to 200
// When specifying format = Full (as opposed to Brief, Detailed), maximum records returned is capped 50

$profile = "webdes.eit.pers_eds1";
$pwd = "ebsco";

$EITServiceURL = "http://eit.ebscohost.com/Services/SearchService.asmx/Search?prof=" . $profile . "&pwd=" . $pwd . "&query=" . $query . "&sort=" . $vars["sort"] . "&startrec=" . $start . "&numrec=10";

$EITClusterURL="http://eit.ebscohost.com/Services/SearchService.asmx/GetClusters?prof=" . $profile . "&pwd=" . $pwd . "&query=" . $query." ";
// Make the request to the web services API by issuing a curl Get request

$data = curl_get($EITServiceURL);
$data_clust=curl_get( $EITClusterURL );
// Load the XML result received from the web services API into a local document 
// object so that it can be parsed 
$XMLdata = new DOMDocument();
$XMLdata->loadXML($data);


$XMLclust =new DOMDocument();
$XMLclust->loadXML( $data_clust);
// Get the total number of records returned from the search.
//Changed to get the right Hits value
$XMLhits = $XMLdata->getElementsByTagName("Hits");
$hits = 0;
foreach ($XMLhits as $hitcount) {
    $hits += $hitcount->nodeValue;
}

// Get the RecordCount for this page.  This represents the number of
// records returned on this page.
$XMLrecords = $XMLdata->getElementsByTagName("rec");
$RecordCount = 0;
foreach ($XMLrecords as $rec) {
    $RecordCount++;
}

    
// Next Page record number and Previous Page record number
$NextPageStart = $start + 10;
$PrevPageStart = $start - 10;

// Begin: generate wrapper XML that will be used by to build the search results web page
// search.xsl, located in the same directory as search.php, will translate this XML into HTML
header('Content-type: text/xml');
    
echo "<?xml version='1.0' encoding='UTF-8'?>\n";
echo "<?xml-stylesheet type='text/xsl' href='search.xsl'?>\n";
echo "<!-- Copyright 2010 EBSCO Industries, Inc.  All rights reserved. -->\n";
echo "<wrapper>\n";
echo "<query_req>" . 	$query . "</query_req>\n";
echo "<query_adv>" . 	$query_adv . "</query_adv>\n";
echo "<query>" . 	$query . "</query>\n";
echo "<prevpage>" . $PrevPageStart . "</prevpage>\n";
echo "<hits>" . 	$hits . "</hits>\n";

//if not hits found then specify noresults as true with value 1 or if found set to false with value 0
if (!$hits) {
    echo "<noresults>1</noresults>";
} else {
    echo "<noresults>0</noresults>";
}    
    
//if number of records is greater than 10 specify the start of next page    
if (($RecordCount) < 10) {
    echo "<nextpage>0</nextpage>\n";
} else {
    echo "<nextpage>" . $NextPageStart . "</nextpage>\n";
}

//specify total count of records found
echo "<totalrecs>" . $RecordCount . "</totalrecs>\n";
//specify start for the current page
echo "<thispage>" . $start . "</thispage>\n";
echo "<page>" . (!isset($_GET['page']) ? 1 : $_GET['page']) . "</page>\n";
echo "<sort>" . $vars["sort"] . "</sort>\n";

// Output the variables for the XSL stylesheet.
echo $xml_vars;


// Output the results from the EBSCOhost Search.
echo str_replace('<?xml version="1.0"?>', '', $XMLdata->saveXML());
echo str_replace('<?xml version="1.0"?>', '', $XMLclust->saveXML());
echo "</wrapper>\n";

// End: generate wrapper XML 

/**
* To get the value of a particular POST/GET variable or Cookie.
*
*@param string $var_name Name of variable whose value is to be saved.
*
*@param string $method   Method through which it is obtained.
*
*@return Return value of the variable
*
*/
function getVar($var_name, $method = "post")
{
    switch($method)
    {
    case "post":
            return (!isset($_POST[ $var_name ]) ? null : $_POST[ $var_name ]);
    case "get":
            return (!isset($_GET[ $var_name ]) ? null : $_GET[ $var_name ]);
    case "cookie":
            return (!isset($_COOKIE[ $var_name ]) ? null : $_COOKIE[ $var_name ]);
    default:
            return null;
            
    }
}

/**
* Function, which gets the contents of a webpage.  In this case, it's the
* contents of the EBSCOhost Web Service.
*
*@param string $url URL to be executed through cURL
*
*@return Response obtained from executing the URL through cURL.
*
*/ 
function curl_get($url)
{
    $rest_con = curl_init();	
    curl_setopt($rest_con, CURLOPT_URL, $url);
    curl_setopt($rest_con, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($rest_con, CURLOPT_CONNECTTIMEOUT, 0);
	//If using a Proxy Server to request the web service add the following cURL parameters.
    /*curl_setopt($rest_con, CURLOPT_HTTPPROXYTUNNEL, 0); 
    curl_setopt($rest_con, CURLOPT_PROXY, 'http://mycompany.com:8080'); 
    curl_setopt($rest_con, CURLOPT_PROXYUSERPWD, 'mycompany\username:password'); 
    curl_setopt($rest_con, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);*/
    
    $result = curl_exec($rest_con);
    curl_close($rest_con); 
    
    return $result;
}