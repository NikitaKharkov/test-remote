<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'web_service';
$page = 'ws_info';
include( 'includes/navbar.php' );


?>

<script type="text/javascript" src="js/api.js"></script>

<!---div id="showhide_btn">
	<a href="javascript: hideMenu()" style="font-size: 10px;">&lt;&lt;</a>
</div--->

<a name="top"></a><h2>Info</h2>
<div style="clear:both;"></div>

<p>
	The <b>Info</b> method allows the customer to receive a list of databases available to 
	the given profile as well as the attributes of those databases such as the sort 
	fields and indexes allowed by each database.  
	<p>
	To test this method with your EIT profile, visit the 
	<a target="_new" href="http://eit.ebscohost.com/Pages/MethodDescription.aspx?service=~/Services/SearchService.asmx&amp;method=Info">EBSCOhost Web Service Info method page</a>.
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



<a name="b"></a><h3 style="float: left;">Input Parameters</h3>

<p class="top" id="parametersTxt">
	<a href="javascript: hideSect( 'parameters' )">Hide</a> | <a href="#top">Back to Top</a>
</p>

<div style="clear:both;"></div>

<div id="parameters">

<p>
These are the input parameters for both the REST and SOAP protocols of the EIT Web Service
API's Info method.  To see more information on either the REST or SOAP protocol with the EIT Web Service,
see:
</p>
<ul>
	<li><a href="ws_rest.php">Making REST Requests</a></li>
	<li><a href="ws_soap.php">Making SOAP Requests</a></li>
</ul>
<p>
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
</table>

</div>

<div class="hr"></div>

<a name="f" ></a><h3>Output Format</h3>

<p class="top" id="outputFormatTxt">
	<a href="javascript: hideSect( 'outputFormat' )">Hide</a> | <a href="#top">Back to Top</a>
</p>

<div style="clear:both;"></div>
<div id="outputFormat">
<div id="simple_response">
<p>This is the expected output of the Info function:</p>
<pre style="height: 500px;">
&lt;info shortName="xs:string"  longName="xs:string"  dbType="xs:string"  contentType="xs:string" outsideSource="xs:string" &gt;
  &lt;dbInfo&gt;
    &lt;!-- N number of db elements, one per database available to profile --&gt;
    &lt;db shortName="xs:string" longName="xs:string" &gt;
      &lt;sortOptions&gt;
        &lt;sort name="xs:string"  id="xs:string" &gt;
        &lt;/sort&gt;
      &lt;/sortOptions&gt;
      &lt;dbTags&gt;
        &lt;dbTag name="xs:string"  description="xs:string" &gt;
        &lt;/dbTag&gt;
      &lt;/dbTags&gt;
      &lt;dbIndices&gt;
        &lt;dbIndex name="xs:string"  description="xs:string" &gt;
        &lt;/dbIndex&gt;
      &lt;/dbIndices&gt;
      &lt;dbFormats&gt;
        &lt;dbFormat name="xs:string"  description="xs:string" &gt;
        &lt;/dbFormat&gt;
      &lt;/dbFormats&gt;
      &lt;authorityInfo&gt;
        &lt;!-- N number of db elements, one per authority database available to current database. --&gt;
        &lt;db&gt;
          &lt;!-- Each db element may also contain sortOptions, dbTags, dbIndices, or dbFormats --&gt;
        &lt;/db&gt;
      &lt;/authorityInfo&gt;
    &lt;/db&gt;
  &lt;/dbInfo&gt;
&lt;/info&gt;
</pre>
	<p>
	<span class="highlight3">Viewing</span>: Simplified Response | <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Real Response</a>
	</p>
</div>

