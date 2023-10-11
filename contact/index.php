
<?php

header( 'Location: http://support.ebscohost.com/contact/askus.php' ) ;

?>



<?
/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('Contact Us');

$template->printHeader();
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #

include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox.php");
?>

<div id="page_title">Contact Us</div>
<table cellpadding="0" cellspacing="0" class="two_columns" border="0" align="center">

	<tr>
		<td valign="top" width="650px">
		
			
		
			<h2 style="padding-bottom: 6px;">EBSCO Support</h2>
			
			<a class="email_support_button" href="/contact/askus.php">Email Support</a><br /><br />
			
			Librarians/Account Administrators:<br />
			U.S. / Canada - (800) 758-5995<br />
			Outside U.S. / Canada<br />
			00-800-3272-6000
			<br /><br />
			
			
			<strong>Hours of operation:</strong><br />
			Monday - Friday, 24 hour support<br />
			Saturday &amp; Sunday, 9:00 AM-5:00 PM (Eastern Time)
			<br /><br />
			
			
    
		<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/support_news/alerts">Check here for System Alerts</a><br /><br />
		</td>
		<td width="550px" valign="top">
		
		
		<h2 style="padding-bottom: 6px;">Students, Library Patrons, and End Users</h2>For your convenience, answers to frequently asked questions are available by using the search box above.  If you need additional assistance please contact your local library or EBSCO administrator.
<br /><br />
<h2>Product newsletters and information</h2>
<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="http://www.ebsco.com/news-center/newsletters">Sign up to receive product newsletters and updates</a><br />
<!--<img src="/images/bullet_arrow.gif" alt="" />&nbsp;View our System Alerts page  [Comment Out until done]<br />-->
<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="http://support.ebsco.com/training/TNSignup.php">Join the EBSCO Training Mailing List</a><br /><br />

	
		<h2>Requests</h2>
		<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/contact/ill.php">Request Custom ILL Form</a><br />
		<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/contact/materials.php">Request Printed Materials</a><br />
		
		</td>
	</tr>
	<tr>
		<td>
		&nbsp;
			
		</td>
		<td>
			<div class="even">
				<!--<span style="font-size:1.2em; font-weight:bold; font-family:tahoma,helvetica;">Helpful FAQs</span><br /><br />
	
				
				<a href="http://support.epnet.com/knowledge_base/detail.php?topic=&id=1118">How do I log in to EBSCOhost using my library card?</a><br /><br />
				<a href="http://support.epnet.com/knowledge_base/detail.php?topic=&id=3737">Are EBSCOhost URLs bookmarkable?</a><br /><br />
				<a href="http://support.epnet.com/knowledge_base/detail.php?topic=&id=4478">How can I request an article from my library when full text is not available?</a><br /><br />
				<a href="http://support.ebsco.com/knowledge_base/detail.php?id=3091">I cannot log in to my Career Guidance System or Career Library account - what's wrong?</a><br /><br />
				<a href="http://support.ebsco.com/knowledge_base/detail.php?id=2866">I received an error message when I tried to log in to EBSCOhost. What do these error messages mean?</a><br /><br />


				<br />-->
			</div>
		</td>
	</tr>
</table>

<?php
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>
