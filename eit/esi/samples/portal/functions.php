<?php
/**
* Define the functions needed.
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

/**
* Declaring XML header information
*
*@param string $skin mention link/refernce to a file.
*
* @return Specify XML header
*
*/ 
function xml_header($skin = 'index.xsl')
{
    header('Content-type: text/xml');
    
    echo "<?xml version='1.0' encoding='UTF-8'?>\n";
    echo "<?xml-stylesheet type='text/xsl' href='$skin'?>\n";
    echo "<!-- Copyright 2010 EBSCO Industries, Inc.  All rights reserved. -->\n";
}

/**
* This function uses cURL to retrieve data from an online document.  cURL is 
* standard in most PHP installations.  file_get_contents() may also be a substitute
* for this function.
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
    curl_setopt($rest_con, CURLOPT_HTTPPROXYTUNNEL, 0);
	
	//If Proxy is used,add the following curl parameters 
    /*curl_setopt($rest_con, CURLOPT_PROXY, 'http://mycompany.com:8080'); 
    curl_setopt($rest_con, CURLOPT_PROXYUSERPWD, 'mycompany\username:password'); 
    curl_setopt($rest_con, CURLOPT_PROXYAUTH, CURLAUTH_NTLM);*/
    
    $result = curl_exec($rest_con);
    curl_close($rest_con); 
    return $result;
}

/** This function will retrieve the subjects associated with a search
* and return the 10 most common subjects in a sorted array.  It does this
* by retrieving the 50 records closest to the current start record.
* 		$exclude is an associative array of items to not include in the
*		   returned subjects.  For any given $subject, if $exclude[ $subject ] is 
*		   set, then it, then it will not display that particular subject.
*
*@param string $query   Query to find matched records from the database
*
*@param string $start   Start point for records to be considered
*
*@param array  $exclude Array of Items to be excluded
*
*@param string $profile Profile ID for authentication
*
*@param string $pwd     Password for the mentioned Profile ID
*
*@param string $db      Database to be searched in.
*
*@return 10 most common subjects associated with a search in a sorted array
*
*/
function subject_clusters($query, $start, $exclude, $profile, $pwd, $db)
{
    $start_record = $start - 25;
    $start_record = ($start_record < 1) ? (24 - (25 - $start)) : (25);
    
    // Force a full-text only search result if it is checked.
    if (!preg_match('/ AND FT Y/', $query))
        $query .= ' AND FT Y';
    //Encrypt the query according to standards by replacing space by +
    $query = str_replace(' ', '+', $query);
    
    // Retrieve the XML search file from the EIT Search Service.  See 'function curl_get()'
    // below for more details.
    $xml = curl_get(
        "http://eit.ebscohost.com/Services/SearchService.asmx/Search?prof="
        . $profile . "&pwd=" . $pwd . "&db=" . $db . "&query=" . $query
        . "&startrec=" . ($start - $start_record) . "&numrec=50"
    );
    
    $subject_clusters = preg_match_all('/<subj type="thes">(.+?)<\/subj>/', $xml, $subjects);
    
    foreach ($subjects[1] as $subject) {
	
	if (!isset($exclude[ $subject ]) && !isset($exclude[ strtolower($subject) ])) {
        if (!isset($count[ $subject ])) {
                $count[ $subject ] = 1;
        } else {
        $count[ $subject ]++;
        }
        }
    }
    arsort($count);
    $i = 0;
    foreach ($count as $subject => $number) {
        if ($i >= 10)
            break;
       
        $i++;
		// Trim any extra information off of the end of the subject, and replace
        // any ampersands with &amp;
        $subject = explode('(', $subject);
        $subject_trimmed = $subject[0];
        
        // Trim any ampersands out of subjects, these cause problems with the HTML 
        $subject_trimmed = str_replace('&amp;', '', $subject_trimmed);
        
        $return_ar[ $i ] = $subject_trimmed;
    }
    return $return_ar;
}

/** This function creates an array of breadcrumbs using the formatted query
* string.  This function simply splits the query string using)+AND+(SU+ as
* a delimiter, which separates the terms by subject.
*		["breadcrumb name"] = "query string";
* where "query string" is the query relevant to that breadcrumb.
*
*@param string $query Query string to be converted into array of breadcrumbs
*
*@return Array of breadcrumbs
*
*/
function breadcrumbs($query)
{
    // Output the breadcrumbs into $breadcrumbs array
    //$breadcrumbs = explode(')+AND+(SU+', $query);
    $breadcrumbs = explode(')+AND+(', $query);
    
    // Number of breadcrumbs total
    $bc_count = count($breadcrumbs);
    
    // Counter to keep track of which breadcrumb is being processed.
    $item = 0;
    
    foreach ($breadcrumbs as $breadcrumb) {
        $item++;
        
        // Make Breadcrumbs Readable with replacing the standards
        $breadcrumb = str_replace('+', ' ', $breadcrumb);
        $breadcrumb = str_replace('(', '', $breadcrumb);
        $breadcrumb = str_replace(')', '', $breadcrumb);
        $breadcrumb = str_replace('+AND+FT+Y', '', $breadcrumb);
        $breadcrumb = str_replace(' AND FT Y', '', $breadcrumb);
        //Remove the Cluster Tag value if any
        // This is the query string.  Each breadcrumb will have its own
        // query string.
        $temp_query = '';
        
        // This loop builds the query up.  For the first breadcrumb, it will
        // only include the first query.  For the second breadcrumb, it will
        // include the first and second, etc.
        for ($i = 0; $i < $item; $i++) {
            $temp_query .= $breadcrumbs[$i];
            
            if ($i != ($item - 1))
                $temp_query .= ')+AND+(';
        }
        // If the last character is not a parenthesis, append one
        // onto the query.
        
        if ($temp_query[ strlen($temp_query) - 1 ] != ')') {
            $temp_query .= ')';
		}
        //trim the extra information of the cluster tags
        if ($item>1) {
        $breadcrumb = substr($breadcrumb,3);
        }
		$return_ar[ $breadcrumb ] = $temp_query;
    }
    return $return_ar;
}
