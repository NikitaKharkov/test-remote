<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_widgets.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'widgets';
$page = 'widgets';
include( 'includes/navbar.php' );


?>
<a name="top"></a>
<h2>Widgets</h2>

<p>
	Widgets enable you to add EBSCOhost or EBSCO Discovery Service (EDS) functionality to your institution's website, such as a search box.  You can also include widgets in the Related Information area of the EBSCOhost or EBSCO Discovery Service Results List or to an article's Detailed Record in order to: 
</p>

<ul>
    <li>Add instant messaging such as Meebo for ask-a-librarian functionality</li>
    <li>Display external dynamic results (e.g. images from Flickr, videos from YouTube, Google Books results, ...)</li>
    <li>Links to frequently used content sources (e.g. LibGuides)</li>
    <li>Custom messages, other HTML or text uses...</li>
</ul>

<p>
	<a href="http://support.epnet.com/knowledge_base/detail.php?id=4713" target="blank">Click here for step-by-step instructions on how to add widgets to EBSCOhost or EBSCO Discovery Service.</a>
</p>


<div class="hr"></div>
<h3>Getting Started</h3>

<p>
	There are three areas in the EBSCOhost or EBSCO Discovery Service user interface where you can display your own custom
	HTML widgets:
	<ul>
		<li><a href="widgets_branding.php">Branding</a>: The primary search screen in the EBSCOhost user interface.</li>
		<li><a href="widgets_list.php">Result List</a>: The list of search results after a user executes a search.</li>
		<li><a href="widgets_record.php">Detailed Record</a>: A detailed record of an individual search result item.</li>
	</ul>
</p>
	
<?php 

include( 'includes/image_popup.php' );
include( 'includes/footer.php' );

?>