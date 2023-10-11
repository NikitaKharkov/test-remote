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
<!-- Use of this code assumes agreement with the Google Custom Search Terms of Service. -->
<!-- The terms of service are available at http://www.google.com/cse/docs/tos.html -->
<form name="cse" id="searchbox_demo" action="http://www.google.com/cse">
  <input type="hidden" name="cref" value="" />
  <input type="hidden" name="ie" value="utf-8" />
  <input type="hidden" name="hl" value="" />
  <input name="q" type="text" size="40" />
  <input type="submit" name="sa" value="Search" />
</form>
<script type="text/javascript" src="http://www.google.com/cse/tools/onthefly?form=searchbox_demo&lang="></script>

<h3>Contact Us</h3>
<table cellpadding="20" cellspacing="0" class="two_columns" border="0" align="center">

	<tr height="130px">
		<td width="650px">
			<h2>EBSCO Support</h2>
			<strong>Hours of operation:</strong><br />
			Monday - Friday, 24 hour support<br />
			Saturday &amp; Sunday, 9:00 AM-5:00 PM (Eastern Time)
			<br /><br />
			Librarians/Account Administrators:<br />
			U.S. / Canada - (800) 758-5995<br />
			Outside U.S. / Canada<br />
			(Int'l access code) + 800-3272-6000
			<br /><br />
			<span class="small">Products supported include EBSCO<i>host</i>, EBSCO Discovery Service, EBSCO<i>host</i> Integrated Search, Electronic Journals Service (EJS),
			EBSCO A-to-Z, LinkSource, EBSCONET, ERM Essentials, EBSCO<i>host</i> Connection, other EBSCO Web Services, WilsonWeb and eBooks & Audiobooks on EBSCO<i>host</i>. 
			</span><br /><br />
		</td>
		<td width="550px" valign="top">
		
		<h2>Email</h2><img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/contact/askus.php">E-mail Support</a><br /><br />
		<h2>Students/Patrons</h2>Please search our <a href="/knowledge_base/index.php">FAQs</a> for helpful information</span><br /><br />
	
		<h2>Requests</h2>
		<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/contact/ill.php">Request Custom ILL Form</a><br />
		<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/contact/materials.php">Request Printed Materials</a><br />
		<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/contact/mailing_list.php">Join Our Mailing Lists</a><br />
		<img src="/images/bullet_arrow.gif" alt="" />&nbsp;<a href="/training/TNSignup.php">Join the EBSCO Training Mailing List</a><br />
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

<br />
<br />




<br />


<?php
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>