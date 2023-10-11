<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'rss_feeds';
$page = 'rss_faq';
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

<h2>RSS Feeds - FAQ</h2>

<div style="faq_area">
	<p></p>
	<ul>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2485" target="_blank">Does EBSCO support RSS Feeds for Alerts?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=1286" target="_blank">How do I create a Search Alert?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2854" target="_blank">Can I use the RSS feature on an existing Alert?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2837" target="_blank">Which RSS Readers are supported by EBSCOhost?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2932" target="_blank">RSS Feeds Available </a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4804" target="_blank">How can I subscribe to a RSS feed for an e-journal available in EBSCO A-to-Z® Table of Contents Browsing?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3325" target="_blank">Do One-Step RSS Alerts Expire?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3340" target="_blank">One-Step RSS Search Alert Help Sheet</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3341" target="_blank">One-Step RSS Journal Alert Help Sheet</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3395" target="_blank">Why doesn't EBSCO automatically append my Proxy settings for Persistent Links to EBSCO RSS Alerts? </a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3729" target="_blank">How do I View EBSCOhost RSS feeds in Google Reader?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3314" target="_blank">How do I create a One-Step RSS Search Alert?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3823" target="_blank">Can I set my RSS alerts to include abstracts?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3301" target="_blank">Using One-Step RSS Alerts - Best Practices</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3255" target="_blank">What are One-Step RSS Alerts?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3753" target="_blank">Can I add my Proxy URL to the Persistent Links that are sent via RSS Alerts?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3313" target="_blank">How do I set up One-Step RSS Alerts in EBSCOadmin?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3676" target="_blank">How do I edit the alert name for my RSS feed?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=1920" target="_blank">Do I have to log in to My EBSCOhost to create a Journal or Search alert?</a></li>
	</ul>
</div>

<div style="clear: both"></div>

<?php 

include( 'includes/footer.php' );

?>