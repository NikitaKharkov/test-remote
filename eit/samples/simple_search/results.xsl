<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:eit="http://epnet.com/webservices/SearchService/Response/2007/07/" exclude-result-prefixes="eit">
<xsl:output method="html" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="UTF-8" media-type="text/html" />

<xsl:variable name="hits">
    <xsl:value-of select="wrapper/searchResponse/eit:Statistics/eit:Statistic/eit:Hits" />
</xsl:variable>

<xsl:variable name="start">
    <xsl:value-of select="wrapper/start_record" />
</xsl:variable>

<xsl:variable name="query">
    <xsl:value-of select="wrapper/query" />
</xsl:variable>

<xsl:variable name="next_link">
    <xsl:value-of select="wrapper/next_page" />
</xsl:variable>

<xsl:variable name="prev_link">
    <xsl:value-of select="wrapper/prev_page" />
</xsl:variable>

<xsl:variable name="new_search">
    <xsl:value-of select="wrapper/new_search" />
</xsl:variable>

<xsl:variable name="db">
    <xsl:value-of select="wrapper/dbSelect" />
</xsl:variable>

<xsl:template match='/'>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="en-us" />
    <title>Search Results</title>
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

<form action="results.php" method="GET">
New Search :
        <input type="hidden" name="db">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/dbSelect" />
            </xsl:attribute>
        </input>
        
        <input name="s1" type="text"  value=""/>
        
            <input name="t1" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/t1" />
            </xsl:attribute>
        </input>
            <input name="d1" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/d1" />
            </xsl:attribute>
        </input>
            
            <input name="s2" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/s2" />
            </xsl:attribute>
        </input>
            <input name="t2" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/t2" />
            </xsl:attribute>
        </input>
            <input name="d2" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/d2" />
            </xsl:attribute>
        </input>
            
            <input name="s3" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/s3" />
            </xsl:attribute>
        </input>
            <input name="t3" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/t3" />
            </xsl:attribute>
        </input>
            <input name="d3" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/d3" />
            </xsl:attribute>
        </input>
            
            <input name="s4" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/s4" />
            </xsl:attribute>
        </input>
            <input name="t4" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/t4" />
            </xsl:attribute>
        </input>
            <input name="d4" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/d4" />
            </xsl:attribute>
        </input>
            
            <input name="sort" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/sort" />
            </xsl:attribute>
        </input>
            <input name="ft" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/ft" />
            </xsl:attribute>
        </input>    
           <input type="submit" value="Search" />
 
</form>
</td>
</tr>
</table>
<table border="0" width="700px">
    <tr class="title" style="text-align: center;">
        <th class="search_result" colspan="2">
            Search Results for: <xsl:value-of select="$query" /><br/><br/>
            <xsl:call-template name="controls" />
        </th>
    </tr>
    <xsl:apply-templates select="//wrapper/searchResponse/eit:SearchResults/records" />
    <tr>
    <td class="search_result" colspan="2" style="text-align:center;">
    <xsl:call-template name="controls"/>
    </td>
    </tr>
</table>
</div>
<a href="http://support.ebscohost.com/eit/" style="text-align:center;text-decoration: underline;color:#104E8B;font-size: 10px;">Return to EBSCOhost Integration Toolkit Home</a>
</div>
</body>
</html>

</xsl:template>

<xsl:template name="controls">
    Results <xsl:value-of select="$start"/> - <xsl:value-of select="$start + 9" />
     of <xsl:value-of select="$hits" /> Total <br />
    <xsl:choose>
        <xsl:when test="$start > 1">
            <a>
                <xsl:attribute name="href">
                    <xsl:value-of select="$prev_link" />
                </xsl:attribute>
                Prev
            </a>
        </xsl:when>
        <xsl:otherwise>
            Prev
        </xsl:otherwise>
    </xsl:choose>
    |
    <xsl:choose>
        <xsl:when test="$hits > ($start + 10)">
            <a>
                <xsl:attribute name="href">
                    <xsl:value-of select="$next_link" />
                </xsl:attribute>
                Next
            </a>
        </xsl:when>
        <xsl:otherwise>
            Next
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

<xsl:template match="rec">
    <tr>    
    <td valign="top" style="padding-top: 5px;padding-bottom: 5px;"><xsl:value-of select="@recordID" />. </td>
        <td class="search_result">
            <font style="font-weight: bold;">
            <a>
                <xsl:attribute name="href">
                    <xsl:value-of select="plink" />
                </xsl:attribute>
                <xsl:value-of select="header/controlInfo/artinfo/tig/atl" />
            </a>
            </font>
            <br />
            <i>
                <xsl:if test="header/controlInfo/artinfo/aug/au">
                    By:
                    <xsl:for-each select="header/controlInfo/artinfo/aug/au">
                        <xsl:value-of select="." />;
                    </xsl:for-each>
                </xsl:if>
                <xsl:value-of select="header/controlInfo/jinfo/jtl" />, <xsl:value-of select="header/controlInfo/pubinfo/dt" />.
            </i>
            <br />
            
            <xsl:if test="header/controlInfo/artinfo/su">
                <br/>Subjects: <br/>
                <xsl:for-each select="header/controlInfo/artinfo/su">
                    <xsl:value-of select="." />, 
                </xsl:for-each><br />
            </xsl:if>
            <br />
        </td>
    </tr>
</xsl:template>

</xsl:stylesheet>