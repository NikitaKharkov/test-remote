<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = '';
include( 'includes/navbar.php' );


?>

<h2>EBSCOhost Integration Toolkit&trade;</h2>

<p>
	The EBSCO<i>host</i> Integration Toolkit enables users to access premium business content from within enterprise search applications, corporate portals, and intranets. The EBSCO<i>host</i> Integration Toolkit allows corporate information professionals and IT experts to provide employees with the best content in the optimal online environment... the one already in use!
</p>

<br>

<div id="links">
	<div class="description_box">
		<h3><a href="api.php">EBSCO Discovery Service (EDS) API</a></h3>
		<a class="feature_edsapi_image" href="api.php"></a>
			The EDS API is a REST-compatible API that provides access to an entire institution's collection through one entry point: a search box. With the EDS API, you can integrate search directly into your website to search and browse full-text databases from leading information providers. 
	</div>
	<div class="description_box">
		<h3><a href="https://connect.ebsco.com/s/article/EBSCOhost-API" target="_blank">EBSCO<i>host</i> API</a></h3>
		<a class="feature_ws_image" href="https://connect.ebsco.com/s/article/EBSCOhost-API" target="_blank"></a>
			The EBSCO<i>host</i> API is a SOAP- and REST- compatible API used to establish links to EBSCO<i>host</i> databases. With the EBSCO<i>host</i> API, you can add an EBSCO<i>host</i> database search to your website or company portal. 
	</div>
	<div class="description_box">
		<h3><a href="sbb.php">Search Box Builder</a></h3>
		<a class="feature_sbb_image" href="sbb.php"></a>
		Choose your search parameters and customize your search box size and style to fit your website. Integrate it directly into your website to allow users to access premium content quickly. Multiple styles and customization options are available. 
	</div>
	
	<div class="description_box_separator"></div>
	
	
</div>

<?php 

include( 'includes/footer.php' );

?>