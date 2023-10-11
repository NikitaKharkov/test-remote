<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<link href="styles/style_lms.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'sharepoint';
$page = 'sp_options';
include( 'includes/navbar.php' );


?>

<h2>Sharepoint</h2>

<p>
	The sample SharePoint pages shown below can give you ideas on deploying EBSCOhost content within your own
	SharePoint portal.  
</p>

<div class="hr"></div>

<h3>Screenshots</h3>
<a name="screenshots"></a><a href="#screenshots" onClick="changeSS( 'sp_ebscohost.png', 		'This is a screenshot showing how you can integrate the EBSCOhost Search Interface directly into your SharePoint portal, using only WebParts.' );"><img src="img/content/sp_ebscohost_thumb.png" class="choose_image"></a>
<a href="#screenshots" onClick="changeSS( 'sp_searchbox.png', 		'This screenshot shows different ways to integrate EBSCOhost content into your portal.  Shown above is a custom search box, an RSS feed displaying the latest results for specified keywords, an HTML carousel displaying various books using persistent links, and an &quot;Article of the Week&quot; section, also using persistent links.' );"><img src="img/content/sp_searchbox_thumb.png" class="choose_image"></a>

<div style="clear: both"></div>

<div style="height: 600px; width: 1px; float: right"></div>

<div class="screenshot" id="screenshot">
	<img src="img/content/sp_ebscohost.png" alt="">
	<div class="screenshot_desc">
		This is a screenshot showing how you can integrate the EBSCOhost Search Interface directly into your SharePoint portal, using only WebParts.
	</div>
</div>

<?php 

include( 'includes/footer.php' );

?>