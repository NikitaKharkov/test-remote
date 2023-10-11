<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:eit="http://epnet.com/webservices/SearchService/Response/2007/07/" exclude-result-prefixes="eit">
<xsl:output method="html" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="UTF-8" media-type="text/html" />

<xsl:variable name="db">
    <xsl:value-of select="wrapper/dbSelect" />
</xsl:variable>

<xsl:variable name="index">
    <xsl:value-of select="wrapper/index" />
</xsl:variable>

<xsl:template match='/'>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="en-us" />
    <title>Browse Database Indices</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div class="search_area_right" style="background-color: #CCE0FF;">
<div id="box_search_right" style="background-color: #FFFFFF;">
<table>
    <tr>
        <td  style="vertical-align: top;">
            <img src="images/logoEhost.gif" style="float:left" alt="" />
        </td>
        <td  style="vertical-align: top;">
            <p style='height: 17px;
                font-weight: bold;'><br/><br/>
            EBSCO Integration Toolkit (EIT) Web Services:  Simple Search Results
            </p>
        </td>
    </tr>
</table>
<p class="title"> </p>
<table width="700px">
<tr>
<td align="left">
<a>
    <xsl:attribute name="href">
        <xsl:value-of select="concat( 'search.php?db=', $db )" />
    </xsl:attribute>
    Refine Search
</a>
</td>
<td align="right">

<form action="browse.php" method="GET">
New Search :
        <input type="hidden" name="db">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/dbSelect" />
            </xsl:attribute>
        </input>
        
        <input name="browse" type="text"  value=""/>
        
            <input name="index" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/index" />
            </xsl:attribute>
        </input>
        <input type="submit" value="Search" />
        </form>
</td>
</tr>
</table>
<table  width="700px">
    <tr  class="title">
        <th  width="500px">Name</th>
        <th  width="200px">Records Count</th>
    </tr>
    <xsl:apply-templates select="//wrapper/browseResponse/eit:response/records" />
</table>
</div>
<a href="http://support.ebscohost.com/eit/" style="text-align:center;text-decoration: underline;color:#104E8B;font-size: 10px;">Return to EBSCOhost Integration Toolkit Home</a>
</div>
</body>
</html>
</xsl:template>

<xsl:template match="rec">
    <tr>
        <td>
            <a>
                <xsl:attribute name="href">
                    <xsl:value-of select="concat( 'browse.php?db=', $db, '&amp;index=', $index, '&amp;browse=', header/browseTerms/@searchKey )" />
                </xsl:attribute>
                <xsl:value-of select="header/browseTerms/browseTerm" />
            </a>
        </td>
        <td>
            <a>
                <xsl:attribute name="href">
                    <xsl:value-of select="concat( 'browse.php?db=', $db, '&amp;index=', $index, '&amp;browse=', header/browseTerms/@searchKey )" />
                </xsl:attribute>
                <xsl:value-of select="header/browseTerms/@count" />
            </a>
        </td>
    </tr>
</xsl:template>

</xsl:stylesheet>