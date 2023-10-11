<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'openurl';
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
		<option value="" selected >OpenURL</option>
		<option value="z3950.php">Z39.50</option>
		<option value="sp_faq.php">SharePoint</option>
		<option value="lms_faq.php">LMS</option>
	</select>
	</form>
</div>

<h2>OpenURL - FAQ</h2>

<div class="faq_area">
	<ul>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=996"  target="_blank">What is OpenURL and how does it relate to EBSCO?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5130" target="_blank">What version of the OpenURL standard is EBSCOhost compatible with?</a></li>		
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5131" target="_blank">What EBSCOhost content is available via EBSCOhost OpenURL?</a></li>
		
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5132" target="_blank">Where is EBSCOhost's OpenURL Server located?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5133" target="_blank">What is the correct syntax to build an OpenURL Request to EBSCOhost?</a></li>		
	</ul>
</div>

<div style="clear: both"></div>
<?php 

include( 'includes/footer.php' );

?>