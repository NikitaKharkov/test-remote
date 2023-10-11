<?php
/** 
* This example provides a fake company portal, and conveys the possible
* uses of the EBSCOhost Integration Toolkits functionality.
* 
* This example makes use of the REST protocol to retrieve the RSS feeds
* and the search results.  Both are processed using XSLT.
* 
* The RSS resides in rss.php, and is integrated into the portal page
* using an iframe.
* 
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
 

// See this file for details on the web service, breadcrumb, and
// subject cluster features.
require "functions.php" ;	// Misc. Functions
require "profile.php" ;		// User Profile Inforamtion

// If there is no query set, then we display the index page.
if (!isset($_GET['query'])) {
        // Get the unformatted query string.
    $query_unformatted = "global warming";
} else {
    // Get the unformatted query string.
    $query_unformatted = $_GET['query'];
}
    // There is a query, so instead of loading the index page, we
    // need to create a query, return the results, and use an XSL
    // stylesheet to transform the results.
    
    $start = (isset($_GET["start"])) ? $_GET["start"] : 1;
    

    
    // The query will now be formatted into this format:
    //		from:	search terms
    //		to:		(search+terms+AND+FT+Y)
    
    // Force a full-text only search result.
    if (!preg_match('/ AND FT Y/', $query_unformatted))
        $query = $query_unformatted . ' AND FT Y';
    else
        $query = $query_unformatted;
    
    // Replace all spaces with plus signs.
    $query = str_replace(' ', '+', $query);
    
    // Insert parenthesis if they are not already in the string.  Checking the
    // first and last characters.
    if ($query[0] != '(')
        $query = '(' . $query;
    
    if ($query[ strlen($query) - 1 ] != ')')
        $query .= ')';
    
    // Retrieve the XML search file from the EIT Search Service.  See 'function curl_get()'
    // below for more details.
    $xml = curl_get(
        "http://eit.ebscohost.com/Services/SearchService.asmx/Search?prof="
        . $profile . "&pwd=" . $password . "&db=" . $database . "&query=" . $query
        . "&startrec=" . $start 
    );
    
    $xml_clust=curl_get(
        "http://eit.ebscohost.com/Services/SearchService.asmx/GetClusters?prof="
        . $profile . "&pwd=" . $password . "&db=" . $database . "&query=" . $query
        );
    
    //echo $xml;
    // Get rid of the default XML version information
    $xml = str_replace('<?xml version="1.0"?>', '', $xml);
    $xml_clust = str_replace('<?xml version="1.0"?>', '', $xml_clust);
    // Output the XML header, and use the search stylesheet 'search.xsl'.
    xml_header("search.xsl");
    preg_match('/<Hits xmlns=\"http:\/\/epnet.com\/webservices\/SearchService\/Response\/2007\/07\/\">(.+?)<\/Hits>/', $xml, $hits);
    $num_hits = $hits[1];
    //$num_hits = $hits[1];
    // If the query returned some search hits, we need to process some data
    // before we output the XML.

    // This "wrapper" enables us to give some information to the XSL stylesheet,
    // such as the query and the starting record number.
    
    if (!isset($_GET["qo"]))
        $query_original = $query_unformatted;
    else
        $query_original = $_GET["qo"];
    
    echo "<wrapper>\n";
    
    // The "query_original" field is used to display the original query in the search box.
    echo "<query_original>" . $query_original . "</query_original>\n";
    
    // This holds the actual formatted query.
    echo "<query>" . $query . "</query>\n"; 
    
    // Lowest and highest record number.
    echo "<min>" . $start . "</min>\n";
    echo "<max>" . ($start + 9) . "</max>\n";
    
    // Output Breadcrumbs.  This function returns the breadcrumbs in an
    // associative array.
    $breadcrumbs = breadcrumbs($query);
    
    echo '<breadcrumbs>' . "\n";
    
    foreach ($breadcrumbs as $bc_name=>$bc_query) {
        echo "\t" . '<bc name="' . $bc_name . '">' . $bc_query . '</bc>' . "\n";
    }
    
    echo '</breadcrumbs>' . "\n";
    
    // If there were no hits, we do not need to search for subject clusters.
    if ($num_hits > 0) {
        // Exlude subjects already in $breadcrumbs.
        $subjects = subject_clusters($query, $start, $breadcrumbs, $profile, $password, $database);
        
        // Print out the subject terms for the "Narrow Search" section.
        echo '<eit_subjects>' . "\n";
        foreach ($subjects as $term) {
            echo "\t" . '<eit_subject>' . $term . '</eit_subject>' . "\n";
        }
        echo '</eit_subjects>' . "\n";
    } 
    
    // Print out the XML search results returned from the web service.
    echo $xml;
    echo $xml_clust;
    
    echo '</wrapper>';


?>