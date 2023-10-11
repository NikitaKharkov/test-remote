<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_samples.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'enterprise_search';
$page = 'esi';
include( 'includes/navbar.php' );


?>

<div class="minHeight"></div>

<h2>Enterprise Search Integration</h2>

<div style="width: 500px">
	<p class="infobox_green">
		<strong>Coming Soon</strong> - ESI will be undergoing some major enhancements. Check back 
		for details on the new Web Service, OAI-PMH capabilities, and richer formats.		
	</p>
	<p>
		Enterprise Search Integration (ESI) makes database metadata available for local indexing.
		Databases are accessible as XML via FTP.  Integrate EBSCOhost premium content directly into
		your search interface!
	</p>
	
	<p>
		XML files contain article metadata with links back to Full Text. XML files of the article 
		metadata are put onto an ftp site as content is updated inside EBSCOhost.
	</p>
	
	<p>
	Customer setup tasks
	<ul>
	    <li>Customer Enterprise Search Application administrator scripts pick-up and process the XML.</li>
	    <li>Perform initial full database load.</li>
	    <li>Retrieve daily/frequent updates.</li>
	</ul>
	</p>
	<p>
		To learn more about how EBSCO Publishing can serve all of a corporation's electronic 
		information needs <a href="http://www.ebscohost.com/thisMarket.php?marketID=17">click here</a>.
	</p>
</div>
	

<?php 

include( 'includes/footer.php' );

?>