<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws';
include( 'includes/navbar.php' );


?>
<h2>EBSCOhost Web Service API</h2>
<p>
	As part of the EBSCOhost Integration Toolkit, we offer the EBSCOhost Web Service API.  The EIT Web
	Service is great if you'd like to integrate EBSCOhost's search directly into your website.  For example,
	pull search results directly into your library or corporate portal for ease of use, or use the Web Service
	to display similar results to a search.
</p>
<p>
	Using the EIT Web Service API, you can search and browse
	full text databases and popular databases from leading information providers. The comprehensive
	databases range from general reference collections to specially designed, subject-specific 
	databases for healthcare organizations.
</p>
<p>
	The EIT Web Service API also supports EBSCOhost Discovery Service (EDS).  <a href="#eds">Click here</a>
	for more information.
</p>

<div class="hr"></div>
<h3>Getting Started</h3>
<p>
	In order to use the EIT Web Service API, you must have an EIT profile.  If you do not have an EIT
	profile, or are not sure if you have one, contact your account manager for details on getting one.
</p>
<p>
	Most of our databases support the EIT Web Service API. <a href="http://support.epnet.com/knowledge_base/detail.php?id=3783" target="_blank">Click here</a> 
	to check if the database(s) you want to use are compatible with the EIT Web Service API.  
</p>
<p>
	It is recommended that you have some knowledge of web services, XML, and HTML/CSS to use the
	EIT Web Service API.  If you prefer to use integration options that do not require a
	programming background, you can use <a href="rss.php">RSS Feeds</a>, <a href="pl.php">Persistent Links</a>, and
	the <a href="sbb.php">Search Box Builder</a>.
</p>

<div class="hr"></div>
<h3>Using the Web Service</h3>
<p>
	The Web Service API supports the following methods:
</p>
<p class="indent">
	<a href="ws_api_info.php">Info</a>: Returns database information for databases available to a profile.
</p>
<p class="indent">
	<a href="ws_api_search.php">Search</a>: Performs a search and returns the results in multiple formats.
</p>
<p class="indent">
	<a href="ws_api_search_eds.php">Search (EDS)</a>: For EDS-enabled profiles.  Performs a search and returns the results in multiple formats.
</p>
<p class="indent">
	<a href="ws_api_search_ehis.php">Search (EHIS)</a>: This is the EBSCOhost Integrated Search version of the search method.  Performs a search and returns the results in multiple formats.
</p>
<p class="indent">
	<a href="ws_api_browse.php">Browse</a>: Browses a given index of a database.
</p>
<p class="indent">
	<a href="ws_api_authority.php">AuthoritySearch</a>: Searches an authority of a given database.
</p>

<div class="hr"></div>
<a name="eds"></a><h3>Web Service with EDS</h3>
<p>
	The EBSCOhost Web Service supports EBSCOhost Discovery Service enabled profiles.  To find out
	more about EDS, go to the <a href="http://support.ebscohost.com/eds">EDS Website</a>.  If you
	have EBSCOhost Discovery Service, you must have an EDS-enabled Web Service profile.  If you
	would like to get an EDS-enabled profile, contact your EBSCO Publishing Account Manager.
</p>
<p>
	An EDS-enabled Web Service profile only supports the <a href="ws_api_search_eds.php">Search</a> method
	of the Web Service.  To view the differences when searching using an EDS-enabled profile,
	<a href="ws_api_search_eds.php#a">click here</a>.
</p>

<div class="hr"></div>
<h3>Web Service Protocols</h3>
<p>
	The EIT Web Service API is accessible by two different protocols: 
</p>
<p class="indent">
	<b>REST: </b>An HTTP protocol which uses simple URL's to request data from the EIT Web Service API.
	This protocol is much simpler than SOAP.
</p>
<p class="indent">
	<b>SOAP: </b>An HTTP protocol which uses XML messaging to request data from the EIT Web Service API.
	This protocol is more complicated than REST, but may be easily supported on more platforms. 
</p>
<p>
	Both protocols return data from the EBSCOhost Databases in XML format.
	The intent of our interface is to provide XML to the caller and allow that caller to apply a 
	style-sheet of their choosing.
</p>
<p>
	Once you decide which protocol is best for your specific needs, you can learn more about
	how to use it with the EIT Web Service API here:
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
