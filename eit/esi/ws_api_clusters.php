<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_clusters';
include( 'includes/navbar.php' );


?>

<script type="text/javascript" src="js/api.js"></script>

<!---div id="showhide_btn">
	<a href="javascript: hideMenu()" style="font-size: 10px;">&lt;&lt;</a>
</div--->

<a name="top"></a><h2 style="float: left;">GetClusters</h2>
<div style="clear:both;"></div>

<p>
	The <b>GetClusters</b> method is used to return facets which organize search results into groups based on categories such as: source types, subjects, authors, publications,
	companies, geography, location and content providers that are associated with a particular database(s) for a given query.  
	<p>
	To test this method with your EIT profile, visit the <a target="_new" href="http://eit.ebscohost.com/Pages/MethodDescription.aspx?service=~/Services/SearchService.asmx&method=GetClusters">EBSCOhost Web Service GetClusters method page</a>.
</p>
<ul>
	<li><a href="#b">Input Parameters</a></li>
	<li><a href="#f">Output Format</a></li>
	<li><a href="#c">REST Sample</a></li>
	<li><a href="#e">SOAP Sample</a></li>
</ul>

<p class="highlight3">
</p>


<div class="hr"></div>

<a name="b"></a><h3>Input Parameters</h3>

<p class="top" id="parametersTxt">
	<a href="javascript: hideSect( 'parameters' )">Hide</a> | <a href="#top">Back to Top</a>
</p>

<div style="clear:both;"></div>

<div id="parameters">

<p>
These are the input parameters for both the REST and SOAP protocols of the EIT Web Service
API's GetClusters method.  To see more information on either the REST or SOAP protocol with the EIT Web Service,
see:

<ul>
	<li><a href="ws_rest.php">Making REST Requests</a></li>
	<li><a href="ws_soap.php">Making SOAP Requests</a></li>
</ul>

The REST and SOAP protocols will return the same results, but the parameter names are
different.  Parameter names for the REST protocol are listed under the "REST" column, and
parameter names for the SOAP protocol are listed under the "SOAP" column.
<br><br>

</p>

<table class="parameters">
	<tr class="tr_header">
		<th>
			<div class="th_leftcorner"></div>
			
			<div class="th_lefttext">
				REST
			</div>
			
		</th>
		<th>
			<div class="th_text">
				SOAP
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
		<th style="min-width: 80px">
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
			<code>Profile<b>*</b></code>
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
			<code>Password<b>*</b></code>
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
			<code>AuthType<b>*</b></code>
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
			<code>IpProfile<b>*</b></code>
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
			<code>-</code>
		</td>
		<td>
			<code>IpAddress<b>*</b></code>
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
	<tr>
		<td>
			<code>query</code>
		</td>
		<td>
			<code>Query</code>
		</td>
		<td>
			Terms to be searched on.
		</td>
		<td>
			Yes
		</td>
		<td class="td_right">
			-
		</td>
	</tr>
	<tr>
		<td>
			<code>db</code>
		</td>
		<td>
			<code>Databases</code>
		</td>
		<td>
			Database(s) to perform the search on.
		</td>
		<td>
			Yes
		</td>
		<td class="td_right">
			-
		</td>
	</tr>

</table>
<span class="highlight3">* When using the SOAP API, these items must be in the AuthorizationHeader
of the request.  See <a href="ws_soap.php">Making Requests with SOAP</a> for more information on how
to form the AuthorizationHeader.</span>

</div>

<div class="hr"></div>

<a name="f" ></a><h3>Output Format</h3>

<p class="top" id="outputFormatTxt">
	<a href="javascript: hideSect( 'outputFormat' )">Hide</a> | <a href="#top">Back to Top</a>
</p>

<div style="clear:both;"></div>

<div id="outputFormat">

