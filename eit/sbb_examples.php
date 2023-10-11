<?php 

$head = '<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="styles/style_api.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/site.js"></script>';
include( 'includes/header.php' );

$menu = 'search_box_builder';
$page = 'sbb_examples';
include( 'includes/navbar.php' );


?>

<h2>Search Box Builder - Examples</h2>

			<div class="hr"></div>
<table>
	<tr>
		<td style="width: 395px;">
			<iframe src="sbb_examples/simple.html" style="width: 395px; height: 85px; border: 0px;"></iframe>
			This is a simple example of the Search Box builder.  It searches multiple databases and
			has full-text limiting, but only shows the user the search box.
		</td>
		<td>
<pre style="width: 325px; height: 200px; font-size: 10px;">
&lt;?xml version="1.0" encoding="ISO-8859-1" ?&gt;
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /&gt;
&lt;title&gt;&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;

&lt;!-- EBSCOhost Custom Search Box Begins --&gt;
&lt;script src="http://support.ebscohost.com/eit/scripts/ebscohostsearch.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;form action="" onsubmit="return ebscoHostSearchGo(this);" method="post"&gt;
&lt;input id="ebscohostwindow" name="ebscohostwindow" type="hidden" value="1" /&gt;
&lt;input id="ebscohosturl" name="ebscohosturl" type="hidden" value="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&type=1&db=&db=a9h&db=afh&db=aph&cli0=FT&clv0=Y&authtype=uid" /&gt;
&lt;input id="ebscohostsearchsrc" name="ebscohostsearchsrc" type="hidden" value="url" /&gt;
&lt;input id="ebscohostsearchmode" name="ebscohostsearchmode" type="hidden" value="+" /&gt;
&lt;input id="ebscohostkeywords" name="ebscohostkeywords" type="hidden" value="" /&gt;
&lt;div style="background-Image:url('http://support.ebscohost.com/eit/images/researchdatabases.gif');background-repeat:no-repeat;height:66px;width:300px;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;font-weight:bold;color:#353535;"&gt;
	&lt;div style="padding-top:5px;padding-left:75px;"&gt;
		&lt;span style="font-weight:bold;"&gt;Research databases&lt;/span&gt;
		&lt;div&gt;
			&lt;input id="ebscohostsearchtext" name="ebscohostsearchtext" type="text" size="23" style="font-size:9pt;padding-left:5px;margin-left:0px;" /&gt;
			&lt;input type="submit" value="Search" style="font-size:9pt;padding-left:5px;" /&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;/form&gt;
&lt;!-- EBSCOhost Custom Search Box Ends --&gt;

&lt;/body&gt;
&lt;/html&gt;
</pre>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class="hr"></div>
		</td>
	</tr>
	<tr>
		<td>
			<iframe src="sbb_examples/select_db.html" style="width: 395px; height: 250px; border: 0px;"></iframe>
			This is a slightly more advanced example of the Search Box builder.  The user is able to
			choose which databases they want to search.
		</td>
		<td><pre style="width: 325px; height: 200px; font-size: 10px;">&lt;?xml version="1.0" encoding="ISO-8859-1" ?&gt;
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /&gt;
&lt;title&gt;&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;

