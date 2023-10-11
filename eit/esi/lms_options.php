<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_lms.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'learning_management';
$page = 'lms_options';
include( 'includes/navbar.php' );


?>

<h2>Learning Management Systems</h2>

<p>
	There are many ways EBSCOhost content can be integrated directly into your LMS!  All of the
	different methods include:
</p>
<ul>
	<li><a href="#a">Persistent Links</a></li>
	<li><a href="#b">RSS Feeds</a></li>
	<li><a href="#c">Multiple Article Course</a></li>
	<li><a href="#d">Single Article Course</a></li>
</ul>

<a name="a"></a><div class="hr"></div>
<h3>Persistent Links</h3>
<p>
	<div class="lms_options_text">
		Persistent links are links which permanently point to an article, search, or publication.  They can be
		used from within the LMS to link to individual course-related articles, for example.
		<ul>
			<li>
				EBSCO content added as another module
				to an existing non-EBSCO course.
			</li>
			<li>
				Each title links directly to article PDT/HTML
			</li>
			<li>
				No usage tracking (SCORM) invoked
			</li>
			<li>
				EBSCO and/or customer would create this
				page.  Format and content would vary
				according to customer's needs 
			</li>
			<li>
				Customer would be responsible for 
				integrating within the LMS.
			</li>
		</ul>
	</div>
	<a href="javascript: popupImage( 'img/content/lms_option1.png', 627 )"><img src="img/content/lms_option1_thumb.png" style="border: 2px solid #0000FF; float: right" alt=""></a>
	<div style="clear: both"></div>
</p>

<div class="hr"></div>
<a name="b"></a><h3>RSS Feeds</h3>
<p>
	<div class="lms_options_text">
		RSS Feeds can be setup to display up-to-date search results, or the latest articles in a
		specific publication.  A feed can be setup to a subject specific to a course.
		<ul>
			<li>
				EBSCO content added as another module
				to an existing non-EBSCO course. 
			</li>
			<li>
				Each title links directly to article PDF/HTML
	
			</li>
			<li>
				No usage tracking (SCORM) invoked
			</li>
			<li>
				EBSCO and/or customer would create this
				page.  Format and content would vary
				according to customer's needs 
			</li>
			<li>
				Customer would be responsible for 
				integrating within the LMS.
			</li>
		</ul>
	</div>
	<a href="javascript: popupImage( 'img/content/lms_option2.png', 627 )"><img src="img/content/lms_option2_thumb.png" style="border: 2px solid #0000FF; float: right" alt=""></a>
	<div style="clear: both"></div>
</p>

<div class="hr"></div>
<a name="c"></a><h3>Multiple Article Course</h3>
<p>
	<div class="lms_options_text">
		A course can be setup comprising of several EBSCO Articles.
		<ul>
			<li>
				EBSCO content integrated as a 4 module
				(SCO) course within the LMS.
			</li>
			<li>
				Example shows how the course is
				displayed to the user by the LMS course
				viewer.
			</li>
			<li>
				Each module would be tracked (SCORM)
				separately.
			</li>
			<li>
				Number of articles (modules) to be used 
				within a single course is based on
				customer's preference.
			</li>
		</ul>
	</div>
	<a href="javascript: popupImage( 'img/content/lms_option4.png', 627 )"><img src="img/content/lms_option4_thumb.png" style="border: 2px solid #0000FF; float: right" alt=""></a>
	<div style="clear: both"></div>
</p>

<div class="hr"></div>
<a name="d"></a><h3>Single Article Course</h3>
<p>
	<div class="lms_options_text">
		A course can be setup comprising of several EBSCO Articles.
		<ul>
			<li>
				EBSCO content integrated as a single
				module (SCO) course within the LMS.
			</li>
			<li>
				Example shows how the course is
				displayed to the user by the LMS course
				viewer without the need for module 
				navigation.
			</li>
		</ul>
	</div>
	<a href="javascript: popupImage( 'img/content/lms_option5.png', 627 )"><img src="img/content/lms_option5_thumb.png" style="border: 2px solid #0000FF; float: right" alt=""></a>
	<div style="clear: both"></div>
</p>





<?php 

$page_footer = '<div id="fadeBox" style="position: fixed; left: 0px; top: 0px; bottom: 0px; right: 0px; background-color: #000000; display: none;">
</div>
<div onclick="popupImageOut()" id="imageBox" style="position: fixed; left: 0px; right: 0px; top: 0px; bottom: 0px; display: none;">

</div>';

include( 'includes/footer.php' );

?>