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
?>



<h1>Contact Us</h1>
<br />
<!--<img src="/images/contact.gif" class="page_graphic" alt="Contact EBSCO"/>-->
<table cellpadding="0" cellspacing="0" class="two_columns" border="0">
	<tr height="130px">
		<td width="50%"><img src="/images/building.jpg" alt="Contact EBSCO" /></td>
		<td valign="top">
		
		<h2>Email</h2><img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/contact/askus.php">E-mail Support</a><br /><br />
		<h2>Students/Patrons</h2>Please search our <a href="/knowledge_base/index.php" class="podcast"><u>FAQs</u></a> for helpful information</span><br /><br />
		<br />
		</td>
	</tr>
	<tr>
		<td>
			<h2>EBSCO Support</h2>
	
				<strong>Hours of operation:</strong><br />
				Monday - Friday, 24 hour support<br />
				Saturday &amp; Sunday, 9:00 AM-5:00 PM (Eastern Time)
				<br />
				<br />
				
				Librarians/Account Administrators:<br />
				U.S. / Canada - (800) 758-5995<br />
				Outside U.S. / Canada<br />
				(Int'l access code) + 00-800-3272-6000
				<br />
				<br />
				<span class="small">Products supported include EBSCOhost, Electronic Journals Service (EJS),
				EBSCO A-Z, LinkSource with A-Z, EBSCONET, other EBSCO<br /> Web Services and NetLibrary.</span><br /><br />
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

<br />
<br />




<br />


<?php
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>