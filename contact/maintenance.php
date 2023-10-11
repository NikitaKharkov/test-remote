<?php

/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('Ask Us');

$template->printHeader();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/contact/field_datatest.php");
		
	if ($_REQUEST["notme"]!="true" && isset($_COOKIE["webauth"])) {
		$cookie=explode("&",$_COOKIE["webauth"]);
		$ugvalue=substr($cookie[0], 3);
		
		$connection = mssql_connect('esddw.epnet.com:1433','CustSatTools','VCgHDz6');
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

include($_SERVER['DOCUMENT_ROOT'] . "/library/searchboxes/searchbox.php");
?>
</form>
<h3>Product Maintenance or Emergency Downtime Notification</h3>
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
<div id="message">
	Thank you, we have received your request. You will receive a confirmation email with the netcrm case number.
</div>
<?
}

/**
*
* send
* 
*/
if ($page_function == "send") {
	
	if (($_REQUEST['occupation'] == "2" || $_REQUEST['occupation'] == "3") && ($_REQUEST['service'] != "NetLibrary"))
	
	{    
	
	?>
		<div class="message">
			Thank you for using EBSCOhost services. The library administrator at your institution can best handle your inquiry.
			For your convenience, answers to frequently asked questions (FAQs) are available in our searchable knowledge base at
			<a href="http://support.epnet.com">http://support.epnet.com</a>. Here are some examples of what you will find there:<br /><br />
			
			<ul>
				<li>How to Access EBSCOhost: <a href="http://support.epnet.com/knowledge_base/detail.php?faq=1265">http://support.epnet.com/knowledge_base/detail.php?faq=1265</a></li>
				<li>Help with Searching: <a href="http://support.epnet.com/uploads/CustSupport/UserDocumentation/ebs_2219.PDF">http://support.epnet.com/uploads/CustSupport/UserDocumentation/ebs_2219.PDF</a></li>
				<li>Check out our Documentation: <a href="http://support.epnet.com/knowledge_base/index.php?page_function=services">http://support.epnet.com/knowledge_base/index.php?page_function=services</a></li>
				<li>Watch a Flash Tutorial: <a href="http://support.epnet.com/training/tutorials.php">http://support.epnet.com/training/tutorials.php</a></li>
			</ul>
		</div>
	<?
		$template->printFooter();
		die();
	}

	//  Validate the form submission.
	$email2 = stripslashes($_POST["email2"]);
	
	if (!empty($email2)) {
	header("location: askus.php");
	exit();
	}
	
	$validator = new Validator();
	
	if(($_REQUEST['scope1'] == '') && ($_REQUEST['scope2'] == '') && ($_REQUEST['scope3'] == '') && ($_REQUEST['scope4'] == '') && ($_REQUEST['scope5'] == '') && ($_REQUEST['scope6'] == '') && ($_REQUEST['scope7'] == '') && ($_REQUEST['scope8'] == '') && ($_REQUEST['scope9'] == '') && ($_REQUEST['scope12'] == '') && ($_REQUEST['other'] == '') && ($_REQUEST['scope_other'] == ''))
	{ 
	$validator->validateFields("name, reason, email, audience, smonth, sday, syear, shours, smins, emonth, eday, eyear, ehours, emins, other, scope_other");
	
	echo "<span class='red'>Please select at least one Product/Scope of Maintenance</span>"."<br /><br />";
	
	}
	elseif(($_REQUEST['scope_other'] != '') && ($_REQUEST['other'] == ''))
	{ 
	$validator->validateFields("name, reason, email, audience, smonth, sday, syear, shours, smins, emonth, eday, eyear, ehours, emins, other");
	}
	elseif(($_REQUEST['scope_other'] == '') && ($_REQUEST['other'] != ''))
	{ 
	$validator->validateFields("name, reason, email, other, audience, smonth, sday, syear, shours, smins, emonth, eday, eyear, ehours, emins, scope_other");
	}
	else
	$validator->validateFields("name, reason, email, audience, smonth, sday, syear, shours, smins, emonth, eday, eyear, ehours, emins");	
		
	if (!$validator->getError()){
		$validator->validateEmail($_REQUEST['email']);
	}
	
		
	if ($validator->getError()){
		$error = str_replace("first_name <strong>or</strong> last_name <strong>or</strong> institution_name", "email", $validator->getError());
		$page_function = "show_form";
	} else {
			//Dynamic values
			$values["companyname"] = stripslashes($_REQUEST['institution_name']);
			$values["email"] = stripslashes($_REQUEST['email']);
			$values["title"] = stripslashes($_REQUEST['subject']);
			$values["custevent_occupationtextfield"] = stripslashes($_REQUEST['occupation']);
			$values["issue"] = stripslashes($_REQUEST['category']);
	
			$values["incomingmessage"] .= "Requestor Name: ".stripslashes($_REQUEST['name'])."\n\n";
			$values["incomingmessage"] .= "Reason for outage: ".stripslashes($_REQUEST['reason'])."\n\n";
			
			$values["incomingmessage"] .= "Product(s) impacted: " . "\n\n" . stripslashes($_REQUEST['scope1']) ."\n" . stripslashes($_REQUEST['scope2']) ."\n" . stripslashes($_REQUEST['scope3']) ."\n" . stripslashes($_REQUEST['scope4']) ."\n" . stripslashes($_REQUEST['scope5']) . "\n" . stripslashes($_REQUEST['scope6']) ."\n". stripslashes($_REQUEST['scope7']) ."\n". stripslashes($_REQUEST['scope8']) ."\n". stripslashes($_REQUEST['scope9']) ."\n". stripslashes($_REQUEST['scope12']) ."\n". stripslashes($_REQUEST['other'])." - ".stripslashes($_REQUEST['scope_other']) ."\n\n";
			
			//$values["incomingmessage"] .= "Scope of Maintenance Window: " . "\n\n" . stripslashes($_REQUEST['scope1']) .", " . stripslashes($_REQUEST['scope2']) .", " . stripslashes($_REQUEST['scope3']) .", " . stripslashes($_REQUEST['scope4']) .", " . stripslashes($_REQUEST['scope5']) .", ". stripslashes($_REQUEST['scope6']) .", ". stripslashes($_REQUEST['scope7']) ."\n". stripslashes($_REQUEST['scope8']) . stripslashes($_REQUEST['scopeother']) ."\n\n";
			
			$values["incomingmessage"] .= "Audience: " . stripslashes($_REQUEST['audience'])."\n\n";
			$values["incomingmessage"] .= "Start date: " . stripslashes($_REQUEST['smonth']) ."-" . stripslashes($_REQUEST['sday']) ."-" . stripslashes($_REQUEST['syear']) ."&nbsp;&nbsp;&nbsp;" . stripslashes($_REQUEST['shours']) .":" . stripslashes($_REQUEST['smins']) ."\n\n";
			$values["incomingmessage"] .= "End date: " . stripslashes($_REQUEST['emonth']) ."-" . stripslashes($_REQUEST['eday']) ."-" . stripslashes($_REQUEST['eyear']) ."&nbsp;&nbsp;&nbsp;" . stripslashes($_REQUEST['ehours']) .":" . stripslashes($_REQUEST['emins']) ."\n\n";
			
			$values["incomingmessage"] .= "Comments: " . "\n\n" . stripslashes($_REQUEST['comment']) . "\n";
				
			//Static values for EP
			$values["h"] = "6b3a7de6e3b4af573d83";
			$values["compid"] = "392875";
			$values["formid"] = "37";
			
			//create url from values
			foreach ($values as $name => $value)
				$querystring .= $name.'='.urlencode($value).'&';
		
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL,"https://forms.netsuite.com/app/site/crm/externalcasepage.nl?whence=");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $querystring);
		curl_exec ($ch);
		
		if (curl_errno($ch)) {
		   print curl_error($ch);
		} else {
		   curl_close($ch);
		}
		
		curl_close ($ch);
			
		ob_end_clean();
		header("Location: " .  server_address() . $_SERVER['PHP_SELF'] . "?page_function=confirm");
		exit;
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
<div id="detail" style="padding-bottom:8px;">
<!--This form should be used to request an announcement be sent for <b>scheduled product maintenance requiring product downtime</b> or for <b>unplanned emergency product maintenance requiring product downtime</b>. Please note that all fields below are required to submit this form.
<br /><br /><b>Reminder</b>: All scheduled product downtime announcements/site messages need to be sent/posted at least 10 calendar days prior to the maintenance window.-->
Request for an announcement to be sent for <b>scheduled product maintenance requiring product downtime</b> or for <b>unplanned emergency product maintenance requiring product downtime</b>.
<br /><br /><b>Reminder</b>: All scheduled product downtime announcements/site messages need to be sent/posted at least 10 calendar days prior to the maintenance window.
<br /><br />
Please email maintenance/downtime requests to Leslie Sierra at <a href="mailto:lsierra@ebsco.com?subject=Product Maintenance or Emergency Downtime Notification Request">lsierra@ebsco.com</a>.
</div>

