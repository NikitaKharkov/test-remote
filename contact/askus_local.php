<?php
//Redirect if necessary so the domain is ebscohost 
$domainParts = explode(".",$_SERVER["SERVER_NAME"]);
if($domainParts[1] != "epnet") {
	$domainParts[1] = "epnet";
	header("Location: http://" . implode(".",$domainParts) . "/contact/askus_local.php");
	die();
}
/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('Ask Us');

$template->printHeader();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/contact/field_data.php");
		
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
<h3>EBSCO Support</h3>
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
	Thank you, we have received your case. You will receive a confirmation email and a technician will be in touch with you
	shortly.
	
	Once you have finished browsing the site, please close your browser to prevent others from viewing your case information.
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
			<a href="http://support.ebsco.com">http://support.ebsco.com</a>. Here are some examples of what you will find there:<br /><br />
			
			<ul>
				<li>How to Access EBSCOhost: <a href="http://support.ebsco.com/knowledge_base/detail.php?faq=1265">http://support.ebsco.com/knowledge_base/detail.php?faq=1265</a></li>
				<li>Help with Searching: <a href="http://support.ebsco.com/uploads/CustSupport/UserDocumentation/ebs_2219.PDF">http://support.ebsco.com/uploads/CustSupport/UserDocumentation/ebs_2219.PDF</a></li>
				<li>Check out our Documentation: <a href="http://support.ebsco.com/knowledge_base/index.php?page_function=services">http://support.ebsco.com/knowledge_base/index.php?page_function=services</a></li>
				<li>Watch a Flash Tutorial: <a href="http://support.ebsco.com/training/tutorials.php">http://support.ebsco.com/training/tutorials.php</a></li>
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
	$validator->validateFields("first_name, last_name, email, occupation, service, category, subject, issue");
	
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
			$values["custevent_itemproduct"] = stripslashes($_REQUEST['product']);
			$values["issue"] = stripslashes($_REQUEST['category']);
	
			$values["incomingmessage"] .= "Name: ".stripslashes($_REQUEST['first_name'])." ".stripslashes($_REQUEST['last_name'])."\n";
			$values["incomingmessage"] .= "Company: ".stripslashes($_REQUEST['institution_name'])."\n";
			$values["incomingmessage"] .= "Service: " . stripslashes($services[ $_REQUEST['service'] ]) . "\n\n";
			$values["incomingmessage"] .= stripslashes($_REQUEST['issue']) . "\n\n";
			$values["incomingmessage"] .= stripslashes($_REQUEST['accountid']);
						
			//Static values for EP
			$values["h"] = "d4acd011543448c98ae8";
			$values["compid"] = "392875";
			$values["formid"] = "17";
			
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
Looking for an answer to a specific question? Send a message to our Customer Support Team. Please provide information for all required fields (marked with an *).
<br /><br />
<span class="red"><b>Patrons/Students/End Users</b></span>: The librarian or administrator at your institution can best handle your inquiry. For your convenience, frequently asked questions (FAQs), training, and tutorial links are available on the right side of this page</div>

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

