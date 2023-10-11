<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';

include( 'includes/header.php' );

$menu = 'persistent_links';
$page = 'pl_faq';
include( 'includes/navbar.php' );


?>
<div class="minHeight"></div>

<div class="faq_quickSelect">
	<form>
	Jump to FAQ: <select name="faqQuickSelect" onChange="changePage( this.form.faqQuickSelect )">
		<option value="faq.php">EBSCO Integration Toolkit</option>
		<option value="ws_faq.php" >Web Service</option>
		<option value="esi_faq.php">Enterprise Search</option>
		<option value="" selected >Persistent Links</option>
		<option value="widgets_faq.php">Widgets</option>
		<option value="rss_faq.php">RSS Feeds</option>
		<option value="ourl.php">OpenURL</option>
		<option value="z3950.php">Z39.50</option>
		<option value="sp_faq.php">SharePoint</option>
		<option value="lms_faq.php">LMS</option>
	</select>
	</form>
</div>

<h2>Persistent Links - FAQ</h2>

<div class="faq_area">
	<p></p>
	<ul>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=272"  target="_blank">What are EBSCOhost Persistent Links?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=1314" target="_blank">How do persistent links authenticate?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2747" target="_blank">What is the correct syntax for an EBSCOhost Persistent Link?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2378" target="_blank">What is the default profile for a persistent link?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4022" target="_blank">What is the correct syntax for a NoveList Persistent Link?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=1889" target="_blank">Can I set up a preferred authentication order that applies to persistent links created in EBSCOhost?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=1379" target="_blank">How can I save a persistent link to my search?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4011" target="_blank">What is the correct syntax for a DynaMed Search Persistent Link?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2464" target="_blank">Why, when I followed a persistent link in ERIC, would the Full Text not be linked?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4142" target="_blank">How do I create a persistent link to a DynaMed summary that will automatically open a specific section header?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2042" target="_blank">Why would the persistent link to a search I've added to my web page return a "results not found" message?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3750" target="_blank">Is persistent linking available in DynaMed?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=1892" target="_blank">What are Persistent Links to Searches?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3407" target="_blank">How are Persistent Links handled with an HTTPS connection?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=859"  target="_blank">What is Persistent Linking to the Hierarchical Journal Authority File?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3700" target="_blank">Why do my persistent links or catalog links to Company Profile Records (Datamonitor reports) return No Results?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2171" target="_blank">How do I set up my persistent links to point to SRC?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2146" target="_blank">How do I setup my persistent links to point to BSI?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=2476" target="_blank">How do I set up my persistent links to point to Consumer Health Complete?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3239" target="_blank">How do I set up my persistent links to point to Salud en Español?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=1174" target="_blank">What is the difference between Persistent Linking and EBSCO SmartLinks?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3753" target="_blank">Can I add my Proxy URL to the Persistent Links that are sent via RSS Alerts?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4549" target="_blank">How do I set up persistent links to EBSCOhost Integrated Search Database Subject Groups?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3395" target="_blank">Why doesn't EBSCO automatically append my Proxy settings for Persistent Links to EBSCO RSS Alerts? </a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4524" target="_blank">How can I link directly to Company Profiles in EBSCO's Business databases?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4528" target="_blank">How can I link directly to Market Research Reports in EBSCO's Business Searching Interface?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4527" target="_blank">How can I link directly to Industry Reports in EBSCO's Business Searching Interface?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4525" target="_blank">How can I link directly to Country Reports in EBSCO's Business Searching Interface?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4526" target="_blank">How can I link directly to SWOT Analyses in EBSCO's Business Searching Interface?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3475" target="_blank">Can I link to a specific screen in an EBSCO interface?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3405" target="_blank">Can EBSCO provide a secure search link via an HTTPS connection?</a></li>
</div>

<div style="clear: both"></div>
<?php 

include( 'includes/footer.php' );

?>