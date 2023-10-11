<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:eit="http://epnet.com/webservices/SearchService/Response/2007/07/" exclude-result-prefixes="eit">
<xsl:output method="html" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="UTF-8" media-type="text/html" />
<xsl:template match='/'>

<html>
<head>

<script language="Javascript">

function fade_boxes( )
{
	 document.getElementById("fading_box_left").style.filter="alpha(opacity=40)";
	 document.getElementById("fading_box_middle").style.filter="alpha(opacity=40)";
	 document.getElementById("fading_box_right").style.filter="alpha(opacity=40)";
}

function toggle_display( id ) {
	obj = document.getElementById(id);
	if (obj) {
		obj.style.display = (obj.style.display == "none") ? "block" : "none";
	}
}

</script>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>CompanyX Portal - EIT Demonstration</title>

<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body onLoad="fade_boxes()">

<div id="container">
	<table class="main_table">
		<tr>
			<td colspan="3" class="header">
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<p class="links">
					<img src="images/home_btn.jpg" style="vertical-align: bottom" alt="" />
					<img src="images/contacts_btn.jpg" style="vertical-align: bottom" alt="" />
				</p>
			</td>
		</tr>
		<tr class="content_holder">
			<td style="text-align: center;">
				<div id="fading_box_left" class="content_left" style="opacity: .4;">
					<div id="box_left">
						<p class="title">
							<span style="margin-left: 25px;"><img src="images/inbox_controls.jpg" alt="" /></span>
						</p>
						<p class="body">
							<img src="images/inbox_area.jpg" alt="" />
						</p>
					</div>
					<div id="box_left">
						<p class="title">
							<span style="margin-left: 25px;">Quotes</span>
						</p>
						<p class="body">
							<img src="images/quotes_area.jpg" alt="" />
						</p>
					</div>
				</div>
			</td>
			<td style="text-align: center;">
				<div id="fading_box_middle" class="content_middle" style="opacity: .4;">
					<div id="box">
						<p class="title">
							<span style="margin-left: 25px;">Market Summary</span>
						</p>
						<p class="body">
							<img src="images/market_area.jpg" alt="" />
						</p>
					</div>
				</div>
				<div class="content_middle">
					<br />
					<div id="box">
						<p class="title">
							<span style="margin-left: 25px;">Search using EBSCOhost Web Services API
								<input type="image" src="images/demo_btn.gif" onMouseOver="toggle_display('search_help')" onMouseOut="toggle_display('search_help')" style="vertical-align: top;" /> 
							</span>
							<div id="search_help" class="help_box" style="margin-left: 265px; margin-top: -145px; display: none;" >
								This component features EBSCOhost's <span class="definition">Web Service</span> functionality.  The user types in a search, the portal makes a search request to the web service,
								and the results are returned in XML format.  The results can be displayed directly in your portal.
							</div>
						</p>
						
						<form action="index.php" method="get">
						<input type="hidden" name="db">
							<xsl:attribute name="value">
								<xsl:value-of select="info/eit:dbInfo/eit:db/@shortName" />
							</xsl:attribute>
						</input>
						<p class="body">
							<font style="font-weight: bold">Welcome to the Company X Demonstration Portal</font>!  The components
							on this page demonstrate the different ways you can use the EBSCOhost Integration Toolkit.  
							For more information on each component, click the 
							<img style="vertical-align: top;" src="images/demo_btn.gif" alt="" /> button.
							<br />
							<br />
							<hr />
							<br />
							<table style="margin-left: 25px;">
								<tr>
									<td style=" vertical-align: top">
										<input type="text" name="query" class="text_input" />
									</td>
									<td style=" vertical-align: top">
										<input type="image" src="images/search_btn.gif" />
									</td>
								</tr>
								<tr>
									<td colspan="2">
										Powered by EBSCOhost Integration Toolkit
									</td>
								</tr>
							</table>
							<br />
						</p>
						
						</form>
					</div>
					<br />
					<div id="box">
						<p class="title">
							<span style="margin-left: 25px;">RSS Feed: Sustainability
								<input type="image" src="images/demo_btn.gif" onMouseOver="toggle_display('rss_help')" onMouseOut="toggle_display('rss_help')" style="vertical-align: top;" /> 
							</span>
							<div id="rss_help" class="help_box" style="margin-left: 185px; margin-top: -135px; display: none;" >
								This component features EBSCOhost's <span class="definition">RSS</span> functionality.  An RSS feed, which displays the 10 most recent search results for
								a particular search, can be set up and displayed directly in your portal.
							</div> 
						</p>
						<p class="body">
							<iframe src="rss.php" height="250px" width="400px" frameborder="0" scrolling="yes" ></iframe>
						</p>
					</div>
				</div>
			</td>
			<td style="text-align: center;">
				<div class="content_right">
					<div id="box_right">
						<p class="title">
							<span style="margin-left: 25px;">Top Prospects
								<input type="image" src="images/demo_btn.gif" onMouseOver="toggle_display('plink_help')" onMouseOut="toggle_display('plink_help')" style="vertical-align: top;" /> 
							</span>
							<div id="plink_help" class="help_box" style="margin-left:-105px; margin-top: -165px; display: none;" >
								This component features EBSCOhost's <span class="definition">Persistent Link</span> functionality.  The search box will send the users query to EBSCOhost's search interface.
								The company links are persistent, meaning they are hard-coded, and will send a user to a company profile in the Business Source Complete database. 
							</div>
						</p>
						<p class="body">
							<form name="plink_search" method="GET" action="http://search.ebscohost.com/login.aspx" target="_new">
							<input type="hidden" name="direct" value="true" />
							<input type="hidden" name="site" value="ehost-live" />
							<input type="hidden" name="scope" value="site" />
							<input type="hidden" name="type" value="1" />
							<input type="hidden" name="db" value="bch" />
							<input type="hidden" name="authtype" value="uid" />
							<table style="margin-left: 10px;">
								<tr>
									<td style=" vertical-align: top">
										<input type="text" name="bquery" class="text_input" />
									</td>
									<td style=" vertical-align: top">
										<input type="image" src="images/search_btn.gif" />
									</td>
								</tr>
								<tr>
									<td colspan="2">
										Powered by EBSCOhost Integration Toolkit
									</td>
								</tr>
							</table>
							</form>
							<table style="width: 100%; border-collapse: collapse; vertical-align: center;" >
								<tr class="search_row">
									<td class="search_result">
										<a style="text-decoration:none;" target="_new" href="http://search.ebscohost.com/login.aspx?direct=true&amp;db=bch&amp;authdb=dmhco&amp;AN=F4EFC8D9-A1D9-412E-AFE2-554F4A036D7F&amp;site=ehost-live">
											<img src="images/document.png" border="0px" alt=""/> IBM
										</a>
									</td>
								</tr>
								<tr class="search_row">
									<td class="search_result">
										<a style="text-decoration:none;" target="_new" href="http://search.ebscohost.com/login.aspx?direct=true&amp;db=bch&amp;authdb=dmhco&amp;AN=8ABE78BB-0732-4ACA-A41D-3012EBB1334D&amp;site=ehost-live">
											<img src="images/document.png" border="0px" alt=""/> Microsoft
										</a>
									</td>
								</tr>
								<tr class="search_row">
									<td class="search_result">
										<a style="text-decoration:none;" target="_new" href="http://search.ebscohost.com/login.aspx?direct=true&amp;db=bch&amp;authdb=dmhco&amp;AN=41192B57-8248-4EF9-93C8-ABE35E30A2E6&amp;site=ehost-live">
											<img src="images/document.png" border="0px" alt=""/> HP
										</a>
									</td>
								</tr>
							</table>
						</p>
					</div>
				</div>
				<div id="fading_box_right" class="content_right" style="opacity: .4;">
					<div id="box_right">
						<p class="title">
							<span style="margin-left: 12px;"><img src="images/calendar_controls.jpg" alt="" /></span>
						</p>
						<p class="body">
							<img src="images/calendar_area.jpg" alt="" />
						</p>
					</div>
				</div>
			</td>
		</tr>
		<tr class="content_holder">
			<td colspan="3" style="text-align: center">
				<br />
				<br />
				<br />
				<a href="http://support.ebscohost.com/eit/webservice/samples.htm">
				<span>Back to EBSCOhost Integration Toolkit Website</span>
				</a>
				<br />
				<br />
			</td>
		</tr>
	</table>
	<br />
	<br />
</div>

</body>
</html>

</xsl:template>
</xsl:stylesheet>