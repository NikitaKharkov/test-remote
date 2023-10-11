<?php

// Redirect if necessary so the domain is ebscohost
$domainParts = explode(".",$_SERVER["SERVER_NAME"]);
if($domainParts[1] != "ebscohost") {
	$domainParts[1] = "ebscohost";
	header("Location: http://" . implode(".",$domainParts) . "/contact/ebscohost_defaults.php");
	die();
}

/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('EBSCO Journal Service (EJS) Smartlink Opt-Out');

$template->printHeader();
	
		if ($_REQUEST["notme"]!="true" && isset($_COOKIE["webauth"])) {
		$cookie=explode("&",$_COOKIE["webauth"]);
		$ugvalue=substr($cookie[0], 3);
		
		$connection = mssql_connect('sqldw.epnet.com:1433','CustSatTools','VCgHDz6');
		$result=mssql_query("exec eareplica.dbo.CSI_GetCustomerName_70 '".$ugvalue."'");

		//$connection = mssql_connect('sql-repos.epnet.com:1433','ehweb','webeh');
		//$result=mssql_query("exec eamaster.dbo.CSI_GetCustomerName_70 '".$ugvalue."'");
		
		if (mssql_num_rows($result)== 1)
		$custinfo=mssql_fetch_array($result);
		
		mssql_close($connection);
	}
	
# ----------------------------------- #
#	BODY
# ----------------------------------- #
?>

<h1>EBSCO Journal Service (EJS) Smartlink Opt-Out</h1>


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
	$validator->validateFields("institution_name, name, street, city, state_province, zip_code, email, phone");
	
	if (!$validator->getError()){
		$validator->validateEmail($_REQUEST['email']);
	}
	
	if ($validator->getError()){
		$error = str_replace("name <strong>or</strong> institution_name", "email", $validator->getError());
		$page_function = "show_form";
				
	} else {
		$today = date("Y-M-d");
		 
		 	$data = array($cust_id, $institution_name, $name, $street, $city, $state_province, $zip_code, $country, $email, $phone, $ejscode, $today);
		  			  
		  if ($fp = @fopen('/home/custadmin/ejs_smartlink_optout.csv', 'a')) {
		    fputcsv($fp, $data);
		    fclose($fp);
		    echo 'CSV written.';
		  } else {
		    echo 'Cannot open file.';
		  }
		
		//  Set the contact e-mail address.
		//$to = "ehayden@ebscohost.com";	//	Live e-mail account.
		$to = "dpersakis@ebscohost.com";	//	Live e-mail account.		
		//  Compile the body of the e-mail.
		$m = "";
		$m .="Support Website: (EBSCO Journal Service (EJS) Smartlink Opt-Out)\n\n";
		$m .="The following user has requested to opt-out of EBSCO Journal Service (EJS) Smartlink:\n";
		$m .="-----------------------------------------------------------\n";
		$m .="CustomerID: " . stripslashes($_REQUEST['cust_id']) . "\n";
		$m .="Institution: " . stripslashes($_REQUEST['institution_name']) . "\n";
		$m .="Name: " . stripslashes($_REQUEST['name']) . "\n";
		$m .="Street: " . stripslashes($_REQUEST['street']) . "\n";
		$m .="City: " . stripslashes($_REQUEST['city']) . "\n";
		$m .="State Province: " . stripslashes($_REQUEST['state_province']) . "\n";
		$m .="Zip Code: " . stripslashes($_REQUEST['zip_code']) . "\n";
		$m .="Country: " . stripslashes($_REQUEST['country']) . "\n";
		$m .="E-Mail: " . stripslashes($_REQUEST['email']) . "\n";
		$m .="Phone: " . stripslashes($_REQUEST['phone']) . "\n";
		$m .="EJS Customer Code: " . stripslashes($_REQUEST['ejscode']) . "\n";
		$m .="-----------------------------------------------------------\n\n";		
								
		// Mail headers
		$date = date("m/d/Y");
		$mailsubject = "EBSCO Journal Service (EJS) Smartlink Opt-Out Request: $date";
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
		
		On December 14, 2009, EBSCO will enable EJS Smartlinking to all mutual EJS and EBSCO Publishing customers.  If you wish to remove your institution from having 
		this set-up, please complete this form.

				
		<br /><br />
		<?
	}
	?>
	
<div>
<form id="ejs_smartlinking_optout" name="ejs_smartlinking_optout" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="notme" value="<?=$_REQUEST["notme"]?>"/>
<table cellpadding="0" cellspacing="0" border="0" width="90%">
	
	<tr>
			<? 
				if(isset($custinfo)) {  
				
				echo "<td colspan='2'>Customer ID / Institution Name:<br />";
				echo "<b>" . $custinfo[0] . " - " . $custinfo[1] . "</b>"; echo "<a href='?notme=true'> (Change institution)</a>";
				echo "<input type='hidden' name='institution_name' value='". $custinfo[1]."'>";
				echo "<input type='hidden' name='cust_id' value='".$custinfo[0]."'>";
				echo "</td>";
				}
				else {
			?>
			
		<td>Customer ID <span class="small">(optional)</span>:<br /><input input style="width:250px;" type="text" name="cust_id" value="<? if(isset($_POST['cust_id'])) echo $_POST['cust_id'];?>" tabindex="1" /></td>
		<td>*Institution Name:<br /><input input style="width:250px;" type="text" name="institution_name" value="<? if(isset($_POST['institution_name'])) echo $_POST['institution_name'];?>" tabindex="2" /></td>
			<? } ?>
	</tr>
	<tr>
		<td>*Contact Name:<br /><input style="width:250px;" type="text" name="name" value="<?= stripslashes($name); ?>" tabindex="3" /></td>
		<td>*Street:<br /><input style="width:250px;" type="text" name="street" value="<?= stripslashes($street); ?>" tabindex="4" /></td>
	</tr>
	<tr>
		<td>*City:<br /><input style="width:250px;" type="text" name="city" value="<?= stripslashes($city); ?>" tabindex="5" /></td>
		<td>*State/Province:<br /><input style="width:250px;" type="text" name="state_province" value="<?= stripslashes($state_province); ?>" tabindex="6" /></td>
	</tr>
	<tr>
		<td>*Zip/Postal Code:<br /><input style="width:250px;" type="text" name="zip_code" value="<?= stripslashes($zip_code); ?>" tabindex="7" /></td>
		<td>Country:<br /><input style="width:250px;" type="text" name="country" value="<?= stripslashes($country); ?>" tabindex="8" /></td>
	</tr>
	<tr>
		<td>*E-mail:<br /><input style="width:250px;" type="text" name="email" value="<?= stripslashes($email); ?>" maxlength="50" tabindex="9" /></td>
		<td>*Phone:<br /><input style="width:250px;" type="text" name="phone" value="<?= stripslashes($phone); ?>" maxlength="50" tabindex="10" /></td>
	</tr>
	<tr>
		<td>EJS Customer Code:<br /><input style="width:250px;" type="text" name="ejscode" value="<?= stripslashes($ejscode); ?>" maxlength="50" tabindex="11" /></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="2">* required fields<br /><br /></th>
	</tr>
	<tr>
		<td colspan="2">
			Please call Tech Support if you have any questions or <a href="/contact/askus.php"> email</a> us.<br /><br />
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="hidden" name="page_function" value="send" /> <input type="image" src="/images/btn_submit.gif" alt="Submit" class="graphic_button" tabindex="13" /></td>
	</tr>
</table>
</form>
</div>
	

<?php
}
?>


<?php
# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>