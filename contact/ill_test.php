<?
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('Support Materials');

$template->printHeader();
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox.php");
?>
</form>
<link rel="stylesheet" href="form.css" type="text/css" media="screen" />
<h3>Customized ILL Form</h2>

<?
// PAGE FUNCTION
$page_function = (isset($_REQUEST['page_function'])) ? $_REQUEST['page_function'] : '';	
$valid_page_functions = array("show_form", "send", "confirm");
if(!in_array($page_function, $valid_page_functions)){
	$page_function = $valid_page_functions[0];
}

$error	   = "";
$message   = "";
?>



<?
/**
*
* confirm
* 
*/
if ($page_function == "confirm") {
?>
<div class="message">Your request has been sent successfully.</div>
<?
}



/**
*
* send
* 
*/
if ($page_function == "send") {
		
	//  Validate the form submission.
	$validator = new Validator();
	$validator->validateFields("name, institution_name, phone, street_address, email, city, state, zip, country");
	
	if (!$validator->getError()){
		$validator->validateEmail($_REQUEST['email']);
	}
	
	if ($validator->getError()){
		$error = str_replace("name <strong>or</strong> institution_name <strong>or</strong> phone <strong>or</strong> street_address <strong>or</strong> city <strong>or</strong> state <strong>or</strong> zip <strong>or</strong> country", "email", $validator->getError());
		$page_function = "show_form";
		
	} else {
		//  Set the contact e-mail address.
		$to = "support@ebscohost.com"; //	Live e-mail account
		
		//  Compile the body of the e-mail.
		$m = "";
		$m .="Support Website: (Customized ILL Form)\n\n";
		$m .="-----------------------------------------------------------\n";
		$m .="Customized ILL Form Request:\n";
		$m .="Name: " . stripslashes($_REQUEST['name']) . "\n";
		$m .="Institution: " . stripslashes($_REQUEST['institution_name']) . "\n";
		$m .="Address: " . stripslashes($_REQUEST['street_address']) . "\n";
		if($_REQUEST['city']){
			$m .="City: " . stripslashes($_REQUEST['city']) . "\n";
		}
		if($_REQUEST['state']){
			$m .="State: " . stripslashes($_REQUEST['state']) . "\n";
		}
		if($_REQUEST['zip']){
			$m .="ZIP: " . stripslashes($_REQUEST['zip']) . "\n";
		}
		$m .="Country: " . stripslashes($_REQUEST['country']) . "\n";
		if($_REQUEST['phone']){
			$m .="Phone: " . stripslashes($_REQUEST['phone']) . "\n";
		}
		$m .="E-Mail: " . stripslashes($_REQUEST['email']) . "\n";
		$m .="-----------------------------------------------------------\n";
										
		// Mail headers
		$date = date("m/d/Y");
		$mailsubject = "Custom ILL Form Request: $date"; 
		$mailheaders = "From: " . $_REQUEST['email'] . "\n";
		$mailheaders .= "Reply-To: " . $_REQUEST['email'] . "\n";
		$mailheaders .= "X-Mailer: PHP Mail Function on Apache\n";

		// Send the email to the administrators
		if (mail($to, $mailsubject, $m, $mailheaders)) {
			ob_end_clean();
			header("Location: " .  server_address() . $_SERVER['PHP_SELF'] . "?page_function=confirm");
			exit;
		} else {
			$error = "We're sorry, but there's been an error while sending your contact request.";
			$page_function = "show_form";
		}
	}
}


