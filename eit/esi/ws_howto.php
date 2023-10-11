<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_howto';
include( 'includes/navbar.php' );


?>
<h2>How-To: EBSCOhost Web Service</h2>
<p>
	This section contains how-to articles on formatting queries for the EBSCOhost Web Service API.
</p>

<ul style="width: 400px">
	<li><a href="ws_howto_hl.php">Search Health Library</a>
		<div class="indent" style="padding-top: 5px">
			Browse sample search scenarios for Health Library to review how queries are formatted with commonly used search tags and limiters for
			the EBSCOhost Web Service API.
		</div>
	</li>
	<li><a href="ws_howto_queries.php">Search EBSCOhost</a>
		<div class="indent" style="padding-top: 5px">
			Browse sample search scenarios for EBSCOhost databases to review how queries are formatted with commonly used search tags and limiters for
			the EBSCOhost Web Service API. 
		</div>
	</li>
	<li><a href="ws_rest.php">Making Requests with REST</a>
		<div class="indent" style="padding-top: 5px">
			Instructions for using the REST protocal with the EBSCOhost Web Service API.
		</div>
	</li>
	<li><a href="ws_soap.php">Making Requests with SOAP</a>
		<div class="indent" style="padding-top: 5px">
			Instructions for using the SOAP protocal with the EBSCOhost Web Service API.
		</div></li>
</ul>

<p>
	To learn more about how EBSCO Publishing can serve all of a corporation's electronic 
	information needs <b><a href="http://www.ebscohost.com/thisTopic.php?marketID=6&amp;topicID=683" target="_blank">click here</a></b>.
</p>
<?php 

include( 'includes/footer.php' );

?>
