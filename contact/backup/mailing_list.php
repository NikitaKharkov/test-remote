<?
/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('Mailing List Opt-in Request');

$template->printHeader();
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
?>


<h1>Join Our Mailing Lists</h1>


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
	$validator->validateFields("first_name, last_name, email, title, institution_name, city, state_province, zip_code, country, general_product_information || technical_interface_and_database_enhancements || resources_for_marketing_your_library || library_conferences_and_events");
	
	if (!$validator->getError()){
		$validator->validateEmail($_REQUEST['email']);
	}
	
	if ($validator->getError()){
		$error = str_replace("first_name <strong>or</strong> last_name <strong>or</strong> institution_name", "email", $validator->getError());
		$page_function = "show_form";
			
	} else {
		$today = date("d-M-Y-h:i a");
		 /*if (!function_exists('fputcsv')) {
		    function fputcsv($fp, $line, $separator = ',') {
		      for ($i=0; $i < count($line); $i++) {
		        if (false !== strpos($line[$i], '"')) {
		          $line[$i] = ereg_replace('"', '""', $line[$i]);
		        }
		        if (false !== strpos($line[$i], $separator) ||
		            false !== strpos($line[$i], '"')) {
		          $line[$i] = '"' . $line[$i] . '"';
		        }
		      }
		      $line = 
		      fwrite($fp, implode($separator, $line) . "\r\n");
		    }
		  }*/
		 	$data = array($first_name, $last_name, $title, $institution_name, $city, $state_province, $zip_code, $country, $email, $phone, $general_product_information, $resources_for_marketing_your_library, $technical_interface_and_database_enhancements, $library_conferences_and_events, $today);
		  			  
		  if ($fp = @fopen('/home/custadmin/mailing_list.csv', 'a')) {
		    fputcsv($fp, $data);
		    fclose($fp);
		    echo 'CSV written.';
		  } else {
		    echo 'Cannot open file.';
		  }
		
		//  Set the contact e-mail address.
		//$to = "mbrown@ebscohost.com";	//	Live e-mail account.
		$to = "dpersakis@ebscohost.com";	//	Live e-mail account.		
		//  Compile the body of the e-mail.
		$m = "";
		$m .="Support Website: (Mailing List Opt-in Request)\n\n";
		$m .="The following user has requested to be added to one or more mailing lists:\n";
		$m .="-----------------------------------------------------------\n";
		$m .="First Name: " . stripslashes($_REQUEST['first_name']) . "\n";
		$m .="Last Name: " . stripslashes($_REQUEST['last_name']) . "\n";
		$m .="Title: " . stripslashes($_REQUEST['title']) . "\n";
		$m .="Institution: " . stripslashes($_REQUEST['institution_name']) . "\n";
		$m .="City: " . stripslashes($_REQUEST['city']) . "\n";
		$m .="State Province: " . stripslashes($_REQUEST['state_province']) . "\n";
		$m .="Zip Code: " . stripslashes($_REQUEST['zip_code']) . "\n";
		$m .="Country: " . stripslashes($_REQUEST['country']) . "\n";
		$m .="E-Mail: " . stripslashes($_REQUEST['email']) . "\n";
		$m .="Phone: " . stripslashes($_REQUEST['phone']) . "\n";
		$m .="-----------------------------------------------------------\n\n";		
		$m .="Mailing Lists:\n\n";
		if($_POST['general_product_information']){
			$m .=$general_product_information . "\n";
		}
		if($_POST['resources_for_marketing_your_library']){
			$m .=$resources_for_marketing_your_library . "\n";
		}
		if($_POST['technical_interface_and_database_enhancements']){
			$m .=$technical_interface_and_database_enhancements . "\n";
		}
		if($_POST['library_conferences_and_events']){
			$m .=$library_conferences_and_events . "\n";
		}
				
		// Mail headers
		$date = date("m/d/Y");
		$mailsubject = "Mailing List Opt-in Request: $date";
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
		
		<h2>Sign up to join any (or all) of our mailing lists. It's free!</h2><br />
		Most of our communications fall into one of three categories--general product information, technical interface and database enhancements, or resources for marketing your library.
		To receive automatic email notification in any (or all) categories, simply fill in the fields shown below, check the appropriate boxes, and then click <span class="bold">Submit.</span>
				
		<br /><br />
		<?
	}
	?>
	
