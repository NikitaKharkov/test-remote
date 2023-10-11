<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_hl';
include( 'includes/navbar.php' );


?>
<h2>Health Library and the EBSCOhost Web Service API</h2>
<p>
	Retrieving Health Library content using the EIT: Web Service API can be achieved through the use of the Info, Search and Browse methods.   
	For most web service requests, you will specify a field code (e.g. ZT, AN) to indicate which field(s) will be targeted in the search in order 
	to provide the most precise search results.  All field codes specified must be in uppercase.  
</p>

<p>
	<a href="ws_howto_hl.php">The Health Library How-To page</a> will help you by offering applicable sample scenarios that you can use to configure your own applications. 
</p>

<div class="hr"></div>
<h3>Health Library Databases</h3>
<p>
	The following list of databases names and their respective codes comprise the Health Library database.
</p>
<ol>
	<li>Health Library English (hlt)</li>
	<li>Health Library Spanish (hls)</li>
	<li>Lexi-PALS English  (lpe)</li>
	<li>Lexi-PALS Spanish  (lps)</li>
	<li>Health News English  (nrcn)</li>
	<li>Health News Spanish  (hns)</li>
</ol>

<div class="hr"></div>
<h3>Using the Web Service</h3>
<p>
	The Web Service API supports the following methods for the Health Library databases:
</p>
<p class="indent">
	<a href="ws_api_info.php">Info</a>: Returns database information for databases available to a profile.
</p>
<p class="indent">
	<a href="ws_api_search.php">Search</a>: Performs a search and returns the results in multiple formats.
</p>
<p class="indent">
	<a href="ws_api_browse.php">Browse</a>: Browses a given index of a specific Health Library database.
</p>

<div class="hr"></div>
<h3>Web Service Protocols</h3>
<p>
	The EIT Web Service API is accessible by two different protocols: 
</p>

<p class="indent">
	<a href="ws_rest.php">Making Requests with REST</a>
</p><p class="indent">
	<a href="ws_soap.php">Making Requests with SOAP</a>
</p>

<p>
	To learn more about how EBSCO Publishing can serve all of a corporation's electronic 
	information needs <b><a href="http://www.ebscohost.com/thisTopic.php?marketID=6&amp;topicID=683" target="_blank">click here</a></b>.
</p>
<?php 

include( 'includes/footer.php' );

?>
