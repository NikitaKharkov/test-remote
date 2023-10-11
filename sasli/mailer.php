<?php include('header.php');

if(empty($_POST)) {
	print('<h3>There were errors in your submission. Please <a href="agree.php">go back</a> and try again.</h3>'."\n");
	include('footer.php');
	die();
}

//Check the Contact Email and Fax - Contact Email is not required if a Contact fax is given
if (strlen($_POST["req_Contact_Email"]) == 0 and strlen($_POST["req_Verify_Contact_Email"]) == 0 and strlen($_POST["txt_Contact_Fax"]) > 0) {
	$_POST["req_Contact_Email"] = "use fax";
	$_POST["req_Verify_Contact_Email"] = "use fax";
}

//Make sure values exist in required fields
$vErrors = "";
foreach($_POST as $current) {
	if (substr(key($_POST),0,4) == "req_" and strlen($current) == 0) {
		$vErrors .= "<li>Required field not filled out: <i>".str_replace("_"," ",substr(key($_POST),4))."</i></li>";
	}
	each($_POST);
}

//Make sure that fields match their verification values
if ($_POST["req_Email_Address"] != $_POST["req_Verify_Email_Address"]) {
	$vErrors .= "<li>E-mail Addresses do not match.</li>";
}
if ($_POST["req_Contact_Email"] != $_POST["req_Verify_Contact_Email"]) {
	$vErrors .= "<li>Contact E-mail Addresses do not match.</li>";
}


if (strlen(trim($vErrors)) > 0) {
	print('<h3>There were errors in your submission, please <a href="javascript:history.go(-1)">go back</a>, correct them, and submit again.</h3>'."\n");
	print("<ul>\n");
	print($vErrors);
	print("</ul>\n");
}
else {
	print('<h3>Thank You</h3><p>Your access form has been successfully completed. You will soon receive a response to your access request.</p>'."\n");
	
	//Generate and send email
	$to = "deannafecteau@epnet.com";
	$subject = "SASLI Site Application";
	$headers = 'Content-Type: text/html; charset=ISO-8859-1'."\n";
	$headers .= 'From: SASLI_Application@epnet.com'."\n";
	$headers .= 'Reply-To: '.$_POST["req_Contact_Email"]."\n";
	$headers .= 'X-Mailer: PHP/'.phpversion();
	
	$body = '<html><head>'."\n";
	$body .= '<style>* {font-family:verdana} h1 { font-weight: normal; font-size: 24px; }'."\n";
	$body .= 'p { margin: 2px; color: #333; font-size:12px; }'."\n";
	$body .= '</style></head><body>'."\n";
	$body .= '<h1>SASLI Site Application</h1>'."\n";
	
	foreach($_POST as $current) {
		if(trim($current) != "") {
			$body .= "<p><b>".str_replace("_"," ",substr(key($_POST),4)).":</b> ".stripslashes(str_replace("_"," ",trim($current)))."</p>";
		}
		each($_POST);
	}
	
	$body .= '</body></html>'."\n";
	
	mail($to, $subject, $body, $headers);
	
	// Uncomment the following two lines to display the text of the e-mail on the mailer page for testing
	//print('<h2>DEBUG Text contained in e-mail:</h2>');
	//print($body);
}

include('footer.php'); ?>




