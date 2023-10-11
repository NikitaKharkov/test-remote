<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'enterprise_search';
$page = 'esi_xml';
include( 'includes/navbar.php' );


?>

<h2 style="color: #004C00">Enterprise Search Integration - XML Metadata</h2>

<p>
XML database rebuild files represent metadata in the following format:
</p>

<pre>
&lt;root&gt;
  &lt;record plink="[Persistent link to the EBSCOhost article] "&gt;
    &lt;item name="[Metadata field]"&gt;[Field value]&lt;/item&gt;
    &lt;item name="[Metadata field]"&gt;
    &lt;subitem name="[Metadata subfield]"&gt;[Subfield value]&lt;/subitem&gt;
    &lt;subitem name="[Metadata subfield]"&gt;[Subfield value]&lt;/subitem&gt;
    &lt;/item&gt;
    &lt;item name="[Metadata field]"&gt;[Field value]&lt;/item&gt;
    ...
  &lt;/record&gt;
  &lt;record plink="[Persistent link to the EBSCOhost article] "&gt;
    &lt;item name="[Metadata field]"&gt;
    &lt;subitem name="[Metadata subfield]"&gt;[Subfield value]&lt;/subitem&gt;
    &lt;subitem name="[Metadata subfield]"&gt;[Subfield value]&lt;/subitem&gt;
    &lt;/item&gt;
  ...
  &lt;/record&gt;
  ...
&lt;/root&gt;
</pre>

<p>
	Three types of records are represented in XML update files:

	<ol>
	   <li>New - The metadata for the record is the same as in the full build. The record needs to be added to the database index.</li>
	   <li>Update - The metadata for the record is the same as in the full build. The entire record needs to be reloaded with the new data.</li>
	   <li>Delete - These records will have the delete attribute set to true in the record xml element, and the only subelement of this record will be an item xml element containing the AN for the record.  An example would look like this:
	   <pre>
&lt;record plink="http://search.ebscohost.com/login.aspx?direct=true&id=113603&site=dynamed" delete="true"&gt;
  &lt;item name="AN"&gt;113603&lt;/item&gt;
&lt;/record&gt;
	   </pre>
	   </li>
	</ol>
</p>
 
<h2>Description of Database Tag Names</h2>
<p>
	For information on the details of the XML metadata specific to your database, please contact technical support.  
</p>


<?php 

include( 'includes/footer.php' );

?>