<div id="real_response" style="display: none;">
<p>This is the expected output of the Info function:</p>
<pre style="height: 500px">
&lt;?xml version="1.0"?&gt;
&lt;info xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"&gt;
  &lt;dbInfo xmlns="http://epnet.com/webservices/SearchService/Response/2007/07/"&gt;
    &lt;db shortName="a9h" longName="Academic Search Complete" dbType="Regular" contentType="Not Specified" outsideSource="false"&gt;
      &lt;sortOptions&gt;
        &lt;sort name="Date Descending" id="date" /&gt;
        &lt;sort name="Date Ascending" id="date2" /&gt;
        &lt;sort name="Author" id="author" /&gt;
        &lt;sort name="Source" id="source" /&gt;
        &lt;sort name="Relevance" id="relevance" /&gt;
      &lt;/sortOptions&gt;
      &lt;dbTags&gt;
        &lt;dbTag name="TX" description="All Text" /&gt;
        &lt;dbTag name="AU" description="Author" /&gt;
        &lt;dbTag name="TI" description="Title" /&gt;
        &lt;dbTag name="SU" description="Subject Terms" /&gt;
        &lt;dbTag name="AB" description="Abstract or Author-Supplied Abstract" /&gt;
        &lt;dbTag name="KW" description="Author-Supplied Keywords" /&gt;
        &lt;dbTag name="GE" description="Geographic Terms" /&gt;
        &lt;dbTag name="PE" description="People" /&gt;
        &lt;dbTag name="PS" description="Reviews &amp; Products" /&gt;
        &lt;dbTag name="CO" description="Company Entity" /&gt;
        &lt;dbTag name="IC" description="NAICS Code or Description" /&gt;
        &lt;dbTag name="DN" description="DUNS Number" /&gt;
        &lt;dbTag name="TK" description="Ticker Symbol" /&gt;
        &lt;dbTag name="SO" description="Journal Name" /&gt;
        &lt;dbTag name="IS" description="ISSN (No Dashes)" /&gt;
        &lt;dbTag name="IB" description="ISBN" /&gt;
        &lt;dbTag name="AN" description="Accession Number" /&gt;
      &lt;/dbTags&gt;
      &lt;dbIndices&gt;
        &lt;dbIndex name="ZA" description="Author" /&gt;
        &lt;dbIndex name="ZW" description="Author-Supplied Keywords" /&gt;
        &lt;dbIndex name="ZO" description="Company Entity" /&gt;
        &lt;dbIndex name="ZT" description="Document Type" /&gt;
        &lt;dbIndex name="ZZ" description="DUNS Number" /&gt;
        &lt;dbIndex name="ZD" description="Entry Date" /&gt;
        &lt;dbIndex name="ZG" description="Geographic Terms" /&gt;
        &lt;dbIndex name="ZU" description="Headings" /&gt;
        &lt;dbIndex name="ZH" description="ISBN" /&gt;
        &lt;dbIndex name="ZI" description="ISSN" /&gt;
        &lt;dbIndex name="ZJ" description="Journal Name" /&gt;
        &lt;dbIndex name="ZL" description="Language" /&gt;
        &lt;dbIndex name="ZC" description="NAICS Code or Description" /&gt;
        &lt;dbIndex name="ZP" description="People" /&gt;
        &lt;dbIndex name="ZS" description="Reviews &amp; Products" /&gt;
        &lt;dbIndex name="ZE" description="Subject Terms" /&gt;
        &lt;dbIndex name="ZN" description="Ticker Symbol" /&gt;
        &lt;dbIndex name="ZR" description="Year of Publication" /&gt;
      &lt;/dbIndices&gt;
      &lt;authorityInfo&gt;
        &lt;db xsi:type="DatabaseWithAuth" shortName="a9hjnh" longName="Academic Search Complete -- Publications" dbType="Hierarchical Authority" contentType="Hierarchical Journal" outsideSource="false" &gt;
          &lt;sortOptions /&gt;
          &lt;dbTags&gt;
            &lt;dbTag name="SU" description="By Title Subject &amp; Description" /&gt;
            &lt;dbTag name="OC" description="Country of Origin" /&gt;
          &lt;/dbTags&gt;
          &lt;dbIndices&gt;
            &lt;dbIndex name="ZO" description="Company" /&gt;
            &lt;dbIndex name="ZY" description="Country" /&gt;
            &lt;dbIndex name="ZC" description="Industry" /&gt;
            &lt;dbIndex name="ZM" description="Market" /&gt;
            &lt;dbIndex name="ZB" description="Publisher" /&gt;
            &lt;dbIndex name="ZX" description="Region" /&gt;
          &lt;/dbIndices&gt;
          &lt;dbFormats&gt;
            &lt;dbFormat name="list" description="list" /&gt;
            &lt;dbFormat name="detailed" description="detailed" /&gt;
          &lt;/dbFormats&gt;
        &lt;/db&gt;
        &lt;db xsi:type="DatabaseWithAuth" shortName="a9hthes" longName="Academic Search Complete -- Subject Terms" dbType="Flat Authority" contentType="Thesaurus" outsideSource="false" &gt;
          &lt;sortOptions /&gt;
          &lt;dbTags&gt;
            &lt;dbTag name="DE" description="Subject" /&gt;
            &lt;dbTag name="SU" description="Subject" /&gt;
          &lt;/dbTags&gt;
          &lt;dbIndices /&gt;
          &lt;dbFormats&gt;
            &lt;dbFormat name="list" description="list" /&gt;
            &lt;dbFormat name="detailed" description="detailed" /&gt;
          &lt;/dbFormats&gt;
        &lt;/db&gt;
      &lt;/authorityInfo&gt;
    &lt;/db&gt;
  &lt;/dbInfo&gt;
