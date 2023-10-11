<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';

include( 'includes/header.php' );

$menu = 'widgets';
$page = 'widgets_faq';
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
		<option value="" selected >Widgets</option>
		<option value="rss_faq.php">RSS Feeds</option>
		<option value="ourl.php">OpenURL</option>
		<option value="z3950.php">Z39.50</option>
		<option value="sp_faq.php">SharePoint</option>
		<option value="lms_faq.php">LMS</option>
	</select>
	</form>
</div>
<h2>Widgets - FAQ</h2>

	<div class="faq_area">
		<p></p>
		<ul>
			<li><a href="http://support.ebscohost.com/knowledge_base/detail.php?id=4688" target="_blank">What are Widgets?</a></li>
			<li><a href="http://support.ebscohost.com/knowledge_base/detail.php?id=4713" target="_blank">How can I add Widgets to EBSCOhost or EBSCO Discovery Service?</a></li>
		</ul>
	</div>
	
<div style="clear: both"></div>
<?php 

include( 'includes/footer.php' );

?>