<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'sharepoint';
$page = 'sp_faq';
include( 'includes/navbar.php' );


?>
<div class="minHeight"></div>
<div class="faq_quickSelect">
	<form>
	Jump to FAQ: <select name="faqQuickSelect" onChange="changePage( this.form.faqQuickSelect )">
		<option value="faq.php">EBSCO Integration Toolkit</option>
		<option value="ws_faq.php" >Web Service</option>
		<option value="esi_faq.php">Enterprise Search</option>
		<option value="pl_faq.php">Persistent Links</option>
		<option value="widgets_faq.php">Widgets</option>
		<option value="rss_faq.php">RSS Feeds</option>
		<option value="ourl.php">OpenURL</option>
		<option value="z3950.php">Z39.50</option>
		<option value="" selected >SharePoint</option>
		<option value="lms_faq.php">LMS</option>
	</select>
	</form>
</div>
<h2>Sharepoint - FAQ</h2>
<ul>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5119" target="_blank">What types of Web Parts are available?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5129" target="_blank">Which versions of SharePoint are supported?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5120" target="_blank">Can I use EBSCO's Web Parts as-is when embedding EBSCOhost into SharePoint??</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5121" target="_blank">What kind of EBSCOhost functionality is available through the Web Parts?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5122" target="_blank">Is there any documentation available to help me implement the Web Parts?</a></li>
	
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5123" target="_blank">Can I create my own Web Parts?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5124" target="_blank">How do I know if EBSCO provides Web Parts support for my database subscription?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5125" target="_blank">Can SharePoint be the primary access point to EBSCOhost for my users?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5126" target="_blank">Will I need to change my authentication settings in EBSCOadmin to support use of the Web Parts?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5127" target="_blank">Will I need to configure new permissions in SharePoint to support EBSCO's Web Parts?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5128" target="_blank">How many EBSCO Web Parts can be deployed at any 1 time?</a></li>
	
</ul>
	

<?php 

include( 'includes/footer.php' );

?>