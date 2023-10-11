<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_lms.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_services';
$page = 'ws_admin';
include( 'includes/navbar.php' );


?>
<h2>EBSCOadmin Setup</h2>
<p>
	The following screenshots taken from <code>EBSCOadmin</code> show the settings 
	required to setup a web services account.  Contact your EBSCO Account Manager or Customer Support
	for assistance with EBSCOadmin.
</p>

<div class="hr"></div>

<h3>Screenshots</h3>
<a name="screenshots"></a>
<a href="#screenshots" onClick="changeSS( 'ws_admin_searching.png', 		'EBSCOadmin web services Searching tab.' 					);"><img src="img/content/ws_admin_searching_thumb.png" class="choose_image"></a>
<a href="#screenshots" onClick="changeSS( 'ws_admin_databases.png', 		'EBSCOadmin web services Databases tab.' 					);"><img src="img/content/ws_admin_databases_thumb.png" class="choose_image"></a>
<a href="#screenshots" onClick="changeSS( 'ws_admin_viewresults.png', 		'EBSCOadmin web services Viewing Results tab.' 				);"><img src="img/content/ws_admin_viewresults_thumb.png" class="choose_image"></a>

<div style="clear: both"></div>

<div class="screenshot" id="screenshot">
	<img src="img/content/ws_admin_searching.png" alt="">
	<div class="screenshot_desc">
		EBSCOadmin web services Searching tab.
	</div>
</div>

<?php 

include( 'includes/footer.php' );

?>