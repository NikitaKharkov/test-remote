<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_search';
$subpage = 'standard';
include( 'includes/navbar.php' );


?>

<script type="text/javascript" src="js/api.js"></script>

<!---div id="showhide_btn">
	<a href="javascript: hideMenu()" style="font-size: 10px;">&lt;&lt;</a>
</div--->

<a name="top"></a><h2 style="float: left;">Search</h2>
<div style="float: left; margin-top: 22px; font-size: 16px; margin-left: 15px;">
	(<strong>Standard</strong>, <a href="ws_api_search_eds.php">EDS</a>, <a href="ws_api_search_ehis.php">EHIS</a>)
</div>

<div style="clear:both;"></div>

<p>
	The <b>Search</b> method is used to perform searches on the EBSCOhost databases. 
	Abstracts as well as the full text for documents and articles can 
	be retrieved using this method. When available, full text articles can also 
	be downloaded in pdf format.  
	<p>
	To test this method with your EIT profile, visit the 
	<a target="_new" href="http://eit.ebscohost.com/Pages/MethodDescription.aspx?service=~/Services/SearchService.asmx&method=Search">EBSCOhost Web Service Search method page</a>.
</p>
<ul>
	<li><a href="#b">Input Parameters</a></li>
	<li><a href="#f">Output Format</a></li>
	<li><a href="#c" onclick="showSect( 'restSample' )">REST Sample</a></li>
	<li><a href="#e" onclick="showSect( 'soapSample' )">SOAP Sample</a></li>
</ul>

<p class="highlight3">
	Note: This method takes different parameters
	when using a Discovery Service profile.  
	<a href="ws_api_search_eds.php">Click here</a> for the EDS Search method.
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
API's Search method.  To see more information on either the REST or SOAP protocol with the EIT Web Service,
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
			Keywords and phrases.
			<br><br>
			<a href="http://support.epnet.com/knowledge_base/detail.php?id=3198" target="_blank">Click here for information on using field codes when searching multiple databases.</a>
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
			One or more short database names to search.  Values separated by commas.  
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
			1 or greater
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
			1-200
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
	<tr>
		<td>
			<code>subset</code>
		</td>
		<td>
			<code>RecordsDataSubSet</code>
		</td>
		<td>
			Returns a subset of the records' data.
		</td>
		<td>
			No
		</td>
		<td class="td_right">
			subjects,
			<br>
			authors,
			<br>
			titles
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
&lt;searchResponse&gt;
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
      &lt;!-N-number of rec element, one per record returned from the search --&gt;
         &lt;rec recordID="xs:int"&gt;
         &lt;!-- The exact structure will depend on a number of factors including the format used and database(s) searched --&gt;
         &lt;!-- Below is a list of more commonly used data items --&gt;
            &lt;pdfLink&gt; &lt;!-- link to the full text pdf document --&gt; &lt;/pdfLink&gt;
            &lt;pubinfo&gt; &lt;!-- publication information --&gt; &lt;/pubinfo&gt;
            &lt;aug&gt; &lt;!-- authors --&gt; &lt;/aug&gt;
            &lt;su&gt; &lt;!-- subjects --&gt; &lt;/su&gt;
            &lt;ab&gt; &lt;!-- abstract --&gt; &lt;/ab&gt;
            &lt;atl&gt; &lt;!-- title --&gt; &lt;/atl&gt;
            &lt;abody&gt; &lt;!-- the full text --&gt; &lt;/abody&gt;
         &lt;/rec&gt;
      &lt;/records&gt;
   &lt;/SearchResults&gt;
&lt;/searchResponse&gt;
</pre>
	<p>
	<span class="highlight3">Viewing</span>: Simplified Response | <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Real Response</a>
	</p>
</div>

