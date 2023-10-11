<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'enterprise_search';
$page = 'esi_faq';
include( 'includes/navbar.php' );


?>
<div class="minHeight"></div>

<div style="float: right">
	<form>
	Jump to FAQ: <select name="faqQuickSelect" onChange="changePage( this.form.faqQuickSelect )">
		<option value="faq.php">EBSCO Integration Toolkit</option>
		<option value="ws_faq.php" >Web Service</option>
		<option value="" selected >Enterprise Search</option>
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

<h2>Enterprise Search Integration - FAQ</h2>
<p></p>
<div id="faq">
	<ul>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4036" target="_blank">What is EBSCOhost Integration Toolkit: Enterprise Search Integration?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4035" target="_blank">What is an Enterprise Search Application?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4034" target="_blank">How will EBSCOhost content be accessed by EBSCOhost Integration Toolkit: Enterprise Search Integration?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4033" target="_blank">Which databases are supported by EBSCOhost Integration Toolkit: Enterprise Search Integration?</a></li>
	</ul>
</div>
<div style="clear: both"></div>

<?php 

include( 'includes/footer.php' );

?>