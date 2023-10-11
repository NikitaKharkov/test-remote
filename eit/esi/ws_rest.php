<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_howto';
$subpage = 'rest';
include( 'includes/navbar.php' );


?>

<!---div id="showhide_btn">
	<a href="javascript: hideMenu()" style="font-size: 10px;">&lt;&lt;</a>
</div--->

<div class="ws_infobox">

	Web Service Type:
	<p style="margin: 5px; padding-left: 15px; font-size: 10px;">
		REST
	</p>
	
	Web Service Location:
	<p style="margin: 5px; padding-left: 15px; font-size: 10px;">
		Click to Select<br>
		<input class="txt" id="txtUrl" onclick="txtSelectAll( 'txtUrl' )" type="text" value="http://eit.ebscohost.com/Services/SearchService.asmx" style="width: 225px">
	</p>
	
	Supported Methods:
	<p style="margin: 5px; padding-left: 15px; font-size: 12px;">
		<a href="ws_api_info.php">Info</a><br>
		<a href="ws_api_search.php">Search</a><br>
		<a href="ws_api_search_eds.php">Search (EDS)</a><br>
		<a href="ws_api_search_ehis.php">Search (EHIS)</a><br>
		<a href="ws_api_browse.php">Browse</a><br>
		<a href="ws_api_authority.php">AuthoritySearch</a><br>
		<a href="ws_api_clusters.php">GetClusters</a><br>
	</p>
	
</div>

<a name="top"></a><h2>Making Requests with REST</h2>

<ul>
	<li><a href="#a">Using REST with the EIT Web Service API</a></li>
	<li><a href="#b">REST Authentication</a></li>
</ul>


<p>
	EIT Web Service can be implemented in a REST-like way. REST, or Representational State Transfer, 
	allows data to be retrieved in many different ways, without the additional messaging layers 
	SOAP requires. Before you can access EIT, you will need access to an EIT profile. To have 
	this set-up, please contact your sales rep.
</p>

<p>
	Using the EIT Web Service is extremely easy. To begin, you simply need to know your 
	username (a string made-up of your EBSCOhost Customer ID, Group ID, and Profile ID), and 
	profile password for accessing. If you already have access to EIT Web Service, and you do 
	not know these values, please contact EBSCOhost Technical Support for assistance.
</p>
	
<div class="hr"></div>

<a name="a"></a><h3>Using REST with the EIT Web Service API</h3>
<a class="top" href="#top">Back to Top</a>
<div style="clear:both;"></div>

<p>
	Making a REST call is as easy as making calls to the EIT Web Service using a URL
	with GET variables.  This is an example REST call to the EIT Web Service API:
</p>	

<pre>
http://eit.ebscohost.com/Services/SearchService.asmx/Search?
	<span class="highlight">prof</span>=<span class="highlight2">[Your EIT Profile ID]</span>
	&amp;<span class="highlight">pwd</span>=<span class="highlight2">[Your Profile Password]</span>
	&amp;<span class="highlight">query</span>=<span class="highlight2">[Your Search Query]</span>
	&amp;<span class="highlight">db</span>=<span class="highlight2">[Database to Search]</span>
</pre>

<p>
	The EIT Web Service API is always available at the following URL:
</p>

<p class="indent">
	<code>http://eit.ebscohost.com/Services/SearchService.asmx</code>
</p>

<p>
	To use a method of the EIT Web Service API using REST, simply append a '/', and the name of the
	method you'd like to use.  For example, if you'd like to perform a browse, the correct format
	would be:
</p>

<p class="indent">
	<code>http://eit.ebscohost.com/Services/SearchService.asmx/Browse</code>
</p>

<p>
	To send parameters with your request, simply add them on to the end of the URL as variables.
	For example, to send a Browse request with the parameter "db" set, it would look as follows:
</p>

<p class="indent">
	<code>http://eit.ebscohost.com/Services/SearchService.asmx/Browse?db=a9h</code>
</p>

<div class="hr"></div>

<a name="b"></a><h3>REST Authentication</h3>
<a class="top" href="#top">Back to Top</a>
<div style="clear:both;"></div>

<p>
	All requests to the EIT Web Service API require authentication.  Authentication is also very
	easy; Just put your authentication details in variables in your request URL.  For example,
	if you'd like to make an Info request with profile authentication:
</p>

<p class="indent">
	<code>http://eit.ebscohost.com/Services/SearchService.asmx/Info?prof=s0123456&pwd=password</code>
</p>
<p>
	This makes an Info request with "0123456" as the profile, and "password" as the password. 
</p>
<p>
	These are the available authentication parameters for the EIT Web Service REST API:
</p>

<table class="parameters">
	<tr class="tr_header">
		<th>
			<div class="th_leftcorner"></div>
			
			<div class="th_lefttext">
				Name
			</div>
			
		</th>
		<th>
			<div class="th_text">
				Description
			</div>
		</th>
		<th>
			<div class="th_text">
				Required
			</div>
		</th>
		<th class="th_right">
			<div class="th_rightcorner"></div>
			<div class="th_righttext">
				Values
			</div>
		</th>
	</tr>
	<tr>
		<td>
			<code>prof</code>
		</td>
		<td>
			The profile used for authentication.  This must be an EIT enabled profile.
		</td>
		<td>
			Required if using profile authentication.
		</td>
		<td class="td_right">
			-
		</td>
	</tr>
	<tr>
		<td>
			<code>pwd</code>
		</td>
		<td>
			The password used for profile authentication.
		</td>
		<td>
			Required if using profile authentication.
		</td>
		<td class="td_right">
			-
		</td>
	</tr>
	<tr>
		<td>
			<code>authType</code>
		</td>
		<td>
			Indicates if using IP Authentication or Profile Authentication.  
			<br><br>
			<span class="highlight3">Default: profile</span>
		</td>
		<td>No</td>
		<td class="td_right">
			profile,
			<br>
			ip
		</td>
	</tr>
	<tr>
		<td>
			<code>ipprof</code>
		</td>
		<td>
			The profile used for authentication.
		</td>
		<td>
			Required if using IP authentication.
		</td>
		<td class="td_right">
			-
		</td>
	</tr>
</table>


<?php 

include( 'includes/footer.php' );

?>