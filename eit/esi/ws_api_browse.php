<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_browse';
include( 'includes/navbar.php' );


?>

<script type="text/javascript" src="js/api.js"></script>

<!---div id="showhide_btn">
	<a href="javascript: hideMenu()">&lt;&lt;</a>
</div--->

<a name="top"></a><h2>Browse</h2>
<div style="clear:both;"></div>

<p>
	The <b>Browse</b> method is used to view indexes such as Authors or Subject 
	Terms on an EBSCOhost database. Note that the index availability can be different 
	per database.  To test this method with your EIT profile, visit the 
	<a target="_new" href="http://eit.ebscohost.com/Pages/MethodDescription.aspx?service=~/Services/SearchService.asmx&method=Browse">
		EBSCOhost Web Service Browse method page</a>.
</p>

<ul>
	<li><a href="#b">Input Parameters</a></li>
	<li><a href="#f">Output Format</a></li>
	<li><a href="#c">REST Sample</a></li>
	<li><a href="#e">SOAP Sample</a></li>
</ul>

<p class="highlight3">
	Note: This method is not supported when using a Discovery Service profile.  
	<a href="ws.php#eds">Click here</a> for more information.
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
API's Browse method.  To see more information on either the REST or SOAP protocol with the EIT Web Service,
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
			<code>term</code>
		</td>
		<td>
			<code>Term</code>
		</td>
		<td>
			Term(s) to browse.
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
			One short database name to browse.
			<br><br>
			<a href="http://support.epnet.com/knowledge_base/detail.php?id=3783" target="_blank">Click here for a list of databases supported by EIT.</a>
		</td>
		<td>
			Yes.
		</td>
		<td class="td_right">
			-
		</td>
	</tr>
	<tr>
		<td>
			<code>index</code>
		</td>
		<td>
			<code>Index</code>
		</td>
		<td>
			The index used for the browse. Note that the different indexes are available 
			per database, please use the Info method for a list of indexes per database.
			<br><br>
		</td>
		<td>
			Yes
		</td>
		<td class="td_right">
			&gt; 0
		</td>
	</tr>
	<tr>
		<td>
			<code>numrec</code>
		</td>
		<td>
			<code>NumberRecordsReturned</code>
		</td>
		<td>
			Number of records returned from a search (if available). Note that the 
			maximum number of records returned is 50 when a 'full' record format 
			is specified.
			<br><br>
			<span class="highlight3">Default: 20</span>
		</td>
		<td>
			No
		</td>
		<td class="td_right">
			&gt; 0, 
			<br>
			&lt; 200
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

<p>This is the expected output of the Search function:</p>
<div id="simple_response">
	<pre style="height: 500px;">
&lt;browseResponse&gt;
  &lt;response&gt;
    &lt;records&gt;
      &lt;!-- N - number of rec elements --&gt;
      &lt;rec resultID="xs:int"&gt;
        &lt;header&gt;
          &lt;browseTerms searchKey="xs:string" count="xs:int"&gt;
            &lt;browseTerm&gt;
              &lt;!-- Browse Term --&gt;
            &lt;/browseTerm&gt;
          &lt;/browseTerms&gt;
        &lt;/header&gt;
      &lt;/rec&gt;
    &lt;/records&gt;
  &lt;/response&gt;
&lt;/browseResponse&gt;
	</pre>
	<p>
	<span class="highlight3">Viewing</span>: Simplified Response | <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Real Response</a>
	</p>
</div>

<div id="real_response" style="display: none;">
	<pre style="height: 500px;">
&lt;?xml version="1.0"?&gt;
&lt;browseResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"&gt;
  &lt;response xmlns="http://epnet.com/webservices/SearchService/Response/2007/07/"&gt;
    &lt;records xmlns=""&gt;
      &lt;rec resultID="1"&gt;
        &lt;header&gt;
          &lt;browseTerms searchKey="john" count="63"&gt;
            &lt;browseTerm&gt;john&lt;/browseTerm&gt;
          &lt;/browseTerms&gt;
        &lt;/header&gt;
      &lt;/rec&gt;
      &lt;rec resultID="2"&gt;
        &lt;header&gt;
          &lt;browseTerms searchKey="john #beilby" count="1"&gt;
            &lt;browseTerm&gt;john #beilby&lt;/browseTerm&gt;
          &lt;/browseTerms&gt;
        &lt;/header&gt;
      &lt;/rec&gt;
      &lt;rec resultID="3"&gt;
        &lt;header&gt;
          &lt;browseTerms searchKey="john #milne" count="1"&gt;
            &lt;browseTerm&gt;john #milne&lt;/browseTerm&gt;
          &lt;/browseTerms&gt;
        &lt;/header&gt;
      &lt;/rec&gt;
    &lt;/records&gt;
  &lt;/response&gt;