<p>This is the expected output of the GetClusters function:</p>
<div id="simple_response">
<pre style="height: 500px;">
&lt;?xml version="1.0"?&gt;
&lt;clusterResponse&gt;
   &lt;ClusterCategory ID="xs:string"  Tag="xs:string" &gt;
      &lt;Cluster&gt;
      &lt;/Cluster&gt;
   &lt;/ClusterCategory&gt;
&lt;/clusterResponse&gt;
</pre>
	<p>
	<span class="highlight3">Viewing</span>: Simplified Response | <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Real Response</a>
	</p>
</div>

<div id="real_response" style="display: none;">
<pre style="height: 500px;">
&lt;?xml version="1.0"?&gt;
&lt;clusterResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"&gt;
  &lt;ClusterCategory ID="SubjectThesaurus" Tag="ZE" xmlns="http://epnet.com/webservices/SearchService/Response/2007/07/"&gt;
    &lt;Cluster&gt;HIGH performance liquid chromatography&lt;/Cluster&gt;
    &lt;Cluster&gt;EDUCATIONAL technology&lt;/Cluster&gt;
    &lt;Cluster&gt;HUMAN-computer interaction&lt;/Cluster&gt;
    &lt;Cluster&gt;ANTIOXIDANTS&lt;/Cluster&gt;
    &lt;Cluster&gt;MATERIALS -- Fatigue&lt;/Cluster&gt;
    &lt;Cluster&gt;CASE studies&lt;/Cluster&gt;
    &lt;Cluster&gt;COMPUTER-assisted instruction&lt;/Cluster&gt;
    &lt;Cluster&gt;RHEOLOGY&lt;/Cluster&gt;
    &lt;Cluster&gt;METHANOL&lt;/Cluster&gt;
    &lt;Cluster&gt;MATHEMATICAL models&lt;/Cluster&gt;
  &lt;/ClusterCategory&gt;
  &lt;ClusterCategory ID="Subject" Tag="DE" xmlns="http://epnet.com/webservices/SearchService/Response/2007/07/"&gt;
    &lt;Cluster&gt;STUDY &amp; teaching&lt;/Cluster&gt;
    &lt;Cluster&gt;MECHANICAL properties&lt;/Cluster&gt;
    &lt;Cluster&gt;ROTATING machinery&lt;/Cluster&gt;
    &lt;Cluster&gt;ORGANIC dyes &amp; pigments&lt;/Cluster&gt;
    &lt;Cluster&gt;BUTYLATED hydroxytoluene&lt;/Cluster&gt;
    &lt;Cluster&gt;SOCIAL aspects&lt;/Cluster&gt;
    &lt;Cluster&gt;ECONOMIC conditions&lt;/Cluster&gt;
    &lt;Cluster&gt;MALAWI -- Economic conditions&lt;/Cluster&gt;
    &lt;Cluster&gt;SUPPORT vector machines&lt;/Cluster&gt;
    &lt;Cluster&gt;GALLATES&lt;/Cluster&gt;
  &lt;/ClusterCategory&gt;
&lt;/clusterResponse&gt;
</pre>
	<p>
	<span class="highlight3">Viewing</span>: <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Simplified Response</a> | Real Response
	</p>
</div>

<p>
	Upon success, the first node returned should be the <code>&lt;clusterResponse&gt;</code> node (note: in SOAP, this node
	is contained within the <code>Envelope/Body/GetClustersResponse</code> node).  If there was an error, then the
	first node returned would be the <code>&lt;Fault&gt;</code> node.
</p>
<p>
	If the query was sucessful and returned results, the next node should be the <code>&lt;ClusterCategory&gt;</code> node.  This node
	contains all of the different cluster categories available for this database  It has two attributes: 'ID', which is the text description
	of the cluster category, and 'Tag', which is a search tag that can be used to format a query (See <a href="howto_queries.php">Formatting Queries</a>).  Each <code>&lt;ClusterCategory&gt;</code> node contains
	many <code>&lt;Cluster&gt;</code> nodes.  Each <code>&lt;Cluster&gt;</code> node contains the name of the cluster.
