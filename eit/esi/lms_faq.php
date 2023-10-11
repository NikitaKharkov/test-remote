<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'learning_management';
$page = 'lms_faq';
include( 'includes/navbar.php' );


?>
<div class="faq_quickSelect">
	<form>
	Jump to FAQ: <select name="faqQuickSelect" onChange="changePage( this.form.faqQuickSelect )">
		<option value="faq.php">EBSCO Integration Toolkit</option>
		<option value="ws_faq.php" >Web Service</option>
		<option value="esi_faq.php">Enterprise Search</option>
		<option value="sbb_faq.php">Search Box</option>
		<option value="pl_faq.php">Persistent Links</option>
		<option value="widgets_faq.php">Widgets</option>
		<option value="rss_faq.php">RSS Feeds</option>
		<option value="ourl.php">OpenURL</option>
		<option value="z3950.php">Z39.50</option>
		<option value="sp_faq.php">SharePoint</option>
		<option value="" selected >LMS</option>
	</select>
	</form>
</div>

<h2>Learning Management System - FAQ</h2>
<div class="faq_area">
	<ul>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5104" target="_blank">Is EBSCO's LMS courseware applicable to my organization's needs?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5105" target="_blank">Does the EBSCO LMS courseware conform to eLearning standards?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5106" target="_blank">Can I see a list of what courses you offer?</a></li>
			
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5107" target="_blank">How are specific articles mapped to a course?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5108" target="_blank">How do I find articles specific to my competencies?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5109" target="_blank">Does EBSCO courseware contain tests/quizzes?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5110" target="_blank">Which SCORM data model tracking elements are supported?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5111" target="_blank">Will EBSCO send me the article's HTML and/or PDF files for my Learning Management System?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5112" target="_blank">Can EBSCO articles be added to existing courses within the LMS?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5113" target="_blank">How would I assign users in the Learning Management System to the EBSCO courseware?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5114" target="_blank">How do I add the EBSCO courseware to my Learning Management System?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5115" target="_blank">Can I get assistance to add the courseware to my Learning Management System?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5116" target="_blank">How is the EBSCO courseware packaged?</a></li>
	<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5118" target="_blank">The LMS is behind a firewall, how will the EBSCO content communicate with the LMS's SCORM API.</a></li>
	
	</ul>
</div>
	

<?php 

include( 'includes/footer.php' );

?>