<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_widgets.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

echo '<script type="text/javascript" src="js/jquery.popupWindow.js"></script>';

$menu = 'widgets';
$page = 'widgets_branding';
include( 'includes/navbar.php' );


?>
<a name="top"></a>
<h2>Branding Widgets</h2>

<p>
	Branding widgets are displayed on the initial search page on the EBSCOhost interface.  Branding
	widgets can be used to add persistent link functionality to the EBSCOhost or EBSCO Discovery Service user interfaces for 
	recommended books, publications/journals, articles, searches and even user profiles. Persistent links represent a simple 
	but effective way to promote and target specific content for your users.
</p>

<p>
	<a href="http://support.epnet.com/knowledge_base/detail.php?id=4713" target="blank">Click here for step-by-step instructions on how to add widgets to EBSCOhost or EBSCO Discovery Service</a>
</p>

<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="gbooks"></a><h3>Custom Branding Template</h3>

<a href="javascript: popupImage( 'img/widgets/springfield_template2.png', 800 )">
	<img class="widget_image" src="img/widgets/springfield_template_thumb.png" alt="Springfield Template">
</a>

<p class="widget_desc">
	<b>Name: </b>Custom Branding Template<br>
	<b>Submitter: </b>EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
</p>

<p class="widget_comments">
	<b>Comments</b>: This sample HTML code can be used as your guide when creating custom branding for your organization's own EBSCOhost site. The
	HTML is divided into 2 pieces; a top portion and a bottom portion that work best together on the Basic Search page.  Each portion may also be used on other
    EBSCOhost pages.  Custom branding HTML allows you to leverage the use of EBSCOhost persistent links for targeted, direct access to specific articles, publications/journals and
	searches. Contact EBSCO Technical Support if you would like help repurposing this HTML template when creating your own custom branding for the EBSCOhost or EBSCO Discovery Service user interfaces. 
 
</p>
<p>
	
	<!---Use our <a href="cbuilder.php">Carousel Builder</a> to get customized carousel code easily.--->
</p>
<p>
	To deploy the TOP BRANDING custom HTML:
	<ol>
	<li>Log into your EBSCOadmin account</li>
	<li>Go to Customize Services...Branding page
	<li>Set Branding Style = Enhanced</li>
	<li>Set Library Logo Placement = Above Find Field</li>
	<li>Copy the TOP BRANDING HTML code</li>
	<li>Paste copied code into the HTML text box</li>
	<li>Click Submit</li>
	</ol>
</p>

<p class="widget_comments">
	<b>Top Branding</b> 
</p>

<pre>
&lt;!-- TOP BRANDING --&gt;
&lt;link href="http://www.lh2cc.net/eds_demo_images/springfielduniversity/springfield-styles.css" rel="stylesheet" type="text/css" /&gt;
&lt;div class="enhanced-header"&gt;
       &lt;img class="header-logo" height="133" width="1001" src="http://www.lh2cc.net/eds_demo_images/springfielduniversity/headerLogo.jpg"&gt;
       &lt;div class="branding-toolbar clearfix"&gt;
              &lt;a href="#" class="home-link"&gt;&lt;span class="link-text"&gt;Springfield University Home&lt;/span&gt;&lt;/a&gt;
              
              &lt;ul class="branding-links"&gt;
                     &lt;li&gt;&lt;a class="site-map" href="#"&gt;&lt;span class="link-text"&gt;Site Map&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
                     &lt;li&gt;&lt;a class="contact-us" href="#"&gt;&lt;span class="link-text"&gt;Contact Us&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
              &lt;/ul&gt;
       &lt;/div&gt;
&lt;/div&gt;
&lt;!-- END TOP BRANDING --&gt;

</pre>
</br>
<p>
	To deploy the BOTTOM BRANDING custom HTML:
	<ol>
	<li>Log into your EBSCOadmin account</li>
	<li>Go to Customize Services...Branding page
	<li>Add new bottom branding by clicking the Bottom Branding Modify link located at the bottom page</li>
	<li>Copy the BOTTOM BRANDING HTML code</li>
	<li>Paste copied code into the Enter Custom Text on the Add New Branding page. </li>
	<li>Set Type of Text = HTML </li>
	<li>Choose to show branding on the Basic/Refine Search page or any other page desired.</li>
	<li>Click Submit</li>
	<li>On the Customize Services...Branding page, select the new bottom branding item in the Bottom Branding Version dropdown selection. </li>
	</ol>
</p>

<p class="widget_comments">
	<b>Bottom Branding</b> 