/**
*
* show_form
* 
*/
if ($page_function == "show_form") {
	// errors, messages
	if ($error)	   echo "<div class=\"error\">" . $error . "</div>";
	if ($message)  echo "<div class=\"message\">". $message . "</div>";
	
	if(!$message && !$error){
?>
<div id="detail">You can either choose one of the <a class="DocLink" href="/training/ill_linking.pdf">preset ILL forms</a>, or customize a form to your specifications. ILL form customization is available free of charge to EBSCO<i>host</i> customers. The sample form below shows the fields that can be customized. Fill in your contact information below and a Technical Support Representative will call you to discuss how you would like the form customized. We will then create a form for your library, update EBSCO<i>admin</i> with the form's URL, and contact you upon completion. Note: Please allow two weeks for completion of your customized ILL form.</div>
<br />
<?
	}
?>

<style type="text/css">
<!--
.spacer{clear:both; height:1px;}
/* ----------- My Form ----------- */
.myform{
width:450px;
padding:24px;
}

/* ----------- stylized ----------- */
#stylized{
border:solid 2px #b7ddf2;
background:#ebf4fb;
}
#stylized h1 {
font-size:14px;
font-weight:bold;
margin-bottom:8px;
}
#stylized p{
font-size:11px;
color:#666666;
margin-bottom:20px;
border-bottom:solid 1px #b7ddf2;
padding-bottom:10px;
}
#stylized label{
display:block;
font-weight:bold;
text-align:right;
width:140px;
float:left;
}
#stylized .small{
color:#666666;
display:block;
font-size:11px;
font-weight:normal;
text-align:right;
width:140px;
}
#stylized input{
float:left;
font-size:12px;
padding:4px 2px;
border:solid 1px #aacfe4;
width:200px;
margin:2px 0 20px 10px;
}
#stylized .greenbtn{
clear:both;
margin-left:180px;
line-height:10px;
text-align:center;
color:#FFFFFF;
font-size:11px;
font-weight:bold;
}
-->

</style>

<div style="width:950px; padding-bottom: 50px;" id="container">

	<div style="float:left; padding-left:20px;" id="left">

		<div id="stylized" class="myform">
			<form id="customized_ill" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
			<h1>Customized ILL Form Request</h1>
			<p>* required field</p>

			<label>*Name</label>
			<input type="text" name="name" value="<?= stripslashes($name); ?>" tabindex="18" />
			<label>* Institution Name</label>
			<input type="text" name="institution_name" value="<?= stripslashes($institution_name); ?>" length="4" tabindex="19" />
			<label>* Phone</label>
			<input type="text" name="phone" value="<?= stripslashes($phone); ?>" tabindex="20" />
			<label>* Street Address</label>
			<input type="text" name="street_address" value="<?= stripslashes($street_address); ?>" tabindex="21" />
			<label>* E-mail</label>
			<input type="text" name="email" value="<?= stripslashes($email); ?>" maxlength="50" tabindex="22" />
			<label>* City</label>
			<input type="text" name="city" value="<?= stripslashes($city); ?>" maxlength="50" tabindex="23" />
			<label>* State</label>
			<input type="text" name="state" value="<?= stripslashes($state); ?>" maxlength="5" tabindex="24" />
			<label>* ZIP</label>
			<input type="text" name="zip" value="<?= stripslashes($zip); ?>" maxlength="10" tabindex="25" />
			<label>* Country</label>
			<input type="text" name="country" value="<?= stripslashes($country); ?>" tabindex="26" />
			<input type="hidden" name="page_function" value="send" /> 
			<button type="submit" class="greenbtn" value="Submit" tabindex="10" />Submit</button>
			<div class="spacer"></div>
			</form>
		</div>

	</div>
	  
	 <div style="float:left; padding-left:45px;" id="right">
	 <p style="padding-left:10px;width:400px;text-align:center;">Sample Form</p>
		 <div id="example">
		
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" 

		codebase="http://download.macromedia.com/pub/shockwave/
		cabs/flash/swflash.cab#version=6,0,40,0" 
		 
		width="423" height="461" 
		 id="mymoviename"> 

		<param name="movie"  

		value="/contact/illform.swf" /> 
		 
		<param name="quality" value="high" /> 

		<param name="bgcolor" value="#ffffff" /> 

		<embed src="/contact/illform.swf" quality="high" bgcolor="#ffffff"

		width="423" height="461" 

		name="mymoviename" align="" type="application/x-shockwave-flash" 

		pluginspage="http://www.macromedia.com/go/getflashplayer"> 


		</embed> 

		</object> 
		</div>

	</div>

</div>

	<!--<script type="text/javascript">
		// <![CDATA[
		var fo = new FlashObject("/contact/illform.swf", "example", "445", "500", 6, "");
		fo.write("example");
		// ]]>
	</script>-->
<?php
}



# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>