<? $_SESSION['nlAccountId'] = $_REQUEST['nlAccountId']; ?>
<?
	}
?>
<div id="detail">


<?

function printOptions($optionArray, $value) {

   foreach($optionArray as $key => $option)  {

      $result .= '<option value="'.$key.'"';    

      if(isset($value) && $value == $key) { 

         $result .= ' selected="selected"';

      }

      $result .= '>'.$option.'</option>';

   }

   return $result;
   
}

?> 
<!--
<form id="eis" name="eis" method="post" action="<?= $_SERVER['PHP_SELF']; ?>" onSubmit='return Validate();'>
<input type="hidden" name="notme" value="<?=$_REQUEST["notme"]?>"/>
<table align="center" cellpadding="8" cellspacing="1" class="option_table" border="0">
	<tr>
		<td>
			Requestor Name:<br /><input type="text" name="name" value="<? if(isset($_POST['name'])) echo $_POST['name'];?>" tabindex="1" />
		</td>
		<td>E-mail:<br /><input type="text" name="email" value="<? if(isset($_POST['email'])) echo $_POST['email'];?>" maxlength="50" tabindex="2" />
		</td>
	</tr>
	<tr>
		<td colspan="2">Reason for outage (include project ID & name if applicable):<br /><input style="width:350px;" type="text" name="reason" value="<? if(isset($_POST['reason'])) echo $_POST['reason'];?>" tabindex="3" /></td>
	</tr>
	<tr>
		
	
