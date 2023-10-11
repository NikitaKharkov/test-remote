<?php 
$html5 = true;

$head = '<link href="styles/style_urlb.css" rel="stylesheet" type="text/css">
<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';


$newJQuery = true;
include( 'includes/header_urlb.php' );

$menu = 'url_builder';
$page = 'urlb';
include( 'includes/navbar.php' );
?>

		<h2>Direct URL FAQS:</h2>
		  <ol>
		    

		    <li>
            	<a href="https://connect.ebsco.com/s/article/How-do-I-set-up-direct-links-to-EBSCOhost-profiles-and-or-databases" target="_blank">How do I set up direct links to EBSCO<em>host</em>  profiles and/or databases? 
            	</a>
            </li>

		

		  

		    <li>
            	<a href="https://connect.ebsco.com/s/article/How-do-I-create-direct-links-to-my-eBook-or-Audiobook-collections" target="_blank">How do I create direct links to my EBSCO eBook  or Audiobook collections?
            	</a>
            </li>


		    <li>
            	<a href="https://connect.ebsco.com/s/article/What-is-the-direct-URL-syntax-to-link-to-an-ebook-or-audiobook
" target="_blank">What is the direct URL syntax to link to an  EBSCO eBook or audiobook?
           	  </a>
            </li>
</ol>
	
<?php 

// insert config
/*include( 'includes/sbbData.php' );

$page_footer = '<script type="text/javascript" src="js/jsrender.js"></script>
*/
include( 'includes/footer_urlb.php' );

?>

