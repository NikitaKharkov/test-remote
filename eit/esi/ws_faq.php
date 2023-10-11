<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_faq';
include( 'includes/navbar.php' );


?>
<div class="minHeight"></div>

<div class="faq_quickSelect">
	<form>
	Jump to FAQ: <select name="faqQuickSelect" onChange="changePage( this.form.faqQuickSelect )">
		<option value="faq.php">EBSCO Integration Toolkit</option>
		<option value="" selected >Web Service</option>
		<option value="esi_faq.php">Enterprise Search</option>
		<option value="sbb_faq.php">Search Box</option>
		<option value="pl_faq.php">Persistent Links</option>
		<option value="widgets_faq.php">Widgets</option>
		<option value="rss_faq.php">RSS Feeds</option>
		<option value="ourl.php">OpenURL</option>
		<option value="z3950.php">Z39.50</option>
		<option value="sp_faq.php">SharePoint</option>
		<option value="lms_faq.php">LMS</option>
	</select>
	</form>
</div>

<h2>Web Service - FAQ</h2>
	<h4>General</h4>
	<ul>
	
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5092" target="_blank">What do I need to use the EBSCOhost Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5093" target="_blank">What can the EBSCOhost Web Service be used for?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5094" target="_blank">How do I get started using the EBSCOhost Web Service API?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5095" target="_blank">Does EBSCO provide any sample code that I can review to help get me started with the EBSCOhost Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5096" target="_blank">How can I retrieve the latest articles from a particular journal using the EBSCOhost Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5097" target="_blank">What data elements are returned in the XML when consuming the Search method?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5098" target="_blank">What is the maximum number of records that I can retrieve in a single request using the EBSCOhost Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5099" target="_blank">If I issue a search across multiple databases using the EBSCOhost Web Service, how do I eliminate duplicate records?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5100" target="_blank">Can I retrieve audio and video files using the EBSCOhost Web Service via the Search method?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5101" target="_blank">When using the Search method, what is the default sort order of the returned record set?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5102" target="_blank">When using the Search method, I don't need all the fields returned in the record set. Is it possible to eliminate certain fields from the returned record set?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=5103" target="_blank">How do I know which EBSCOhost databases are associated with my organization's account?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4191" target="_blank">What types of authentication are supported via the EIT: Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3782" target="_blank">How do I utilize search tags in EIT Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3781" target="_blank">How do I search multiple databases in EIT Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3780" target="_blank">How can I limit to PDF or HTML full text results in EIT Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4196" target="_blank">What is the maximum number of results I can return in a call to the EIT: Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4193" target="_blank">Which EBSCOhost database authorities have limited support via the EIT: Web Service AuthoritySearch Method?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4192" target="_blank">Which EBSCOhost database authorities are fully supported via the EIT: Web Service AuthoritySearch Method?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4197" target="_blank">What is the EIT: Web Service Info Method and want kind of data does it provide?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=4198" target="_blank">Which database authority search tags (dbTags) obtained from the EIT: Web Service Info Method are supported via the EIT: Web Service AuthoritySearch Method?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3198" target="_blank">What Field Codes are available with Multi-Database Searching?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3783" target="_blank">What databases are supported by EIT Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3779" target="_blank">What communication protocols are supported by EIT Web Service?</a></li>
		<li><a href="http://support.epnet.com/knowledge_base/detail.php?id=3778" target="_blank">How is Full Text represented in EIT Web Service?</a></li>
		
		<li>
			<a href="javascript: toggle_display('q2_20');">How can I customize the links from a result list to the detail record/full text?</a>
			<div class="faq_div" style="display: none" id="q2_20">
				You can customize persistent links to control what a user sees when viewing the detailed record and/or full text. Choosing to include scope
				information on persistent links, which can be set in EBSCOadmin, will open full access to EBSCOhost user interface including the toolbar
				in the header area. You may also choose to use different profiles and profile settings to customize the user interface display.  You can
				configure profile settings to control header branding, allow email, allow notetaking, etc.   Using specific profiles will also allow you
				to ensure EBSCOhost properly logs usage statistics when users view either the detailed record or full text.  Moreover, the detailed record
				has many features/functions that are not directly controlled via the web service such as: email, folders, cite and text to speech 
				among others. 
			</div>
		</li>

		<li>
			<a href="javascript: toggle_display('q1_5');">Will EBSCO develop our EIT application?</a>
			<div class="faq_div" style="display: none" id="q1_5">
				No, organizations that do not have the infrastructure to implement EIT should continuing using EBSCOhost.  
				For those customers interested in developing their own EIT application, sample code that you can download
				is available on the EBSCOhost EIT Support center. In addition, EBSCO's Customer Satisfaction team can
				provide EIT integration support.
			</div>
		</li>
		
	</ul>
	<h4>EBSCO Discovery Service</h4>
	<ul>
	
		<li><a href="http://support.ebscohost.com/knowledge_base/detail.php?id=4694" target="blank">How does the EBSCO Discovery Service search experience differ from EBSCOhost? </a></li>

		<li>
			<a href="javascript: toggle_display('q3_1');">Which methods are available for the EBSCO Discovery Service web service API? </a>
			<div class="faq_div" style="display: none" id="q3_1">
				Currently, only the Search method is available.  The Info, Browse and AuthoritySearch methods are not supported for EDS web service profiles at this time.
				If you organization's subscription provides access to multiple EBSCO databases and accessing the additional web service methods is required, it is 
				recommended that an EBSCOhost web service profile be created.  Using the EBSCOhost web service profile will allow you to issue
				requests against the Info, Browse and AuthoritySearch methods.  Combining both web service profile types within your application will provide an
				effective solution.
			</div>
		</li>
		
		<li>
			<a href="javascript: toggle_display('q3_2');">How do I specify my organization's specific catalog when using the Search method?</a>
			<div class="faq_div" style="display: none" id="q3_2">
				You do not need to specify the catalog or any other database when consuming the Search method.  The API will automatically search all databases and 
				catalogs associated with your organization's subscription.  
			</div>
		</li>
		
		<li>
			<a href="javascript: toggle_display('q3_3');">Can I query my 3rd party data sources that are part of my organization's EHIS account?</a>
			<div class="faq_div" style="display: none" id="q3_3">
				Yes. You will be able to retrieve content from non-EBSCO databases just as you would with EBSCO database records. 
			</div>
		</li>
		
		<li>
			<a href="javascript: toggle_display('q3_4');">Can I consume the web service API methods using Guest Access?</a>
			<div class="faq_div" style="display: none" id="q3_4">
				No.  Guest access is not supported at this time.  You must use a valid web services profile.
			</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q3_5');">How do I incorporate book jacket covers in my application?</a>
			<div class="faq_div" style="display: none" id="q3_5">
				Book jackets are made exclusively available to the Discovery Service under a license agreement with Baker and Taylor.  A license upgrade from
				Baker and Taylor will be required for those customers wanting to incorporate the book jackets in their own applications.</div>
		</li>
		<li>
			<a href="javascript: toggle_display('q3_6');">Is Real Time Availability Checking available for catalog records?</a>
			<div class="faq_div" style="display: none" id="q3_6">
				No. Real Time Availability Checking is only available within the EBSCOhost interface</div>
		</li>
		
	</ul>

	
<div style="clear: both"></div>

<?php 

include( 'includes/footer.php' );

?>