</td>
<td colspan="2">

<table border="0">
<tr>
<td>

<?
$intonly = 'unchecked';
$intandcust = 'unchecked';

if (isset($_POST['audience'])) {

$selected_radio = $_POST['audience'];

if ($selected_radio == 'Internal Only') {
$intonly = 'checked';
}
else if ($selected_radio == 'Internal and Customers') {
$intandcust = 'checked';
}
}
?>

Audience:<br />

<input style="width: auto;" type="radio" name="audience" value="Internal Only" <? print $intonly; ?> tabindex="4"/>Internal Only<br />
<input style="width: auto;" type="radio" name="audience" value="Internal and Customers" <? print $intandcust; ?> tabindex="5" />Internal and Customers (for selected application(s))
<br /><br />
Start Date:<br />
			<select  style="width:90px;" name="smonth" id="smonth" tabindex="6">
				<option value="">-Start Month-</option>
				<?= printOptions($smonth, $_POST['smonth']) ?>
			</select>
			<select style="width:90px;" name="sday" id="sday" tabindex="7">
				<option value="">-Start Day-</option>
				<?= printOptions($sday, $_POST['sday']) ?>
			</select>
			<select style="width:90px;" name="syear" id="syear" tabindex="8">
				<?= printOptions($syear, $_POST['syear']) ?>
			</select>
			<select style="width:90px;" name="shours" id="shours" tabindex="9">
				<option value="">-Start Hour-</option>
				<?= printOptions($shours, $_POST['shours']) ?>
			</select>
			<select style="width:90px;" name="smins" id="smins" tabindex="10">
				<option value="">-Start Min-</option>
				<?= printOptions($smins, $_POST['smins']) ?>
			</select> (24 hr format CST)
			<br />
		End Date:<br />
			<select  style="width:90px;" name="emonth" id="emonth" tabindex="11">
				<option value="">-End Month-</option>
				<?= printOptions($emonth, $_POST['emonth']) ?>
			</select>
			<select style="width:90px;" name="eday" id="eday" tabindex="12">
				<option value="">-End Day-</option>
				<?= printOptions($eday, $_POST['eday']) ?>
			</select>
			<select style="width:90px;" name="eyear" id="eyear" tabindex="13">
				<?= printOptions($eyear, $_POST['eyear']) ?>
			</select>
			<select style="width:90px;" name="ehours" id="ehours" tabindex="14">
				<option value="">-End Hour-</option>
				<?= printOptions($ehours, $_POST['ehours']) ?>
			</select>
			<select style="width:90px;" name="emins" id="emins" tabindex="15">
				<option value="">-End Min-</option>
				<?= printOptions($emins, $_POST['emins']) ?>
			</select> (24 hr format CST)
				