&lt;/browseResponse&gt;
	</pre>
	<p>
	<span class="highlight3">Viewing</span>: <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Simplified Response</a> | Real Response
	</p>
</div>

<p>
	Upon success, the first node returned should be the <code>&lt;browseResponse&gt;</code> node (note: in SOAP, this node
	is contained within the <code>Envelope/Body/BrowseResponse</code> node).  If there was an error, then the
	first node returned would be the <code>&lt;Fault&gt;</code> node.
</p>
<p>
	There will be N <code>&lt;rec&gt;</code> nodes, one per browse record returned.  All of the record
	nodes are within the <code>&lt;response&gt;/&lt;records&gt;</code> node.
	
	The information about each record is contained in the <code>&lt;header&gt;</code> node within each
	<code>&lt;rec&gt;</code> node.
	
	The <code>&lt;browseTerms&gt;</code> node format is as follows:
</p>
<p class="indent">
	<code>
	&lt;browseTerms searchKey="xs:string" count="xs:int"&gt;<br>
	&nbsp;&nbsp;&lt;browseTerm&gt; &lt;!-- Browse Term --&gt; &lt;/browseTerm&gt;<br>
	&lt;/browseTerms&gt;
	</code>
</p>
<p>
	The <code>searchKey</code> is the term returned, and <code>count</code> is the number of
	results for that term.  The <code>&lt;browseTerm&gt;</code> node contains the name of
	the term.
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
http://eit.ebscohost.com/Services/SearchService.asmx/Browse?
	<span class="highlight">prof</span>=<span class="highlight2">[Your EIT Profile ID]</span>
	&amp;<span class="highlight">pwd</span>=<span class="highlight2">[Your Profile Password]</span>
	&amp;<span class="highlight">term</span>=<span class="highlight2">[Term to Browse]</span>
	&amp;<span class="highlight">index</span>=<span class="highlight2">[Index to Browse]</span>
	&amp;<span class="highlight">db</span>=<span class="highlight2">[Database to Browse]</span>
</pre>
<i>Response:</i>
<br />
<pre>
&lt;browseResponse&gt;
  &lt;response&gt;
    &lt;records&gt;
      &lt;rec resultID="xs:int"&gt;
        &lt;header&gt;
          &lt;browseTerms searchKey="xs:string" count="xs:int"&gt;
            &lt;browseTerm&gt; &lt;/browseTerm&gt;
          &lt;/browseTerms&gt;
        &lt;/header&gt;
      &lt;/rec&gt;
    &lt;/records&gt;
  &lt;/response&gt;
&lt;/browseResponse&gt;
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
      &lt;eit:<span class="highlight">Password</span>&gt;<span class="highlight2">[Your Profile Password]</span>&lt;/eit:Password&gt;
    &lt;/eit:AuthorizationHeader&gt;
  &lt;/soap:Header&gt;
  &lt;soap:Body&gt;
    &lt;eit:Search xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;eit:searchRequest&gt;
        &lt;eit:<span class="highlight">Term</span>&gt;<span class="highlight2">[Term to Browse for]</span>&lt;/eit:Query&gt;
        &lt;eit:<span class="highlight">Index</span>&gt;<span class="highlight2">[Index to Browse]</span>&lt;/eit:Query&gt;
        &lt;eit:<span class="highlight">Databases</span>&gt;<span class="highlight2">[Database to Browse]</span>&lt;/eit:Databases&gt;
      &lt;/eit:searchRequest&gt;
    &lt;/eit:Search&gt;
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
    &lt;BrowseResponse xmlns="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;browseResponse&gt;
        &lt;response&gt;
          &lt;records&gt;
            &lt;rec resultID="xs:int"&gt;
              &lt;header&gt;
                &lt;browseTerms searchKey="xs:string" count="xs:int"&gt;
                  &lt;browseTerm&gt; &lt;/browseTerm&gt;
                &lt;/browseTerms&gt;
              &lt;/header&gt;
            &lt;/rec&gt;
          &lt;/records&gt;
        &lt;/response&gt;
      &lt;/browseResponse&gt;
    &lt;/BrowseResponse&gt;
  &lt;/soap:Body&gt;
&lt;/soap:Envelope&gt;
</pre>

</div>

<?php 

include( 'includes/footer.php' );

?>