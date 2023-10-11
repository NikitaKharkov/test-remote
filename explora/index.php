<?php

include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "training.php");
$template->setHtmlTitle('Explora Support Page');
$template->printHeader();
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #

include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox.php");
?>
<div>&nbsp;</div>
<div id="page_title">
<img src="explora_logo.jpg" width="150" height="45" alt="explora logo" /></div>

<table cellpadding="0" cellspacing="0" class="two_columns" align="center">
  <tr>
		
    <td width="480px" valign="top">
	  
      <h1>Getting Started</h1>
      <p><em>Explora</em> is EBSCO's engaging new interface for schools and public libraries. We know you are excited to get started, so we have compiled some resources that we think you'll find helpful.</p>
      <ul>
        <li><a href="http://support.ebsco.com/knowledge_base/detail.php?id=7509">Frequently Asked Questions</a><br />
        </li>
        <li><a href="http://support.ebsco.com/knowledge_base/detail.php?id=7519">Enabling the <em>Explora</em> interface in EBSCO<em>admin</em></a></li>
        <li><a href="http://support.ebsco.com/knowledge_base/detail.php?id=7564">Creating a direct link to <em>Explora</em></a></li>
        <li><a href="http://support.ebsco.com/knowledge_base/detail.php?id=7571"><em>Explora</em> Setup Best Practices Guide for Library Administrators</a></li>
<!----------------commenting out AP Videos & Educator's Edition sections----------        
        <li><a href="http://support.ebsco.com/knowledge_base/detail.php?id=7544">Enabling AP Videos in <em>Explora</em></a></li>
        <li><a href="http://support.ebsco.com/knowledge_base/detail.php?id=7563">Enabling the Educator's Edition of <em>Explora</em></a><em></em></li>
       ----------------------------> 
        <li><a href="http://support.ebsco.com/knowledge_base/detail.php?id=7520">User Guide</a></li>
      </ul>
 <br />
     <h1> Tutorials</h1>
      <p>View these video tutorials for an introduction to the <em>Explora</em> interface or to learn more about the functions of your EBSCO<em>admin </em>account.</p>
      <ul>
        <li><a href="http://support.ebsco.com/training/flash_videos/explora/explora.html" target="_blank">Introduction to <em>Explora</em></a></li>
        <li><a href="http://support.ebsco.com/training/flash_videos/admin_create_profiles/admin_create_profiles.html">Creating Profiles in EBSCO<em>admin</em></a></li>
        <li><a href="http://support.ebsco.com/training/flash_videos/admin_create_usr_grp/admin_create_usr_grp.html">Creating User Groups in EBSCO<em>admin</em></a></li>
      </ul>
<br />
      <h1>Promotion</h1>
      <p> Spread the word about <em>Explora</em> with our colorful  <!----<a href="http://support.ebsco.com/knowledge_base/detail.php?id=7518">----->promotional materials</a>, such as flyers,  posters,  and downloadable graphics that can   be used as links or  advertisements,  in print or on a website.</p>
      <ul>
        <li><a href="http://support.ebsco.com/promotion/graphics/Files/Col2/Explora/explora_graphics.zip">Graphics (logos, buttons, icons)</a></li>
        <li><a href="http://support.ebsco.com/promotion/promo_resources/Files/Col2/Explora/explora_promo_email_sample_text_schools.doc">Sample Promotional Email Text for Schools</a></li>
        <li><a href="http://support.ebsco.com/promotion/promo_resources/Files/Col2/Explora/explora_promo_email_sample_text_publics.doc">Sample Promotional Email Text for Public Libraries</a></li>
        <li><a href="http://support.ebsco.com/promotion/promo_resources/Files/Col2/Explora/Explora_Poster_11x17.pdf" target="_blank">Poster (11x17)</a></li>
        <li><a href="http://support.ebsco.com/promotion/promo_resources/Files/Col2/Explora/Explora_Student_Flyer.pdf" target="_blank">Flyer (for students)</a></li>
        <li><a href="http://support.ebsco.com/promotion/promo_resources/Files/Col2/Explora/Explora_Teacher_Flyer.pdf" target="_blank">Flyer (for teachers)</a></li>
        <li><a href="http://support.ebsco.com/promotion/promo_resources/Files/Col2/Explora/Explora_Bookmarks.pdf" target="_blank">Bookmarks</a></li>
    </ul></td>

<td width="50px">
</td>
		
		
<td width="480px" valign="top"><h1>Online Training</h1>
  <p>Want to learn more? Attend one of our upcoming training sessions on <em>Explora</em> and/or EBSCO<em>admin</em>, the administrative tool that allows you to customize the interface content and features to best suit your users' needs.</p>
  <p>Click the links below to visit our training sites. From there, simply search on the term “Explora” to isolate all upcoming sessions related to <em>Explora</em>. Click on the session title for more information and to register.</p>
  <ul>
    <li><a href="http://ebscotraining.webex.com/" target="_blank">U.S. and Canada Training Site</a></li>
    <li><a href="http://ebsco-australasia.webex.com/" target="_blank">Australasia Training Site</a></li>
</ul>
  <p>&nbsp;</p>
<p>&nbsp;</p>
<p><br />
  <br />
</p></td>
			
  </tr>
</table>

<?php
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>
