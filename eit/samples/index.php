<?php

// This will connect to the EIT via REST, retrieve the database information
// available for this profile, and display the databases.

// The DataService interface uses cURL to connect to the EIT and request
// the XML file.  See 'service.php'.

// Error reporting to all

error_reporting( E_ALL );

require_once( "service.php" );

// Get the current mode.
$mode = ( isset( $_GET["mode"] ) ? $_GET["mode"] : null );

if( $mode == null )
{
	eit_header();
	echo 'Please choose a database:<br/>';
	// Request Database Information
	$xmlDoc = new DataService;
	$xmlDoc->connect( "http://eit.ebscohost.com/Services/SearchService.asmx/", "webdes.eit.bbates", "ebsco" );
	$xmlDoc->send( "Info", null );
	
	$xml = $xmlDoc->recieve();
	
	$xmlObj = new DOMDocument();
	$xmlObj->loadXML( $xml );
	$databases = $xmlObj->getElementsByTagName( "db" );
	
	foreach( $databases as $database )
	{
		if( $database->getAttribute( "xsi:type" ) == null )
			print( '<a href="index.php?mode=search&db=' . $database->getAttribute("shortName") . '">'
			. $database->getAttribute("longName") . '</a><br>' );
		
	}
	eit_footer();
} else if( $mode == "search" )
{	
	$xmlDoc = new DataService;
	$xmlDoc->connect( "http://eit.ebscohost.com/Services/SearchService.asmx/", "webdes.eit.bbates", "ebsco" );
	$xmlDoc->send( "Info", null );
	
	$xml = $xmlDoc->recieve();
	
	$xmlObj = new DOMDocument();
	$xmlObj->loadXML( $xml );
	$databases = $xmlObj->getElementsByTagName( "db" );
	
	
	// Get all of the needed database information.
	
	$db_found = false;
	
	foreach( $databases as $database )
	{
		if( !isset( $_GET["db"]) )
			die( header( "Location: index.php" ) );
			
		if( $database->getAttribute("shortName") == $_GET["db"] )
		{
			$db_found = true;
			$db_name = $database->getAttribute("longName");
			$db_short = $_GET["db"];
			
			
			// Here we are going to build the select boxes.  Note that
			// each database has authority databases, and these authorities have
			// additional indices/tags.  In order to avoid listing these, we
			// only use the first instance of each.
			
			$index_options = '<select name="index">';
			$tag_options = '<select name="t:n:">';		// The :n: will be replaced.
			$sort_options = '<select name="sort">';
			
			
			$dbIndex = $database->getElementsByTagName( "dbIndices" );
			$dbIndex = $dbIndex->item(0);
			$dbIndex = $dbIndex->getElementsByTagName( "dbIndex" );
			foreach( $dbIndex as $index )
			{
				$index_options .= '<option value="' . $index->getAttribute("name")
					. '">' . $index->getAttribute("description") . '</option>';
			}
			
			// Tags
			
			$dbTag = $database->getElementsByTagName( "dbTags" );
			$dbTag = $dbTag->item(0);
			$dbTag = $dbTag->getElementsByTagName( "dbTag" );
			foreach( $dbTag as $tag )
			{
				$tag_options .= '<option value="' . $tag->getAttribute("name")
					. '">' . $tag->getAttribute("description") . '</option>';
			}
			
			// Sorting
			
			$sortOption = $database->getElementsByTagName( "sortOptions" );
			$sortOption = $sortOption->item(0);
			$sortOption = $sortOption->getElementsByTagName( "sort" );
			foreach( $sortOption as $sort )
			{
				$sort_options .= '<option value="' . $sort->getAttribute("id")
					. '">' . $sort->getAttribute("name") . '</option>';
			}
			
			$index_options .= '</select>';
			$tag_options .= '</select>';
			$sort_options .= '</select>';
			
			// We have the all the database information necessary to render
			// the search interface.
		}
	}
	
	if( !$db_found )
		die( header( "Location: index.php" ) );
		
	eit_header();
	echo '
<a href="index.php">Database:</a> ' . $db_name . '
<hr align="left" width="500px"/>
Index Browse
<table>
	<tr>
		<td>
			Index:
		</td>
		<td>
			' . $index_options . '
		</td>
	</tr>
	<tr>
		<td>
			Browse for:
		</td>
		<td>
			<input type="text" name="browse"/><br/>
		</td>
	</tr>
</table>
<input type="submit" value="Browse"/>
<hr align="left" width="500px"/>
Standard Search:<br/>

<form action="index.php" method="GET" name="search">
<input type="hidden" name="mode" value="exec"/>
<input type="hidden" name="db" value="' . $db_short . '"/>
<table>
	<tr>
		<td>
			Find:
		</td>
		<td>
			<input type="text" name="s1">
		</td>
		<td>
			in ' . str_replace(":n:", "1", $tag_options ) . '
		</td>
	</tr>
	<tr>
		<td>
			<select name="d1">
				<option value="AND">AND</option>
				<option value="OR">OR</option>
				<option value="NOT">NOT</option>
			</select>
		</td>
		<td>
			<input type="text" name="s2">
		</td>
		<td>
			in ' . str_replace(":n:", "2", $tag_options ) . '
		</td>
	</tr>
	<tr>
		<td>
			<select name="d2">
				<option value="AND">AND</option>
				<option value="OR">OR</option>
				<option value="NOT">NOT</option>
			</select>
		</td>
		<td>
			<input type="text" name="s3">
		</td>
		<td>
			in  ' . str_replace(":n:", "3", $tag_options ) . '
		</td>
	</tr>
	<tr>
		<td>
			<select name="d3">
				<option value="AND">AND</option>
				<option value="OR">OR</option>
				<option value="NOT">NOT</option>
			</select>
		</td>
		<td>
			<input type="text" name="s4">
		</td>
		<td>
			in  ' . str_replace(":n:", "4", $tag_options ) . '
		</td>
	</tr>
	<tr>
		<td>
			Sort By:
		</td>
		<td align="left" colspan="2">
			 ' . $sort_options . '
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<input type="submit" value="Search"/>
		</td>
	</tr>
</table>
';
	
	eit_footer();
} else if( $mode == "exec" )
{
	// Execute search query and return results.
	
	// Search Terms
	$s1 = $_GET["s1"];
	$s2 = $_GET["s2"];
	$s3 = $_GET["s3"];
	$s4 = $_GET["s4"]; 
	
	// Delimiters
	$d1 = $_GET["d1"];
	$d2 = $_GET["d2"];
	$d3 = $_GET["d3"];
	
	// Tags
	$t1 = $_GET["t1"];
	$t2 = $_GET["t2"];
	$t3 = $_GET["t3"];
	$t4 = $_GET["t4"];
	
	// Other
	$db = $_GET["db"];
	$sort = $_GET["sort"];
	$start = ( isset( $_GET["start"] ) ? $_GET["start"] : 1 );
	
	// No search terms, go back to select DB
	if( !$s1 && !$s2 && !$s3 && !$s4
		|| !$db )
		die( header( "Location: index.php") );
	
	$link = 'index.php?mode=exec&db=' . $db . '&sort=' . $sort . '&s1='
			. $s1 . '&s2' . $s2 . '&s3=' . $s3 . '&s4=' . $s4 . '&t1=' 
			. $t1 . '&t2=' . $t2 . '&t3=' . $t3 . '&t4=' . $t4 . '&d1=' 
			. $d1 . '&d2=' . $d2 . '&d3=' . $d3;
		
		
	// Query Build Algorithm
	$s1 = str_replace( " ", "+", $s1 );
	$s1 = ( $s1 != null ) ? ( '(' . $t1 . '+(' . $s1 . '))' ) : null;
	
	$s2 = str_replace( " ", "+", $s2 );
	$s2 = ( $s2 != null ) ? ( '(' . $t2 . '+(' . $s2 . '))' ) : null;
	
	$s3 = str_replace( " ", "+", $s3 );
	$s3 = ( $s3 != null ) ? ( '(' . $t3 . '+(' . $s3 . '))' ) : null;
	
	$s4 = str_replace( " ", "+", $s4 );
	$s4 = ( $s4 != null ) ? ( '(' . $t4 . '+(' . $s4 . '))' ) : null;
	
	$q = $s1 . ( ( $s1 != null && $s2 != null ) ? ('+' . $d1 . '+') : null ) . 
		 $s2 . ( ( $s2 != null && $s3 != null ) ? ('+' . $d2 . '+') : null ) .
		 $s3 . ( ( $s3 != null && $s4 != null ) ? ('+' . $d3 . '+') : null ) .
		 $s4;
	
	eit_header();	

	$top_result = $start + 9;
	
	// Query ready.
	$xmlDoc = new DataService;
	$xmlDoc->connect( "http://eit.ebscohost.com/Services/SearchService.asmx/", "webdes.eit.bbates", "ebsco" );
	
	// Build Parameters
	$params = array(
		"query" => $q,
		"startrec" => $start,
		"db" => $db,
		"sort" => $sort
	);
	
	$xmlDoc->send( "Search", $params );
	$xml = $xmlDoc->recieve();
	
	$xmlObj = new DOMDocument();
	$xmlObj->loadXML( $xml );
	
	$records = $xmlObj->getElementsByTagName( "rec" );
	
	$hits = $xmlObj->getElementsByTagName( "Statistics" )
			 	   ->item(0)->getElementsByTagName( "Hits" )
			 	   ->item(0)->nodeValue;
	
	$page_string = '';
	
	if( $start > 1 )
	{
		$page_string .= ' <a href="' . $link . '&start='
			. ($start - 10) . '">Prev</a> ';
	} else
	{
		$page_string .= ' Prev ';
	}
	
	$page_string .= ' | ';
	
	if( $start < ceil( $hits/10 ) )
	{
		$page_string .= ' <a href="' . $link . '&start='
			. ($start + 10) . '">Next</a> ';
	} else
	{
		$page_string .= ' Next ';
	}
	
	echo '
	<a href="index.php?mode=search&db=' . $db . '">&lt; Back to Search
	<table border="1" width="600px">
	<tr>
		<th>
			<h3>Search Results for: ' . $q . '</h3>
			Results ' . $start . ' to ' . $top_result . ' of '
			 . $hits . '<br/>' . $page_string . '
		</th>
	</tr>
	
	';
	
	foreach( $records as $record )
	{
		$info_str = "By: ";
		$authors = $record->getElementsByTagName( "au" );
		foreach( $authors as $author )
		{
			$info_str .= $author->nodeValue . '; ';
		}
		
		$info_str .= $record->getElementsByTagName( "jtl" )->item(0)->nodeValue . ', ';
		$info_str .= $record->getElementsByTagName( "dt" )->item(0)->nodeValue . ', ';
		
		$abstract = $record->getElementsByTagName( "ab" )->item(0)->nodeValue;
		
		echo '<tr><td><font style="font-weight: bold;"><a href="'
		  . $record->getElementsByTagName( "plink" )->item(0)->nodeValue . '">'
		  . $record->getElementsByTagName( "atl" )->item(0)->nodeValue
		  . '</a></font><br/><i>' . $info_str . '</i>'
		  . '<br/>' . substr( $abstract, 0, 200 ) . '...';
		
		echo '<br/><br/>Subjects: <br/>';
		
		$subjects = $record->getElementsByTagName( "su" );
		foreach( $subjects as $subject )
		{
			echo $subject->nodeValue . ', ';
		}
		
		echo '</td></tr>';
	}	
	eit_footer();	  
}


function eit_header()
{
	echo '<html>
<head>
<title>Search EBSCOhost</title>
</head>
<body>';
}

function eit_footer()
{
	echo '</body>
	</html>';
}
