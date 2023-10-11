<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_error';
include( 'includes/navbar.php' );


?>
<div class="minHeight"></div>
<h2>Web Service - Error Codes</h2>
	<ul>
	
		<li>
			<a href="javascript: toggle_display('q1_1');">Profile password does not match</a>
			<div class="faq_div" style="display: none" id="q1_1">
				Password provided was not recognized.  Please check your password and try again. 
			</div>
		</li>
		
		<li>
			<a href="javascript: toggle_display('q1_2');">Valid Profile but no Password specified</a>
			<div class="faq_div" style="display: none" id="q1_2">
				A valid password was not detected.  Check to ensure a password was provided for this required parameter.
			</div>
		</li>
		
		<li>
			<a href="javascript: toggle_display('q1_3');">Valid Password with no Profile specified</a>
			<div class="faq_div" style="display: none" id="q1_3">
				A valid profile was not detected for the prof parameter.  Please check to ensure a profile is provided
				for this required parameter.
			</div>
		</li>
		
		<li>
			<a href="javascript: toggle_display('q1_4');">Improperly formatted Profile (i.e. user1,main.ehost)</a>
			<div class="faq_div" style="display: none" id="q1_4">
				A profile was provided but does not adhere to the proper format of customerID.groupID.profileID.  This information
				can be found under your account in EBSCOadmin. 
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_5');">IP Authentication Type but no IP Profile specified</a>
			<div class="faq_div" style="display: none" id="q1_5">
				Your web service account is setup to authenticate all requests using your organization's IP address 
				or IP Address range.  However, no ip address was detected in EBSCOadmin.  Before you proceed, you will be
				required to configure one or more IP Addresses or ranges in EBSCOadmin.  
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_6');">Authentication Type not specified as IP and no Profile specified</a>
			<div class="faq_div" style="display: none" id="q1_6">
				A valid authentication type was not detected for the authtype parameter. Please check to ensure that either
				an IP address or profile type is specified for this required parameter. 
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_7');">No query term specified</a>
			<div class="faq_div" style="display: none" id="q1_7">
				No keyword or phrase was detected for the query parameter.  Please check to ensure a value was specified for
				this required parameter.
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_8');">No index specified</a>
			<div class="faq_div" style="display: none" id="q1_8">
				A valid index value was not detected for the index parameter which is a required field. Because different indexes are available per database, 
				you should use the Info method to obtain a list of indexes per database. 
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_9');">No database specified</a>
			<div class="faq_div" style="display: none" id="q1_9">
				A valid database code was not detected for the db parameter which is a required field.   
				<p>
				Use the Info method to obtain a list of	databases available to your web services profile:
				<p>
				&nbsp; &nbsp; <a target="_new" href="http://support.ebscohost.com/knowledge_base/detail.php?topic=&id=3783">Click here to see a list of all databases supported by the EIT web service API.</a>
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_10');">Invalid Number of Records data type</a>
			<div class="faq_div" style="display: none" id="q1_10">
				An invalid value was detected for the numrec parameter.  Please check to ensure a numerical number is specified. 
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_11');">Number of Records less than</a>
			<div class="faq_div" style="display: none" id="q1_11">
				Number of Records less than
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_12');">Wrong Index</a>
			<div class="faq_div" style="display: none" id="q1_12">
				An invalid index was specified for target database.  Because different indexes are available per database, 
				you should use the Info method to obtain a list of indexes per database. 
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_13');">Invalid Start Record data</a>
			<div class="faq_div" style="display: none" id="q1_13">
				An invalid value was detected for the startrec parameter. The likely cause is that the starting record value
				exceeds the total number of records returned by the web service request.  To find out how many records have
				been returned, please refer to the Hits element in the XML response.
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_14');">Less then zero Start Record value</a>
			<div class="faq_div" style="display: none" id="q1_14">
				An invalid value was detected for the startrec parameter.  Please check to ensure a numerical number of 1 or greater
				is specified.
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_15');">Invalid Format value</a>
			<div class="faq_div" style="display: none" id="q1_15">
				An invalid value was detected for the format parameter. Valid values are: Brief, Detailed or Full.  The default
				value for the format parameter is Brief.
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_16');">No access to the database</a>
			<div class="faq_div" style="display: none" id="q1_16">
				No access to the database
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q1_17');">User does not have access rights to database</a>
			<div class="faq_div" style="display: none" id="q1_17">
				The database code specified is not associated with your web services account. Use the Info method to obtain a list of databases available to your web services profile:
				<p>
				<p>
				See also:
				<p>
				<a target="_new" href="http://support.ebscohost.com/knowledge_base/detail.php?topic=&id=3602">How do I add a database to a Profile?</a>
				<p>
				<a target="_new" href="http://support.ebscohost.com/knowledge_base/detail.php?topic=&id=3783">Click here to see a list of all databases supported by the EIT web service API.</a>
				</div>
		</li>
		
	</ul>
	
<div style="clear: both"></div>

<?php 

include( 'includes/footer.php' );

?>