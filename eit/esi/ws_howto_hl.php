<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_howto';
$subpage = 'hl';
include( 'includes/navbar.php' );


?><a name="top"></a>
<h2>Search Health Library</h2>
<p>
	This section contains examples of certain scenarios when using the EBSCOhost Web Service to retrieve content in Health Library.
	This page will help you by offering applicable sample scenarios that you can use to configure your own applications. 
</p>
<p>
	For additional help with query syntax, refer to the 
	<a target="_top" href="http://lh2cc.net/eit2/ws_querysyn_hl.php">Health Library Query Syntax guide</a>.
	
	
</p>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 1</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Get articles restricted to Natural & Alternative Treatments that have the word “diabetes” in the Title</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: ZH "natural & alternative treatment*" AND TI diabetes</p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 2</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Get articles restricted to Journal Notes that have the phrase “blood pressure” in the abstract</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: ZH journal notes AND AB "blood pressure"</p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
</td></tr></table>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 3</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Get the last 10 (max) HealthDay News articles</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: "HealthDay News"</p>
	<p class="indent">numrec: 10</p>
	<p class="indent">sort: date</p>
	<p>
	<u>Database code</u>
	<p class="indent">nrcn</p>
</td></tr></table>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 4</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Get all articles in ICD-9 category 405*– hypertension</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: IC 405*</p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
</td></tr></table>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 5</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Render an Index page listing all conditions under alpha listing “A” </p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: AN [chunk ID] For example: AN 33341</p>
	<p class="indent">format: Full</p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
	<u>Instructions:</u>
	<p>
	<p class="indent">Once the single index page is retreived, use an XPath document object in 
	your script to locate and copy the section element bearing the id attribute of “A”.  The XML 
	can be transformed into HTML and render into page.
</td></tr></table>
<a class="top" href="#top">Back to Top</a>
<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 6</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Render a listing of gneric drug names which begin with "asp" (as in "aspirin")</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Browse</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: asp*</p>
	<p class="indent">Index: ZM</p>
	<p>
	<u>Database code</u>
	<p class="indent">lpe</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 7</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Render a listing of brand name drugs which begin with "asp" (as in "aspergum [otc]")</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Browse</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: asp*</p>
	<p class="indent">Index: ZQ</p>
	<p>
	<u>Database code</u>
	<p class="indent">lpe, lps</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 8 - Get All Index Pages</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Returns a complete list of all index pages. Data returned includes record abstract, associated categories, and anchor tags for the various sections</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: PT "index page"</p>
	<p>
	<u>Example</u>
	<p class="indent">query: PT "index page"</p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 9 - Get Index Page</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Retrieve a specific index page.  Data returned includes record abstract, associated categories, and anchor tags for the various sections.</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: AN [master index page ID]</p>
	<p>
	<u>Example</u>
	<p class="indent">query: AN 2010815375</p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 10 - Get Search Results</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Retrieve links to articles that match a specific search criteria.  This method will return a list of article ID’s (i.e. chunk ID) that can, in turn, be used with Get Article.</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: <i>term</i></p>
	<p>
	<u>Example</u>
	<p class="indent">query: heart</p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 11 - Get Article</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Retrieve the full text for a specific article</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: AN [chunk ID]></p>
	<p>
	<u>Example</u>
	<p class="indent">query: AN 31424</p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 12 - Get Index</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Retrieve a list of indexes for a specific Health Library database. These indexes can, in turn, be used with the Get Collection function.</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Info</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">No search or browse input parameters required</p>
	<p>
	<u>Database code</u>
	<p class="indent">No database codes are required</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 13 - Get Collection</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Retrieve a list of content collections based on browsing a list of indexes for a specific term.</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Browse</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">term: <i>term</i></p>
	<p class="indent">index: ZT </p>
	<p>
	<u>Examples</u>
	<p class="indent">term: lifestyle</p>
	<p class="indent">index: ZT </p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
	<u>Instructions:</u>
	<p>
    <p class="indent">For each collection returned, a searchable browse term contained within the searchKey attribute 
	of the <browseTerms> element will be shown.  This searchKey value represents different publication types 
	that can be searched.</p>
</td></tr></table>

<div class="hr" width=20px></div>
<a class="top" href="#top">Back to Top</a>
<h3>Scenario 14 - Get History</h3>
<table><tr><td width=20>&nbsp;</td><td>
	<p>Retrieve list of articles that were added to a collection after a specified date.</p>

	<p>
	<u>Web Service method to use</u>
	<p class="indent">Search</p> 
	<P>
	<u>Parameters</u>
	<p class="indent">query: DT > [yyyymmdd]</p>
	<p>
	<u>Examples</u>
	<p class="indent">query: DT > 20100531 </p>
	<p>
	<u>Database code</u>
	<p class="indent">hlt</p>
</td></tr></table>


<p>
	To learn more about how EBSCO Publishing can serve all of a corporation's electronic 
	information needs <b><a href="http://www.ebscohost.com/thisTopic.php?marketID=6&amp;topicID=683" target="_blank">click here</a></b>.
</p>
<?php 

include( 'includes/footer.php' );

?>