</p>

<pre>
&lt;!-- BOTTOM BRANDING --&gt;
&lt;link href="http://www.lh2cc.net/eds_demo_images/springfielduniversity/springfield-styles.css" rel="stylesheet" type="text/css" /&gt;
&lt;div id="springfieldufooter" class="three-column"&gt;
       &lt;div class="column quick-links"&gt;
              &lt;h2 class="linklist-heading"&gt;Quick Links to Major Resources&lt;/h2&gt;
              &lt;div class="two-column"&gt;
                     &lt;ul class="linklist column"&gt;
                           &lt;li&gt;&lt;a href="#"&gt;Academic Search complete (EBSCOhost)&lt;/a&gt;&lt;/li&gt;
                           &lt;li&gt;&lt;a href="#"&gt;Business Source complete (EBSCOhost)&lt;/a&gt;&lt;/li&gt;
                           &lt;li&gt;&lt;a href="#"&gt;Dissertations &amp; Teses (ProQuest)&lt;/a&gt;&lt;/li&gt;
                           &lt;li&gt;&lt;a href="#"&gt;JSTOR&lt;/a&gt;&lt;/li&gt;
                     &lt;/ul&gt;
                     
                     &lt;ul class="linklist column"&gt;
                           &lt;li&gt;&lt;a href="#"&gt;Oxford English Dictionary&lt;/a&gt;&lt;/li&gt;
                           &lt;li&gt;&lt;a href="#"&gt;PsycINFO (EBSCOhost)&lt;/a&gt;&lt;/li&gt;
                           &lt;li&gt;&lt;a href="#"&gt;Scopus&lt;/a&gt;&lt;/li&gt;
                           &lt;li&gt;&lt;a href="#"&gt;Web of Science&lt;/a&gt;&lt;/li&gt;
                     &lt;/ul&gt;
              &lt;/div&gt;
       &lt;/div&gt;&lt;!-- END Quick Links --&gt;
       
       &lt;div class="column"&gt;
              &lt;h2 class="linklist-heading"&gt;Research Help&lt;/h2&gt;
              &lt;ul class="linklist"&gt;
                     &lt;li&gt;&lt;a href="#"&gt;Ask a Librarian&lt;/a&gt;&lt;/li&gt;
                     &lt;li&gt;&lt;a href="#"&gt;Citation Style Guides&lt;/a&gt;&lt;/li&gt;
                     &lt;li&gt;&lt;a href="#"&gt;Research Guides&lt;/a&gt;&lt;/li&gt;
              &lt;/ul&gt;
       &lt;/div&gt;&lt;!-- END Research Help --&gt;
       
       &lt;div class="column"&gt;
              &lt;h2 class="linklist-heading"&gt;Services&lt;/h2&gt;
              &lt;ul class="linklist"&gt;
                     &lt;li&gt;&lt;a href="#"&gt;For Faculty&lt;/a&gt;&lt;/li&gt;
                     &lt;li&gt;&lt;a href="#"&gt;For Graduate Students&lt;/a&gt;&lt;/li&gt;
                     &lt;li&gt;&lt;a href="#"&gt;For Undergraduates&lt;/a&gt;&lt;/li&gt;
                     &lt;li&gt;&lt;a href="#"&gt;Borrowing Privileges&lt;/a&gt;&lt;/li&gt;
                     &lt;li&gt;&lt;a href="#"&gt;Interlibrary Loan&lt;/a&gt;&lt;/li&gt;
              &lt;/ul&gt;
       &lt;/div&gt;&lt;!-- END Services --&gt;
&lt;/div&gt;
&lt;!-- END BOTTOM BRANDING --&gt;
</pre>


<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="gbooks"></a><h3>Book Carousel</h3>

<a href="javascript: popupImage( 'img/widgets/carousel.png', 800 )">
	<img class="widget_image" src="img/widgets/carousel_thumb.png" alt="">
</a>

<p class="widget_desc">
	<b>Name: </b>Book Carousel<br>
	<b>Submitter: </b>EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
</p>

<p class="widget_comments">
	<b>Comments</b>: This widget provides a custom book carousel which rotates through a set of books with covers
	and titles.  Contact EBSCO Technical Support if you would like help enabling this widget in your EBSCOhost or
	EBSCO Discovery Service user interfaces.  
</p>
<p>
	<!--- Use our <a href="cbuilder.php">Carousel Builder</a> to get customized carousel code easily. --->
</p>
<p>
	Your custom html code should be placed in the 
	"Custom HTML" box of the Branding screen in EBSCOadmin. Below is an example of the html 
	code: 
