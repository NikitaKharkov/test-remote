<?php

/* --------------------------------------------------------------------- */
/* @author  Dave Tufts [dt] <dave@imarc.net>
/* --------------------------------------------------------------------- */
include($_SERVER['DOCUMENT_ROOT'] . '/library/init.php'); 

$template->setStyle('site');
$template->setColumn("left", "contact.php");
$template->setHtmlTitle('EIS Product Setup Form');

$template->printHeader();
	require_once($_SERVER['DOCUMENT_ROOT'] . "/contact/usf_field_data.php");
		
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

?>
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
<br />
<div id="demoWrapper"> 
	Thank you, your request has been sent. You will receive a confirmation email with a case number. A representative will contact you promptly.
	<br /><br />
	If you have additional comments or questions, please reply to the case number email you will receive.
	<br /><br />
	Click <a href="/contact/eisproductsetup.php">here</a> to setup additional products<br /><br />
	<a href="mailto:support@ebsco.com?subject=EIS Product Setup Form Feedback">EIS Product Setup Form Feedback</a><br /><br />
	<b>EBSCO Support</b><br /><br />
	Hours of operation:<br />
	Monday-Friday, 24 hour support<br />
	U.S. / Canada - (800) 758-5995, option 2<br />
	Outside U.S. / Canada<br />
	(Int'l access code) + 800-3272-6000
	
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
	
		{
			//Dynamic values
					
			$values["title"] = stripslashes($_REQUEST['subject']);
			$values["email"] = stripslashes($_REQUEST['requestor_email']);
			
			$values["incomingmessage"] .= "Requestor Name: ".stripslashes($_REQUEST['requestor_name'])." - ".stripslashes($_REQUEST['requestor_phone']) ."\n";
			$values["incomingmessage"] .= "Requestor Title: " . stripslashes($_REQUEST['requestor_title'])."\n";
			$values["incomingmessage"] .= "Requestor Office: " . stripslashes($_REQUEST['requestor_office'])."\n\n\n";
			
			//EBSCONET form
			$values["incomingmessage"] .= "Product: " . stripslashes($_REQUEST['EBSCONET'])."\n\n";
			$values["incomingmessage"] .= "EBSCONET Admin First Name: " . stripslashes($_REQUEST['ebsconet_admin_first_name'])." ".stripslashes($_REQUEST['ebsconet_admin_last_name'])."\n";
			$values["incomingmessage"] .= "Job title: " . stripslashes($_REQUEST['ebsconet_jobtitle'])."\n";
			$values["incomingmessage"] .= "Phone: " . stripslashes($_REQUEST['ebsconet_phone'])."\n";
			$values["incomingmessage"] .= "Fax: " . stripslashes($_REQUEST['ebsconet_fax'])."\n";
			$values["incomingmessage"] .= "Email: " . stripslashes($_REQUEST['ebsconet_email'])."\n";
			$values["incomingmessage"] .= "Institution name: " . stripslashes($_REQUEST['ebsconet_institution_name'])."\n";
			$values["incomingmessage"] .= "EIS Cust Code: " . stripslashes($_REQUEST['ebsconet_eiscustcode'])."\n";
			$values["incomingmessage"] .= "A-to-Z Cust ID: " . stripslashes($_REQUEST['atoz_custid'])."\n";
			$values["incomingmessage"] .= "Fund Code: " . stripslashes($_REQUEST['ebsconet_fundcode'])."\n";
			$values["incomingmessage"] .= "Welcome Letter Language: " . stripslashes($_REQUEST['welcome_letter_language'])."\n";
			$values["incomingmessage"] .= "Billing Location 1: " . stripslashes($_REQUEST['billingloc1'])."\n";
			$values["incomingmessage"] .= "Account(s) for location 1: " . stripslashes($_REQUEST['accountloc1'])."\n";
			$values["incomingmessage"] .= "Billing Location 2: " . stripslashes($_REQUEST['billingloc2'])."\n";
			$values["incomingmessage"] .= "Account(s) for location 2: " . stripslashes($_REQUEST['accountloc2'])."\n";
			$values["incomingmessage"] .= "Billing Location 3: " . stripslashes($_REQUEST['billingloc3'])."\n";
			$values["incomingmessage"] .= "Account(s) for location 3: " . stripslashes($_REQUEST['accountloc3'])."\n\n";

			$values["incomingmessage"] .= "Account Options for Production: " . "\n\n";
			$values["incomingmessage"] .= "Standard Default Options- " . "\n\n";
			
			$values["incomingmessage"] .= "1: " . stripslashes($_REQUEST['prod_orders'])."\n";
			$values["incomingmessage"] .= "2: " . stripslashes($_REQUEST['show_prices'])."\n";
			$values["incomingmessage"] .= "3: " . stripslashes($_REQUEST['claims'])."\n";
			$values["incomingmessage"] .= "4: " . stripslashes($_REQUEST['missing_copy_bank'])."\n";
			$values["incomingmessage"] .= "5: " . stripslashes($_REQUEST['order_activation_and_registration'])."\n";
			$values["incomingmessage"] .= "6: " . stripslashes($_REQUEST['e_journal_updates'])."\n";
			$values["incomingmessage"] .= "7: " . stripslashes($_REQUEST['e_journal_format_changes'])."\n";
			$values["incomingmessage"] .= "8: " . stripslashes($_REQUEST['allow_create_subscriber'])."\n";
			$values["incomingmessage"] .= "9: " . stripslashes($_REQUEST['allow_cover_images']) . "\n\n";
			
			$values["incomingmessage"] .= "Additional Options- " . "\n\n";
			$values["incomingmessage"] .= "10: " . stripslashes($_REQUEST['view_original_invoices'])."\n";
			$values["incomingmessage"] .= "11: " . stripslashes($_REQUEST['view_supplemental_invoices'])."\n";
			$values["incomingmessage"] .= "12: " . stripslashes($_REQUEST['claim_checker_int'])."\n";
			$values["incomingmessage"] .= "13: " . stripslashes($_REQUEST['local_check'])."\n";
			$values["incomingmessage"] .= "14: " . stripslashes($_REQUEST['renewals'])."\n";
			$values["incomingmessage"] .= "15: " . stripslashes($_REQUEST['load_renewals'])."\n";
			$values["incomingmessage"] .= "16: " . stripslashes($_REQUEST['jets_order_activity'])."\n";
			$values["incomingmessage"] .= "17: " . stripslashes($_REQUEST['e_package_renewals'])."\n";
			$values["incomingmessage"] .= "18: " . stripslashes($_REQUEST['link_to_A-to-Z_admin'])."\n";
			$values["incomingmessage"] .= "19: " . stripslashes($_REQUEST['link_to_minerva_infonet'])."\n";
			$values["incomingmessage"] .= "20: " . stripslashes($_REQUEST['upload_EDI_claims'])."\n";
			$values["incomingmessage"] .= "21: " . stripslashes($_REQUEST['download_EDI_invoices']) ."\n\n";
			
			$values["incomingmessage"] .= "Reports for Production: " . "\n\n";
			$values["incomingmessage"] .= "Standard Default Reports- " . "\n\n";
			$values["incomingmessage"] .= "1: " . stripslashes($_REQUEST['abstract_and_index'])."\n";
			$values["incomingmessage"] .= "2: " . stripslashes($_REQUEST['bulletin_of_serials_changes'])."\n";
			$values["incomingmessage"] .= "3: " . stripslashes($_REQUEST['claim_checker'])."\n";
			$values["incomingmessage"] .= "4: " . stripslashes($_REQUEST['claims_processed'])."\n";
			$values["incomingmessage"] .= "5: " . stripslashes($_REQUEST['collection_assessment'])."\n";
			$values["incomingmessage"] .= "6: " . stripslashes($_REQUEST['combination_membership'])."\n";
			$values["incomingmessage"] .= "7: " . stripslashes($_REQUEST['current_subscriptions'])."\n";
			$values["incomingmessage"] .= "8: " . stripslashes($_REQUEST['e_journal_access_and_registration'])."\n";
			$values["incomingmessage"] .= "9: " . stripslashes($_REQUEST['historical_price_analysis'])."\n";
			$values["incomingmessage"] .= "10: " . stripslashes($_REQUEST['library_of_congress_classification'])."\n";
			$values["incomingmessage"] .= "11: " . stripslashes($_REQUEST['license_details'])."\n";
			$values["incomingmessage"] .= "12: " . stripslashes($_REQUEST['list_of_membership_titles'])."\n";
			$values["incomingmessage"] .= "13: " . stripslashes($_REQUEST['online_availability'])."\n";
			$values["incomingmessage"] .= "14: " . stripslashes($_REQUEST['ownership_access'])."\n";
			$values["incomingmessage"] .= "15: " . stripslashes($_REQUEST['publisher_packages'])."\n";
			$values["incomingmessage"] .= "16: " . stripslashes($_REQUEST['standing_order_bill_later_summary'])."\n";
			$values["incomingmessage"] .= "17: " . stripslashes($_REQUEST['subscriber_list'])."\n";
			$values["incomingmessage"] .= "18: " . stripslashes($_REQUEST['subscription_data_file'])."\n";
			$values["incomingmessage"] .= "19: " . stripslashes($_REQUEST['summary_of_new_titles_ordered'])."\n";
			$values["incomingmessage"] .= "20: " . stripslashes($_REQUEST['summary_of_payments'])."\n";
			$values["incomingmessage"] .= "21: " . stripslashes($_REQUEST['summary_of_publications'])."\n";
			$values["incomingmessage"] .= "22: " . stripslashes($_REQUEST['summary_of_publications_by_country_language'])."\n";
			$values["incomingmessage"] .= "23: " . stripslashes($_REQUEST['survey_for_customer_titles'])."\n";
			$values["incomingmessage"] .= "24: " . stripslashes($_REQUEST['titles_with_claiming_restrictions']) ."\n\n";
			
			$values["incomingmessage"] .= "Additional Reports- " . "\n\n";
			$values["incomingmessage"] .= "25: " . stripslashes($_REQUEST['jets_reports_packing_lists']) ."\n\n";
			
			$values["incomingmessage"] .= "Account Options for Trial: " . "\n\n";
			$values["incomingmessage"] .= "1: " . stripslashes($_REQUEST['trial_orders'])."\n";
			$values["incomingmessage"] .= "2: " . stripslashes($_REQUEST['trial_show_prices'])."\n";
			$values["incomingmessage"] .= "3: " . stripslashes($_REQUEST['trial_claims'])."\n";
			$values["incomingmessage"] .= "4: " . stripslashes($_REQUEST['trial_missing_copy_bank'])."\n";
			$values["incomingmessage"] .= "5: " . stripslashes($_REQUEST['trial_order_activation_and_registration'])."\n";
			$values["incomingmessage"] .= "6: " . stripslashes($_REQUEST['trial_e_journal_updates'])."\n";
			$values["incomingmessage"] .= "7: " . stripslashes($_REQUEST['trial_e_journal_format_changes'])."\n";
			$values["incomingmessage"] .= "8: " . stripslashes($_REQUEST['trial_allow_create_subscriber'])."\n";
			$values["incomingmessage"] .= "9: " . stripslashes($_REQUEST['trial_allow_cover_images']) ."\n\n";
						
			$values["incomingmessage"] .= "Reports for Trial: " . "\n\n";
			$values["incomingmessage"] .= "10: " . stripslashes($_REQUEST['trial_abstract_and_index'])."\n";
			$values["incomingmessage"] .= "11: " . stripslashes($_REQUEST['trial_bulletin_of_serials_changes'])."\n";
			$values["incomingmessage"] .= "12: " . stripslashes($_REQUEST['trial_claims_processed'])."\n";
			$values["incomingmessage"] .= "13: " . stripslashes($_REQUEST['trial_collection_assessment'])."\n";
			$values["incomingmessage"] .= "14: " . stripslashes($_REQUEST['trial_combination_membership'])."\n";
			$values["incomingmessage"] .= "15: " . stripslashes($_REQUEST['trial_current_subscriptions'])."\n";
			$values["incomingmessage"] .= "16: " . stripslashes($_REQUEST['trial_e_journal_access_and_registration'])."\n";
			$values["incomingmessage"] .= "17: " . stripslashes($_REQUEST['trial_library_of_congress_classification'])."\n";
			$values["incomingmessage"] .= "18: " . stripslashes($_REQUEST['trial_license_details'])."\n";
			$values["incomingmessage"] .= "19: " . stripslashes($_REQUEST['trial_list_of_membership_titles'])."\n";
			$values["incomingmessage"] .= "20: " . stripslashes($_REQUEST['trial_publisher_packages'])."\n";
			$values["incomingmessage"] .= "21: " . stripslashes($_REQUEST['trial_subscriber_list'])."\n";
			$values["incomingmessage"] .= "22: " . stripslashes($_REQUEST['trial_summary_of_new_titles_ordered'])."\n";
			$values["incomingmessage"] .= "23: " . stripslashes($_REQUEST['trial_summary_of_publications'])."\n";
			$values["incomingmessage"] .= "24: " . stripslashes($_REQUEST['trial_summary_of_publications_by_country_language'])."\n";
			$values["incomingmessage"] .= "25: " . stripslashes($_REQUEST['trial_titles_with_claiming_restrictions']) ."\n\n\n";
			
			//ERM Essentials
			$values["incomingmessage"] .= "Product: " . stripslashes($_REQUEST['ERM'])."\n\n";
			$values["incomingmessage"] .= "ERM Essentials order number: " . stripslashes($_REQUEST['erm_order_number'])."\n";
			$values["incomingmessage"] .= "A-to-Z order number (not trial): " . stripslashes($_REQUEST['atoz_order_number'])."\n";
			$values["incomingmessage"] .= "A-to-Z customer ID: " . stripslashes($_REQUEST['atoz_customer_id'])."\n";
			$values["incomingmessage"] .= "A-to-Z customer code: " . stripslashes($_REQUEST['atoz_customer_code'])."\n";
							
			//ERM Essentials (If existing EBSCONET account)	
			$values["incomingmessage"] .= "EBSCONET customer code: " . stripslashes($_REQUEST['erm_ebsconet_cust_code'])."\n";
			$values["incomingmessage"] .= "EJS customer ID: " . stripslashes($_REQUEST['ejs_customer_id'])."\n";
			$values["incomingmessage"] .= "ERM Essentials administrator name: " . stripslashes($_REQUEST['erm_admin_name'])."\n";
			$values["incomingmessage"] .= "Job title: " . stripslashes($_REQUEST['erm_job_title'])."\n";
			$values["incomingmessage"] .= "Phone number: " . stripslashes($_REQUEST['erm_phone'])."\n";
			$values["incomingmessage"] .= "Fax number: " . stripslashes($_REQUEST['erm_fax'])."\n";
			$values["incomingmessage"] .= "Email address: " . stripslashes($_REQUEST['erm_email'])."\n\n";
			
			//$values["incomingmessage"] .= "User already an EBSCONET User or Administrator: " . stripslashes($_REQUEST['already_ebsconet_user'])."\n";
			//$values["incomingmessage"] .= "Add additional ERM user: " . stripslashes($_REQUEST['already_ebsconet_user'])."\n";
			
			$values["incomingmessage"] .= "Select Account Options: " . "\n\n";
			$values["incomingmessage"] .= "1: " . stripslashes($_REQUEST['my_collection'])."\n";
			$values["incomingmessage"] .= "2: " . stripslashes($_REQUEST['renewals_erm'])."\n";
			$values["incomingmessage"] .= "3: " . stripslashes($_REQUEST['field_manager'])."\n";
			$values["incomingmessage"] .= "4: " . stripslashes($_REQUEST['erm_essentials_reports'])."\n";
			$values["incomingmessage"] .= "5: " . stripslashes($_REQUEST['upload'])."\n";
			$values["incomingmessage"] .= "6: " . stripslashes($_REQUEST['tasks'])."\n";
			$values["incomingmessage"] .= "7: " . stripslashes($_REQUEST['reminders'])."\n";
			$values["incomingmessage"] .= "8: " . stripslashes($_REQUEST['identity_manager'])."\n";
			$values["incomingmessage"] .= "9: " . stripslashes($_REQUEST['end_user_notes'])."\n";
			$values["incomingmessage"] .= "10: " . stripslashes($_REQUEST['custom_links_atoz'])."\n";
			$values["incomingmessage"] .= "111: " . stripslashes($_REQUEST['access_management']) ."\n\n\n";
						
			//EJS
			$values["incomingmessage"] .= "Product: " . stripslashes($_REQUEST['EJS'])."\n\n";
			$values["incomingmessage"] .= "Please enter EJS Cust ID: " . stripslashes($_REQUEST['ejs_id'])."\n";
			$values["incomingmessage"] .= "EBSCOhost Customer ID: " . stripslashes($_REQUEST['ehost_cust_id'])."\n";
			$values["incomingmessage"] .= "E-Journals database order number: " . stripslashes($_REQUEST['ejs_db_order_number'])."\n\n";
			$values["incomingmessage"] .= "Account numbers where E-journal order have been placed: " . stripslashes($_REQUEST['ejs_accounts'])."\n\n\n";
						
			//MARC Updates
			$values["incomingmessage"] .= "Product: " . stripslashes($_REQUEST['MARC'])."\n\n";
			$values["incomingmessage"] .= "MARC Updates Order Number: " . stripslashes($_REQUEST['marc_order_number'])."\n";
			$values["incomingmessage"] .= "Administrator Name: " . stripslashes($_REQUEST['marc_admin_name'])."\n";
			$values["incomingmessage"] .= "Job title: " . stripslashes($_REQUEST['marc_job_title'])."\n";
			$values["incomingmessage"] .= "Phone number: " . stripslashes($_REQUEST['marc_phone_number'])."\n";
			$values["incomingmessage"] .= "Fax number: " . stripslashes($_REQUEST['marc_fax_number'])."\n";
			$values["incomingmessage"] .= "Email address: " . stripslashes($_REQUEST['marc_email_address'])."\n";
			$values["incomingmessage"] .= "Notification email address(es): " . stripslashes($_REQUEST['marc_note_email_address']).", ".stripslashes($_REQUEST['marc_note_email_address2']) .", ".stripslashes($_REQUEST['marc_note_email_address3']) ."\n";
			$values["incomingmessage"] .= "Server URL: " . stripslashes($_REQUEST['marc_ftp_server_url'])."\n";
			$values["incomingmessage"] .= "Directory: " . stripslashes($_REQUEST['marc_ftp_server_directory'])."\n";
			$values["incomingmessage"] .= "Username: " . stripslashes($_REQUEST['marc_ftp_server_username'])."\n";
			$values["incomingmessage"] .= "Password: " . stripslashes($_REQUEST['marc_ftp_server_password'])."\n\n";
			
			$values["incomingmessage"] .= "Additional Options: " . "\n\n";
			$values["incomingmessage"] .= "1: " . stripslashes($_REQUEST['deliver_updates_only'])."\n";
			$values["incomingmessage"] .= "2: " . stripslashes($_REQUEST['holdings_changes_report'])."\n";
			$values["incomingmessage"] .= "3: " . stripslashes($_REQUEST['include_custom_titles'])."\n";
			$values["incomingmessage"] .= "4: " . stripslashes($_REQUEST['include_all_035'])."\n";
			$values["incomingmessage"] .= "5: " . stripslashes($_REQUEST['include_ISSN'])."\n";
			$values["incomingmessage"] .= "6: " . stripslashes($_REQUEST['include_key_title'])."\n";
			$values["incomingmessage"] .= "7: " . stripslashes($_REQUEST['seg_mono_marc_records'])."\n";
			$values["incomingmessage"] .= "8: " . stripslashes($_REQUEST['to_present'])."\n\n";
			
			$values["incomingmessage"] .= "Indicate Fields to Include: " . "\n\n";
			$values["incomingmessage"] .= "Field: " . stripslashes($_REQUEST['marc_field'])."\n";
			$values["incomingmessage"] .= "Ind 1: " . stripslashes($_REQUEST['marc_ind1'])."\n";
			$values["incomingmessage"] .= "Ind 2: " . stripslashes($_REQUEST['marc_ind2'])."\n";
			$values["incomingmessage"] .= "Field Text: " . stripslashes($_REQUEST['marc_field_text'])."\n";
			$values["incomingmessage"] .= "Req. Field: " . stripslashes($_REQUEST['marc_req_field'])."\n\n";
						
			$values["incomingmessage"] .= "Comments: " . "\n\n" .
			stripslashes($_REQUEST['marc_comments'])."\n";
				
			//Static values for EP
			$values["h"] = "6a0cf7e3f998093758e3";
			$values["compid"] = "392875";
			$values["formid"] = "42";
			
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

<?
	}
?>
<div style="background-color:#efefef;" id="detail">


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
 
<link rel="stylesheet" type="text/css" href="/contact/jqueryform/css/ui-lightness/jquery-ui-1.8.2.custom.css" />  
<style type="text/css">
body {background-color:#efefef;} 
</style>
	<div id="demoWrapper">
		<h3>EIS Unified Product Setup</h3>
		<h5 id="status"></h5>
		<hr />
			<!--<div id="step_visualization"></div>-->
		<br />
			<form id="eis" name="eis" id="eis" method="post" class="bbq" action="<?= $_SERVER['PHP_SELF']; ?>">
			
					<div id="fieldWrapper">
					<span class="step" id="Requestor-info">
					Welcome to the EIS Product Setup Wizard. Use this form to setup the following products:
					<ul>
						<li>EBSCONET</li>
						<li>ERM Essentials</li>
						<li>E-journals Database</li>
						<li>MARC Updates</li>
			</ul>
		Use the Continue button to move on. Use the Previous button to go back and change information you had previously entered. When you're finished setting up your products, you will be presented with a summary page where you can make changes.
		<br /><br />
		<span class="red">Important Note: Do not close your browser window until you submit this form and see the confirmation screen. Closing your browser window will clear all fields in the setup wizard.</span><br />
		<br /><br />
			<span class="font_normal_07em_black">Requestor info</span><br /><br />
				<div class="input">
					<label for="name">* Requestor name</label><br />
					<input class="input_field_12em required" name="requestor_name" id="requestor_name" value="<? if(isset($_POST['requestor_name'])) echo $_POST['requestor_name'];?>"><br />
					<label for="requestor_title">* Requestor title</label><br />
					<input class="input_field_12em required" name="requestor_title" id="requestor_title" value="<? if(isset($_POST['requestor_title'])) echo $_POST['requestor_title'];?>"><br />
					<label for="requestor_office">* Requestor office</label><br />
					<input class="input_field_12em required" name="requestor_office" id="requestor_office" value="<? if(isset($_POST['requestor_office'])) echo $_POST['requestor_office'];?>"><br />
					<label for="requestor_phone">* Requestor phone</label><br />
					<input class="input_field_12em required" name="requestor_phone" id="requestor_phone" value="<? if(isset($_POST['requestor_phone'])) echo $_POST['requestor_phone'];?>"><br />
					<label for="requestor_email">* Requestor email</label><br />
					<input class="input_field_12em required email" name="requestor_email" id="requestor_email" value="<? if(isset($_POST['requestor_email'])) echo $_POST['requestor_email'];?>"><br /><br />
				</div>
			</span>
	
			<span id="Product_select" class="step">
			To setup EBSCONET, click the Continue button.<br /><br />
			If you do not need to set up EBSCONET (an account exists or is not needed), choose "Skip to next product" from under
			the Product list menu before clicking the Continue button.<br /><br />
				<label for="product">* Product</label><br />
					<select style="width:auto;" class="input_field_12em link required" name="product" id="product">
						<option value="EBSCONET">EBSCONET</option>
						<option value="Product_select2">Skip to next product</option>
					</select><br />
				</span>
			
			<!-- EBSCONET -->
			<span id="EBSCONET" class="step">
			<input type="hidden" name="EBSCONET" value="EBSCONET" id="EBSCONET" />
				
				<div class="input">
				<span class="font_normal_07em_black">EBSCONET</span><div style="text-align:right; width:680px;"><img src="jqueryform/EBSCONET_100.png" /></div>
					<div id="ebsconet_div">	
						<div style="float:left; width:340px; padding-left:12px; padding:6px;">
							<label for="ebsconet_admin_first_name">* EBSCONET Administrator First Name</label><br />
							<input class="input_field_12em required" name="ebsconet_admin_first_name" id="ebsconet_admin_first_name" value="<? if(isset($_POST['ebsconet_admin_first_name'])) echo $_POST['ebsconet_admin_first_name'];?>" maxlength="50"><br />
							<label for="ebsconet_admin_last_name">* Last Name</label><br />
							<input class="input_field_12em required" name="ebsconet_admin_last_name" id="ebsconet_admin_last_name" value="<? if(isset($_POST['ebsconet_admin_last_name'])) echo $_POST['ebsconet_admin_last_name'];?>" maxlength="50"><br />
							<label for="ebsconet_phone">Phone number</label><br />
							<input class="input_field_12em" name="ebsconet_phone" id="ebsconet_phone" value="<? if(isset($_POST['ebsconet_phone'])) echo $_POST['ebsconet_phone'];?>" maxlength="50"><br />
							<label for="email_se">* Email address</label><br />
							<input class="input_field_12em required email" name="ebsconet_email" id="ebsconet_email" value="<? if(isset($_POST['ebsconet_email'])) echo $_POST['ebsconet_email'];?>" maxlength="50"><br />
							<label for="ebsconet_jobtitle">Job title</label><br />
							<input class="input_field_12em" name="ebsconet_jobtitle" id="ebsconet_jobtitle" value="<? if(isset($_POST['ebsconet_jobtitle'])) echo $_POST['ebsconet_jobtitle'];?>" maxlength="50"><br />
							<label for="ebsconet_fax">Fax number</label><br />
							<input class="input_field_12em" name="ebsconet_fax" id="ebsconet_fax" value="<? if(isset($_POST['ebsconet_fax'])) echo $_POST['ebsconet_fax'];?>" maxlength="50"><br />
							<label for="ebsconet_institution_name">* Institution name</label><br />
							<input class="input_field_12em required" name="ebsconet_institution_name" id="ebsconet_institution_name" value="<? if(isset($_POST['ebsconet_institution_name'])) echo $_POST['ebsconet_institution_name'];?>" maxlength="50"><br />
							<label for="ebsconet_eiscustcode">EIS Customer Code (to link to EBSCO Books)</label><br />
							<input class="input_field_12em" name="ebsconet_eiscustcode" id="ebsconet_eiscustcode" value="<? if(isset($_POST['ebsconet_eiscustcode'])) echo $_POST['ebsconet_eiscustcode'];?>" maxlength="50" tabindex="12" /><br />
							<label for="ebsconet_eiscustcode">A-to-Z Cust ID (if also the A-to-Z Administrator)</label><br />
							<input class="input_field_12em" name="atoz_custid" id="atoz_custid" value="<? if(isset($_POST['atoz_custid'])) echo $_POST['atoz_custid'];?>" maxlength="50" tabindex="12" /><br />
						</div>
						<div style="float:right; width:330px;">
							<label for="ebsconet_eiscustcode">Fund code</label><br />
							<input class="input_field_12em" name="ebsconet_fundcode" id="ebsconet_fundcode" value="<? if(isset($_POST['ebsconet_fundcode'])) echo $_POST['ebsconet_fundcode'];?>" maxlength="50" tabindex="12" /><br />
							<label for="welcome_letter_language">* Preferred welcome letter language</label><br />
							<select class="input_field_12em required" style="width:220px;" name="welcome_letter_language" id="welcome_letter_language" tabindex="14">
							<option value="">-Select Language-</option>
							<?= printOptions($welcome_letter_language, $_POST['welcome_letter_language']) ?>
							</select><br /><br />
							<label for="ebsconet_eiscustcode">Billing location 1</label><br />
							<input class="input_field_12em" name="billingloc1" id="billingloc1" value="<? if(isset($_POST['billingloc1'])) echo $_POST['billingloc1'];?>" maxlength="50" tabindex="12" /><br />
							<label for="ebsconet_eiscustcode">* Account(s) for location 1</label><br />
							<input class="input_field_12em required" type="text" name="accountloc1" id="accountloc1" placeholder="e.g. BR1111100, BR2222200" value="<? if(isset($_POST['accountloc1'])) echo $_POST['accountloc1'];?>" maxlength="50" tabindex="6" /><br />
							<label for="ebsconet_eiscustcode">Billing location 2</label><br />
							<input class="input_field_12em" name="billingloc2" id="billingloc2" value="<? if(isset($_POST['billingloc2'])) echo $_POST['billingloc2'];?>" maxlength="50" tabindex="12" /><br />
							<label for="ebsconet_eiscustcode">Account(s) for location 2</label><br />
							<input class="input_field_12em" name="accountloc2" id="accountloc2" placeholder="e.g. BR1111100, BR2222200" value="<? if(isset($_POST['accountloc2'])) echo $_POST['accountloc2'];?>" maxlength="50" tabindex="6" /><br />
							<label for="ebsconet_eiscustcode">Billing location 3</label><br />
							<input class="input_field_12em" name="billingloc3" id="billingloc3" value="<? if(isset($_POST['billingloc3'])) echo $_POST['billingloc3'];?>" maxlength="50" tabindex="12" /><br />
							<label for="ebsconet_eiscustcode">Account(s) for location 3</label><br />
							<input class="input_field_12em" name="accountloc3" id="accountloc3" placeholder="e.g. BR1111100, BR2222200" value="<? if(isset($_POST['accountloc3'])) echo $_POST['accountloc3'];?>" maxlength="50" tabindex="6" /><br /><br />
						</div>
					</div>
				</div>
				Once you have made your selections please select the Continue button.<br /><br />	
			</span>
	
			<span id="Production_or_Trial" class="step">
			<span class="font_normal_07em_black">Production or Trial</span><div style="text-align:right; width:680px;"><img src="jqueryform/EBSCONET_100.png" /></div>
				
					<label for="product">* Production or Trial</label><br />
					<select style="width:135px;" class="input_field_12em link required" name="product" id="product">
						<option value="EBSCONET-Production">Production</option>
						<option value="EBSCONET-Trial">Trial</option>
						
					</select><br />
				</span>
			
			<span id="EBSCONET-Production" class="step">
				<div id="production_div">
					<span class="font_normal_07em_black">Production</span><div style="text-align:right; width:680px;"><img src="jqueryform/EBSCONET_100.png" /></div>	
					<div class="input">	
					
						<div style="float:left; height:640px;">
						
							<label for="accountoptionsprod"><b>Account Options for Production (Check all that apply)</b></label><br />
							<ul style="list-style-image:none;">
							<li style="padding:4px;"><u>Standard Default Options</u></li>
							<li><input type="checkbox" style="width: auto;" name="prod_orders" id="prod_orders" value="Orders" <? if(isset($_POST['prod_orders'])) { echo "checked";}?> tabindex="14" checked> Orders</li>
							<li><input type="checkbox" style="width: auto;" name="show_prices" id="show_prices" value="Show Prices" <? if(isset($_POST['show_prices'])) { echo "checked";}?> tabindex="15" checked> Show Prices</li>
							<li><input type="checkbox" style="width: auto;" name="claims" id="claims" value="Claims" <? if(isset($_POST['claims'])) { echo "checked";}?> tabindex="16" checked> Claims</li>
							<li><input type="checkbox" style="width: auto;" name="missing_copy_bank" id="missing_copy_bank" value="Missing Copy Bank" <? if(isset($_POST['missing_copy_bank'])) { echo "checked";}?> tabindex="15" checked> Missing Copy Bank</li>
							<li><input type="checkbox" style="width: auto;" name="order_activation_and_registration" id="order_activation_and_registration" value="Order Activation and Registration" <? if(isset($_POST['order_activation_and_registration'])) { echo "checked";}?> tabindex="15" checked> Order Activation and Registration</li>
							<li><input type="checkbox" style="width: auto;" name="e_journal_updates" id="e_journal_updates" value="E-Journal Updates" <? if(isset($_POST['e_journal_updates'])) { echo "checked";}?> tabindex="15" checked> E-Journal Updates</li>
							<li><input type="checkbox" style="width: auto;" name="e_journal_format_changes" id="e_journal_format_changes" value="E-Journal Format Changes" <? if(isset($_POST['e_journal_format_changes'])) { echo "checked";}?> tabindex="15" checked> E-Journal Format Change</li>
							<li><input type="checkbox" style="width: auto;" name="allow_create_subscriber" id="allow_create_subscriber" value="Allow Create Subscriber" <? if(isset($_POST['allow_create_subscriber'])) { echo "checked";}?> tabindex="15" checked> Allow Create Subscriber</li>
							<li><input type="checkbox" style="width: auto;" name="allow_cover_images" id="allow_cover_images" value="Allow Cover Images" <? if(isset($_POST['allow_cover_images'])) { echo "checked";}?> tabindex="15" checked> Allow Cover Images</li>
							<li style="padding:4px;"><u>Additional Options</u></li>
							<li><input type="checkbox" style="width: auto;" name="view_original_invoices" id="view_original_invoices" value="View Original Invoices(OI) - USA customers only" <? if(isset($_POST['view_original_invoices'])) { echo "checked";}?> tabindex="15"> View Original Invoices(OI) - USA customers only</li>
							<li><input type="checkbox" style="width: auto;" name="view_supplemental_invoices" id="view_supplemental_invoices" value="View Supplemental Invoices(SI) - USA customers only" <? if(isset($_POST['view_supplemental_invoices'])) { echo "checked";}?> tabindex="15"> View Supplemental Invoices(SI) - USA customers only</li>
							<li><input type="checkbox" style="width: auto;" name="claim_checker_int" id="claim_checker_int" value="Claim Checker (interactive)" <? if(isset($_POST['claim_checker_int'])) { echo "checked";}?> tabindex="15"> Claim Checker (interactive)</li>
							<li><input type="checkbox" style="width: auto;" name="local_check" id="local_check" value="Local Check-in" <? if(isset($_POST['local_check'])) { echo "checked";}?> tabindex="15"> Local Check-in</li>
							<li><input type="checkbox" style="width: auto;" name="renewals" id="renewals" value="Renewals" <? if(isset($_POST['renewals'])) { echo "checked";}?> tabindex="15"> Renewals</li>
							<li><input type="checkbox" style="width: auto; margin-left:20px;" name="load_renewals" id="load_renewals" value="Load Renewals Now" <? if(isset($_POST['load_renewals'])) { echo "checked";}?> tabindex="15"> Load Renewals Now?</li>
							<li><input type="checkbox" style="width: auto;" name="jets_order_activity" id="jets_order_activity" value="JETS Order Activity" <? if(isset($_POST['jets_order_activity'])) { echo "checked";}?> tabindex="15"> JETS Order Activity</li>
							<li><input type="checkbox" style="width: auto;" name="e_package_renewals" id="e_package_renewals" value="E-Package Renewals" <? if(isset($_POST['e_package_renewals'])) { echo "checked";}?> tabindex="15"> E-Package Renewals</li>
							<li><input type="checkbox" style="width: auto;" name="link_to_A-to-Z_admin" id="link_to_A-to-Z_admin" value="Link to A-to-Z Admin" <? if(isset($_POST['link_to_A-to-Z_admin'])) { echo "checked";}?> tabindex="15"> Link to A-to-Z Admin</li>
							<li><input type="checkbox" style="width: auto;" name="link_to_minerva_infonet" id="link_to_minerva_infonet" value="Link to Minerva Infonet" <? if(isset($_POST['link_to_minerva_infonet'])) { echo "checked";}?> tabindex="15"> Link to Minerva Infonet</li>
							<li><input type="checkbox" style="width: auto;" name="upload_EDI_claims" id="upload_EDI_claims" value="Upload EDI Claims" <? if(isset($_POST['upload_EDI_claims'])) { echo "checked";}?> tabindex="15"> Upload EDI Claims</li>
							<li><input type="checkbox" style="width: auto;" name="download_EDI_invoices" id="download_EDI_invoices" value="Download EDI Invoices" <? if(isset($_POST['download_EDI_invoices'])) { echo "checked";}?> tabindex="15"> Download EDI Invoices</li>
							</ul>
						</div>
						
						<div style="float:right;height:640px;">
							<label for="accountoptionsprod"><b>Reports for Production (check all that apply)</b>:</label><br />
							<ul style="list-style-image:none;">
								<li style="padding:4px;"><u>Standard Default Reports</u></li>
								<li><input type="checkbox" style="width: auto;" name="abstract_and_index" id="abstract_and_index" value="Abstract and Index" <? if(isset($_POST['abstract_and_index'])) { echo "checked";}?> tabindex="14" checked> Abstract and Index</li>
								<li><input type="checkbox" style="width: auto;" name="bulletin_of_serials_changes" id="bulletin_of_serials_changes" value="Bulletin of Serials Changes" <? if(isset($_POST['bulletin_of_serials_changes'])) { echo "checked";}?> tabindex="15" checked> Bulletin of Serials Changes</li>
								<li><input type="checkbox" style="width: auto;" name="claim_checker" id="claim_checker" value="Claim Checker" <? if(isset($_POST['claim_checker'])) { echo "checked";}?> tabindex="16" checked> Claim Checker</li>
								<li><input type="checkbox" style="width: auto;" name="claims_processed" id="claims_processed" value="Claims Processed" <? if(isset($_POST['claims_processed'])) { echo "checked";}?> tabindex="15" checked> Claims Processed</li>
								<li><input type="checkbox" style="width: auto;" name="collection_assessment" id="collection_assessment" value="Collection Assessment" <? if(isset($_POST['collection_assessment'])) { echo "checked";}?> tabindex="15" checked> Collection Assessment</li>
								<li><input type="checkbox" style="width: auto;" name="combination_membership" id="combination_membership" value="Combination Membership" <? if(isset($_POST['combination_membership'])) { echo "checked";}?> tabindex="15" checked> Combination Membership</li>
								<li><input type="checkbox" style="width: auto;" name="current_subscriptions" id="current_subscriptions" value="Current Subscriptions" <? if(isset($_POST['current_subscriptions'])) { echo "checked";}?> tabindex="15" checked> Current Subscriptions</li>
								<li><input type="checkbox" style="width: auto;" name="e_journal_access_and_registration" id="e_journal_access_and_registration" value="E-Journal Access and Registration" <? if(isset($_POST['e_journal_access_and_registration'])) { echo "checked";}?> tabindex="15" checked> E-Journal Access and Registration</li>
								<li><input type="checkbox" style="width: auto;" name="historical_price_analysis" id="historical_price_analysis" value="Historical Price Analysis" <? if(isset($_POST['historical_price_analysis'])) { echo "checked";}?> tabindex="15" checked> Historical Price Analysis</li>
								<li><input type="checkbox" style="width: auto;" name="library_of_congress_classification" id="library_of_congress_classification" value=" Library of Congress Classification" <? if(isset($_POST['library_of_congress_classification'])) { echo "checked";}?> tabindex="15" checked> Library of Congress Classification</li>
								<li><input type="checkbox" style="width: auto;" name="license_details" id="license_details" value="License Details" <? if(isset($_POST['license_details'])) { echo "checked";}?> tabindex="15" checked> License Details</li>
								<li><input type="checkbox" style="width: auto;" name="list_of_membership_titles" id="list_of_membership_titles" value="List of Membership Titles" <? if(isset($_POST['list_of_membership_titles'])) { echo "checked";}?> tabindex="15" checked> List of Membership Titles</li>
								<li><input type="checkbox" style="width: auto;" name="online_availability" id="online_availability" value="Online Availability" <? if(isset($_POST['online_availability'])) { echo "checked";}?> tabindex="15" checked> Online Availability</li>
								<li><input type="checkbox" style="width: auto;" name="ownership_access" id="ownership_access" value="Ownership/Access" <? if(isset($_POST['ownership_access'])) { echo "checked";}?> tabindex="15" checked> Ownership/Access</li>
								<li><input type="checkbox" style="width: auto;" name="publisher_packages" id="publisher_packages" value="Publisher Packages" <? if(isset($_POST['publisher_packages'])) { echo "checked";}?> tabindex="15" checked> Publisher Packages</li>
								<li><input type="checkbox" style="width: auto;" name="standing_order_bill_later_summary" id="standing_order_bill_later_summary" value="Standing Order/Bill Later Summary" <? if(isset($_POST['standing_order_bill_later_summary'])) { echo "checked";}?> tabindex="15" checked> Standing Order/Bill Later Summary</li>
								<li><input type="checkbox" style="width: auto;" name="subscriber_list" id="subscriber_list" value="Subscriber List" <? if(isset($_POST['subscriber_list'])) { echo "checked";}?> tabindex="15" checked> Subscriber List</li>
								<li><input type="checkbox" style="width: auto;" name="subscription_data_file" id="subscription_data_file" value="Subscription Data File" <? if(isset($_POST['subscription_data_file'])) { echo "checked";}?> tabindex="15" checked> Subscription Data File</li>
								<li><input type="checkbox" style="width: auto;" name="summary_of_new_titles_ordered" id="summary_of_new_titles_ordered" value="Summary of New Titles Ordered" <? if(isset($_POST['summary_of_new_titles_ordered'])) { echo "checked";}?> tabindex="15" checked> Summary of New Titles Ordered</li>
								<li><input type="checkbox" style="width: auto;" name="summary_of_payments" id="summary_of_payments" value="Summary of Payments" <? if(isset($_POST['summary_of_payments'])) { echo "checked";}?> tabindex="15" checked> Summary of Payments</li>
								<li><input type="checkbox" style="width: auto;" name="summary_of_publications" id="summary_of_publications" value="Summary of Publications" <? if(isset($_POST['summary_of_publications'])) { echo "checked";}?> tabindex="15" checked> Summary of Publications</li>
								<li><input type="checkbox" style="width: auto;" name="summary_of_publications_by_country_language" id="summary_of_publications_by_country_language" value="Summary of Publications by Country/Language" <? if(isset($_POST['summary_of_publications_by_country_language'])) { echo "checked";}?> tabindex="15" checked> Summary of Publications by Country/Language</li>
								<li><input type="checkbox" style="width: auto;" name="survey_for_customer_titles" id="survey_for_customer_titles" value="Survey for Customer Titles" <? if(isset($_POST['survey_for_customer_titles'])) { echo "checked";}?> tabindex="15" checked> Survey for Customer Titles</li>
								<li><input type="checkbox" style="width: auto;" name="titles_with_claiming_restrictions" id="titles_with_claiming_restrictions" value="Titles with Claiming Restrictions" <? if(isset($_POST['titles_with_claiming_restrictions'])) { echo "checked";}?> tabindex="15" checked> Titles with Claiming Restrictions</li>
								<li style="padding:4px;"><u>Additional Reports</u></li>
								<li><input type="checkbox" style="width: auto;" name="jets_reports_packing_lists" id="jets_reports_packing_lists" value="JETS Reports - packing lists" <? if(isset($_POST['jets_reports_packing_lists'])) { echo "checked";}?> tabindex="15"> JETS Reports - packing lists</li>
							</ul><br /><br />
						</div>
					</div>
					
					<input type="hidden" name="Product_select2" value="Product_select2" class="link" />
				</div>
				Once you have made your selections please select the Continue button.<br /><br />	
				</span>
	
				<span id="EBSCONET-Trial" class="step">
				
					<div id="trial_div">	
						<div class="input">
								<span class="font_normal_07em_black">Trial</span><div style="text-align:right; width:680px;"><img src="jqueryform/EBSCONET_100.png" /></div>								
							<div style="float:left; height:340px;">
							
								<label for="accountoptionstrial"><b>Account Options for Trial (Check all that apply)</b></label><br />
								<ul style="list-style-image:none;">
									<li><input type="checkbox" style="width: auto;" name="trial_orders" id="trial_orders" value="Orders" <? if(isset($_POST['trial_orders'])) { echo "checked";}?> tabindex="14"> Orders</li>
									<li><input type="checkbox" style="width: auto;" name="trial_show_prices" id="trial_show_prices" value="Show Prices" <? if(isset($_POST['trial_show_prices'])) { echo "checked";}?> tabindex="15"> Show Prices</li>
									<li><input type="checkbox" style="width: auto;" name="trial_claims" id="trial_claims" value="Claims" <? if(isset($_POST['trial_claims'])) { echo "checked";}?> tabindex="16"> Claims</li>
									<li><input type="checkbox" style="width: auto;" name="trial_missing_copy_bank" id="trial_missing_copy_bank" value="Missing Copy Bank" <? if(isset($_POST['trial_missing_copy_bank'])) { echo "checked";}?> tabindex="15"> Missing Copy Bank</li>
									<li><input type="checkbox" style="width: auto;" name="trial_order_activation_and_registration" id="trial_order_activation_and_registration" value="Order Activation and Registration" <? if(isset($_POST['trial_order_activation_and_registration'])) { echo "checked";}?> tabindex="15"> Order Activation and Registration</li>
									<li><input type="checkbox" style="width: auto;" name="trial_e_journal_updates" id="trial_e_journal_updates" value="E-Journal Updates" <? if(isset($_POST['trial_e_journal_updates'])) { echo "checked";}?> tabindex="15"> E-Journal Updates</li>
									<li><input type="checkbox" style="width: auto;" name="trial_e_journal_format_changes" id="trial_e_journal_format_changes" value="E-Journal Format Changes" <? if(isset($_POST['trial_e_journal_format_changes'])) { echo "checked";}?> tabindex="15"> E-Journal Format Change</li>
									<li><input type="checkbox" style="width: auto;" name="trial_allow_create_subscriber" id="trial_allow_create_subscriber" value="Allow Create Subscriber" <? if(isset($_POST['trial_allow_create_subscriber'])) { echo "checked";}?> tabindex="15"> Allow Create Subscriber</li>
									<li><input type="checkbox" style="width: auto;" name="trial_allow_cover_images" id="trial_allow_cover_images" value="Allow Cover Images" <? if(isset($_POST['trial_allow_cover_images'])) { echo "checked";}?> tabindex="15"> Allow Cover Images</li>
								</ul>
								
							</div>
							
							<div style="float:right; height:440px;">
								
								<label for="reportsoptionstrial"><b>Reports for Trial (check all that apply)</b></label><br />
								
								<ul style="list-style-image:none;">
									<li><input type="checkbox" style="width: auto;" name="trial_abstract_and_index" id="trial_abstract_and_index" value="Abstract and Index" <? if(isset($_POST['trial_abstract_and_index'])) { echo "checked";}?> tabindex="14"> Abstract and Index</li>
									<li><input type="checkbox" style="width: auto;" name="trial_bulletin_of_serials_changes" id="trial_bulletin_of_serials_changes" value="Bulletin of Serials Changes" <? if(isset($_POST['trial_bulletin_of_serials_changes'])) { echo "checked";}?> tabindex="15"> Bulletin of Serials Changes</li>
									<li><input type="checkbox" style="width: auto;" name="trial_claims_processed" id="trial_claims_processed" value="Claims Processed" <? if(isset($_POST['trial_claims_processed'])) { echo "checked";}?> tabindex="15"> Claims Processed</li>
									<li><input type="checkbox" style="width: auto;" name="trial_collection_assessment" id="trial_collection_assessment" value="Collection Assessment" <? if(isset($_POST['trial_collection_assessment'])) { echo "checked";}?> tabindex="15"> Collection Assessment</li>
									<li><input type="checkbox" style="width: auto;" name="trial_combination_membership" id="trial_combination_membership" value="Combination Membership" <? if(isset($_POST['trial_combination_membership'])) { echo "checked";}?> tabindex="15"> Combination Membership</li>
									<li><input type="checkbox" style="width: auto;" name="trial_current_subscriptions" id="trial_current_subscriptions" value="Current Subscriptions" <? if(isset($_POST['trial_current_subscriptions'])) { echo "checked";}?> tabindex="15"> Current Subscriptions</li>
									<li><input type="checkbox" style="width: auto;" name="trial_e_journal_access_and_registration" id="trial_e_journal_access_and_registration" value="E-Journal Access and Registration" <? if(isset($_POST['trial_e_journal_access_and_registration'])) { echo "checked";}?> tabindex="15"> E-Journal Access and Registration</li>
									<li><input type="checkbox" style="width: auto;" name="trial_library_of_congress_classification" id="trial_library_of_congress_classification" value=" Library of Congress Classification" <? if(isset($_POST['trial_library_of_congress_classification'])) { echo "checked";}?> tabindex="15"> Library of Congress Classification</li>
									<li><input type="checkbox" style="width: auto;" name="trial_license_details" id="trial_license_details" value="License Details" <? if(isset($_POST['trial_license_details'])) { echo "checked";}?> tabindex="15"> License Details</li>
									<li><input type="checkbox" style="width: auto;" name="trial_list_of_membership_titles" id="trial_list_of_membership_titles" value="List of Membership Titles" <? if(isset($_POST['trial_list_of_membership_titles'])) { echo "checked";}?> tabindex="15"> List of Membership Titles</li>
									<li><input type="checkbox" style="width: auto;" name="trial_publisher_packages" id="trial_publisher_packages" value="Publisher Packages" <? if(isset($_POST['trial_publisher_packages'])) { echo "checked";}?> tabindex="15"> Publisher Packages</li>
									<li><input type="checkbox" style="width: auto;" name="trial_subscriber_list" id="trial_subscriber_list" value="Subscriber List" <? if(isset($_POST['trial_subscriber_list'])) { echo "checked";}?> tabindex="15"> Subscriber List</li>
									<li><input type="checkbox" style="width: auto;" name="trial_summary_of_new_titles_ordered" id="trial_summary_of_new_titles_ordered" value="Summary of New Titles Ordered" <? if(isset($_POST['trial_summary_of_new_titles_ordered'])) { echo "checked";}?> tabindex="15"> Summary of New Titles Ordered</li>
									<li><input type="checkbox" style="width: auto;" name="trial_summary_of_publications" id="trial_summary_of_publications" value="Summary of Publications" <? if(isset($_POST['trial_summary_of_publications'])) { echo "checked";}?> tabindex="15"> Summary of Publications</li>
									<li><input type="checkbox" style="width: auto;" name="trial_summary_of_publications_by_country_language" id="trial_summary_of_publications_by_country_language" value="Summary of Publications by Country/Language" <? if(isset($_POST['trial_summary_of_publications_by_country_language'])) { echo "checked";}?> tabindex="15"> Summary of Publications by Country/Language</li>
									<li><input type="checkbox" style="width: auto;" name="trial_titles_with_claiming_restrictions" id="trial_titles_with_claiming_restrictions" value="Titles with Claiming Restrictions" <? if(isset($_POST['trial_titles_with_claiming_restrictions'])) { echo "checked";}?> tabindex="15"> Titles with Claiming Restrictions</li>
								</ul>
						
							</div>
						</div>
						
						
					</div>
				Once you have made your selections please select the Continue button.<br /><br />	
				<input type="hidden" name="Product_select2" value="Product_select2" class="link" />	
				</span>
	
				<span id="Product_select2" class="step">
				If you're done with your setup select "Complete, Confirm, and Submit" from under the Product list menu before clicking the Continue button. Follow the prompts until you receive confirmation that your form has been submitted.<br /><br />
If you wish to skip setting up the selected product, choose "Skip to next product" from under the Product List menu before clicking the Continue button.<br /><br />

					<label for="product">* Product</label><br />
					<select style="width:auto;" class="input_field_12em link required" name="product" id="product">
						<option value="ERM">ERM Essentials</option>
						<option value="Product_Select3">Skip to next product</option>
						<option value="Confirmation">Complete, Confirm and Submit</option>
					</select><br />
				</span>
	
			<!-- ERM Essentials -->
			
				<span id="ERM" class="step">
					<div class="input">	
							<span class="font_normal_07em_black">ERM Essentials</span><div style="text-align:right; width:680px;"><img src="jqueryform/EBSCONET_100.png" /></div>	
						<div id="erm_div">	
							<div style="float:left; width:330px; padding-left:20px;">
								<input type="hidden" name="ERM" value="ERM" id="ERM" />
								<label for="erm_order_number">* ERM Essentials order number</label><br />
								<input class="input_field_12em required" name="erm_order_number" id="erm_order_number" value="<? if(isset($_POST['erm_order_number'])) echo $_POST['erm_order_number'];?>"><br />
								<label for="atoz_order_number">* A-to-Z order number (not trial)</label><br />
								<input class="input_field_12em required" name="atoz_order_number" id="atoz_order_number" value="<? if(isset($_POST['atoz_order_number'])) echo $_POST['atoz_order_number'];?>"><br />
								<label for="atoz_customer_code">* A-to-Z Customer ID</label><br />
								<input class="input_field_12em" name="atoz_customer_id" id="atoz_customer_id" value="<? if(isset($_POST['atoz_customer_id'])) echo $_POST['atoz_customer_id'];?>"><br />
								<label for="atoz_customer_code required">* A-to-Z Customer Code</label><br />
								<input class="input_field_12em" name="atoz_customer_code" id="atoz_customer_code" value="<? if(isset($_POST['atoz_customer_code'])) echo $_POST['atoz_customer_code'];?>"><br />
								<label for="erm_ebsconet_cust_code">* EBSCONET customer code<br />(if setting up EBSCONET now enter NA in this field)</label><br />
								<input class="input_field_12em required" name="erm_ebsconet_cust_code" id="erm_ebsconet_cust_code" value="<? if(isset($_POST['erm_ebsconet_cust_code'])) echo $_POST['erm_ebsconet_cust_code'];?>"><br />
								<label for="ejs_customer_id">* EJS Customer ID (active or inactive account)<br />(if an EJS ID does not exist enter NA in this field)</label><br />
								<input class="input_field_12em required" name="ejs_customer_id" id="ejs_customer_id" value="<? if(isset($_POST['ejs_customer_id'])) echo $_POST['ejs_customer_id'];?>"><br />
							</div>
							<div style="float:right; width:330px;">
								<label for="erm_admin_name">* ERM Essentials Administrator Name</label><br />
								<input class="input_field_12em required" name="erm_admin_name" id="erm_admin_name" value="<? if(isset($_POST['erm_admin_name'])) echo $_POST['erm_admin_name'];?>"><br />
								<label for="erm_job_title">Job Title</label><br />
								<input class="input_field_12em" name="erm_job_title" id="erm_job_title" value="<? if(isset($_POST['erm_job_title'])) echo $_POST['erm_job_title'];?>"><br />
								<label for="erm_phone">Phone Number</label><br />
								<input class="input_field_12em" name="erm_phone" id="erm_phone" value="<? if(isset($_POST['erm_phone'])) echo $_POST['erm_phone'];?>"><br />
								<label for="erm_fax">Fax number</label><br />
								<input class="input_field_12em" name="erm_fax" id="erm_fax" value="<? if(isset($_POST['erm_fax'])) echo $_POST['erm_fax'];?>"><br />
								<label for="erm_email">* Email Address</label><br />
								<input class="input_field_12em required email" name="erm_email" id="erm_email" value="<? if(isset($_POST['erm_email'])) echo $_POST['erm_email'];?>"><br /><br />
							</div>
						</div>
					</div>
					Once you have made your selections please select the Continue button.<br /><br />		
				</span>	
				
	<span id="ERM_Options" class="step">
	
	<div class="input">
	<span class="font_normal_07em_black">Account Options</span><div style="text-align:right; width:680px;"><img src="jqueryform/EBSCONET_100.png" /></div>	
	<label for="accountoptionsprod">Select Account Options:</label><br />
	
	<ul style="list-style-image:none;">
		<li><input type="checkbox" style="width: auto;" name="my_collection" id="my_collection" value="My Collection" <? if(isset($_POST['my_collection'])) { echo "checked";}?> tabindex="14" onclick="return false" onkeydown="return false" checked>* My Collection</li>
		<li><input type="checkbox" style="width: auto;" name="renewals_erm" id="renewals_erm" value="Renewals" <? if(isset($_POST['renewals_erm'])) { echo "checked";}?> tabindex="15" checked> Renewals</li>
		<li><input type="checkbox" style="width: auto;" name="field_manager" id="field_manager" value="Field Manager" <? if(isset($_POST['field_manager'])) { echo "checked";}?> tabindex="16" checked> Field Manager</li>
		<li><input type="checkbox" style="width: auto;" name="erm_essentials_reports" id="erm_essentials_reports" value="ERM Essentials Reports" <? if(isset($_POST['erm_essentials_reports'])) { echo "checked";}?> tabindex="15" checked> ERM Essentials Reports</li>
		<li><input type="checkbox" style="width: auto;" name="upload" id="upload" value="Upload" <? if(isset($_POST['upload'])) { echo "checked";}?> tabindex="15" checked> Upload</li>
		<li><input type="checkbox" style="width: auto;" name="tasks" id="tasks" value="Tasks" <? if(isset($_POST['tasks'])) { echo "checked";}?> tabindex="15" checked> Tasks</li>
		<li><input type="checkbox" style="width: auto;" name="reminders" id="reminders" value="Reminders" <? if(isset($_POST['reminders'])) { echo "checked";}?> tabindex="15" checked> Reminders</li>
		<li><input type="checkbox" style="width: auto;" name="identity_manager" id="identity_manager" value="Account Information (Identity Manager) - A-to-Z" <? if(isset($_POST['identity_manager'])) { echo "checked";}?> tabindex="15" checked> Account Information (Identity Manager) - A-to-Z</li>
		<li><input type="checkbox" style="width: auto;" name="end_user_notes" id="end_user_notes" value="End User Notes - A-to-Z" <? if(isset($_POST['end_user_notes'])) { echo "checked";}?> tabindex="15" checked> End User Notes - A-to-Z</li>
		<li><input type="checkbox" style="width: auto;" name="custom_links_atoz" id="custom_links_atoz" value="CustomLinks - A-to-Z" <? if(isset($_POST['custom_links_atoz'])) { echo "checked";}?> tabindex="15" checked> CustomLinks - A-to-Z</li>
		<li><input type="checkbox" style="width: auto;" name="access_management" id="access_management" value="Access Management (Proxy Settings) - A-to-Z" <? if(isset($_POST['access_management'])) { echo "checked";}?> tabindex="15" checked> Access Management (Proxy Settings) - A-to-Z</li>
	</ul><br /><br />
	</div>
		Once you have made your selections please select the Continue button.<br /><br />
	</span>	
	
		<span id="Product_Select3" class="step">
		If you're done with your setup select "Complete, Confirm, and Submit" from under the Product list menu before clicking the Continue button. Follow the prompts until you receive confirmation that your form has been submitted.<br /><br />
		If you wish to skip setting up the selected product, choose "Skip to next product" from under the Product List menu before clicking the Continue button.
	<br /><br />
					<label for="product">* Product</label><br />
					<select style="width:auto;" class="input_field_12em link required" name="product" id="product">
						<option value="EJS">E-Journals Database</option>
						<option value="Product_Select4">Skip to next product</option>
						<option value="Confirmation">Complete, Confirm and Submit</option>
						
					</select><br />
				</span>	
		
				<span id="EJS" class="step">
				<input type="hidden" name="EJS" value="EJS" id="EJS" />
				
				<div class="input">
						<span class="font_normal_07em_black">E-Journals Database</span><div style="text-align:right; width:680px;"><img src="jqueryform/logoEhost.jpg" /></div>
					<label for="ejs_id">* EJS Customer ID (active or inactive account)<br />
					(if an EJS ID does not exist enter NA in this field)</label><br />
					<input class="input_field_12em required" name="ejs_id" id="ejs_id" value="<? if(isset($_POST['ejs_id'])) echo $_POST['ejs_id'];?>"><br />
					<label for="ehost_cust_id">* EBSCOhost Customer ID</label><br />
					<input class="input_field_12em required" name="ehost_cust_id" id="ehost_cust_id" value="<? if(isset($_POST['ehost_cust_id'])) echo $_POST['ehost_cust_id'];?>"><br />
					<label for="ejs_db_order_number">* E-Journals database order number</label><br />
					<input class="input_field_12em required" name="ejs_db_order_number" id="ejs_db_order_number" value="<? if(isset($_POST['ejs_db_order_number'])) echo $_POST['ejs_db_order_number'];?>"><br />
					<label for="ejs_accounts">* List all account numbers where e-journal orders have been placed (separated with semi-colons)</label><br />
					<textarea rows="5" cols="40"  placeholder="e.g. BR1111100;BR2222200" name="ejs_accounts" id="ejs_accounts" value="<? if(isset($_POST['ejs_accounts'])) echo $_POST['ejs_accounts'];?>"></textarea><br /><br />
				</div><br />	
				</span>
								
				<span id="Product_Select4" class="step">
				If you're done with your setup select "Complete, Confirm, and Submit" from under the Product list menu before clicking the Continue button. Follow the prompts until you receive confirmation that your form has been submitted.<br /><br />
If you wish to skip setting up the selected product, choose "Skip to next product" from under the Product List menu before clicking the Continue button.
<br /><br />
					<label for="product">* Product</label><br />
					<select style="width:auto;" class="input_field_12em link required" name="product" id="product">
					<option value="MARC">MARC Updates</option>
						<option value="Confirmation">Complete, Confirm and Submit</option>
					</select><br />
				</span>
				
			<!-- MARC Updates Start -->
			
				<span id="MARC" class="step">
				<input type="hidden" name="MARC" value="MARC Updates" id="MARC" />
					<div class="input">
						<span class="font_normal_07em_black">MARC Updates</span><div style="text-align:right; width:680px;"><img src="jqueryform/MARC_100.jpg" /></div>
						<div id="marc_div">	
							<div style="float:left; width:330px;">
								
								<label for="sample_marc_record">Sample MARC Record<br /><b>We strongly encourage you to send a sample MARC record. To do so, reply to the automated case number email you will receive making sure to attach the sample MARC record</b></label><br /><br />
								<label for="marc_order_numbe">* MARC Updates order number</label><br />
								<input class="input_field_12em required" name="marc_order_number" id="marc_order_number" value="<? if(isset($_POST['marc_order_number'])) echo $_POST['marc_order_number'];?>"><br />
								<label for="marc_admin_name">* MARC Administrator name</label><br />
								<input class="input_field_12em required" name="marc_admin_name" id="marc_admin_name" value="<? if(isset($_POST['marc_admin_name'])) echo $_POST['marc_admin_name'];?>"><br />
								<label for="marc_job_title">Job title</label><br />
								<input class="input_field_12em" name="marc_job_title" id="marc_job_title" value="<? if(isset($_POST['marc_job_title'])) echo $_POST['marc_job_title'];?>"><br />					
								<label for="marc_phone_number">Telephone number</label><br />
								<input class="input_field_12em" name="marc_phone_number" id="marc_phone_number" value="<? if(isset($_POST['marc_phone_number'])) echo $_POST['marc_phone_number'];?>"><br />
								<label for="marc_fax_number">Fax number</label><br />
								<input class="input_field_12em" name="marc_fax_number" id="marc_fax_number" value="<? if(isset($_POST['marc_fax_number'])) echo $_POST['marc_fax_number'];?>"><br />					
								<label for="marc_email_address">* Email address</label><br />
								<input class="input_field_12em email required" name="marc_email_address" id="marc_email_address" value="<? if(isset($_POST['marc_email_address'])) echo $_POST['marc_email_address'];?>">
							</div>
							<div style="float:right; width:340px;">
								<label for="marc_note_email_address">List additional notification email addresses)</label><br />
								<input class="input_field_12em" name="marc_note_email_address" id="marc_note_email_address" value="<? if(isset($_POST['marc_note_email_address'])) echo $_POST['marc_note_email_address'];?>"><br />
								<input class="input_field_12em" name="marc_note_email_address2" id="marc_note_email_address2" value="<? if(isset($_POST['marc_note_email_address2'])) echo $_POST['marc_note_email_address2'];?>"><br />
								<input class="input_field_12em" name="marc_note_email_address3" id="marc_note_email_address3" value="<? if(isset($_POST['marc_note_email_address3'])) echo $_POST['marc_note_email_address3'];?>"><br /><br />
								<label for="ftp_server_label"><b>FTP Server (if other than A-to-Z FTP server)</b></label><br /><br /> 
								<label for="marc_ftp_server_url">Server URL</label><br />
								<input class="input_field_12em" name="marc_ftp_server_url" id="marc_ftp_server_url" value="<? if(isset($_POST['marc_ftp_server_url'])) echo $_POST['marc_ftp_server_url'];?>"><br />					
								<label for="marc_ftp_server_directory">Directory</label><br />
								<input class="input_field_12em" name="marc_ftp_server_directory" id="marc_ftp_server_directory" value="<? if(isset($_POST['marc_ftp_server_directory'])) echo $_POST['marc_ftp_server_directory'];?>"><br />
								<label for="marc_ftp_server_username">Username</label><br />
								<input class="input_field_12em" name="marc_ftp_server_username" id="marc_ftp_server_username" value="<? if(isset($_POST['marc_ftp_server_username'])) echo $_POST['marc_ftp_server_username'];?>"><br />					
								<label for="marc_ftp_server_password">Password</label><br />
								<input class="input_field_12em" name="marc_ftp_server_password" id="marc_ftp_server_password" value="<? if(isset($_POST['marc_ftp_server_password'])) echo $_POST['marc_ftp_server_password'];?>"><br /><br />
							</div>
						</div>
					</div>
						Once you have made your selections please select the Continue button.<br /><br />	
					</span>
					
					<span id="MARC-Options" class="step">
				
					<div class="input">
							<span class="font_normal_07em_black">MARC Options</span><div style="text-align:right; width:680px;"><img src="jqueryform/MARC_100.jpg" /></div>
					<label for="accountoptionsprod">Additional Options:</label><br />
						<ul style="list-style-image:none;">
							<li><input type="checkbox" style="width: auto;" name="deliver_updates_only" id="deliver_updates_only" value="Deliver updates only" <? if(isset($_POST['deliver_updates_only'])) { echo "checked";}?> tabindex="14" checked> Deliver updates only (added, changed, or deleted records)</li>
							<li><input type="checkbox" style="width: auto;" name="holdings_changes_report" id="holdings_changes_report" value="Send a Holdings Changes report via email" <? if(isset($_POST['holdings_changes_report'])) { echo "checked";}?> tabindex="15" checked> Send a Holdings Changes report via email</li>
							<li><input type="checkbox" style="width: auto;" name="include_custom_titles" id="include_custom_titles" value="Include custom titles" <? if(isset($_POST['include_custom_titles'])) { echo "checked";}?> tabindex="16" checked> Include custom titles</li>
							<li><input type="checkbox" style="width: auto;" name="include_all_035" id="include_all_035" value="Include all 035 fields" <? if(isset($_POST['include_all_035'])) { echo "checked";}?> tabindex="15" checked> Include all 035 fields</li>
							<li><input type="checkbox" style="width: auto;" name="include_ISSN" id="include_ISSN" value="Include ISSN in the 022 $a subfield" <? if(isset($_POST['include_ISSN'])) { echo "checked";}?> tabindex="15" checked> Include ISSN in the 022 $a subfield</li>
							<li><input type="checkbox" style="width: auto;" name="include_key_title" id="include_key_title" value="Include key title in field 222" <? if(isset($_POST['include_key_title'])) { echo "checked";}?> tabindex="15" checked> Include key title in field 222</li>
							<li><input type="checkbox" style="width: auto;" name="seg_mono_marc_records" id="seg_mono_marc_records" value="Segregate Monographic MARC Records" <? if(isset($_POST['seg_mono_marc_records'])) { echo "checked";}?> tabindex="15" checked> Segregate Monographic MARC Records</li>
							<li><input type="checkbox" style="width: auto;" name="to_present" id="to_present" value="Use the phrase 'to present' in coverage" <? if(isset($_POST['to_present'])) { echo "checked";}?> tabindex="15" checked> Use the phrase "to present" in coverage</li>
						</ul><br /><br />
						</div>
								Once you have made your selections please select the Continue button.<br /><br />	
						</span>	
						
					<span id="Include-Fields" class="step" >
					
						<div class="input">
							<span class="font_normal_07em_black">Indicate Fields to Include</span><div style="text-align:right; width:680px;"><img src="jqueryform/MARC_100.jpg" /></div>
							<label for="marc_field">* Field</label><br />
							<input class="input_field_12em required" name="marc_field" id="marc_field" value="<? if(isset($_POST['marc_field'])) echo $_POST['marc_field'];?>"><br />					
							<label for="marc_ind1">Ind 1</label><br />
							<input class="input_field_12em" name="marc_ind1" id="marc_ind1" value="<? if(isset($_POST['marc_ind1'])) echo $_POST['marc_ind1'];?>"><br />
							<label for="marc_ind2">Ind 2</label><br />
							<input class="input_field_12em" name="marc_ind2" id="marc_ind2" value="<? if(isset($_POST['marc_ind2'])) echo $_POST['marc_ind2'];?>"><br />					
							<label for="marc_field_text">* Field Text</label><br />
							<input class="input_field_12em required" name="marc_field_text" id="marc_field_text" value="<? if(isset($_POST['marc_field_text'])) echo $_POST['marc_field_text'];?>"><br />
							<label for="marc_req_field">Req. Field</label><br />
							<input type="radio" name="marc_req_field" value="Yes" class="link" id="yes" />
							<label for="yes">Yes</label>
							<input type="radio" name="marc_req_field" value="No" class="link" id="no" checked />
							<label for="no">No</label><br /><br />
						</div>
						Once you have made your selections please select the Continue button.<br /><br />	
					</span>
					
				<span id="Yes" class="step">
					<label for="product">* Go to Summary page and complete setup request</label><br />
					<select style="width:auto;" class="input_field_12em link required" name="product" id="product">
						<option value="Confirmation">Complete, Confirm and Submit</option>
						<br /><br />
						You have completed the product setup wizard. Click submit to complete the setup.
					</select><br />
				</span>
				<span id="No" class="step">
					<label for="product">* Go to Summary page and complete setup request</label><br />
					<select style="width:auto;" class="input_field_12em link required" name="product" id="product">
						<option value="Confirmation">Complete, Confirm and Submit</option>
						<br /><br />
						You have completed the product setup wizard. Click submit to complete the setup.
					</select><br />
				</span>
				<span id="Confirmation" class="step">
				<div class="input">
					<span class="font_normal_07em_black">Please enter comments for technical support below</span><br /><br />
					<label for="marc_comments"></label><br />
						 <textarea rows="10" cols="50" name="marc_comments" id="marc_comments"></textarea><br />
					<br /><br />
				</div>
				</span>
				<div id="summary" class="step">
					<div class="input">
						<span class="font_normal_07em_black">Summary page</span><br />
						<p>Please verify your product selection and information below. You can make edits on this page and submit when ready.</p>
					<div id="summaryContainer"></div>
					</div>
				</div>
			
				<div id="demoNavigation"> 							
					<input class="navigation_button" id="back" value="Back" type="reset" />
					<input type="hidden" name="page_function" value="send" />
					<input class="navigation_button" id="next" value="Next" type="submit" />
				</div>

<input type="hidden" name="subject" value="EIS Unified Setup Request" tabindex="9" />
		</form>		
				</div>
		
			<hr />
	* Required field		
			<p id="data"></p>
		</div>

    <script type="text/javascript" src="/contact/jqueryform/js/jquery-1.4.2.min.js"></script>		
    <script type="text/javascript" src="/contact/jqueryform/js/jquery.form.js"></script>
    <script type="text/javascript" src="/contact/jqueryform/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/contact/jqueryform/js/bbq.js"></script>
    <script type="text/javascript" src="/contact/jqueryform/js/jquery-ui-1.8.5.custom.min.js"></script>
    <script type="text/javascript" src="/contact/jqueryform/js/jquery.form.wizard.js"></script>
    
<script type="text/javascript">

			var cache = {}; // caching inputs for the visited steps

			$("#eis").bind("step_shown", function(event,data){	
				if(data.isLastStep){ // if this is the last step...then
					$("#summaryContainer").empty(); // empty the container holding the 
					$.each(data.activatedSteps, function(i, id){ // for each of the activated steps...do
						if(id === "summary") return; // if it is the summary page then just return
						cache[id] = $("#" + id).find(".input"); // else, find the div:s with class="input" and cache them with a key equal to the current step id
						cache[id].detach().appendTo('#summaryContainer').show().find(":input").removeAttr("disabled"); // detach the cached inputs and append them to the summary container, also show and enable them
					});
				}else if(data.previousStep === "summary"){ // if we are movin back from the summary page
					$.each(cache, function(id, inputs){ // for each of the keys in the cache...do
						var i = inputs.detach().appendTo("#" + id).find(":input");  // put the input divs back into their normal step
						if(id === data.currentStep){ // (we are moving back from the summary page so...) if enable inputs on the current step
							 i.removeAttr("disabled");
						}else{ // disable the inputs on the rest of the steps
							i.attr("disabled","disabled");
						}
					});
					cache = {}; // empty the cache again
				}
			})
			
			$(function(){
				$("#eis").formwizard({ 
				 	validationEnabled: true,
				 	focusFirstInput : true
				 }
				);
				
				// function for appending step visualization
				function addVisualization(id){
					$("#step_visualization").append("<span class=\"visualization\" id=\"visualization_" + id + "\">" + id + "</span> ")
				}
				// initial call to addVisualization (for visualizing the first step)
				addVisualization($("#eis").formwizard("state").firstStep);

				// bind a callback to the step_shown event
				$("#eis").bind("step_shown", function(event, data){
					$("#step_visualization").html(""); 
					
					if(data.isBackNavigation || !data.isFirstStep){
						var direction = (data.isBackNavigation)?"back":"forward";
						$("#step_visualization").append("<div>Moving "+ direction +"</div>");
					}
					$.each(data.activatedSteps, function(){
						addVisualization(this)
					});
					/*
						Available data:
						isBackNavigation - boolean
						settings - options object containing the options set for the wizard
						activatedSteps - list of activated steps (visited steps)
						isLastStep - boolean specifying whether the current step is a submit step
						isFirstStep - boolean
						previousStep - the id of the previously visited step
						currentStep - the id of the current step
						backButton
						nextButton
						steps - the steps of the wizard 
						firstStep - the id of the first step
					*/
					
				})
  		});
		
		var _isPostBack = false;
    window.onbeforeunload = function ()
    {
     if( _isPostBack == true )
      return; // Let the page unload

     if ( window.event )
      window.event.returnValue = 'If you have not clicked SUBMIT you will lose all data.'; // IE
     else
      return 'If you have not clicked SUBMIT you will lose all data.'; // FX
    }
	

    </script>

<?php
}



# ----------------------------------- #
#	FOOTER
# ----------------------------------- #
	$template->printFooter();
?>