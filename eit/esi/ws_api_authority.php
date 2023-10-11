<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_authority';
include( 'includes/navbar.php' );


?>

<script type="text/javascript" src="js/api.js"></script>

<!---div id="showhide_btn">
	<a href="javascript: hideMenu()" style="font-size: 10px;">&lt;&lt;</a>
</div--->

<a name="top"></a><h2 style="float: left;">AuthoritySearch</h2>
<div style="clear:both;"></div>

<p>
	The <b>AuthoritySearch</b> method is used to perform authority searches on EBSCOhost databases.  
	To test this method with your EIT profile, visit the 
	<a target="_new" href="http://eit.ebscohost.com/Pages/MethodDescription.aspx?service=~/Services/SearchService.asmx&method=AuthoritySearch">
		EBSCOhost Web Service AuthoritySearch method page</a>.
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
API's AuthoritySearch method.  To see more information on either the REST or SOAP protocol with the EIT Web Service,
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
		<th>
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
			<code>Authority_x0020_Database</code>
		</td>
		<td>
			One short authority database name to search.
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
			<code>mode</code>
		</td>
		<td>
			<code>SearchMode</code>
		</td>
		<td>
			The authority search mode.
			<br><br>
			<span class="highlight3">Default: relevancy</span>
		</td>
		<td>
			Yes.
		</td>
		<td class="td_right">
			relevancy, alphabetic, boolean, termcontains
		</td>
	</tr>
	<tr>
		<td>
			<code>startrec</code>
		</td>
		<td>
			<code>StartingRecordNumber</code>
		</td>
		<td>
			Starting record number for the result set returned from a search.
			<br><br>
			<span class="highlight3">Default: 1</span>
		</td>
		<td>
			No
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
			<span class="highlight3">Default: 10</span>
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
	<tr>
		<td>
			<code>sort</code>
		</td>
		<td>
			<code>Sort</code>
		</td>
		<td>
			The sort order for the search results. Note that the different sort options 
			are database specific, please use the Info method for a list of sort options 
			per database.
			<br><br>
			<span class="highlight3">Default: date</span>
		</td>
		<td>
			No
		</td>
		<td class="td_right">
			-
		</td>
	</tr>
	<tr>
		<td>
			<code>format</code>
		</td>
		<td>
			<code>RecordFormat</code>
		</td>
		<td>
			The format of the results' records. 
			<br><br>
			<span class="highlight3">Default: brief</span>
		</td>
		<td>
			No
		</td>
		<td class="td_right">
			brief,
			<br>
			detailed,
			<br>
			full
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

<p>This is the expected output of the AuthoritySearch function:</p>
<div id="simple_response">
<pre style="height: 500px;">
&lt;AuthoritySearchResponse&gt;
   &lt;Statistics&gt;
      &lt;!-- N-number of Statistic elements, one per database used during the search --&gt;
      &lt;Statistic&gt;
         &lt;Database&gt;
            &lt;!-- Database Short Name --&gt;
         &lt;/Database&gt;
         &lt;Hits&gt;
            &lt;!-- Number of hits found for the query within the database --&gt;
         &lt;/Hits&gt;
      &lt;/Statistic&gt;
   &lt;/Statistics&gt;
   &lt;SearchResults&gt;
      &lt;records&gt;
      &lt;!—N-number of rec element, one per record returned from the search --&gt;
         &lt;rec recordID="xs:int"&gt;
         &lt;!-- The exact structure will depend on a number of factors including the format used and authority searched --&gt;
         &lt;!-- Below is a list of more commonly used data items --&gt;
            &lt;browseTerm&gt; &lt;!-- Browse Term --&gt; &lt;/browseTerm&gt;
            &lt;searchTag&gt; &lt;!-- Search Tag --&gt; &lt;/searchTag&gt;
            &lt;searchTerm&gt; &lt;!—- Search Term --&gt; &lt;/searchTerm&gt;
            &lt;useTerm&gt; &lt;!—- Use Term --&gt; &lt;/useTerm&gt;
            &lt;isExplodable&gt; &lt;!—- Term can be exploded (Y/N) --&gt; &lt;/isExplodable&gt;
         &lt;/rec&gt;
      &lt;/records&gt;
   &lt;/SearchResults&gt;
&lt;/AuthoritySearchResponse&gt;
</pre>
	<p>
	<span class="highlight3">Viewing</span>: Simplified Response | <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Real Response</a>
	</p>
</div>

<div id="real_response" style="display: none;">
<pre style="height: 500px;">
&lt;?xml version="1.0"?&gt;
&lt;AuthoritySearchResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"&gt;
  &lt;Statistics xmlns="http://epnet.com/webservices/SearchService/Response/2007/07/"&gt;
    &lt;Statistic&gt;
      &lt;Database&gt;a9hjnh&lt;/Database&gt;
      &lt;Hits&gt;4&lt;/Hits&gt;
    &lt;/Statistic&gt;
  &lt;/Statistics&gt;
  &lt;SearchResults xmlns="http://epnet.com/webservices/SearchService/Response/2007/07/"&gt;
    &lt;records xmlns=""&gt;
      &lt;rec resultID="1"&gt;
        &lt;name&gt;Bloomberg Businessweek&lt;/name&gt;
        &lt;issn&gt;0007-7135&lt;/issn&gt;
        &lt;isbn&gt;
        &lt;/isbn&gt;
      &lt;/rec&gt;
      &lt;rec resultID="2"&gt;
        &lt;name&gt;BusinessWeek&lt;/name&gt;
        &lt;issn&gt;0007-7135&lt;/issn&gt;
        &lt;isbn&gt;
        &lt;/isbn&gt;
      &lt;/rec&gt;
    &lt;/records&gt;
  &lt;/SearchResults&gt;
