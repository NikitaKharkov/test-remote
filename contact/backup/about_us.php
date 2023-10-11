<?
/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('About Us');

$template->printHeader();
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
?>



<h1>About Us</h1>
<br />
<table cellpadding="0" cellspacing="0" class="two_columns">
	<tr>
		<td>
			<div class="narrow">
				<h2>EBSCO at a Glance</h2>
				EBSCO is a worldwide leader in providing information access and management solutions through print and electronic journal subscription services, research database development and production, online access to more than 300 databases and thousands of e-journals, a full-featured OpenURL link resolver, and e-commerce book procurement. EBSCO has been serving the library and business communities for more than 60 years. 
			</div>
		</td>
		<td>
			<h2>Our Beginning</h2>
			EBSCO was founded in 1944.
			<br />
			<br />
			
			<h2>Our Name</h2>
			EBSCO is an acronym for Elton B. Stephens Company.
			<br />
			<br />
			
			<h2>Our Employees</h2>
			EBSCO currently has 6,200 employees, 2,000 in manufacturing operations and 1,100 outside the United States. 
			<br />
			<br />
			
			<h2>Our Dun &amp; Bradstreet Financial Rating</h2>
			5A1, the highest awarded.
			<br />
			<br />
			
			<h2>Our Ranking</h2>
			EBSCO is ranked in the top 200 of the nation's largest privately held corporations, based on revenues and number of employees, according to &quot;Forbes&quot; magazine.
		</td>
	</tr>
</table>
<br />
<br />






<?php
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>