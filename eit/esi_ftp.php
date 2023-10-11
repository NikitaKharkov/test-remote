<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'enterprise_search';
$page = 'esi_ftp';
include( 'includes/navbar.php' );


?>

<h2 style="color: #004C00">Enterprise Search Integration - FTP Retrieval</h2>

	<p>
	The FTP directory for your provided username and password are organized by folders 
	named by the product codes.
 	</p>
	
	<p>
	The manifest.txt file in each directory lists the order to download and index the 
	files, where each file is separated by a line break. The first file to download 
	and index is on line one, the second file on line two, the third on line three and 
	so forth. The manifest.txt file is erased and recreated when a new full build becomes 
	available.
	 </p>
	
	<p>
	Examples:
		<ul>
		    <li>heh1_20080623_full-001.zip</li>
		    <li>heh1_20080623_full-002.zip</li>
		    <li>heh1_20080623_full-003.zip</li>
		    <li>heh1_20080623_full-004.zip</li>
		    <li>heh1_20080623_full-005.zip</li>
		    <li>heh2_20080623_full-001.zip</li>
		    <li>heh2_20080701_update-001.zip</li>
		    <li>heh2_20080706_update-001.zip</li>
		    <li>heh2_20080713_update-001.zip</li>
		    <li>heh2_20080721_update-001.zip</li>
		 </ul>
	
	[Square brackets indicates optional elements]
	</p> 
	
	<p>
		ZIP files are named in each folder using the following syntax: {productcode}[{segment}]_{yyyymmdd}_full-{counter}.zip
	 
	 	<table>
	 		<tr>
	 			<td>productcode</td>
	 			<td>short database code</td>
	 		</tr>
	 		<tr>
	 			<td>[segment]</td>
	 			<td>database segment</td>
	 		</tr>
	 		<tr>
	 			<td>yyyymmdd</td>
	 			<td>date of file</td>
	 		</tr>
	 		<tr>
	 			<td>counter</td>
	 			<td>sequential counter</td>
	 		</tr>
	 	</table>
	</p>	 
	
	<p>
		XML files are named in the ZIP files using the following syntax: {productcode}[{segment}]_{yyyymmdd}_update-{counter}.xml
		
	 	<table>
	 		<tr>
	 			<td>productcode</td>
	 			<td>short database code</td>
	 		</tr>
	 		<tr>
	 			<td>[segment]</td>
	 			<td>database segment</td>
	 		</tr>
	 		<tr>
	 			<td>yyyymmdd</td>
	 			<td>date of file</td>
	 		</tr>
	 		<tr>
	 			<td>counter</td>
	 			<td>sequential counter</td>
	 		</tr>
	 	</table>
	</p>


<?php 

include( 'includes/footer.php' );

?>