&lt;/AuthoritySearchResponse&gt;
</pre>
	<p>
	<span class="highlight3">Viewing</span>: <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Simplified Response</a> | Real Response
	</p>
</div>

<p>
	Upon success, the first node returned should be the <code>&lt;AuthoritySearchResponse&gt;</code> node (note: in SOAP, this node
	is contained within the <code>Envelope/Body/AuthoritySearchResponse</code> node).  If there was an error, then the
	first node returned would be the <code>&lt;Fault&gt;</code> node.
</p>
<p>
	The <code>&lt;Statistics&gt;</code> node contains the number of records returned from the authority database searched.  It will
	contain one <code>&lt;Statistic&gt;</code> node containing the information.
</p>
<p>
	If the query was sucessful and returned results, the next node should be the <code>&lt;SearchResults&gt;</code> node.  This node
	contains all of the individual search results.  Each record is returned in a <code>&lt;rec&gt;</code> node, within the <code>&lt;records&gt;</code>
	node.  An AuthoritySearch query will return X number of <code>&lt;rec&gt;</code> nodes, where X is the number of search results returned.
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
http://eit.ebscohost.com/Services/SearchService.asmx/Search?
	<span class="highlight">prof</span>=<span class="highlight2">[Your EIT Profile ID]</span>
	&amp;<span class="highlight">pwd</span>=<span class="highlight2">[Your Profile Password]</span>
	&amp;<span class="highlight">query</span>=<span class="highlight2">[Your Search Query]</span>
	&amp;<span class="highlight">db</span>=<span class="highlight2">[Authority Database to Search]</span>
</pre>
<i>Response:</i>
<br />
<pre>
&lt;?xml version="1.0"&gt;
&lt;AuthoritySearchResponse&gt;
   &lt;Statistics&gt;
      &lt;!-- N-number of Statistic elements, one per database used during the search --&gt;
      &lt;Statistic&gt;
         &lt;Database&gt;
            &lt;!-- Database Short Name --&gt;
         &lt;/Database&gt;
         &lt;Hits&gt;
            &lt;!-- Number of hits found for the query within the database --&gt;
         &lt;/Hits&gt;
      &lt;/Statistic&gt;
   &lt;/Statistics&gt;
   &lt;SearchResults&gt;
      &lt;records&gt;
      &lt;!—N-number of rec element, one per record returned from the search --&gt;
         &lt;rec recordID="xs:int"&gt;
         &lt;!-- The exact structure will depend on a number of factors including the format used and authority searched --&gt;
         &lt;!-- Below is a list of more commonly used data items --&gt;
            &lt;browseTerm&gt; &lt;!-- Browse Term --&gt; &lt;/browseTerm&gt;
            &lt;searchTag&gt; &lt;!-- Search Tag --&gt; &lt;/searchTag&gt;
            &lt;searchTerm&gt; &lt;!—- Search Term --&gt; &lt;/searchTerm&gt;
            &lt;useTerm&gt; &lt;!—- Use Term --&gt; &lt;/useTerm&gt;
            &lt;isExplodable&gt; &lt;!—- Term can be exploded (Y/N) --&gt; &lt;/isExplodable&gt;
         &lt;/rec&gt;
      &lt;/records&gt;
   &lt;/SearchResults&gt;
&lt;/AuthoritySearchResponse&gt;
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
    &lt;eit:AuthoritySearch xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;eit:AuthoritySearchRequest&gt;
        &lt;eit:<span class="highlight">Query</span>&gt;<span class="highlight2">[Search Query]</span>&lt;/eit:Query&gt;
        &lt;eit:<span class="highlight">Authority_x0020_Database</span>&gt;<span class="highlight2">[Authority Database to Search]</span>&lt;/eit:Databases&gt;
      &lt;/eit:AuthoritySearchRequest&gt;
    &lt;/eit:AuthoritySearch&gt;
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
    &lt;AuthoritySearchResponse xmlns="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;AuthoritySearchResponse&gt;
        &lt;Statistics&gt;
          &lt;!-- N-number of Statistic elements, one per database used during the search --&gt;
          &lt;Statistic&gt;
            &lt;Database&gt;
              &lt;!-- Database Short Name --&gt;
            &lt;/Database&gt;
            &lt;Hits&gt;
              &lt;!-- Number of hits found for the query within the database --&gt;
            &lt;/Hits&gt;
          &lt;/Statistic&gt;
        &lt;/Statistics&gt;
        &lt;SearchResults&gt;
          &lt;records&gt;
            &lt;!—N-number of rec element, one per record returned from the search --&gt;
            &lt;rec recordID="xs:int"&gt;
              &lt;!-- The exact structure will depend on a number of factors including the format used and authority searched --&gt;
              &lt;!-- Below is a list of more commonly used data items --&gt;
              &lt;browseTerm&gt; &lt;!-- Browse Term --&gt; &lt;/browseTerm&gt;
              &lt;searchTag&gt; &lt;!-- Search Tag --&gt; &lt;/searchTag&gt;
              &lt;searchTerm&gt; &lt;!—- Search Term --&gt; &lt;/searchTerm&gt;
              &lt;useTerm&gt; &lt;!—- Use Term --&gt; &lt;/useTerm&gt;
              &lt;isExplodable&gt; &lt;!—- Term can be exploded (Y/N) --&gt; &lt;/isExplodable&gt;
            &lt;/rec&gt;
          &lt;/records&gt;
        &lt;/SearchResults&gt;
      &lt;/AuthoritySearchResponse&gt;
    &lt;/AuthoritySearchResponse&gt;
  &lt;/soap:Body&gt;
&lt;/soap:Envelope&gt;
</pre>

</div>

<?php 

include( 'includes/footer.php' );

?>