<div>
<form id="mailing_list" name="mailing_list" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
<table cellpadding="6" cellspacing="0" border="0">
	
	<tr>
		<td>* First name:<br /><input style="width:200px;" type="text" name="first_name" value="<?= stripslashes($first_name); ?>" tabindex="1" /></td>
		<td>* Last name:<br /><input style="width:200px;" type="text" name="last_name" value="<?= stripslashes($last_name); ?>" tabindex="2" /></td>
	</tr>
	<tr>
		<td>* Job Title:<br /><input style="width:200px;" type="text" name="title" value="<?= stripslashes($title); ?>" tabindex="3" /></td>
		<td>* Institution Name:<br /><input style="width:200px;" type="text" name="institution_name" value="<?= stripslashes($institution_name); ?>" tabindex="4" /></td>
	</tr>
	<tr>
		<td>* City:<br /><input style="width:200px;" type="text" name="city" value="<?= stripslashes($city); ?>" tabindex="5" /></td>
		<td>* State/Province:<br /><input style="width:200px;" type="text" name="state_province" value="<?= stripslashes($state_province); ?>" tabindex="6" /></td>
	</tr>
	<tr>
		<td>* Zip/Postal Code:<br /><input style="width:200px;" type="text" name="zip_code" value="<?= stripslashes($zip_code); ?>" tabindex="7" /></td>
		<td>* Country:<br /><input style="width:200px;" type="text" name="country" value="<?= stripslashes($country); ?>" tabindex="8" /></td>
	</tr>
	<tr>
		<td>* E-mail:<br /><input style="width:200px;" type="text" name="email" value="<?= stripslashes($email); ?>" maxlength="50" tabindex="9" /></td>
		<td>Phone <span class="small">(optional)</span>:<br /><input style="width:200px;" type="text" name="phone" value="<?= stripslashes($phone); ?>" maxlength="50" tabindex="11" /></td>
	</tr>
	<tr>
		<td>* E-mail <span class="small">(confirm)</span>:<br /><input style="width:200px;" type="text" name="emailcf" value="<?= stripslashes($emailcf); ?>" maxlength="50" tabindex="10" /></td>
	</tr>
	<tr>
		<td colspan="2">* required fields</th>
	</tr>
	<tr>
		<td colspan="2" height="10"></td>
	</tr>
	<tr>
		<th colspan="2">Sign me up to receive automatic email notification in these categories:</th>
	</tr>
	<tr>
		<td colspan="2"><input style="width:14px;" type="checkbox" name="general_product_information" <? if($_POST['general_product_information'] == 'General product information'){ print 'CHECKED'; } ?> value="General product information" tabindex="12" />General product information (content and databases)</td>
	</tr>
	<tr>
		<td colspan="2"><input style="width:14px;" type="checkbox" name="resources_for_marketing_your_library" <? if($_POST['resources_for_marketing_your_library'] == 'Resources for marketing your library') { print 'CHECKED'; } ?> value="Resources for marketing your library" tabindex="13" />Resources for marketing your library</td>
	</tr>
	<tr>
		<td colspan="2"><input style="width:14px;" type="checkbox" name="technical_interface_and_database_enhancements" <? if($_POST['technical_interface_and_database_enhancements'] == 'Technical interface and database enhancements') { print 'CHECKED'; } ?> value="Technical interface and database enhancements" tabindex="14" />Technical interface and database enhancements (including EBSCO<i>admin</i>)</td>
	</tr>
	<tr>
		<td colspan="2"><input style="width:14px;" type="checkbox" name="library_conferences_and_events" <? if($_POST['library_conferences_and_events'] == 'Library conferences and events') { print 'CHECKED'; } ?> value="Library conferences and events" tabindex="15" />Library conferences and events</td>
	</tr>
	<tr>
		<td colspan="2"><input type="hidden" name="page_function" value="send" /> <input type="image" src="/images/btn_submit.gif" alt="Submit" class="graphic_button" tabindex="16" onclick="return BothFieldsIdenticalCaseSensitive();" /></td>
	</tr>
</table>
</form>
</div>
	

<?php
}
?>



<?
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>