&lt;!-- EBSCOhost Custom Search Box Begins --&gt;
&lt;script src="http://support.ebscohost.com/eit/scripts/ebscohostsearch.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;style type="text/css"&gt;
.choose-db-list{ list-style-type:none;padding:0;margin:10px 0 0 0;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;width:375px; }
.choose-db-check{ width:20px;float:left;padding-left:5px;padding-top:5px; }
.choose-db-detail{ margin-left:30px;border-left:solid 1px #E7E7E7;padding:5px 11px 7px 11px;line-height:1.4em; }
.summary { background-color:#1D5DA7;color:#FFFFFF;border:solid 1px #1D5DA7; }
.one { background-color: #FFFFFF;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; padding: 0px; margin: 0px; }
.two { background-color: #F5F5F5;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; padding: 0px; margin: 0px; }
.selected { background-color: #E0EFF7;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; }
&lt;/style&gt;
&lt;form action="" onsubmit="return ebscoHostSearchGo(this);" method="post"&gt;
&lt;input id="ebscohostwindow" name="ebscohostwindow" type="hidden" value="1" /&gt;
&lt;input id="ebscohosturl" name="ebscohosturl" type="hidden" value="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&type=1&cli0=FT&clv0=Y&authtype=uid" /&gt;
&lt;input id="ebscohostsearchsrc" name="ebscohostsearchsrc" type="hidden" value="db" /&gt;
&lt;input id="ebscohostsearchmode" name="ebscohostsearchmode" type="hidden" value="+" /&gt;
&lt;input id="ebscohostkeywords" name="ebscohostkeywords" type="hidden" value="" /&gt;
&lt;div style="background-Image:url('http://support.ebscohost.com/eit/images/ebscohost.gif');background-repeat:no-repeat;height:66px;width:375px;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;font-weight:bold;color:#353535;"&gt;
	&lt;div style="padding-top:5px;padding-left:150px;"&gt;
		&lt;span style="font-weight:bold;"&gt;Search EBSCOhost&lt;/span&gt;
		&lt;div&gt;
			&lt;input id="ebscohostsearchtext" name="ebscohostsearchtext" type="text" size="23" style="font-size:9pt;padding-left:5px;margin-left:0px;" /&gt;
			&lt;input type="submit" value="Search" style="font-size:9pt;padding-left:5px;" /&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;div style="position:absolute;width:auto;"&gt;
&lt;ul class="choose-db-list"&gt;
&lt;li class="summary"&gt;
	&lt;span class="choose-db-check" title="Select / deselect all"&gt;
		&lt;input type="checkbox" onclick="SelectAllCheckBoxes(this);" name="cball" id="cball"&gt;
	&lt;/span&gt;
	&lt;div class="choose-db-detail"&gt;
		 &lt;span style="font-weight:bold;color:#FFFFFF;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;"&gt; Select / deselect all&lt;/a&gt;&lt;/span&gt;
	&lt;/div&gt;
&lt;/li&gt;&lt;li id="tr1" class="one"&gt;
	&lt;span class="choose-db-check" title="Academic Search Complete"&gt;
		&lt;input type="checkbox" id="cb1" name="cbs" value="a9h" onclick="highlight('tr1','one',this.id);"&gt;
	&lt;/span&gt;
	&lt;div class="choose-db-detail"&gt;
		&lt;a href="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&authtype=uid&db=a9h" target="_blank"&gt;Academic Search Complete&lt;/a&gt;
	&lt;/div&gt;
&lt;/li&gt;&lt;li id="tr2" class="two"&gt;
	&lt;span class="choose-db-check" title="Academic Search Elite"&gt;
		&lt;input type="checkbox" id="cb2" name="cbs" value="afh" onclick="highlight('tr2','two',this.id);"&gt;
	&lt;/span&gt;
	&lt;div class="choose-db-detail"&gt;
		&lt;a href="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&authtype=uid&db=afh" target="_blank"&gt;Academic Search Elite&lt;/a&gt;
	&lt;/div&gt;
&lt;/li&gt;&lt;li id="tr3" class="one"&gt;
	&lt;span class="choose-db-check" title="Academic Search FullTEXT Premier"&gt;
		&lt;input type="checkbox" id="cb3" name="cbs" value="aph" onclick="highlight('tr3','one',this.id);"&gt;
	&lt;/span&gt;
	&lt;div class="choose-db-detail"&gt;
		&lt;a href="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&authtype=uid&db=aph" target="_blank"&gt;Academic Search FullTEXT Premier&lt;/a&gt;
	&lt;/div&gt;
&lt;/li&gt;
&lt;/ul&gt;
&lt;/div&gt;
&lt;/form&gt;
&lt;!-- EBSCOhost Custom Search Box Ends --&gt;

&lt;/body&gt;
&lt;/html&gt;
</pre>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class="hr"></div>
		</td>
	</tr>
	<tr>
		<td>
			<iframe src="sbb_examples/custom.html" style="width: 395px; height: 300px; border: 0px;"></iframe>
			This example shows the EHIS functionality of the Search Box Builder.  You can add and label your
			own custom database groups (created in EBSCOadmin), and search using EHIS.
		</td>
		<td><pre style="width: 325px; height: 200px; font-size: 10px;">&lt;?xml version="1.0" encoding="ISO-8859-1" ?&gt;
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /&gt;
&lt;title&gt;&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;!-- EBSCOhost Custom Search Box Begins --&gt;
&lt;script src="http://support.ebscohost.com/eit/scripts/ebscohostsearch.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;style type="text/css"&gt;
.choose-db-list{ list-style-type:none;padding:0;margin:10px 0 0 0;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;width:400px; }
.choose-db-check{ width:20px;float:left;padding-left:5px;padding-top:5px; }
.choose-db-detail{ margin-left:30px;border-left:solid 1px #E7E7E7;padding:5px 11px 7px 11px;line-height:1.4em; }
.summary { background-color:#1D5DA7;color:#FFFFFF;border:solid 1px #1D5DA7; }
.one { background-color: #FFFFFF;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; padding: 0px; margin: 0px; }
.two { background-color: #F5F5F5;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; padding: 0px; margin: 0px; }
.selected { background-color: #E0EFF7;border:solid 1px #E7E7E7;border-top:solid 1px #FFFFFF; }
&lt;/style&gt;
&lt;form action="" onsubmit="return ebscoHostSearchGo(this);" method="post"&gt;
&lt;input id="ebscohostwindow" name="ebscohostwindow" type="hidden" value="1" /&gt;
&lt;input id="ebscohosturl" name="ebscohosturl" type="hidden" value="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&type=1&authtype=uid" /&gt;
&lt;input id="ebscohostsearchsrc" name="ebscohostsearchsrc" type="hidden" value="dbgroup" /&gt;
&lt;input id="ebscohostsearchmode" name="ebscohostsearchmode" type="hidden" value="+" /&gt;
&lt;input id="ebscohostkeywords" name="ebscohostkeywords" type="hidden" value="" /&gt;
&lt;div style="background-Image:url('../img/sbb/sbb_logo.png');background-repeat:no-repeat;height:100px;width:400px;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;font-weight:bold;color:#353535;"&gt;
	&lt;div style="padding-top:25px;padding-left:175px;"&gt;
		&lt;span style="font-weight:bold;"&gt;Search EHIS&lt;/span&gt;
		&lt;div&gt;
			&lt;input id="ebscohostsearchtext" name="ebscohostsearchtext" type="text" size="23" style="font-size:9pt;padding-left:5px;margin-left:0px;" /&gt;
			&lt;input type="submit" value="Search" style="font-size:9pt;padding-left:5px;" /&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;
&lt;div style="position:absolute;width:auto;"&gt;
&lt;ul class="choose-db-list"&gt;
&lt;li class="summary"&gt;
	&lt;span class="choose-db-check" title="Select / deselect all"&gt;
		&lt;input type="checkbox" onclick="SelectAllCheckBoxes(this);" name="cball" id="cball"&gt;
	&lt;/span&gt;
	&lt;div class="choose-db-detail"&gt;
		 &lt;span style="font-weight:bold;color:#FFFFFF;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:9pt;"&gt; Select / deselect all&lt;/a&gt;&lt;/span&gt;
	&lt;/div&gt;
&lt;/li&gt;&lt;li id="tr1" class="one"&gt;
	&lt;span class="choose-db-check" title="Custom Database Groups"&gt;
		&lt;input type="checkbox" id="cb1" name="cbs" value="876" onclick="highlight('tr1','one',this.id);"&gt;
	&lt;/span&gt;
	&lt;div class="choose-db-detail"&gt;
		&lt;a href="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&authtype=uid&dbgroup=876" target="_blank"&gt;Custom Database Groups&lt;/a&gt;
	&lt;/div&gt;
&lt;/li&gt;&lt;li id="tr2" class="two"&gt;
	&lt;span class="choose-db-check" title="Including EHIS Groups"&gt;
		&lt;input type="checkbox" id="cb2" name="cbs" value="123" onclick="highlight('tr2','two',this.id);"&gt;
	&lt;/span&gt;
	&lt;div class="choose-db-detail"&gt;
		&lt;a href="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&authtype=uid&dbgroup=123" target="_blank"&gt;Including EHIS Groups&lt;/a&gt;
	&lt;/div&gt;
&lt;/li&gt;&lt;li id="tr3" class="one"&gt;
	&lt;span class="choose-db-check" title="Are Supported"&gt;
		&lt;input type="checkbox" id="cb3" name="cbs" value="456" onclick="highlight('tr3','one',this.id);"&gt;
	&lt;/span&gt;
	&lt;div class="choose-db-detail"&gt;
		&lt;a href="http://search.ebscohost.com/login.aspx?direct=true&site=ehost-live&scope=site&authtype=uid&dbgroup=456" target="_blank"&gt;Are Supported&lt;/a&gt;
	&lt;/div&gt;
&lt;/li&gt;
&lt;/ul&gt;
&lt;/div&gt;
&lt;/form&gt;
&lt;!-- EBSCOhost Custom Search Box Ends --&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
		</td>
	</tr>
</table>


<?php 

include( 'includes/footer.php' );

?>