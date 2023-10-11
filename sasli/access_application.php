<?php
	include('header.php');
	if (empty($_POST) or (trim($_REQUEST["req_name"]) == "") or (trim($_REQUEST["req_libraryName"]) == ""))
	{
		print "<p>License agreement is incomplete.</p>
			<p>Before registering for access to EBSCO<i>host</i> you must accept the license agreement. Please go 
			<a href=\"agree.php\">back</a> and review the license agreement.</p>
			<p><b>Please note:</b> You must complete all fields on the license agreement form.</p>";
		include('footer.php');
		die();
	}
	if ($_POST["agree"] != "yes") {
		print "<p>License agreement was not accepted.</p>
			<p>Before registering for access to EBSCO<i>host</i> you must accept the license agreement. Please go 
			<a href=\"agree.php\">back</a> and review the license agreement.</p>";
		include('footer.php');
		die();
	}
?>

<form id="mainForm" method="post" action="mailer.php">
	<h1>Site Access Application</h1>
	<p>Please fill out the following fields in English. First enter some general information about your institution.</p>
	<fieldset id="libraryInfo">
		<legend>Library Info</legend>
		<label for="req_Library_Type" class="required">Library Type</label>
		<select id="req_Library_Type" name="req_Library_Type">
			<option selected="selected" value="">Choose your library type:</option>
			<option value="Academic" name="Academic">Academic</option>
			<option value="Medical" name="Medical">Medical</option>
			<option value="Public" name="Public">Public</option>
		</select>
	</fieldset>
	
	<fieldset id="generalInfo">
		<legend>General Info</legend>
		<label for="req_Your_Name" class="required">Your Name</label><input type="text" id="req_Your_Name" name="req_Your_Name" value="<?php print(trim($_REQUEST["req_name"]));?>"/>
		<label for="req_Your_Title" class="required">Your Title</label><input type="text" id="req_Your_Title" name="req_Your_Title"/>
		<label for="req_Institution" class="required">Institution</label><input type="text" id="req_Institution" name="req_Institution" value="<?php print(trim($_REQUEST["req_libraryName"]));?>"/>
		<label for="txt_Department">Department</label><input type="text" id="inf_Department" name="txt_Department"/>
		<label for="req_Street_Address" class="required">Street Address</label><input type="text" id="req_Street_Address" name="req_Street_Address"/>
		<label for="req_City" class="required">City</label><input type="text" id="req_City" name="req_City"/>
		<label for="req_Postal_Code" class="required">Postal Code</label><input type="text" id="req_Postal_Code" name="req_Postal_Code" size="5"/>
		<label for="req_Country" class="required">Country</label><input type="text" id="req_Country" name="req_Country"/>
		<label for="req_Phone" class="required">Phone (including country code)</label><input type="text" id="req_Phone" name="req_Phone"/>
		<label for="txt_Fax">FAX (including country code)</label><input type="text" id="txt_Fax" name="txt_Fax"/>
		<label for="req_Email_Address" class="required">Email Address</label><input type="text" id="req_Email_Address" name="req_Email_Address"/>
		<label for="req_Verify_Email_Address" class="required">Verify Email Address</label><input type="text" id="req_Verify_Email_Address" name="req_Verify_Email_Address"/>
	</fieldset>
	
	<h3>EBSCO Databases And Formats</h3>
	<p>You are being offered a number of different
	databases depending on what kind of library you have. You are also being offered the
	databases in a number of formats including an online version and CD or DVD-ROM* formats.
	If your local internet connection is not reliable, please choose both formats.</p>
	<p>The following questions will help us identify which databases you will require and in what formats. </p>
	<p>You are welcome to choose as many databases as you need for your library. For more information on these databases, please refer to 
	<a target="_blank" href="http://www.epnet.com/titleLists.php?topicID=380&tabForward=titleLists&marketID=6">descriptions and title lists</a>.</p>
	<fieldset id="onlineProducts" class="checks">
		<legend>EBSCO<em>host</em> Online Database Options</legend>
		<label for="prd_ASP"><input type="checkbox" id="prd_ASP" name="prd_Online_Database_Option_1" value="Academic Search Premier"/>Academic Search Premier</label>
		<label for="prd_BSP"><input type="checkbox" id="prd_BSP" name="prd_Online_Database_Option_2" value="Business Source Premier"/>Business Source Premier</label>
		<label for="prd_MasterFilePremier"><input type="checkbox" id="prd_MasterFilePremier" name="prd_Online_Database_Option_6" value="MasterFILE_Premier"/>MasterFILE Premier</label>
		<label for="prd_NewspaperSource"><input type="checkbox" id="prd_NewspaperSource" name="prd_Online_Database_Option_8" value="Newspaper_Source"/>Newspaper Source</label>
		<label for="prd_MEDLINE"><input type="checkbox" id="prd_MEDLINE" name="prd_Online_Database_Option_7" value="MEDLINE" />MEDLINE</label>
		<label for="prd_ERIC"><input type="checkbox" id="prd_ERIC" name="prd_Online_Database_Option_3" value="ERIC"/>ERIC</label>
		<label for="prd_HealthSourceNursing"><input type="checkbox" id="prd_HealthSourceNursing" name="prd_Online_Database_Option_5" value="Health_Source:_Nursing_&amp;_Academic_Edition"/>Health Source: Nursing &amp; Academic Edition</label>
		<label for="prd_HealthSourceConsumer"><input type="checkbox" id="prd_HealthSourceConsumer" name="prd_Online_Database_Option_4" value="Health_Source:_Consumer_Edition"/>Health Source: Consumer Edition</label>
	</fieldset>
	<fieldset id="optionalUpgrades" class="checks">
		<legend>EBSCO<em>host</em> Optional Database Upgrades</legend>
		<label for="prd_ASPComp"><input type="checkbox" id="prd_ASPComp" name="prd_Database_Upgrade_Option_1" value="Academic Search Complete"/>Upgrade Academic Search Premier to Academic Search Complete</label>
		<label for="prd_BSPComp"><input type="checkbox" id="prd_BSPComp" name="prd_Database_Upgrade_Option_2" value="Business Source Complete"/>Upgrade Business Source Premier to Business Source Complete</label>
	</fieldset>
	
	<h3>EBSCO CD/DVD Database Options</h3>
	<p>The databases are also available in CD/DVD-ROM formats. Please fill in the box for the format and databases you want to receive.</p> 
	<p>For more information on these databases, please refer to <a target="_blank" href="http://www.epnet.com/titleLists.php?topicID=380&tabForward=titleLists&marketID=6">descriptions and title lists</a>.</p>
	<fieldset id="cdProducts" class="checks">
		<legend>DVD/CD-ROM Products</legend>
		<label for="prd_Academic_Periodicals"><input type="checkbox" id="prd_Academic_Periodicals" name="prd_CD/DVD_Database_Option_1" value="Academic_Periodicals_Collection"/>Academic Periodicals Collection</label>
		<label for="prd_Business_Periodicals"><input type="checkbox" id="prd_Business_Periodicals" name="prd_CD/DVD_Database_Option_2" value="Business_Periodicals_Collection"/>Business Periodicals Collection</label>
		<label for="prd_Biomedical_Reference"><input type="checkbox" id="prd_Biomedical_Reference" name="prd_CD/DVD_Database_Option_3" value="Biomedical_Reference_Collection"/>Biomedical Reference Collection</label>
	</fieldset>
	
	<h3>Authentication Options</h3>
	<p>To gain access to the EBSCOhost you must be identified as a customer. This is done through one of the following authentication methods.</p>
	<h4>EBSCO Controlled IP Address Method</h4>
	<p>IP address authentication is the most popular method our customers use. You can provide EBSCO
		with a list of IP addresses for your institution, which are entered into our
		authentication tables and stored on EBSCO machines. Please
		provide your ip addresses in the fields below if you%quot;d like to use IP authentication.
	</p>
	<fieldset id="ipAuth">
		<legend>IP Authentication</legend>
		<label for="ath_ip1">IP Address 1</label><input type="text" id="ath_ip1" name="Auth_IP_1"/>
		<label for="ath_ip2">IP Address 2</label><input type="text" id="ath_ip2" name="Auth_IP_2"/>
		<label for="ath_ip3">IP Address 3</label><input type="text" id="ath_ip3" name="Auth_IP_3"/>
	</fieldset>

	<h4>User ID and Password Method:</h4>
	<p>EBSCO can also assign your library with a user ID and password. This user ID and Password can also be used for remote access.</p>
	<fieldset id="userAuth" class="checks">
		<legend>User ID Authentication</legend>
		<label for="ath_id"><input type="checkbox" id="ath_id" name="ath_User_ID_Verification" value="Set_up_user_ID_authentication"/>I'd like EBSCO to set up user ID authentication</label>
	</fieldset>

	<p>EBSCO Publishing will notify a contact person at your library via email when your access is 
		available. It is important that we have only <b>one</b> person to receive this e-mail. 
		Please provide the name, phone number and e-mail address for this person. If you prefer
		this notification be faxed, please leave the e-mail fields blank and enter your fax number.</p>
	<fieldset id="contactInfo">
		<legend>Contact Info</legend>
		<label for="req_Contact_Name" class="required">Contact Name</label><input type="text" id="req_Contact_Name" name="req_Contact_Name"/>
		<label for="req_Contact_Phone" class="required">Contact Phone</label><input type="text" id="req_Contact_Phone" name="req_Contact_Phone"/>
		<label for="req_Contact_Email" class="required">Contact Email</label><input type="text" id="req_Contact_Email" name="req_Contact_Email"/>
		<label for="req_Verify_Contact_Email" class="required">Verify Contact Email</label><input type="text" id="req_Verify_Contact_Email" name="req_Verify_Contact_Email"/>
		<label for="txt_Contact_Fax">Contact Fax (if no e-mail)</label><input type="text" id="txt_Contact_Fax" name="txt_Contact_Fax"/>
	</fieldset>
	
	<p><b>Note:</b> Your EBSCO<i>host</i> access notification letter will arrive by email. It will include detailed information on how to access EBSCO<i>host</i> and EBSCO<i>admin</i>.
	Please see the Technical Support section on this web page located at 
	<a href="http://support.ebscohost.com/">http://support.ebscohost.com</a> for additional information, as well as access User Manuals, Quick Start guides, etc.</p>

	<div>
		<fieldset style="border-style:none;background:transparent;">
			<input type="submit" value="Submit Information"/>
		</fieldset>
	</div>
</form>

<?php
	include('footer.php');
?>
