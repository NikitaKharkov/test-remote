<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_samples.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = '';
include( 'includes/navbar.php' );


?>
<h2>Samples</h2>

<p>
	View how you can use EBSCOhost's Integration Toolkit first-hand.  These samples
	have been created to show how to integrate EBSCOhost's premium content using the
	EIT.
</p>

<ul>
	<li><a href="http://eit.ebscohost.com/JavaClient.zip">Sample Java Client</a></li>
	<li><a href="http://eit.ebscohost.com/CSharpClient.zip">Sample C# Client</a></li>
</ul>

<div class="samples_box">
	<ul class="navmenu">
		<li class="navmenu_library"><a href="samples.php">Corporate / Library</a></li>
		<li class="navmenu_active">Medical</li>
	</ul>
	<div class="infobox_green">
		<h3>HL7 Infobutton Integration Demo</h3>
		
		<p>
			<a target="_new" href="http://hldemo.ebscohost.com/SpringfieldHospital/emr/hl7.jsp"><img src="img/content/screen_hl7.gif" style="background-color: #FFFFFF; float: right; border: 1px solid #000000; margin-left: 5px;" alt=""></a>
			InfoButtons are associated with clinical terms within the patient record 
			in the EMR system. When a user clicks the infobutton clinically relevant 
			content to the term will be presented.
			
			<ul>
				<li>HL7 Compliant (ICD-9, IDC-10, SNOMED, MeSH)</li>
				<li>User specific results</li>
				<li>Access multiple content resources</li>
			</ul>
			
			<a target="_new"  href="http://hldemo.ebscohost.com/SpringfieldHospital/emr/hl7.jsp">View Demo Online</a><br/>
			<a target="_new" href="samples/EIT2Client.zip">Download Java client library</a>
		</p>
		
		<div style="clear: both"></div>
	</div>
	
	<div class="infobox_green">
		<h3>Web Services Integration Demo</h3>

		<p>
			<a href="http://hldemo.ebscohost.com/SpringfieldHospital/emr/ws.jsp" target="_new"><img src="img/content/screen_ws.gif" style="fbackground-color: #FFFFFF; float: right; border: 1px solid #000000;" alt=""></a>
			A real-time web service that enables customized and contextually 
			based searches of clinical content directly from the EMR system.
			
			<ul>
				<li>Push/Pull</li>
				<li>Direct links to specific content within a topic (i.e. Diagnosis, Treatment)</li>
				<li>Flexible style sheet control enables customized look & feel</li>
			</ul>
			
			<a target="_new" href="http://hldemo.ebscohost.com/SpringfieldHospital/emr/ws.jsp">View Demo Online</a><br/>
			<a target="_new" href="samples/Demo_EIT2.zip">View .war Web Application file</a><br/>
			<a target="_new" href="samples/EIT2Client.zip">Download Java client library</a>
		</p>
		
		<div style="clear: both"></div>
	</div>
	
	<div class="infobox_green">
		<h3>Hospital Information Portal</h3>

		<p>
			<a target="_new" href="http://hldemo.ebscohost.com/SpringfieldHospital/"><img src="img/content/screen_ip.gif" style="background-color: #FFFFFF; float: right; border: 1px solid #000000;" alt=""></a>
			This Hospital Information Portal demonstrates the comprehensiveness of EBSCO Publishing's 
			Medical Product Line and the EBSCOhost Integration Toolkit. This page shows:
			
			<ul>
				<li>Dynamic RSS feeds</li>
				<li>Persistent Links to key topics and content areas</li>
				<li>Direct Product Access in a dashboard view for a clinician and nurse</li>
			</ul>
			
			<a target="_new" href="http://hldemo.ebscohost.com/SpringfieldHospital/">View Demo Online</a><br/>
			<a target="_new" href="samples/EIT2Client.zip">Download Java client library</a><br/>
		</p>
		
		<div style="clear: both"></div>
	</div>
	
</div>
<?php 

include( 'includes/footer.php' );

?>