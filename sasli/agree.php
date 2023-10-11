<?php 
	include('header.php');
	$today = getdate();
?>
<form style="clear:both;padding-top:5px;" method="post" action="access_application.php">
<h2>EBSCO publishing product License Agreement</h2>
<p>(covers access via an EBSCO online service, Remote Host, CD-WAN or DBL programs only)</p>
<p>I. LICENSE</p>
<p>A.  The term of this AGREEMENT, and of the license(s) granted hereunder, shall be from <?php print($today["month"]." ".$today["mday"].", ".$today["year"]) ?> to December 31, <?php print($today["year"] + 1)?></p>
<p>B. EBSCO hereby grants to this site a nontransferable and non-exclusive right to use the Database(s) according to the terms and conditions set forth in this AGREEMENT. The parties hereto hereby agree that, any and all terms and conditions herein to the contrary notwithstanding,  (a) this AGREEMENT is subject to the terms and conditions of the EBSCO publishing product License Agreement between International Network for the Availability of Scientific publications (INASp) and EBSCO Casias, Inc. d/b/a EBSCO publishing, and dated as of January 1, 2002 (the "January 1, 2002 AGREEMENT"), and (b) that, in the event of any conflict between the terms of this AGREEMENT and the January 1, 2002 AGREEMENT, the terms of the January 1, 2002 AGREEMENT shall prevail.  The ORIGINAL COPYRIGHT OWNER retains the ownership of the Database(s) and all portions thereof; EBSCO does NOT transfer any ownership, and the  SITE may not reproduce, transfer or transmit, in any form, or by any means, the Database(s) or any portion thereof without the prior written consent of EBSCO, except as specifically authorized in this AGREEMENT.</p>
<p>C. The SITE is authorized to provide on-site access to the Database(s) to their walk-in patrons. The SITE is authorized to provide remote access to the Database(s) only to their patrons as long as security procedures are undertaken that will prevent remote access by institutions or individuals that are not parties to this AGREEMENT who are not expressly and specifically granted access by EBSCO. </p>
<p>D. Through this AGREEMENT, the, SITE and/or the patrons of the SITE may download or print limited copies of citations, abstracts, full text or portions thereof provided the information is used solely for personal, non-commercial use.  The site will not use the Database as a component of or the basis of any other publication prepared for sale and will neither duplicate nor alter the Database or any of the content therein in any manner nor use same for sale or distribution. The SITE shall take all reasonable precautions to limit the usage of the Database(s) to those specifically authorized by this AGREEMENT.</p>
<p>II. LIMITED WARRANTY AND RISKS</p>
<p>A. EBSCO makes no representations or warranties of any kind except as set forth herein, which are in lieu of any and all other warranties, express or implied, including, but not limited to, warranties of erchantability or fitness for a particular purpose. EBSCO neither assumes nor authorizes any other person to assume for EBSCO any other liability in connection with the licensing of the Database(s) under this AGREEMENT and/or its use thereof by the   SITE or  its   patrons.</p>
<p>III. TERMINATION</p>
<p>A. Either party to this AGREEMENT shall have the right, with thirty days' notice to the other party, to terminate this AGREEMENT and any licenses granted hereunder for material breach of the terms and conditions hereof, provided that said other party shall first be given reasonable notice of said breach and reasonable opportunity to cure said breach.</p>
<p>B. The provisions set forth in Sections I, II, III, and IV  of this AGREEMENT shall survive the term of this AGREEMENT and shall continue in force into perpetuity. </p>
<p>IV. GENERAL</p>
<p>A. EBSCO will not be liable or deemed to be in default for any delays or failure in performance resulting directly or indirectly from any cause or circumstance beyond its reasonable control, including but not limited to acts of God, war, riot, embargoes, acts of civil or military authority, rain, fire, flood, accidents, earthquake(s), strikes or labor shortages, transportation facilities shortages or failures of equipment, or failures of the Internet.</p>
<p>B. This AGREEMENT and the license granted herein may not be assigned by the   SITES to any third party(ies) without the prior written consent of EBSCO, which consent shall not be unreasonably withheld or delayed. </p>
<p>C. If any term or condition of this AGREEMENT is found by a court of competent jurisdiction or administrative agency to be invalid or unenforceable, the remaining terms and conditions thereof shall remain in full force and effect so long as a valid AGREEMENT is in effect.</p>
<p> D. This AGREEMENT represents the entire agreement and understanding of the parties with respect to the subject matter hereof and supersedes any and all prior agreements and understandings, written and/or oral, except for the January 1, 2002 AGREEMENT . Except for the January 1, 2002 AGREEMENT, there are no representations, warranties, promises, covenants or undertakings between the parties, except as described herein.</p>        
<p>Please fill out the form below. NOTE: By checking &quot;I Agree,&quot; you are  subject to ALL of the terms of the &quot;EBSCO publishing product License Agreement.&quot; You cannot continue to the application unless you have selected &quot;I AGREE.&quot; Your name and Ip address are being recorded.</p>
<fieldset>
<legend>Agreement</legend>
<label for="req_libraryName">Institution Name</label><input type="text" name="req_libraryName" id="req_libraryName"/>
<label for="req_name">Your Name</label><input type="text" name="req_name" id="req_name"/>
<div class="yesno">
<label for="agree"><input type="radio" id="agree" name="agree" value="yes" />I agree</label>
<label for="dontAgree"><input type="radio" id="dontAgree" name="agree" value="no" checked="checked"/>I do not agree</label>
<input type="submit" value="Submit"/>
</div>
</fieldset>
</form>
<?php
	include('footer.php');
?>