&lt;/info&gt;
</pre>	
	<p>
	<span class="highlight3">Viewing</span>: <a href="javascript: toggle_display( 'simple_response' ); toggle_display( 'real_response' );">Simplified Response</a> | Real Response
	</p>
</div>


<p>
	Upon success, the first node returned should be the <code>&lt;info&gt;</code> node (note: in SOAP, this node
	is contained within the <code>Envelope/Body/InfoResponse</code> node).  If there was an error, then the
	first node returned would be the <code>&lt;Fault&gt;</code> node.
</p>
<p>
	This <code>Info</code> method will return all databases available to a given profile. All of the 
	databases are returned within the <code>&lt;dbInfo&gt;</code> node.  Each database itself
	is represented with a <code>&lt;db&gt;</code> node.  The <code>&lt;db&gt;</code> node contains
	the following attributes:
</p>
<p>
	<ul>
		<li><code>shortName</code> - database code such as: a9h or bch</li>
		<li><code>longName</code> - full name of the database</li>
		<li><code>outsideSource</code> - boolean value (true/false) indicating whether the database is a non-EBSCO database accessible via an EBSCOhost Integrated Search connector</li>
		<li><code>contentType</code> - <i>Not Specified</i> for regular databases.  <i>Flat Subject, MESH, Multimedia/Images, Multimedia/Videos</i> or <i>Thesaurus</i> for authority databases</li>
		<li><code>dbType</code> - <i>Regular</i> for non-authority databases.  Otherwise: <i>Flat Authority</i> or <i>Regular As Authority</i></li>
	</ul> 	
</p>
<p>
	In each <code>&lt;db&gt;</code> node, information about the database is given.  The information
	given is:
</p>
	<ul>
		<li>Sort Options</li>
		<li>Indices</li>
		<li>Tags</li>
		<li>Formats</li>
		<li>Authority Databases</li>
	</ul> 
<p>
	The <code>&lt;sortOptions&gt;</code> node contains the fields which can be used to sort database
	searches.  Each database has a different set of sort options available to it.  Within the 
	<code>&lt;sortOptions&gt;</code> node, there may be several <code>&lt;sort&gt;</code> nodes:
</p>
	<p class="indent">
		<code>&lt;sort name="xs:string" id="xs:string &gt;</code>
	</p>
<p>
	<code>name</code> is the name used to describe the sort option, and <code>id</code> is the id used
	to refer to the sort option when making a search query.
</p>

<p>
	The <code>&lt;dbTags&gt;</code> node contains the tags which can be used for searching the database.
	The tags are represented by <code>&lt;dbTag&gt;</code> within the <code>&lt;dbTags&gt;</code> node:
</p>
	<p class="indent">
		<code>&lt;dbTags name="xs:string" description="xs:string &gt;</code>
	</p>
<p>
	<code>name</code> is the id used to refer to the tag when searching, and <code>description</code> is
	the description of the tag.
	<br><br>The same format applies for the <code>&lt;dbIndices&gt;</code> and <code>&lt;dbFormats&gt;</code>
	nodes as well.  The <code>&lt;dbIndicies&gt;</code> node lists out the available indices to search on
	the database, and the <code>&lt;dbFormats&gt;</code> lists the available record formats of the database.
</p>
<p>
	The <code>&lt;authorityInfo&gt;</code> node contains authority databases available to the database.  The
	<code>&lt;authorityInfo&gt;</code> node contains <code>&lt;db&gt;</code> nodes, which represent each
	authority database.  The <code>&lt;db&gt;</code> nodes representing authority databases can have
	Sort Options, Indices, Tags, and Formats, much like normal databases.
</p>

</div>

<div class="hr"></div>

<a name="c" ></a><h3 style="float: left;">REST Sample</h3>

<p class="top" id="restSampleTxt">
	<a href="javascript: hideSect( 'restSample' )">Hide</a> | <a href="#top">Back to Top</a>
</p>


<div style="clear:both;"></div>


<div id="restSample">

<p>
	This is a sample of the Info method using the REST protocol.
</p>

<i>Call:</i>
<br >
<pre>
http://eit.ebscohost.com/Services/SearchService.asmx/Info?
	<span class="highlight">prof</span>=<span class="highlight2">[Your EIT Profile ID]</span>
	&amp;<span class="highlight">pwd</span>=<span class="highlight2">[Your Profile Password]</span>