</p>

</div>

<div class="hr"></div>

<a name="c" ></a><h3>REST Sample</h3>

<p class="top" id="restSampleTxt">
	<a href="javascript: hideSect( 'restSample' )">Hide</a> | <a href="#top">Back to Top</a>
</p>

<div style="clear:both;"></div>

<div id="restSample">

<p>
	This is a sample of the Search method using the REST protocol.
</p>

<i>Call:</i>
<br />
<pre>
http://eit.ebscohost.com/Services/SearchService.asmx/GetClusters?
	<span class="highlight">prof</span>=<span class="highlight2">[Your EIT Profile ID]</span>
	&amp;<span class="highlight">pwd</span>=<span class="highlight2">[Your Profile Password]</span>
	&amp;<span class="highlight">query</span>=<span class="highlight2">[Your Search Query]</span>
	&amp;<span class="highlight">db</span>=<span class="highlight2">[Authority Database to Search]</span>
</pre>
<i>Response:</i>
<br />
<pre>
&lt;?xml version="1.0"&gt;
&lt;clusterResponse&gt;
   &lt;ClusterCategory ID="xs:string" Tag="xs:string"&gt;
      &lt;Cluster&gt; 
		&lt;!-- Cluster Name --&gt;
	  &lt;/Cluster&gt; 
   &lt;ClusterCategory&gt;
&lt;/clusterResponse&gt;
</pre>

</div>

<div class="hr"></div>

<a name="e" ></a><h3>SOAP Sample</h3>

<p class="top" id="soapSampleTxt">
	<a href="javascript: hideSect( 'soapSample' )">Hide</a> | <a href="#top">Back to Top</a>
</p>

<div style="clear:both;"></div>

<div id="soapSample">

<p>
	This is a sample of the Search methods output using the SOAP protocol.
</p>

<i>Call:</i>
<br />
<pre>
&lt;soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" soap:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" &gt;
  &lt;soap:Header&gt;
    &lt;eit:AuthorizationHeader soap:mustUnderstand="1" xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;eit:<span class="highlight">Profile</span>&gt;<span class="highlight2">[Your EIT Profile ID]</span>&lt;/eit:Profile&gt;
      &lt;eit:<span class="highlight">Password</span>&gt;<span class="highlight2">[Your  Profile Password]</span>&lt;/eit:Password&gt;
    &lt;/eit:AuthorizationHeader&gt;
  &lt;/soap:Header&gt;
  &lt;soap:Body&gt;
    &lt;eit:GetClusters xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;eit:ClusterSearchRequest&gt;
        &lt;eit:<span class="highlight">Query</span>&gt;<span class="highlight2">[Search Query]</span>&lt;/eit:Query&gt;
        &lt;eit:<span class="highlight">Databases</span>&gt;<span class="highlight2">[Database(s) to Retrieve Clusters]</span>&lt;/eit:Databases&gt;
      &lt;/eit:ClusterSearchRequest&gt;
    &lt;/eit:GetClusters&gt;
  &lt;/soap:Body&gt;
&lt;/soap:Envelope&gt;
				</pre>
				<br /><br />
				<i>Response:</i>
				<br />
				<pre>
&lt;?xml version="1.0" encoding="utf-8"?&gt;
&lt;soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"&gt;
  &lt;soap:Body&gt;
    &lt;GetClustersReponse xmlns="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;clusterResponse&gt;
        &lt;ClusterCategory ID="xs:string" Tag="xs:string"&gt;
          &lt;Cluster&gt; 
	 	    &lt;!-- Cluster Name --&gt;
	      &lt;/Cluster&gt; 
        &lt;ClusterCategory&gt;
      &lt;/clusterResponse&gt;
    &lt;/GetClustersReponse&gt;
  &lt;/soap:Body&gt;
&lt;/soap:Envelope&gt;
</pre>

</div>

<?php 

include( 'includes/footer.php' );

?>