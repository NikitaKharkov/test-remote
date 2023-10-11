<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'eds_api';
$page = 'eds_api';
include( 'includes/navbar.php' );


?>
<h2>EBSCO Discovery Service (EDS) API</h2>
<h3>What is the EDS API?</h3>
<p>
	EBSCO Discovery Service (EDS) gives users access to an institution's entire collection through one entry point: a search box. With the EBSCO Discovery Service (EDS) API, you can integrate search directly into your library or corporate portal. You can also search and browse full-text databases and popular databases from leading information providers.
</p>
<p>The EDS API is easy to integrate, allows libraries to customize a user interface, and provides extensive documentation and support.</p>
<div class="hr"></div>
<h3>Getting Started</h3>
<p>
	It is recommended that you have some knowledge of API integration, XML, and HTML/CSS to use the EDS API. If you prefer to use integration options that do not require a web development background, you can use RSS Feeds, Persistent Links, and the <a href="sbb.php">Search Box Builder</a>.
</p>
<p>
	In order to use the EDS API, you must be an EBSCO Discovery Service (EDS) Customer. <a href="mailto:eds@ebscohost.com">Contact your EBSCO sales representative</a> to enable your account for API access.
</p>

<div class="hr"></div>

<a name="eds"></a><h3>EDS API Protocol</h3>
<p>
	The EDS API is accessible by the REST protocol: 
</p>
<p class="indent">
	<b>REST: </b>An HTTP protocol which uses simple URLs to request data from the EDS API. This protocol is much simpler than SOAP. The REST protocol returns data in XML or JSON format.
</p>
<p>
	For full EDS API documentation, see the <a href="https://connect.ebsco.com/s/article/EBSCO-Discovery-Service-API-Documentation" target="_blank">EDS API on EBSCO Connect</a>.
</p>

<p><b>Please note</b>: In order to view the EDS API documentation, you will need an EBSCO Connect account. To request an account, <a href="https://connect.ebsco.com/s/contactsupport?language=en_US" target="_blank">contact EBSCO Customer Support</a>.</p>

<?php 

include( 'includes/footer.php' );

?>
