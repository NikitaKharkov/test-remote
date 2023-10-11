<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = '';
include( 'includes/navbar.php' );


?>
<div class="faq_quickSelect">
	<form>
	Jump to FAQ: <select name="faqQuickSelect" onChange="changePage( this.form.faqQuickSelect )">
		<option value="" selected >EBSCO Integration Toolkit</option>
		<option value="ws_faq.php" >Web Service</option>
		<option value="esi_faq.php">Enterprise Search</option>
		<option value="sbb_faq.php">Search Box</option>
		<option value="pl_faq.php">Persistent Links</option>
		<option value="widgets_faq.php">Widgets</option>
		<option value="rss_faq.php">RSS Feeds</option>
		<option value="ourl.php">OpenURL</option>
		<option value="z3950.php">Z39.50</option>
		<option value="sp_faq.php">SharePoint</option>
		<option value="lms_faq.php">LMS</option>
	</select>
	</form>
</div>

<div class="minHeight"></div>

<h2>EBSCO Integration Toolkit - FAQ</h2>

<div style="width: 600px">
	<h4>What is the EBSCO Integration Toolkit?</h4>
	<p>
		The EBSCO Integration Toolkit (EIT) is a flexible, XML-based web service designed to 
		seamlessly integrate EBSCOhost  content into corporate workflow and business 
		applications. EIT enables fast and cost-effective development of applications and 
		customized integration. 
	</p>
	
	<hr>

	<h4>What do I need to get started?</h4>
	<p> 
		We offer both simple and more specific integration services.  To get started
		quickly, we offer easy to use services such as <a href="rss.php">RSS Feeds</a>, 
		<a href="pl.php">Persistent Links</a>, and a <a href="sbb.php">Search Box Builder</a>.
	<p>
		To use our <a href="ws.php">Web Service</a>, you must have an EIT Profile (contact your
		account manager for more details).  Web Service users can download the EIT Web Service 
		DTD file, in <a href="docs/Word_EIT_WS_searchResponseDtd.zip" target="_blank">Word</a> or 
		<a href="docs/DTD_EIT_WS_searchResponse.zip" target="_blank">DTD</a> formats, to assist with EIT integration.
	</p>
	
	<hr>

	<h4>What Applications are Compatible with EIT?</h4>
	<p> 
		EBSCO Integration Toolkit is application and platform independent, and is 
		compatible with Microsoft SharePoint, IBM Web Sphere, Google Search Appliance, 
		etc. 
	</p>
</div>

<?php 

include( 'includes/footer.php' );

?>