</td>
<td align="right" valign="bottom">
<img src="24hour_time_chart.jpg" />
</td> 
</tr>
</table>

	</td>
	</tr>

	
	<tr>
		<td colspan="2">
		
Application(s) impacted (Select all that apply):<br /><br />

	<table cellspacing="0" cellpadding="3" border="0" width="600">
		<tr>
			<td>A-to-Z Administrator</td>
			<td>
				<select style="width:250px;" name="scope1" id="scope1" tabindex="16">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope1, $_POST['scope1']) ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>A-to-Z Reader Site</td>
			<td>
				<select style="width:250px;" name="scope2" id="scope2" tabindex="17">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope2, $_POST['scope2']) ?>
				</select>
			</td>
		</tr>
		<tr>
		<td>LinkSource</td>
		<td>
			<select style="width:250px;" name="scope3" id="scope3" tabindex="18">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope3, $_POST['scope3']) ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>ERM Essentials</td>
			<td>
				<select style="width:250px;" name="scope4" id="scope4" tabindex="19">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope4, $_POST['scope4']) ?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Usage Consolidation</td>
			<td>
				<select style="width:250px;" name="scope5" id="scope5" tabindex="20">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope5, $_POST['scope5']) ?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>EBSCONET Subscription Management<br />(access to ERM Essentials and Usage Consolidation)</td>
			<td>
				<select style="width:250px;" name="scope6" id="scope6" tabindex="21">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope6, $_POST['scope6']) ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>EBSCO Information MarketPlace: Desktop</td>
			<td>
				<select style="width:250px;" name="scope7" id="scope7" tabindex="22">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope7, $_POST['scope7']) ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>EBSCO Information MarketPlace: E-Procurement</td>
			<td>
				<select style="width:250px;" name="scope8" id="scope8" tabindex="23">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope8, $_POST['scope8']) ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>EBSCO Books</td>
			<td>
				<select style="width:250px;" name="scope9" id="scope9" tabindex="24">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope9, $_POST['scope9']) ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>EBSCONET Administration</td>
			<td>
				<select style="width:250px;" name="scope12" id="scope12" tabindex="25">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope12, $_POST['scope12']) ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Other (add application below)<br />
				<input style="width:246px;" name="other" id="other" value="<? if(isset($_POST['other'])) echo $_POST['other'];?>" tabindex="26" />
				<input type="hidden" name="subject" value="EIS Communications Product Downtime Message Request" tabindex="27" />
			</td>
			<td>
				<br />
				<select style="width:250px;" name="scope_other" id="scope_other" tabindex="28">
					<option value="">- Select Scope of Maintenance -</option>
					<?= printOptions($scope10, $_POST['scope_other']) ?>
				</select>
			</td>

							
		</tr>
	<table>

</td>
	</tr>
	<tr>
		<td colspan="2">
			Comments<br />
			<textarea name="comment" id="comment" style="width:565px" rows="10" cols="40" tabindex="28" /><?php echo $_POST['comment']; ?></textarea>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<input type="hidden" name="page_function" value="send" /><input type="submit" alt="Submit" class="greenbtn" value="Send" tabindex="29" />
		</td>
	</tr>
</table>
<div style="visibility:hidden">
	<input name="email2" type="text" size="45" id="email2" />
</div> 
</form>-->
</div>
<?php
}



# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>
