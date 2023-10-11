<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_howto';
$subpage = 'soap';
include( 'includes/navbar.php' );


?>

<!---div id="showhide_btn">
	<a href="javascript: hideMenu()" style="font-size: 10px;">&lt;&lt;</a>
</div--->

<div class="ws_infobox">
	Web Service Type:
	<p style="margin: 5px; padding-left: 15px; font-size: 10px;">
		SOAP
	</p>
	Web Service Location:
	<p style="margin: 5px; padding-left: 15px; font-size: 10px;">
		Click to Select<br>
		<input class="txt" id="txtUrl" onclick="txtSelectAll( 'txtUrl' )" type="text" value="http://eit.ebscohost.com/Services/SearchService.asmx" style="width: 225px"></input>
	</p>
	WSDL Location:
	<p style="margin: 5px; padding-left: 15px; font-size: 10px;">
		Click to Select<br>
		<input class="txt" id="txtUrl2" onclick="txtSelectAll( 'txtUrl2' )" type="text" value="http://eit.ebscohost.com/Services/SearchService.asmx?WSDL" style="width: 225px"></input>
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

<a name="top"></a><h2>Making Requests with SOAP</h2>
<ul>
	<li><a href="#a">Using SOAP with the EIT Web Service API</a></li>
	<li><a href="#b">SOAP Basics</a></li>
	<li><a href="#c">The SOAP Header</a></li>
	<li><a href="#d">The SOAP Body</a></li>
	<li><a href="#e">The Full SOAP Message</a></li>
</ul>


<p>
	EBSCOhost offers a SOAP protocol for the EBSCOhost Integration Toolkit Web Service 
	API. 'SOAP' is an acronym for "Simple Object Access Protocol". SOAP provides a way 
	for two different applications on two different platforms to easily exchange data. 
</p>

<p>
	SOAP uses XML to exchange data. The exchange of data can be referred to as a 
	"transaction". 
	A typical input-output transaction works as follows: 
</p>

<ol>
	<li>Client sends an XML message to server requesting data.</li>
	<li>Server receives message, and retrieves data.</li>
	<li>Server sends an XML message containing requested data back to the client.</li>
	<li>Client processes returned data.</li>
</ol>

<p>
	This format provides a very concrete and standardized way of communication between 
	applications. Many different platforms and programming languages support SOAP.
</p>

<p>
	The SOAP protocol requires an AuthorizationHeader for authentication.  To learn how
	to authenticate a SOAP request, refer to the <a href="#c">SOAP Header</a> section.
</p>
	
<div class="hr"></div>

<a name="a"></a><h3>Using SOAP with the EIT Web Service API</h3>
<a class="top" href="#top">Back to Top</a>
<div style="clear:both;"></div>

<p>
	The EBSCOhost SOAP Web Service has a WSDL, or Web Services Description Language, file 
	available. The Web Services Description Language is an XML based language, and provides a 
	model for describing web services. The WSDL is always located here: 
</p>
<p class="indent">
	<a href="http://eit.ebscohost.com/Services/SearchService.asmx?WSDL">http://eit.ebscohost.com/Services/SearchService.asmx?WSDL</a>
</p>
<p>
	The WSDL document provides all of the information needed to make a request to the EIT Web Service
	API.  The EIT Web Service SOAP API is always available at this address:
</p>
<p class="indent">
	<a href="http://eit.ebscohost.com/Services/SearchService.asmx">http://eit.ebscohost.com/Services/SearchService.asmx</a>
</p>
<p>
	In order to successfully make a request to the EIT Web Service API, an EIT profile will first be
	needed.  If you do not have an EIT profile, however, you may contact your Account Manager for details on acquiring
	one.
</p>
	
<div class="hr"></div>

<a name="b"></a><h3>SOAP Basics</h3>
<a class="top" href="#top">Back to Top</a>
<div style="clear:both;"></div>
<p>
	There are two parts to a SOAP message:
	
	<ul>
		<li>The SOAP Header - This will contain authentication data for the EIT Web Service API.</li>
		<li>The SOAP Body - This will contain the request to the EIT Web Service API.</li>
	</ul>
	
	For more information on SOAP itself, and to find out the basics about SOAP, these links
	may be helpful:
