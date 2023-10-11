<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<link href="styles/style_lms.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'sharepoint';
$page = 'sp';
include( 'includes/navbar.php' );


?>

<h2>Sharepoint</h2>
<div style="height: 500px; float: left"></div>
<p>
	EBSCOhost content can easily be integrated within SharePoint web pages using standard page viewer and RSS web parts. EBSCO Publishing 
	provides pre-built web parts and How To documentation, enabling organizations to embed the 
	EBSCOhost experience directly into their SharePoint pages. Because the web parts can be configured to leverage 
	existing EIT options such as search boxes, persistent links and RSS feeds, organizations can readily implement web parts
	specific to EBSCOhost content with minimal technical resources. 
	
</p>
<p>
	To get started using EBSCOhost SharePoint Web Parts, refer to the How To documents listed below. 
</p>
	<div class="hr"></div>
	<h3>The EBSCOhost experience</h3>
	<p>
	<div>
	Organizations can embed the entire EBSCOhost experience within SharePoint by using the SharePoint-provided page viewer web part.  
	The page viewer web part enables the full functionality of EBSCOhost, including the My EBSCOhost folders, to be made available 
	to end users.  The page viewer web part leverages all of the existing authentication options offered by EBSCOhost thus allowing 
	for the rapid deployment of EBSCOhost within SharePoint.  
	</div>
	<p>
	<div style="margin-left:50px">
		<a href="docs/ehost_creatingPageViewerWebPart_10_08.doc" target="_blank">How To: The EBSCOhost experience Web Part</a>
	</div>
	<p>
	<div><p></div>	
	<div class="hr"></div>
	<h3>RSS Web Part</h3>
	<p>
	<div>
	Organizations can embed EBSCOhost RSS feeds within any SharePoint Web Part page.  By utilizing a RSS Web Part, you can integrate 
	EBSCOhost RSS feeds within any SharePoint page.	RSS stands for Really Simple Syndication. An RSS feed, also known as a news feed, 
	is a syndicated data feed in an XML format to which you can subscribe.  SharePoint offers a RSS Web Part that will automatically 
	render any RSS feed it is configured to access.
	</div>
	<p>
	<div style="margin-left:50px">
		<a href="docs/ehost_creatingRSSWebPart_12_08.doc" target="_blank">How To: Create an EBSCOhost RSS Web Part</a>
	</div>
	<p>
	<div><p></div>
	<div class="hr"></div>
	<h3>Search Box Web Part</h3>
	<p>
	<div>
	Organizations can embed an EBSCOhost search box within any SharePoint Web Part page.  By utilizing a Page Viewer Web Part, EBSCOhost 
	search functionality can be quickly added to any SharePoint page.  Access to a Search Box Web Part by a SharePoint user will be controlled 
	as part of the standard SharePoint group and user permissions as determined by the SharePoint site owner.  This means that no special 
	security considerations for any EBSCOhost Search Box Web Part need to be considered above and beyond what must be done at the time the 
	user is granted access to the site and/or page.
	</div>
	<p>
	<div style="margin-left:50px">
		<a href="docs/ehost_creatingSearchBoxWebPart_12_08.doc" target="_blank">How To: Create an EBSCOhost Search Box Web Part</a>
	</div>
	<p>


<br/>
<p>
	Or, download the <a href="docs/SharePoint_WebParts_How_To_documents.zip">How To zip file</a> containing all of the SharePoint How To documents.
</p>
<?php 

include( 'includes/footer.php' );

?>