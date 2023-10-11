<?
/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('Customized ILL Forms');

$template->printHeader();

	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
?>



<h1>Customized ILL Form</h1>



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
if ($page_function == "confirm"){
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
	$validator->validateFields("name, institution_name, street_address, city, country, email");
	
	if(!$validator->getError()){
		$validator->validateEmail($_REQUEST['email']);
	}
	
	if($validator->getError()){
		$error = $validator->getError();
		$page_function = "show_form";
	} else {
		//  Set the contact e-mail address.
		$to = "eptech@epnet.com";	//	Live e-mail account.
				
		//  Compile the body of the e-mail.
		$m = "";
		$m .="Support Website: (Customized ILL Form)\n";
		$m .="-----------------------------------------------------------\n";
		$m .="The following user has requested a customized ILL Form:\n";
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
		
		// Mail headers
		$date = date("m/d/Y");
		$mailsubject = "Support Website Request: $date";
		$mailheaders = "From: " . $_REQUEST['email'] . "\n";
		$mailheaders .= "Reply-To: " . $_REQUEST['email'] . "\n";
		$mailheaders .= "X-Mailer: PHP Mail Function on Apache\n";
		$mailheaders .= "Return-Path: " . $_REQUEST['email'] . "\n";

		// Send the email to the administrators
		if (mail($to, $mailsubject, $m, $mailheaders, "-f" . $email)) {
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
		<br />
		You can either choose one of the <a href="/training/ill_linking.pdf">preset ILL forms</a>, or customize a form to your specifications. ILL form customization is available free of charge to EBSCOhost customers. The sample form below shows the fields that can be customized. Simply mouse-over each number, read the accompanying text, and fill in your contact information below. A Technical Support Representative will call you to discuss how you would like the form customized. We will then create a form for your library, update EBSCOadmin with the form's URL, and contact you upon completion. Note: Please allow two weeks for completion of your customized ILL form.
		<br /><br />
		<?
	}
	?>
	
	<div>
	<form id="customized_ill" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
	<table cellpadding="8" cellspacing="0" class="form_table">
		<tr>
			<th colspan="4"><h2> Request Customized ILL</h2></th>
		</tr>
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name" value="<?= stripslashes($name); ?>" tabindex="1" /></td>
			<td>Institution Name:</td>
			<td><input type="text" name="institution_name" value="<?= stripslashes($institution_name); ?>" tabindex="4" /></td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td><input type="text" name="phone" value="<?= stripslashes($phone); ?>" tabindex="2" /></td>
			<td>Street Address:</td>
			<td><input type="text" name="street_address" value="<?= stripslashes($street_address); ?>" tabindex="5" /></td>
		</tr>
		<tr>
			<td>E-mail:</td>
			<td><input type="text" name="email" value="<?= stripslashes($email); ?>" maxlength="50" tabindex="3" /></td>
			<td>City:</td>
			<td><input type="text" name="city" value="<?= stripslashes($city); ?>" maxlength="50" tabindex="6" /></td>
		</tr>
		<tr>
			<td rowspan="4" colspan="2">&nbsp;</td>
			<td>State:</td>
			<td><input type="text" name="state" value="<?= stripslashes($state); ?>" maxlength="5" tabindex="7" /></td>
		</tr>
		<tr>
			<td>ZIP:</td>
			<td><input type="text" name="zip" value="<?= stripslashes($zip); ?>" maxlength="10" tabindex="8" /></td>
		</tr>
		<tr>
			<td>Country</td>
			<td><input type="text" name="country" value="<?= stripslashes($country); ?>" tabindex="9" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="hidden" name="page_function" value="send" /> <input type="image" src="/images/but_submit.gif" alt="Submit" class="graphic_button" tabindex="10" /></td>
		</tr>
	</table>
	</form>
	</div>
	
	<br /><br />
	
	<strong>Mouse-over numbers to see customizable features.</strong><br /><br />
	
	<div id="example">
	</div>
	<script type="text/javascript">
		// <![CDATA[
		var fo = new FlashObject("/contact/illform.swf", "example", "445", "500", 6, "");
		fo.write("example");
		// ]]>
	</script>
	
	<?php
}
?>





<?
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>
