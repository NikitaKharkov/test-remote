<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_lms.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'learning_management';
$page = 'lms';
include( 'includes/navbar.php' );


?>
<h2>Learning Management Systems</h2>
<p>
	Targeted eLearning content provides organizations with relevant, timely information applicable 
	to a wide variety of job and business needs within the organization. Whether used as core learning 
	activities or as reference material for existing eLearning content, users will be well served 
	in their daily performance support and talent development activities. All LMS content is sourced 
	from the industry's most credible authorities, such as American Bar Association, Business Week, 
</p>

<div class="hr"></div>

<h3>Screenshots</h3>
<a name="screenshots"></a>
<a href="#screenshots" onClick="changeSS( 'lms_articles.png', 		'Customer is free to identify articles for their LMS needs.  Customer would simply  need to specify the article title and AN value.  Once this information is collected for the desired articles, the customer would forward  this information to their EBSCO account manager you will schedule the creation of the content packages.' 					);"><img src="img/content/lms_articles_thumb.png" class="choose_image"></a>
<a href="#screenshots" onClick="changeSS( 'lms_grades.png', 		'EBSCO content adheres to the SCORM Reference Model.  Status (pass/fail, complete/incomplete) and Elapsed Time are the main data elements supported.  EBSCO content usage details can be viewed in various LMS status, course and user reports.' 		);"><img src="img/content/lms_grades_thumb.png" class="choose_image"></a>
<a href="#screenshots" onClick="changeSS( 'lms_scorm_package.png',	'SCORM content packages are zip files that can be imported into your LMS as-is.  The zip file contains the imsmanifest.xml which describes the content organization and resources of the package.  The zip packages do not contain the actual PDF or HTML content.  All content will reside and be delivered to the LMS for viewing from the EBSCOhost servers.' 	);"><img src="img/content/lms_scorm_thumb.png" class="choose_image"></a>
<a href="#screenshots" onClick="changeSS( 'lms_page.png',			'Articles and summaries are displayed in their native PDF or HTML format within the LMS course viewer.  Users will also have direct access to the audio version of the business book summaries from the within the LMS course viewer.  ' 	);"><img src="img/content/lms_page_thumb.png" class="choose_image"></a>

<div style="clear: both"></div>

<div class="screenshot" id="screenshot">
	<img src="img/content/lms_articles.png" alt="">
	<div class="screenshot_desc">
		Customer is free to identify articles for their LMS needs.  Customer would simply  need to specify the article title 
		and AN value.  Once this information is collected for the desired articles, the customer would forward  this 
		information to their EBSCO account manager you will schedule the creation of the content packages.
	</div>
</div>

<?php 

include( 'includes/footer.php' );

?>