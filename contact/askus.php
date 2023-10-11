<?
//Redirect if necessary so the domain is ebscohost
$domainParts = explode(".",$_SERVER["SERVER_NAME"]);
  if($domainParts[1] != "ebscohost") {
    $domainParts[1] = "ebscohost";
	 header("Location: http://" . implode(".",$domainParts) . "/contact/askus.php");
	 die();
}
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php');
$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('Contact Support');
$template->printHeaderMT();

require_once($_SERVER['DOCUMENT_ROOT'] . "/contact/field_dataMT.php");

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
?>

<div class="ask_us_title">Contact Support</div>
<hr class="hrstyle">
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
<div class="message">
	<p>Thank you, we have received your case. You will receive a confirmation email and a technician will be in touch with you
	shortly.</p>

	<p>Once you have finished browsing the site, please close your browser to prevent others from viewing your case information.</p>
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
    //$email2 = stripslashes($_POST["email2"]);

  	//if (!empty($email2)) {
  	//header("location: askus.php");
  	//exit();
  	//}

	$validator = new Validator();
	$validator->validateFields("first_name, last_name, email, product, occupation, issue, g-recaptcha-response");

	if (!$validator->getError()){
		$validator->validateEmail($_REQUEST['email']);
	}

	if ($validator->getError()){
		$error = str_replace("first_name <strong>or</strong> last_name <strong>or</strong> institution_name", "email", $validator->getError());
		$page_function = "show_form";

	} else {
		//  Set the contact e-mail address.
		$to = "support@ebscohost.com"; //	Live e-mail account

    //  Compile the body of the e-mail.
		$m = "";
		$m .="Institution Name: " . stripslashes($_REQUEST['institution_name']) . "\n";
		$m .="Name: " . stripslashes($_REQUEST['first_name'])." ".stripslashes($_REQUEST['last_name'])."\n";
    $m .="Occupation: " . stripslashes($occupations[ $_REQUEST['occupation'] ]) . "\n";
    $m .="Email: " . stripslashes($_REQUEST['email']) . "\n\n";
		$m .="Subject: " . stripslashes($_REQUEST['subject']) . "\n";
    $m .="Product/Interface: ". stripslashes($products[ $_REQUEST['product'] ])."\n";
    $m .="Area of Support: ". stripslashes($_REQUEST['area'])."\n\n";

    if($_REQUEST['issue']){
			$m .="Issue: " . stripslashes($_REQUEST['issue']) . "\n\n";
		}

    $m .="-----------------------------------------------------------\n";

		// Mail headers
		$date = date("m/d/Y");
		$mailsubject = "Support Site: " . $_REQUEST['subject'] . $date;
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
?>

<div class="side-info">

  <div class="alert-box">
    <p style="font-size: 16px;">System Alerts</p>
    <p style="font-size: 14px;"><a href="https://status.ebsco.com/" target="_blank">See EBSCO System Status</a></p>
  </div>

  <div class="side-contact" style="font-size: 16px;">Product newsletters and information
    <ul>
        <li><a href="https://more.ebsco.com/Operational-Acad-Preference-Center_Academic-Preference-Center.html">Sign up to receive product newsletters and updates</a></li>

    </ul>

    Requests
    <ul>
        <li><a href="http://support.ebscohost.com/contact/ill.php" target="_blank">Request Custom ILL Form</a></li>

    </ul>

     <hr class="hrstyle">

    Librarians/Account Administrators:
    <ul>
        <li>U.S./Canada - (800)758-5995</li>
        <li>Outside U.S./Canada - 00-800-3272-6000</li>
    </ul>
    <p style="font-size: 14px;">
      <i>Hours of operation</i>:<br>
      Monday-Sunday, 24 hour support<br>

    </p>
  </div>

</div>

<?
	// errors, messages
	if ($error)	   echo "<div class=\"error\">" . $error . "</div>";
	if ($message)  echo "<div class=\"message\">". $message . "</div>";

	if(!$message && !$error){
?>



<div id="detail">
<h2>Looking for help? Try exploring our User Guides, Tutorials and FAQs.</h2>
<p>Still need help? Email Customer Support by filling in the form below.</p>

<?
	}
?>

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

<form id="lm_us" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="notme" value="<?=$_REQUEST["notme"]?>"/>
<table align="left" cellpadding="8" cellspacing="1" class="option_table_askus" border="0">
	<tr>
		<td>
			<?
				if(isset($custinfo)) {
				echo "<b>" . $custinfo[0] . " - " . $custinfo[1] . "</b><br/>";
				echo "<a href='?notme=true'> (Change institution)</a>";
				echo "<input type='hidden' name='institution_name' value='".$custinfo[0] . " - " . $custinfo[1]."'>";
				}

				else {
			?>

			<input type="text" name="institution_name" placeholder="Institution Name *" value="<? if(isset($_POST['institution_name'])) echo $_POST['institution_name'];?>" tabindex="1" />
			<? } ?>
		</td>
		<td>
			<select name="product" id="product" tabindex="5">
				<option value="">Product/Interface *</option>
				<?=printOptions($products, $_POST['product']) ?>
			</select>
    </td>
	</tr>
  <tr>
		<td>
			<input type="text" name="first_name" placeholder="First Name *" value="<? if(isset($_POST['first_name'])) echo $_POST['first_name'];?>" tabindex="2" />
		</td>
		<td>
      <div id="areaAjax" style="">
        <select name="area" id="area" disabled>
          <option value="">Area of Support</option>
        </select>
      </div>
    </td>
	</tr>
  <tr>
		<td><input type="text" name="last_name" placeholder="Last Name *" value="<? if(isset($_POST['last_name'])) echo $_POST['last_name'];?>" tabindex="3" /></td>
    <td>
			<select name="occupation" id="occupation" tabindex="8">
				<option value="">Occupation *</option>
				<?=printOptions($occupations, $_POST['occupation']) ?>
			</select>
  	</td>

	</tr>
	<tr>
		<td><input type="text" name="email" placeholder="Email *" value="<? if(isset($_POST['email'])) echo $_POST['email'];?>" maxlength="50" tabindex="4" /></td>
    <!--<td>
			<select name="category" id="category" tabindex="6">
				<option value="">Category *</option>
				<?=printOptions($categories, $_POST['category']) ?>
			</select>
		</td>-->
 	</tr>
	<tr>
		<td colspan="2"><input type="text" style="width:585px" name="subject" placeholder="Subject *" value="<? if (isset($_POST['subject'])) echo $_POST['subject'];?>" tabindex="9" /></td>
	</tr>
	<tr>
		<td colspan="2">
			<textarea name="issue" placeholder="Additional Comments" style="width:585px" rows="10" cols="40" tabindex="10" /><?php echo $_POST['issue']; ?></textarea>
			<input type="hidden" name="accountid" value="<? if(isset($_SESSION['nlAccountId'])) echo "NetLibrary Account ID: " . $_SESSION['nlAccountId'];?>" maxlength="20" /></td>
		</td>

	</tr>
  <tr>
<td colspan="2">
  By submitting this form, you agree to our <a href="https://www.ebsco.com/company/privacy-policy">Privacy Policy</a>
</td>
</tr>

	<tr>
		<td align="center" colspan="2">
			<input type="hidden" name="page_function" value="send" /><input type="submit" alt="Submit" class="redbut" value="Submit" tabindex="11" />
		</td>
	</tr>
<tr>
  <td>
    <div class="g-recaptcha" data-sitekey="6LdYc2EUAAAAAGr0lTdvM8hv_hN8CWltShntJNXe" data-callback="recaptcha_callback"></div>
  </td>
</tr>
</table>


	<!--<table border="0" align="center" cellpadding="8" cellspacing="1" class="option_table_right" border="0">

	<tr>
		<td valign="top" height="606px">
			<b>Training Resources</b>
			<ul>
			<li><a href="/tutorials" target="_blank">Tutorials</a><br /></li>
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
</table>-->

<!-- lm -->
<link rel="stylesheet" href="/stylesheets/jquery-ui.css" />
<script src="/javascripts/jquery-1.8.3.js"></script>
<script src="/javascripts/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // this function is triggered as soon as something changes in the form
    $("select[name='occupation']").change(function() {
        //console.log('found change');
		if (+$(this).val() == 2) {
        selectDialog('Pan','The library administrator at your institution can best handle your inquiry. For your convenience, frequently asked questions (FAQs), training, and tutorial links are available on the right side of this page.');
		}
    });

    function selectDialog(title, text) {
            return $('<div title="Patrons/Students/End Users"></div>').append(text)
            .dialog({
                resizable: true,
                modal: true,
                buttons: {
                    "OK": function() {
                        $(this).dialog("close");
                    }
                }
            });
        }

});
</script>

<!-- lm -->
<script>
    jQuery(document).ready(function(){
        // when any option from products list is selected
        jQuery("select[name='product']").change(function(){

            // get the selected option value of product
            var optionValue = jQuery("select[name='product']").val();
                jQuery.ajax({
                type: "GET",
                url: "data.php",
                data: "product="+optionValue+"&status=1",
                beforeSend: function(){ jQuery("#ajaxLoader").hide(); },
                complete: function(){ jQuery("#ajaxLoader").show(); },
                success: function(response){
                    jQuery("#areaAjax").html(response);
                    jQuery("#areaAjax").show();
                }
            });
        });
    });
</script>
</form>

</div>

<?php
}

# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooterMT();
?>
