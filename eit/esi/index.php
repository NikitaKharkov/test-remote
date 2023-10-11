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
	The EBSCOhost Integration Toolkit enables users to access 
	premium business content from within enterprise search applications, corporate portals, and
	intranets.  The EBSCOhost Integration Toolkit allows corporate information professionals and IT
	experts to provide employees with the best content in the optimal online environment... the one
	already in use!
</p>

<br>

<div id="links">
	<div class="description_box">
		<h3><a href="ws.php">Web Service</a></h3>
		<a class="feature_ws_image" href="ws.php"></a>
		EBSCO Web Service is a SOAP and REST compatible Web service 
		used to establish direct links from an ESA to databases 
		from EBSCO. The web service can be used, for example, to build 
		custom a EBSCOhost business database search interface for a 
		company portal.
	</div>
	<div class="description_box">
		<h3><a href="rss.php">RSS Feeds</a></h3>
		<a class="feature_rss_image" href="rss.php"></a>
		Users can set up continuously updating RSS-based content feeds from EBSCO databases.  Use
		this to link directly to relevant content on a library homepage, for example.  Links lead
		directly to the EBSCOhost Interface.
	</div>
	<div class="description_box">
		<h3><a href="sbb.php">Search Box Builder</a></h3>
		<a class="feature_sbb_image" href="sbb.php"></a>
		Choose your search parameters and customize your search box size and style to fit your site.  Integrate
		it directly into your website to allow users to access premium content quickly!  Multiple styles and
		customization options available.
	</div>
	
	<div class="description_box_separator"></div>
	
	<div class="description_box">
		<h3><a href="pl.php">Persistent Links</a></h3>
		<a class="feature_pl_image" href="pl.php"></a>
		Users can embed persistent links to specific articles from EBSCO 
		business databases into a portal or intranet. This feature can be 
		used, for example, to provide links to company profiles on your portal.
	</div>
	
	<div class="description_box">
		<h3><a href="widgets.php">Widgets</a></h3>
		<a class="feature_widgets_image" href="widgets.php"></a>
		Users can integrate EBSCO databases into a library ILS using the Z39.50 protocol.  It is also a NISO standard, developed
		by the library community.  It can be used to create a client search application, for example.
	</div>
	
	
	<!--<div class="description_box">
		<h3><a href="esi.php">Search Integration</a></h3>
		<a class="feature_esi_image" href="esi.php"></a>
		Users see EBSCO results within an integrated result list in combination 
		with other corporate and local content. Database metadata is available for 
		local indexing, and can be integrated into commercial software products such 
		as Google OneBox.
	</div>-->
	
	<div class="description_box_separator"></div>
	
	<div class="description_box">
		<h3><a href="sp.php">SharePoint</a></h3>
		<a class="feature_sp_image" href="sp.php"></a>
		Embed the EBSCOhost experience or provide direct article access within SharePoint through Web Parts.
		Improve your company portal by integrating EBSCO's rich content directly into your interface.
	</div>
	
	<div class="description_box">
		<h3><a href="ourl.php">OpenURL</a> &amp; <a href="z3950.php">Z39.50</h3>
		<a class="feature_z3950_image" href="ourl.php"></a>
		OpenURL linking enables users to integrate EBSCO products into the their information systems and 
		architecture. <br /><br />Users can integrate EBSCO databases into a library ILS using the Z39.50 protocol. 
		It is also a NISO standard, developed by the library community. 
	</div>
	<div class="description_box">
		<h3><a href="lms.php">LMS</a></h3>
		<a class="feature_lms_image" href="lms.php"></a>
		Import SCORM-compliant courseware from EBSCO's premium content collections into your LMS.  
		All LMS content is sourced from the industry's most credible authorities, such as American 
		Bar Association, Business Week, CFA Institute, Forbes and Business 2.0.
	</div>
</div>

<?php 

include( 'includes/footer.php' );

?>