<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_samples.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>
<script>
function toggle_display(id) {
    
    obj=document.getElementById( id );
    
    
    if ( obj )
    {
        obj.style.display = ( obj.style.display == "none" ) ? "block" : "none";
        
     }   
      
    
}
</script>';
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
		<li class="navmenu_active">Corporate / Library</li>
		<li class="navmenu_medical"><a href="samples_medical.php">Medical</a></li>
	</ul>
	<div class="infobox_light">
		<h3>Simple Search</h3>

		<p>
            <a target="_new" href="samples/simple_search"><img src="img/content/ss_image.png" style="float: right; border: 1px solid #000000;height:130px;width:190px;" alt=""></a>
			Search and browse the EBSCOhost Databases using the EIT
			Web Service.  Within the demo, you can perform boolean
			searches complete with database tags.   This demo uses 
			the following EIT features:
			
			<ul>
				<li>EIT Web Service</li>
			</ul>
			
            <a target="_new"  href="samples/simple_search">View Demo Online</a><br>
            <a href="javascript:toggle_display('download_ss');">Download Source Code</a></span>
            <div id="download_ss" style="display:none;">
            <br/>
            Source Code is available in four different languages.Please click on the desired language. <br/>
			<ol>
            <li><a href="samples/PHP/simple_search.zip" title="Click to download">PHP</a></li>
            <li><a href="samples/JAVA/simple_search.zip" title="Click to download">JAVA</a></li>
            <li><a href="samples/ASP/SimpleSearch.zip" title="Click to download">ASP.NET</a></li>
            <li><a href="samples/RUBY/simple_search.zip" title="Click to download">RUBY</a></li>
            </ol>
            </div>
		</p>
		<div style="clear: both"></div>
	</div>
	
	<div class="infobox_light">
		<h3>Corporate Portal Demo</h3>

		<p>
            <a href="samples/portal" target="_new"><img src="img/content/cp_image.png" style="float: right; border: 1px solid #000000;height:130px;width:190px;" alt=""></a>
			This company portal shows how various components of the EIT can be integrated
			into a company portal.  This sample features a web service search which returns
			results within the company portal, a persistent link search, and an RSS feed containing
			real-time results of a search.  This demo uses the following EIT features:
			
			<ul>
				<li>EIT Web Service</li>
				<li>Persistent Links</li>
				<li>RSS Feeds</li>
			</ul>
			
            <!--Please Update the redirection to the EBSCO server path in href below when deployed on server
                ex:http://lh2cc.net/eit/samples/portal-->
            <a target="_new" href="samples/portal">View Demo Online</a><br>
            <a href="javascript:toggle_display('download_cp');">Download Source Code</a></span>
            <div id="download_cp" style="display:none;">
            <br/>
			Source Code is available in four different languages.Please click on the desired language. <br/>
			<ol>
            <li><a href="samples/PHP/portal_demo.zip" title="Click to download">PHP</a></li>
            <li><a href="samples/JAVA/portal_demo.zip" title="Click to download">JAVA</a></li>
            <li><a href="samples/ASP/PortalDemo.zip" title="Click to download">ASP.NET</a></li>
            <li><a href="samples/RUBY/portal_demo.zip" title="Click to download">RUBY</a></li>
            </ol>
            </div>
		</p>
		<div style="clear: both"></div>
	</div>
	
	<div class="infobox_light">
		<h3>EDS Demo</h3>
		
		<p>
            <a target="_new" href="samples/eds"><img src="img/content/eds_image.png" style="float: right; border: 1px solid #000000;height:130px;width:190px;" alt="";></a>
			An example of using the EBSCOhost Web Service with an EDS profile.  Search results
			are retrieved using the EIT Web Service API, and 
			rendered within a library portal.
			This demo uses the following EIT features:
			<ul>
				<li>EIT Web Service</li>
				<li>EDS</li>
			</ul>
			<a target="_new" href="samples/eds">View Demo Online</a><br>
            <a href="javascript:toggle_display('download_eds');">Download Source Code</a></span>
            <div id="download_eds" style="display:none;">
            <br/>
			Source Code is available in four different languages.Please click on the desired language. <br/>
			<ol>
            <li><a href="samples/PHP/eds.zip" title="Click to download">PHP</a></li>
            <li><a href="samples/JAVA/eds.zip" title="Click to download">JAVA</a></li>
            <li><a href="samples/ASP/EdsDemo.zip" title="Click to download">ASP.NET</a></li>
            <li><a href="samples/RUBY/eds.zip" title="Click to download">RUBY</a></li>
            </ol>
            </div>
		</p>
		
		<div style="clear: both"></div>
	</div>

		<div class="infobox_light">
		<h3>LMS Sample Courses</h3>
		
		<p>
			<a target="_new" href="docs/LMS_integration_overview.pdf"><img src="img/content/lms_sample.png" style="float: right; border: 1px solid #000000;" width=189px height=112px alt=""></a>
			Sample SCORM content packages are made available to you for downloading and testing within your organization's LMS.  
			Sample content is available for the following databases.  Click on the database name to download the SCORM content package.
			<ul>
				<li><a href="docs/ebsco_bbs_scorm_content_package.zip">Business Book Summaries</a></li>
				<li><a href="docs/ebsco_lmlc_scorm_content_package.zip">Leadership & Management Learning Center</a></li>
				<li><a href="docs/ebsco_nrc_scorm_content_package.zip">Nursing Reference Center</a></li>
			</ul>
			Download overview document: <a target="_new" href="docs/LMS_integration_overview.pdf">LMS_Integration_overview.pdf</a>
		</p>
		
		<div style="clear: both"></div>
	</div>
	
	</div>
<?php 

include( 'includes/footer.php' );

?>