</p>
<ul>
	<li><a href="http://www.w3.org/TR/soap/" target="_new">SOAP Specifications</a></li>
	<li><a target="_new" href="http://en.wikipedia.org/wiki/SOAP">SOAP - Wikipedia, the free encyclopedia</a></li>
	<li><a target="_new" href="http://www.w3schools.com/soap/default.asp">SOAP Tutorial</a></li>
</ul>

<div class="hr"></div>

<a name="c"></a><h3>The SOAP Header</h3>
<a class="top" href="#top">Back to Top</a>
<div style="clear:both;"></div>

<p>
	The SOAP Header will contain the AuthorizationHeader, which is what 
	the EIT SOAP Web Service API uses to authenticate
	users.  The SOAP Header, with the EIT Authorization Header, must look like this:
</p>

<pre>
&lt;soap:Header&gt;
  &lt;eit:AuthorizationHeader soap:mustUnderstand="1" xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
    &lt;eit:<span class="highlight">Profile</span>&gt;<span class="highlight2">[Your EIT Profile ID]</span>&lt;/eit:Profile&gt;
    &lt;eit:<span class="highlight">Password</span>&gt;<span class="highlight2">[Your  Profile Password]</span>&lt;/eit:Password&gt;
  &lt;/eit:AuthorizationHeader&gt;
&lt;/soap:Header&gt;
</pre>

<p>
	These are the parameters which may be used in the AuthorizationHeader:
	
	
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
			<code>Profile</code>
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
			<code>Password</code>
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
			<code>AuthType</code>
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
			<code>IpProfile</code>
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
	<tr>
		<td>
			<code>IpAddress</code>
		</td>
		<td>
			The IP address used for authentication.
		</td>
		<td>
			Required if using IP authentication.
		</td>
		<td class="td_right">
			-
		</td>
	</tr>
</table>
</p>

<div class="hr"></div>

<a name="d"></a><h3>The SOAP Body</h3>
<a class="top" href="#top">Back to Top</a>
<div style="clear:both;"></div>

<p>
	The SOAP Body is where the actual request to data from the EIT Web Service will
	go.  The SOAP Body must look like the following:
</p>

<pre>
&lt;soap:Body&gt;
  &lt;!-- The EIT Web Service method being called goes here --&gt;
&lt;/soap:Body&gt;
</pre>

<p>
	Inside of the Body, one of the EIT Web Service methods is called.  For more information
	on each of the methods, see:
	
	<ul>
		<li><a href="ws_api_info.php">Info</a></li>
		<li><a href="ws_api_search.php">Search</a></li>
		<li><a href="ws_api_browse.php">Browse</a></li>
		<li><a href="ws_api_authority.php">AuthoritySearch</a></li>
	</ul>
	A sample of a SOAP request and response for each method is given.
</p>

<div class="hr"></div>

<a name="e"></a><h3>The Full SOAP Message</h3>
<a class="top" href="#top">Back to Top</a>
<div style="clear:both;"></div>

<p>
	In order to complete the SOAP Request, the SOAP Header and SOAP Body must be
	combined.  Both the SOAP Header and SOAP Body get put in the SOAP Envelope.  The
	full message must look like the following:
	
	<pre>
&lt;soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" soap:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" &gt;
  &lt;soap:Header&gt;
    &lt;eit:AuthorizationHeader soap:mustUnderstand="1" xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;eit:<span class="highlight">Profile</span>&gt;<span class="highlight2">[Your EIT Profile ID]</span>&lt;/eit:Profile&gt;
      &lt;eit:<span class="highlight">Password</span>&gt;<span class="highlight2">[Your  Profile Password]</span>&lt;/eit:Password&gt;
    &lt;/eit:AuthorizationHeader&gt;
  &lt;/soap:Header&gt;
  &lt;soap:Body&gt;
    &lt;!-- The EIT Web Service method being called goes here --&gt;
  &lt;/soap:Body&gt;
&lt;soap:Envelope&gt;
	</pre>
	
	This message may then be sent to the SOAP Web Service, and the data requested
	will be returned in XML format.
</p>

<?php 

include( 'includes/footer.php' );

?>