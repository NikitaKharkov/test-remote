<?php
/* 
 * This example provides a fake company portal, and conveys the possible
 * uses of the EBSCOhost Integration Toolkits functionality.
 * 
 * This example makes use of the REST protocol to retrieve the RSS feeds
 * and the search results.  Both are processed using XSLT.
 * 
 * The RSS resides in rss.php, and is integrated into the portal page
 * using an iframe.
 * 
 */ 

// Profile and password information
$profile 	= "webdes.eit.bbates";
$pwd		= "ebsco";

// If there is no query set, then we display the index page.
if( !isset( $_GET['query'] ) )
{
	// We do not need to connect to the server.  We simply just
	// put out XML headers, and use the default XSL stylesheet.

	// index.xsl is the portal stylesheet.
	xml_header( 'index.xsl' );
	
	echo '<no_data></no_data>';
} else
{		
	// There is a query, so instead of loading the index page, we
	// need to create a query, return the results, and use an XSL
	// stylesheet to transform the results.
	
	// Make sure the query is not empty.
	if( $_GET['query'] == '' )
		die( header( "Location: business_eit.php" ) );
	
	// Database to search
	$db = "a9h";
	
	$start = (isset( $_GET["start"])) ? $_GET["start"] : 1;
	
	// Get the unformatted query string.
	$query_unformatted = $_GET['query'];
	
	// The query is now formatted into this format:
	//		from:	search terms
	//		to:		(search+terms+AND+FT+Y)
	
	// Force a full-text only search result.
	if( !preg_match('/ AND FT Y/', $query_unformatted ) )
		$query = $query_unformatted . ' AND FT Y';
	else
		$query = $query_unformatted;
	
	// Replace all spaces with plus signs.
	$query = str_replace( ' ', '+', $query );
	
	// Insert parenthesis if they are not already in the string.  Checking the
	// first and last characters.
	if( $query[0] != '(' )
		$query = '(' . $query;
	
	if( $query[ strlen( $query ) - 1 ] != ')' )
		$query .= ')';
	
	// Retrieve the XML search file from the EIT Search Service.  See 'function curl_get()'
	// below for more details.
	$xml = curl_get( "http://eit.ebscohost.com/Services/SearchService.asmx/Search?prof="
				. $profile . "&pwd=" . $pwd . "&db=" . $db . "&query=" . $query
				. "&startrec=" . $start );
	
	// Get rid of the default XML version information
	$xml = str_replace('<?xml version="1.0"?>', '', $xml );
	
	// Output the XML header, and use the search stylesheet 'search.xsl'.
	xml_header( "search.xsl" );
	
	preg_match('/<Hits>(.+?)<\/Hits>/', $xml, $hits );
	$num_hits = $hits[1];
	
	// If the query returned some search hits, we need to process some data
	// before we output the XML.

	// This "wrapper" enables us to give some information to the XSL stylesheet,
	// such as the query and the starting record number.
	
	if( !isset( $_GET["qo"] ) )
		$query_original = $query_unformatted;
	else
		$query_original = $_GET["qo"];
	
	echo "<wrapper>\n";
	echo "<query_original>" . $query_original . "</query_original>\n";
	echo "<query>" . $query . "</query>\n"; 
	echo "<min>" . $start . "</min>\n";
	echo "<max>" . ( $start + 9 ) . "</max>\n";
	
	// Output Breadcrumbs.  This function returns the breadcrumbs in an
	// associative array.
	$breadcrumbs = breadcrumbs( $query );
	
	echo '<breadcrumbs>' . "\n";
	
	foreach( $breadcrumbs as $bc_name=>$bc_query )
	{
		echo "\t" . '<bc name="' . $bc_name . '">' . $bc_query . '</bc>' . "\n";
	}
	
	echo '</breadcrumbs>' . "\n";
	
	// If there were no hits, we do not need to search for subject clusters.
	if( $num_hits > 0 )
	{
		$subjects = subject_clusters( $query, $start );
		
		// Print out the subject terms for the "Narrow Search" section.
		echo '<eit_subjects>' . "\n";
		foreach( $subjects as $term )
		{
			echo "\t" . '<eit_subject>' . $term . '</eit_subject>' . "\n";
		}
		echo '</eit_subjects>' . "\n";
	}
	
	// Print out the XML search results returned from the web service.
	echo $xml;
	
	echo '</wrapper>';
}

