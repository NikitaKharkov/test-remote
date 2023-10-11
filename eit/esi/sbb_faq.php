<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'sbb';
$page = 'sbb_faq';
include( 'includes/navbar.php' );


?>
<div class="minHeight"></div>

<div class="faq_quickSelect">
	<form>
	Jump to FAQ: <select name="faqQuickSelect" onChange="changePage( this.form.faqQuickSelect )">
		<option value="faq.php">EBSCO Integration Toolkit</option>
		<option value="ws_faq.php" >Web Service</option>
		<option value="esi_faq.php">Enterprise Search</option>
		<option value="sbb_faq.php">Search Box</option>
		<option value="pl_faq.php">Persistent Links</option>
		<option value="widgets_faq.php">Widgets</option>
		<option value="" selected >RSS Feeds</option>
		<option value="ourl.php">OpenURL</option>
		<option value="z3950.php">Z39.50</option>
		<option value="sp_faq.php">SharePoint</option>
		<option value="lms_faq.php">LMS</option>
	</select>
	</form>
</div>

<h2>Search Box - FAQ</h2>

<div style="faq_area">
	</p>
	<ul>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?topic=937&id=3955" target="_blank">How do I embed an EBSCOhost search box on to my website?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?faq=4676" target="_blank">How do I create an EBSCOhost search box with a date range option?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=1255" target="_blank">EBSCOhost Database Short Names List (Product Codes)</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4397" target="_blank">Can I create a search box to search for Country Reports in EBSCO's Business Source databases?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4295" target="_blank">How do I use the EBSCO Search Box Builder tool?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5027" target="_blank">How can I change the database order for my EBSCOhost Search Box?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4968" target="_blank">Using EBSCO's Search Box Builder Tool Tutorial</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4898" target="_blank">How can I create an EBSCOhost Search box using HTML instead of JavaScript?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5469" target="_blank">How can I create a subject-specific search box for my institution's web site?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5478" target="_blank">How can I create an HTML only subject-specific search box for my institution's web site?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5479" target="_blank">How can I create an HTML subject-specific search box with limiters for my institution's web site?</a></li>
	</ul>
</div>

<div style="clear: both"></div>

<?php 

include( 'includes/footer.php' );

?>