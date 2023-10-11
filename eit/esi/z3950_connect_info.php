<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'z39.50';
$page = 'faq';
include( 'includes/navbar.php' );

?>
<h2>Z39.50 Connection Information</h2>
<p>

<div class="hr"></div>
<h3>Connection Information</h3>        
<p>
<ul>
	<li>Host Name:  zgw.ebscohost.com</li>
	<li>Port Number:  210</li>
	<li>Target Information: custid.groupid.profileid </li>
</ul>

Note:  This data is customer specific

Where custid = Customer ID from EBSCOadmin, for target account<p>
Where groupid = Group ID from EBSCOadmin, for target group<p>
Where profileid = Profile ID from EBSCOadmin, for target profile

Password: 	The password is located in EBSCOadmin under profile maintenance for the Z3950 profile only.  
If you do not have a Z3950 profile please contact technical support (eptech@epnet.com) to have this added.

For best performance always use the z3950 profile provided for use with Z39.50 clients in EBSCOadmin 
in your Target Information.  

Note:  Use of a password is not always required for connection via a Z39.50 client, but is necessary if the target profile contains a password

<div class="hr"></div>
<h3>Suffixing the Target String for the Delivery of Full Text</h3>        
<p><p>

As many EBSCOhost databases contain full text, you may want to suffix your target string so that this 
Full Text may be delivered in a format other than Marc 21, for example in SUTRS record format. The SUTRS 
record format supports delivery in plain text or HTML.  To activate this formatted full text, simply suffix 
the end of your authentication string with the following: @SUTRS-HTML.  

Additionally, to retrieve Full Text already formatted in HTML (via a hyperlink), you should suffix your 
target string with the following: @FT-LINKS. Keep in mind that no MARC Full Text is ever displayed when 
this feature is enabled.

<div class="hr"></div>
<h3>Database Short-names</h3>        
<p><p>
For a complete list of database product codes, see 
<p>
&nbsp; &nbsp; <a href="http://support.epnet.com/CustSupport/Customer/Details.aspx?faq=1255" target="_new">
EBSCOhost Database Short Names List (Product Codes)</a>

</p>

<?php 

include( 'includes/footer.php' );

?>