// Declaring XML header information
function xml_header( $skin = 'index.xsl' )
{
    header('Content-type: text/xml');
    
    echo "<?xml version='1.0' encoding='UTF-8'?>\n";
    echo "<?xml-stylesheet type='text/xsl' href='$skin'?>\n";
    echo "<!-- Copyright 2010 EBSCO Industries, Inc.  All rights reserved. -->\n";
}

// This function uses cURL to retrieve data from an online document.  cURL is 
// standard in most PHP installations.  file_get_contents() may also be a substitute
// for this function.
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

// This function will retrieve the subjects associated with a search
// and return the 10 most common subjects in a sorted array.  It does this
// by retrieving the 50 records closest to the current start record.
function subject_clusters( $query, $start )
{
	global $profile, $pwd, $db;
	
	$start_record = $start - 25;
	$start_record = ( $start_record < 1 ) ? ( 24 - ( 25 - $start ) ) : ( 25 );
	
	// Force a full-text only search result.
	if( !preg_match('/ AND FT Y/', $query ) )
		$query .= ' AND FT Y';
	
	$query = str_replace( ' ', '+', $query );
	
	// Retrieve the XML search file from the EIT Search Service.  See 'function curl_get()'
	// below for more details.
	$xml = curl_get( "http://eit.ebscohost.com/Services/SearchService.asmx/Search?prof="
				. $profile . "&pwd=" . $pwd . "&db=" . $db . "&query=" . $query
				. "&startrec=" . ( $start - $start_record ) . "&numrec=50" );
				
	$subject_clusters = preg_match_all('/<su>(.+?)<\/su>/', $xml, $subjects );
	
	foreach( $subjects[1] as $subject )
	{
		if( !isset( $count[ $subject ]) )
			$count[ $subject ] = 0;
			
		
		$count[ $subject ]++;
	}
	
	arsort( $count );
	
	$i = 0;
	foreach( $count as $subject => $number )
	{
		if( $i >= 10 )
			break;
		
		$i++;
		
		// Trim parenthesis, as these will cause the EBSCOhost search engine
		// to throw an error back.
		$subject = str_replace( '(', '', $subject );
		$subject = str_replace( ')', '', $subject );
		
		$return_ar[ $i ] = $subject;
	}
	
	return $return_ar;
}

// This function creates an array of breadcrumbs using the formatted query
// string  These "breadcrumbs" are the different subjects which the user uses
// to narrow down the search.  The return format is:
//		["breadcrumb name"] = "query string";
function breadcrumbs( $query )
{
	// Output the breadcrumbs
	$breadcrumbs = explode( ')+AND+(SU', $query );
	
	// Number of breadcrumbs total
	$bc_count = count( $breadcrumbs );
	
	// Counter to keep track of which breadcrumb is being processed.
	$item = 0;
	
	foreach( $breadcrumbs as $breadcrumb )
	{
		$item++;
		
		// Make Breadcrumbs Readable
		$breadcrumb = str_replace( '+', ' ', $breadcrumb );
		$breadcrumb = str_replace( '(', '', $breadcrumb );
		$breadcrumb = str_replace( ')', '', $breadcrumb );
		$breadcrumb = str_replace( '+AND+FT+Y', '', $breadcrumb );
		$breadcrumb = str_replace( ' AND FT Y', '', $breadcrumb );
		
		$temp_query = '';
		
		for( $i = 0; $i < $item; $i++ )
		{
			$temp_query .= $breadcrumbs[$i];
			
			if( $i != ($item - 1) )
				$temp_query .= ')+AND+(SU';
				
		}
		// If the last character is not a parenthesis, append one
		// onto the query.
		
		if( $temp_query[ strlen( $temp_query) - 1 ] != ')' )
			$temp_query .= ')';

		$return_ar[ $breadcrumb ] = $temp_query;
	}
	
	return $return_ar;
}

?>