</p>

<pre>
&lt;script type="text/javascript" language="Javascript"&gt;

/*
	Carousel Settings
*/
var carousel = {
	"profile"        : "",
	"newWindow"		 : false,
	"booksDisplayed" : 1,	 // Number of books displayed.
	"shiftRate"      : 1,	 // Number of books shifted every iteration.
	"shiftSpeed"     : 500,	 // How fast the books shift (ms).
	"autoShift"	     : true, // Auto shift will shift the books after a certain period.
	"shiftTime"	     : 5	 // Time, in seconds, to auto shift the books.
};

/*
	Book List
	  Each entry is separated by commas.
	  To add a book, add a comma after the last '}', and
	  copy and paste a new entry to the end.
*/

var bookList = {"books" : [
	{
		"ISBN"      : '9780195338218',
		"AN"        : 'gua3677229',
		"database"  : 'cat00264a',
		"title"	    : "Technology : a world history"
	},
	{
		"ISBN"      : '9780226610894',
		"AN"        : 'gua3679703',
		"database"  : 'cat00264a',
		"title"     : "Modern nature"
	}
]};
&lt;/script&gt;

&lt;script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"type="text/javascript"&gt;&lt;/script&gt;
&lt;script src="http://support.ebscohost.com/eit/scripts/carousel_v0.1.1.js"  type="text/javascript"&gt;&lt;/script&gt;
</pre>


<div class="hr"></div>
<a class="top" href="#top">Back to Top</a>
<a name="gbooks"></a><h3>Business Book Summaries Carousel</h3>

<a href="javascript: popupImage( 'img/widgets/carousel.png', 800 )">
	<img class="widget_image" src="img/widgets/carousel_thumb.png" alt="">
</a>

<p class="widget_desc">
	<b>Name: </b>Business Book Summaries Carousel<br>
	<b>Submitter: </b>EBSCO Publishing<br>
	<b>Type: </b>Custom HTML<br>
</p>

<p class="widget_comments">
	<b>Comments</b>: This widget provides a custom book carousel for Business Book Summaries.  The carousel rotates through a set of books with covers
	and titles.  Contact EBSCO Technical Support if you would like help enabling this widget in your EBSCOhost or
	EBSCO Discovery Service user interfaces.  
</p>
<p>
	<!--- Use our <a href="cbuilder.php">Carousel Builder</a> to get customized carousel code easily. --->
</p>
<p>
	Your custom html code should be placed in the 
	"Custom HTML" box of the Branding screen in EBSCOadmin. Below is an example of the html 
	code: 
</p>


<pre>
&lt;script type="text/javascript" language="Javascript"&gt;

/*
	Carousel Settings
*/
var carousel = {
	"profile"        : "",
	"database"       : "qbh",
	"newWindow"		 : false,
	"booksDisplayed" : 1,	 // Number of books displayed.
	"shiftRate"      : 1,	 // Number of books shifted every iteration.
	"shiftSpeed"     : 500,	 // How fast the books shift (ms).
	"autoShift"	     : true, // Auto shift will shift the books after a certain period.
	"shiftTime"	     : 5	 // Time, in seconds, to auto shift the books.
};

/*
	Book List
	  Each entry is separated by commas.
	  To add a book, add a comma after the last '}', and
	  copy and paste a new entry to the end.
*/

var bookList = {"books" : [
	{
		"AN"        : '55676915',
		"title"	    : "The 800-Pound Gorilla of Sales"
	},
	{
		"AN"        : '55676917',
		"title"	    : "The Experience Effect"
	},
	{
		"AN"        : '55828080',
		"title"	    : "The New Rules of Marketing and PR"
	},
	{
		"AN"        : '55828079',
		"title"	    : "Intelligent M&A"
	},
	{
		"AN"        : '55676918',
		"title"     : "The Manager's Guide to HR"
	}
]};
&lt;/script&gt;

&lt;script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"type="text/javascript"&gt;&lt;/script&gt;
&lt;script src="http://support.ebscohost.com/eit/scripts/carousel_bbs_v1.js"  type="text/javascript"&gt;&lt;/script&gt;
</pre>



<script type="text/javascript" language="Javascript">
//<p><a href="http://www.yahoo.com" title="yahoo.com" class="example1demo">open popup</a></p> 

$('.cBuilderPopup').popupWindow({ 
	height:510, 
	width:620
}); 

</script>

<?php 

include( 'includes/image_popup.php' );
include( 'includes/footer.php' );

?>