<div id="real_response" style="display: none;">
<pre style="height: 500px;">
&lt;?xml version="1.0"?&gt;
&lt;searchResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"&gt;
  &lt;Statistics xmlns="http://epnet.com/webservices/SearchService/Response/2007/07/"&gt;
    &lt;Statistic&gt;
      &lt;Database&gt;a9h&lt;/Database&gt;
      &lt;Hits&gt;4808&lt;/Hits&gt;
    &lt;/Statistic&gt;
  &lt;/Statistics&gt;
  &lt;SearchResults xmlns="http://epnet.com/webservices/SearchService/Response/2007/07/"&gt;
    &lt;records xmlns=""&gt;
      &lt;rec recordID="1"&gt;
        &lt;pdfLink /&gt;
        &lt;plink&gt;http://search.ebscohost.com/login.aspx?direct=true&amp;db=a9h&amp;AN=51921403&amp;site=ehost-live&lt;/plink&gt;
        &lt;header shortDbName="a9h" uiTerm="51921403" longDbName="Academic Search Complete" uiTag="AN"&gt;
          &lt;controlInfo&gt;
            &lt;bkinfo /&gt;
            &lt;jinfo&gt;
              &lt;jid type="issn"&gt;01419331&lt;/jid&gt;
              &lt;jid type="mid"&gt;3Q5&lt;/jid&gt;
              &lt;jtl&gt;Microprocessors &amp; Microsystems&lt;/jtl&gt;
              &lt;issn&gt;01419331&lt;/issn&gt;
              &lt;maglogo&gt;N&lt;/maglogo&gt;
            &lt;/jinfo&gt;
            &lt;pubinfo&gt;
              &lt;dt year="2010" month="10" day="01"&gt;Oct2010&lt;/dt&gt;
              &lt;vid&gt;34&lt;/vid&gt;
              &lt;iid&gt;6&lt;/iid&gt;
            &lt;/pubinfo&gt;
            &lt;artinfo&gt;
              &lt;ui&gt;51921403&lt;/ui&gt;
              &lt;ui type="doi"&gt;10.1016/j.micpro.2010.04.005&lt;/ui&gt;
              &lt;ppf&gt;215&lt;/ppf&gt;
              &lt;ppct&gt;13&lt;/ppct&gt;
              &lt;formats&gt;
                &lt;fmt /&gt;
              &lt;/formats&gt;
              &lt;tig&gt;
                &lt;atl&gt;Branch target buffer design for embedded processors.&lt;/atl&gt;
              &lt;/tig&gt;
              &lt;aug&gt;
                &lt;au&gt;Levison, Nadav&lt;/au&gt;
                &lt;au&gt;Weiss, Shlomo&lt;/au&gt;
              &lt;/aug&gt;
              &lt;su&gt;EMBEDDED computer systems&lt;/su&gt;
              &lt;su&gt;MICROPROCESSORS&lt;/su&gt;
              &lt;su&gt;ENERGY consumption&lt;/su&gt;
              &lt;su&gt;PREDICTION models&lt;/su&gt;
              &lt;su&gt;ENERGY conservation&lt;/su&gt;
              &lt;sug&gt;
                &lt;subj type="thes"&gt;EMBEDDED computer systems&lt;/subj&gt;
                &lt;subj type="thes"&gt;MICROPROCESSORS&lt;/subj&gt;
                &lt;subj type="thes"&gt;ENERGY consumption&lt;/subj&gt;
                &lt;subj type="thes"&gt;PREDICTION models&lt;/subj&gt;
                &lt;subj type="thes"&gt;ENERGY conservation&lt;/subj&gt;
              &lt;/sug&gt;
              &lt;ab&gt;Abstract: The demand for embedded application processors that support multi-tasking operating system and can execute complex applications bring them closer to general purpose processors. These strong processors...&lt;/ab&gt;
              &lt;pubtype&gt;Academic Journal&lt;/pubtype&gt;
              &lt;doctype&gt;Article&lt;/doctype&gt;
              &lt;src&gt;R&lt;/src&gt;
            &lt;/artinfo&gt;
            &lt;language code="en"&gt;English&lt;/language&gt;
            &lt;refInfo /&gt;
            &lt;copyright flag="Y"&gt;
              &lt;dt year="" /&gt;
            &lt;/copyright&gt;
            &lt;holdings islocal="N" /&gt;
          &lt;/controlInfo&gt;
        &lt;/header&gt;
      &lt;/rec&gt;
    &lt;/records&gt;
  &lt;/SearchResults&gt;
&lt;/searchResponse&gt;
</pre>
	<p>
	<span class="highlight3">Viewing</span>: <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Simplified Response</a> | Real Response
	</p>
</div>

<p>
	Upon success, the first node returned should be the <code>&lt;searchResponse&gt;</code> node (note: in SOAP, this node
	is contained within the <code>Envelope/Body/SearchResponse</code> node).  If there was an error, then the
	first node returned would be the <code>&lt;Fault&gt;</code> node.
</p>
<p>
	The <code>&lt;Statistics&gt;</code> node contains the number of records returned from the database(s) searched.  It will
	contain N <code>&lt;Statistic&gt;</code> nodes, where N is the number of databases searched.
</p>
<p>
	If the query was sucessful and returned results, the next node should be the <code>&lt;SearchResults&gt;</code> node.  This node
	contains all of the individual search results.  Each record is returned in a <code>&lt;rec&gt;</code> node, within the <code>&lt;records&gt;</code>
	node.  A search query will return X number of <code>&lt;rec&gt;</code> nodes, where X is the number of search results returned.