<form id="ask_us" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="notme" value="<?=$_REQUEST["notme"]?>"/>
<table align="left" cellpadding="8" cellspacing="1" class="option_table_askus" border="0">
	<tr>
		<td>Institution Name:<br />
			<? 
				if(isset($custinfo)) {  
				echo "<b>" . $custinfo[0] . " - " . $custinfo[1] . "</b><br/>";
				echo "<a href='?notme=true'> (Change institution)</a>";
				echo "<input type='hidden' name='institution_name' value='".$custinfo[0] . " - " . $custinfo[1]."'>";
				}
				
				else {
			?>
				
			<input type="text" name="institution_name" value="<? if(isset($_POST['institution_name'])) echo $_POST['institution_name'];?>" tabindex="1" />
			<? } ?>
			
		</td>
		
		<td>
			* Service:<br />
			<select name="service" id="service" tabindex="5">
				<option value="">-- Select --</option>
				<?=printOptions($services, $_POST['service']) ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			* First Name:<br /><input type="text" name="first_name" value="<? if(isset($_POST['first_name'])) echo $_POST['first_name'];?>" tabindex="2" />
		</td>
		<td>
			* Category:<br />
			<select name="category" id="category" tabindex="6">
				<option value="">-- Select --</option>
				<?=printOptions($categories, $_POST['category']) ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>* Last Name:<br /><input type="text" name="last_name" value="<? if(isset($_POST['last_name'])) echo $_POST['last_name'];?>" tabindex="3" /></td>
		<td>
			EBSCO Product:<br />
			<select name="product" id="product" tabindex="7">
				<option value="">-- Select --</option>
				<?=printOptions($products, $_POST['product'])?>
			</select>
		</td>
	</tr>
	<tr>
		<td>* E-mail:<br /><input type="text" name="email" value="<? if(isset($_POST['email'])) echo $_POST['email'];?>" maxlength="50" tabindex="4" /></td>
		<td>
			* My Occupation is:<br />
			<select name="occupation" id="occupation" tabindex="8">
				<option value="">-- Select --</option>
				<?=printOptions($occupations, $_POST['occupation']) ?>
			</select>
		</td>
		
	</tr>
	<tr>
		<td colspan="2">* Subject:<br /><input type="text" style="width:565px" name="subject" value="<? if (isset($_POST['subject'])) echo $_POST['subject'];?>" tabindex="9" /></td>
	</tr>
	<tr>
		<td colspan="2">
			* How can we help you?<br />
			(If applicable, please describe steps to recreate the issue)<br />
			<textarea name="issue" style="width:565px" rows="10" cols="40" tabindex="10" /><?php echo $_POST['issue']; ?></textarea>
			<input type="hidden" name="accountid" value="<? if(isset($_SESSION['nlAccountId'])) echo "NetLibrary Account ID: " . $_SESSION['nlAccountId'];?>" maxlength="20" /></td>
		</td>
	</tr>
	
	<tr>
		<td align="center" colspan="2">
			<input type="hidden" name="page_function" value="send" /><input type="submit" alt="Submit" class="greenbtn" value="Send" tabindex="11" />
		</td>
	</tr>
</table>

	<table border="0" align="center" cellpadding="8" cellspacing="1" class="option_table_right" border="0">
	
	<tr>
		<td valign="top" height="606px">
			<b>Training Resources</b>
			<ul>
			<li><a href="/training/tutorials.php" target="_blank">Tutorials</a><br /></li>
			<li><a href="https://ebscotraining.webex.com/tc0505ld/trainingcenter/record/navRecordAction.do?siteurl=ebscotraining&firstEnter=1" target="_blank">On-Demand Training</a></li>
			<li><a href="https://ebscotraining.webex.com/mw0306ld/mywebex/default.do?siteurl=ebscotraining" target="_blank">Online Training</a></li>
			</ul>
			<b>Top FAQs</b><br />
		<?
			try {
				$kb_pages = $kb_controller->listKbPages('last_updated_desc', NULL, NULL, NULL, NULL, array('public','private'), NULL, NULL, NULL, TRUE, 10);
			
				$c = 1;
				?>
				
				
				<?
				foreach($kb_pages as $kbp_id => $kbp) {
						
					$link = "/knowledge_base/detail.php?id=" . $kbp_id . "&amp;t=h";

					// $link .= ($private) ? "&amp;private=true" : "";
						
					if (!$kbp->getContent() && $kbp->getFile()) {
						$link = $kbp->getFile(TRUE);
					}
					?>

				<ul><li><a href="<?= $link; ?>"><?= $kbp->getTitle() ?></a></li></ul>
					
				
				
					<?
					$c++;
				}
				?>
				
				<?
			} catch (Exception $e) {}
			?>
			
		</td>
	</tr>
</table>


<div style="visibility:hidden">
	<input name="email2" type="text" size="45" id="email2" />
</div> 
</form>

</div>
<?php
}



# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>
