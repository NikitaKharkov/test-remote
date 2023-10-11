<?
$emailMessage = createCMEText($name, $data["yourEmail"], $data["title"], 
	$selectedSections, $data["searching"], $data["found"], 
	$selectedLearningsStrings, $data["date"], $creditString);

function createCMEText($name, $yourEmail, $title, $selectedSections, $searching, 
			$found, $selectedLearnings, $date, $creditType) {		
	if(strlen($searching) < 1) { $searching = "(none)"; }
	if(strlen($found) < 1) { $found = "(none)"; }
	$learnings = join($selectedLearnings, '</li><li>');
	$sections = join($selectedSections, '</li><li>');	
	$email = <<<EOD
<html>
<head>
<title>DynaMed CME/CE Request</title>
</head>
<body style="color: #000;padding:20px; font-size: 11px; font-family: verdana, sans-serif !important;">
<div style="padding: 0px 10px 10px 10px; text-align: center;">
<h1 style="color: #000;font-size: 14px; margin-top: 0.75em; font-weight: bold">DynaMed CME/CE credit for {$name} - {$date}</h1>
<p style="padding-top: 0px;"><i>Type of Credit Requested:</i> {$creditType}<br/>
<i>User's Email Address:</i> {$yourEmail}</p>
</div>
<div style="padding: 0px 20px 0px 20px; background: #f8f8f8; padding: 10px; color: #444; font-size: 10px;">
The following is a request for DynaMed CME/CE credit.
This request has been sent to your CME/CE coordinator (see below).
</div>
<div style="padding: 0px 20px 0px 20px">
<h2 style="color: #000;font-size: 12px; font-weight: bold; margin-top: 1.5em">{$name} was searching for "<i>{$title}</i>" and reviewed content in the following sections:</h2>
<ul style="padding-left:4em; list-style:square"><li>{$sections}</li></ul>
</div>
<div style="padding: 0px 20px 0px 20px; background: #f8f8f8; padding: 10px; color: #444; font-size: 10px;"><br/>
EOD;
if ($creditType == "AANP Contact Hours 0.5 Hours") {
	$email .= "This activity is jointly sponsored by Tufts University School of Medicine (TUSM) and Tufts Health Care Institute (THCI). This program has been approved for up to 20 contact hours of continuing education by the American Academy of Nurse Practitioners. Program ID 0706267. Learners may claim 0.5 contact hours for conducting a single structured online search on a clinical topic.";
}
else {
	$email .= "This activity has been planned and implemented in accordance with the Essential Areas and policies of the Accreditation Council for Continuing Medical Education (ACCME) through the joint sponsorship of Tufts University School of Medicine (TUSM) and Tufts Health Care Institute (THCI). TUSM is accredited by the ACCME to provide continuing medical education for physicians. TUSM designates this educational activity for a maximum of 20 <i>AMA PRA Category 1 Credits</i>&trade; per year. Physicians may claim a half (0.5) <i>AMA PRA Category 1 Credit</i>&trade; for conducting a single structured online search on a clinical topic.";
}
$email .= "</div>";
if ($creditType == "AAFP Prescribed Credit 0.5 credits") {
	$email .= <<<EOD
<div style="padding: 0px 20px 0px 20px; background: #f8f8f8; padding: 10px; color: #444; font-size: 10px;"><br/>
This activity has been reviewed and is acceptable for up to <b>20 Prescribed</b> credits by the American Academy of Family Physicians. <b>AAFP accreditation begins 10-1-07</b>.  Term of approval is for two years from this date with option for yearly renewal.
</div>
EOD;
}
$email .= <<<EOD
<div style="padding: 0px 20px 0px 20px; background: #f8f8f8; padding: 10px; color: #444; font-size: 10px;"><br/>
Your credits will be recorded in the <b>Tufts Online Credit Tracker on the day following the search</b>. To claim new credits and view all Certificates, proceed as follows: 
</div>
<ul style="padding-left:4em; list-style:square">
<li>Go to <a href="http://cme.thci.org">http://cme.thci.org</a></li>
<li>If you have claimed credits before, enter your Email and Password to log in.</li>
<li>If this is your first time claiming credit for a search, or you need to check your password, then click on the "Forgot Password?" link and enter your email address (this must match the email address that you used to register with DynaMed). You will receive an email from support@thci.org with your password for the Credit Tracker. (Note: you may change that password once you've opened the Credit Tracker.)</li>
<li>Once you've logged in, you will see a record of any Certificates you've earned to date. You may view and print these certificates, which will remain online in the Tracker for a six-year period.</li>
<li>For your initial or additional Certificates, click the "Create Certificate for DynaMed" link on the left hand side of the page. This will bring you to a list of your searches that are eligible to be included in a new Certificate of CME/CE Credit. <b>Searches will be posted on the day after you complete them</b>. Check each search that you would like to include, up to 40 searches (20 credits) and click the "Create Certificate" button to generate the Certificate. This Certificate will now appear on the "Certificates" screen along with previous Certificates.</li>
<li>Users are required to complete a brief evaluation of the Internet point of care CME/CE learning format prior to receiving the first certificate for CME credits.</li> 
<li>Credits must be claimed within six months of the search date. Searches and credits that remain unclaimed are deleted after six months.</li>
</ul>
<div style="padding: 0px 20px 0px 20px; background: #f8f8f8; padding: 10px; color: #444; font-size: 10px;"><br/>
For help with the Tufts Online Credit Tracker, please contact both <a href="mailto:support@thci.org">support@thci.org</a> and <a href="mailto:med-oce@tufts.edu">med-oce@tufts.edu</a>, or call 617-636-1000.
</div>
<p style="margin-top: 15px; text-align: center;background: #f8f8f8; padding: 10px; color: #444; font-size: 10px;"><br/>
E-mail Disclaimer: This e-mail was generated by a user of DynaMed. Please do not reply to this message.
Neither EBSCO nor the institution from which this e-mail was created are responsible for the content of this e-mail.
If you have any problems or questions, contact Technical Support at http://support.ebscohost.com/contact/askus.php or call 800-758-5995.</p>
</body>
</html>
EOD;
	return $email;
}