</p>
<p>
	The <code>&lt;rec&gt;</code> nodes of the SearchResponse house the actual data retrieved. In formatting this data, 
	we have a few objectives in mind:
</p>
<ol>
	<li>
		Identify certain "control" fields that may be of use in providing extended 
		functionality (e.g. linking to library holdings via ISSN, etc.)
	</li>
	<li>
		Provide an ability to choose between "generic" representation of data in 
		form of XML that will allow the XSL designer to exhibit more control on the
		format or content.
	</li>
</ol>
<p>
	The rec element consists of two elements: <code>&lt;header&gt;</code> and <code>&lt;abody&gt;</code>. The <code>&lt;header&gt;</code> contains information
	about an article such as article's author, title, journal where it was published, available
	formats for full text, etc. In the Fulltext format the rec element can also contain <code>&lt;abody&gt;</code> element
	that contains text of the article.
</p>
<p>
	The <code>&lt;ControlInfo&gt;</code> section contains meta-data related information.  It provides ISSN and Date information,
	language tags, and copyright information.  This can be useful for checking local availability of
	books, formatting copyright information, or determining the language of the article.
</p>

<p>
	The exact structure of the XML returned from the web service will depend on the format used (i.e. Brief, Detailed, Full) 
	and which databases are searched.   <!---&nbsp;For a complete comprehensive overview of all fields that could be returned, refer 
	to the <a href="epdirect.txt" target="blank">epdirect.dtd</a>. &nbsp; Each field will be denoted by the <code>&lt;!ELEMENT&gt;</code> item.--->
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
	&amp;<span class="highlight">db</span>=<span class="highlight2">[Database to Search]</span>
</pre>
<i>Response:</i>
<br />
<pre>
&lt;?xml version="1.0"&gt;
&lt;searchResponse&gt;
   &lt;Statistics&gt;
      &lt;Statistic&gt;
         &lt;Database&gt;
         &lt;/Database&gt;
         &lt;Hits&gt;
         &lt;/Hits&gt;
      &lt;/Statistic&gt;
   &lt;/Statistics&gt;
   &lt;SearchResults&gt;
      &lt;records&gt;
         &lt;rec recordID="xs:int"&gt;
            &lt;pdfLink&gt;&lt;/pdfLink&gt;
            &lt;pubinfo&gt;&lt;/pubinfo&gt;
            &lt;aug&gt;&lt;/aug&gt;
            &lt;su&gt;&lt;/su&gt;
            &lt;ab&gt;&lt;/ab&gt;
            &lt;atl&gt;&lt;/atl&gt;
            &lt;abody&gt;&lt;/abody&gt;
         &lt;/rec&gt;
      &lt;/records&gt;
   &lt;/SearchResults&gt;
&lt;/searchResponse&gt;
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
    &lt;eit:Search xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;eit:searchRequest&gt;
        &lt;eit:<span class="highlight">Query</span>&gt;<span class="highlight2">[Search Query]</span>&lt;/eit:Query&gt;
        &lt;eit:<span class="highlight">Databases</span>&gt;<span class="highlight2">[Database to Search]</span>&lt;/eit:Databases&gt;
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
    &lt;SearchResponse xmlns="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;searchResponse&gt;
        &lt;Statistics&gt;
          &lt;Statistic&gt;
            &lt;Database&gt;
            &lt;/Database&gt;
            &lt;Hits&gt;
            &lt;/Hits&gt;
          &lt;/Statistic&gt;
        &lt;/Statistics&gt;
        &lt;SearchResults&gt;
          &lt;records&gt;
            &lt;rec recordID="xs:int"&gt;
              &lt;pdfLink&gt;&lt;/pdfLink&gt;
              &lt;pubinfo&gt;&lt;/pubinfo&gt;
              &lt;aug&gt;&lt;/aug&gt;
              &lt;su&gt;&lt;/su&gt;
              &lt;ab&gt;&lt;/ab&gt;
              &lt;atl&gt;&lt;/atl&gt;
              &lt;abody&gt;&lt;/abody&gt;
            &lt;/rec&gt;
          &lt;/records&gt;
        &lt;/SearchResults&gt;
      &lt;/searchResponse&gt;
    &lt;/SearchResponse&gt;
  &lt;/soap:Body&gt;
&lt;/soap:Envelope&gt;
</pre>
</div>
<?php 

include( 'includes/footer.php' );

?>