</pre>
<i>Response:</i>
<br >
<pre>
&lt;?xml version="1.0"&gt;
&lt;info shortName="xs:string"  longName="xs:string"  dbType="xs:string"  contentType="xs:string"  outsideSource="xs:string" &gt;
  &lt;dbInfo&gt;
    &lt;db shortName="xs:string" longName="xs:string" &gt;
      &lt;sortOptions&gt;
        &lt;sort name="xs:string"  id="xs:string" &gt;
        &lt;/sort&gt;
      &lt;/sortOptions&gt;
      &lt;dbTags&gt;
        &lt;dbTag name="xs:string"  description="xs:string" &gt;
        &lt;/dbTag&gt;
      &lt;/dbTags&gt;
      &lt;dbIndices&gt;
        &lt;dbIndex name="xs:string"  description="xs:string" &gt;
        &lt;/dbIndex&gt;
      &lt;/dbIndices&gt;
      &lt;dbFormats&gt;
        &lt;dbFormat name="xs:string"  description="xs:string" &gt;
        &lt;/dbFormat&gt;
      &lt;/dbFormats&gt;
      &lt;authorityInfo&gt;
        &lt;db&gt;
        &lt;/db&gt;
      &lt;/authorityInfo&gt;
    &lt;/db&gt;
  &lt;/dbInfo&gt;
&lt;/info&gt;
</pre>

</div>

<div class="hr"></div>

<a name="e" ></a><h3 style="float: left;">SOAP Sample</h3>

<p class="top" id="soapSampleTxt">
	<a href="javascript: hideSect( 'soapSample' )">Hide</a> | <a href="#top">Back to Top</a>
</p>

<div style="clear:both;"></div>

<div id="soapSample">

<p>
	This is a sample of the Info methods output using the SOAP protocol.
</p>

<i>Call:</i>
<br >
<pre>
&lt;soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" soap:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" &gt;
  &lt;soap:Header&gt;
    &lt;eit:AuthorizationHeader soap:mustUnderstand="1" xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;eit:<span class="highlight">Profile</span>&gt;<span class="highlight2">[Your EIT Profile ID]</span>&lt;/eit:Profile&gt;
      &lt;eit:<span class="highlight">Password</span>&gt;<span class="highlight2">[Your  Profile Password]</span>&lt;/eit:Password&gt;
    &lt;/eit:AuthorizationHeader&gt;
  &lt;/soap:Header&gt;
  &lt;soap:Body&gt;
    &lt;eit:Info xmlns:eit="http://epnet.com/webservices/SearchService/2007/07/"&gt;
    &lt;/eit:Info&gt;
  &lt;/soap:Body&gt;
&lt;/soap:Envelope&gt;
				</pre>
				<br ><br >
				<i>Response:</i>
				<br >
				<pre>
&lt;?xml version="1.0" encoding="utf-8"?&gt;
&lt;soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"&gt;
  &lt;soap:Body&gt;
    &lt;InfoResponse xmlns="http://epnet.com/webservices/SearchService/2007/07/"&gt;
      &lt;info shortName="xs:string"  longName="xs:string"  dbType="xs:string"  contentType="xs:string" outsideSource="xs:string" &gt;
        &lt;dbInfo&gt;
          &lt;db shortName="xs:string" longName="xs:string" &gt;
            &lt;sortOptions&gt;
              &lt;sort name="xs:string"  id="xs:string" &gt;
              &lt;/sort&gt;
            &lt;/sortOptions&gt;
            &lt;dbTags&gt;
              &lt;dbTag name="xs:string"  description="xs:string" &gt;
              &lt;/dbTag&gt;
            &lt;/dbTags&gt;
            &lt;dbIndices&gt;
              &lt;dbIndex name="xs:string"  description="xs:string" &gt;
              &lt;/dbIndex&gt;
            &lt;/dbIndices&gt;
            &lt;dbFormats&gt;
              &lt;dbFormat name="xs:string"  description="xs:string" &gt;
              &lt;/dbFormat&gt;
            &lt;/dbFormats&gt;
            &lt;authorityInfo&gt;
              &lt;db&gt;
              &lt;/db&gt;
            &lt;/authorityInfo&gt;
          &lt;/db&gt;
        &lt;/dbInfo&gt;
      &lt;/info&gt;
    &lt;/InfoResponse&gt;
  &lt;/soap:Body&gt;
&lt;/soap:Envelope&gt;
</pre>
</div>
<?php 

include( 'includes/footer.php' );

?>