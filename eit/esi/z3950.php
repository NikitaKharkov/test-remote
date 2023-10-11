<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'z39.50';
$page = 'faq';
include( 'includes/navbar.php' );


?>
<div style="float: left; height: 600px; width: 1px;"></div>
<div style="float: right">
	<form>
	Jump to FAQ: <select name="faqQuickSelect" onChange="changePage( this.form.faqQuickSelect )">
		<option value="faq.php">EBSCO Integration Toolkit</option>
		<option value="ws_faq.php" >Web Service</option>
		<option value="esi_faq.php">Enterprise Search</option>
		<option value="pl_faq.php">Persistent Links</option>
		<option value="widgets_faq.php">Widgets</option>
		<option value="rss_faq.php">RSS Feeds</option>
		<option value="ourl.php">OpenURL</option>
		<option value="" selected >Z39.50</option>
		<option value="sp_faq.php">SharePoint</option>
		<option value="lms_faq.php">LMS</option>
	</select>
	</form>
</div>
<h2>Z39.50 - FAQ</h2>
<ul>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=768"  target="_blank">What is Z39.50?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2592" target="_blank">What services do we support?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2591" target="_blank">What is the Z39.50 Connection Information?</a></li>
</ul>


<div style="clear: both"></div>
<?php 

include( 'includes/footer.php' );

?>