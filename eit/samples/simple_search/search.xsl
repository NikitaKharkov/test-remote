<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:eit="http://epnet.com/webservices/SearchService/Response/2007/07/" exclude-result-prefixes="eit">
<xsl:output method="html" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="UTF-8" media-type="text/html" />

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
    <title>Display Databases</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div class="search_area_right">

<table>
    <tr>
        <td  style="vertical-align: top;">
            <img src="images/logoEhost.gif" style="float:left" alt="" />
        </td>
        <td  style="vertical-align: top;">
            <p style='height: 17px;
                font-weight: bold;'><br/>
            EBSCO Integration Toolkit (EIT) Web Services:<br/>  
            Simple Search Search and browse the EBSCOhost Databases using the EIT Web Service. <br/>
            </p>
        </td>
    </tr>
</table>

<div id="box_search_right">
Database: <xsl:apply-templates select="wrapper/info/eit:dbInfo" />
<div id="container">
<table class="main_table">

<tr class="content_holder">
<td>
<p class="title">
Select a Database:
</p>
<br/>
<table>
    <tr>
        <td width="200px" class="search_page">
        Please choose a Database:
        </td>
        <td class="search_page">        
        <select name="db" ONCHANGE="window.location.href=this.options[this.selectedIndex].value">
        <option value="">
        <xsl:if test = " $db = ''">
        <xsl:attribute name="selected">
            <xsl:value-of select="wrapper/selected" />
        </xsl:attribute>
        </xsl:if>
        Select Database</option>
        <xsl:for-each select="wrapper/info/eit:dbInfo/eit:db">                      
            <option>
            <xsl:if test = " $db = string(./@shortName)">
            <xsl:attribute name="selected">
                <xsl:value-of select="wrapper/selected" />
            </xsl:attribute>
            </xsl:if>
            <xsl:attribute name="value">
            <xsl:value-of select="concat('search.php?db=',./@shortName)" />
        </xsl:attribute>
        <xsl:value-of select="./@longName"/>
            </option>
            </xsl:for-each>
        </select>
        </td>
        </tr>
        <tr><td></td>
        <td>
        *(Please select a database if not already selected)
        </td>
    </tr>
</table>
<br/>
</td>
</tr>

<tr class="content_holder">
<td>
<p class="title">
Standard Search:
</p>
<br />
<form action="results.php" method="GET">
<input type="hidden" name="db">
    <xsl:attribute name="value">
        <xsl:value-of select="wrapper/dbSelect" />
    </xsl:attribute>
</input>
<table>
    <tr>
        <td width="100px" class="search_page">
            Find:
        </td>
        <td class="search_page" colspan="2">
            <input name="s1" type="text" style="width:195px;"/>
        </td>
        <td class="search_page">
            in <select name="t1">
                    <option value="">Select a Field (optional)</option>
                    <xsl:apply-templates select="wrapper/info/eit:dbInfo/eit:db/eit:dbTags" />
               </select>
        </td>
    </tr>
    <tr>
    <td></td>
        <td  class="search_page">
            <select name="d1" style="width: 50px; margin: 5px 0pt;">
                <option>AND</option>
                <option>OR</option>
                <option>NOT</option>
            </select>
        </td>
        <td class="search_page">
            <input name="s2" type="text" />
        </td>
        <td class="search_page">
            in <select name="t2">
                    <option value="">Select a Field (optional)</option>
                    <xsl:apply-templates select="wrapper/info/eit:dbInfo/eit:db/eit:dbTags" />
               </select>
        </td>
    </tr>
    <tr style="display:none;">
        <td class="search_page">
            <select name="d2">
                <option>AND</option>
                <option>OR</option>
                <option>NOT</option>
            </select>
        </td>
        <td class="search_page">
            <input name="s3" type="text" />
        </td>
        <td class="search_page">
            in <select name="t3">
                    <option value="">Select a Field (optional)</option>
                    <xsl:apply-templates select="wrapper/info/eit:dbInfo/eit:db/eit:dbTags" />
               </select>
        </td>
    </tr>
    <tr style="display:none;">
        <td class="search_page">
            <select name="d3">
                <option>AND</option>
                <option>OR</option>
                <option>NOT</option>
            </select>
        </td>
        <td class="search_page">
            <input name="s4" type="text" />
        </td>
        <td class="search_page">
            in <select name="t4">
                    <option value="">Select a Field (optional)</option>
                    <xsl:apply-templates select="wrapper/info/eit:dbInfo/eit:db/eit:dbTags" />
               </select>
        </td>
    </tr>
    </table>
    <table>
    <tr>
        <td class="search_page" width="100px">
            Sort By:
        </td>
        <td class="search_page">
            <select name="sort" style="width:150px;margin:5px 0 5px 0;">
                <xsl:apply-templates select="wrapper/info/eit:dbInfo/eit:db/eit:sortOptions" />
            </select>
        </td>
        <td class="search_page">
            Full Text <input type="checkbox" name="ft" value="1" checked="true" />
        </td>
    </tr>
    <tr>
        <td></td>
        <td colspan="1" align="left">
            <input type="submit" value="Search" />
        </td>
    </tr>
</table>
</form>
</td>
</tr>

<tr class="content_holder">
<td>
<p class="title">
Alternative Index Browse:
</p>
<form action="browse.php" method="get">
<input type="hidden" name="db">
    <xsl:attribute name="value">
        <xsl:value-of select="$db" />
    </xsl:attribute>
</input>
<table>
    <tr>
        <td width="100px" class="search_page">
        Index:
        </td>
        <td class="search_page">
        <select name="index" style="width:150px;margin:5px 0 5px 0;">
            <xsl:apply-templates select="wrapper/info/eit:dbInfo/eit:db/eit:dbIndices" />
        </select>
        </td>
    </tr>
    <tr>
        <td class="search_page">
            Browse for:
        </td>
        <td>
            <input type="text" name="browse" />
        </td>
    </tr>

    <tr>
    <td></td>
        <td colspan="1" align="left">
            <input type="submit" value="Browse"/>
        </td>
    </tr>
</table>
</form>
</td>
</tr>

</table>
</div>
</div>
<a href="http://support.ebscohost.com/eit/" style="text-align:center;text-decoration: underline;color:#104E8B;font-size: 10px;">Return to EBSCOhost Integration Toolkit Home</a>
</div>
</body>
</html>
</xsl:template>

<xsl:template match="eit:db">
    <xsl:if test="@shortName = $db">
        <xsl:value-of select="@longName"/>
    </xsl:if> 
</xsl:template>

<xsl:template match="eit:dbIndices">
    <xsl:if test="../@shortName = $db">
        <xsl:for-each select="eit:dbIndex">
            <option>
                <xsl:attribute name="value">
                    <xsl:value-of select="@name" />
                </xsl:attribute>
                <xsl:value-of select="@description" />
            </option>
        </xsl:for-each>
    </xsl:if>
</xsl:template>

<xsl:template match="eit:dbTags">
    <xsl:if test="../@shortName = $db">
        <xsl:for-each select="eit:dbTag">
            <option>
                <xsl:attribute name="value">
                    <xsl:value-of select="@name" />
                </xsl:attribute>
                <xsl:value-of select="@description" />
            </option>
        </xsl:for-each>
    </xsl:if>
</xsl:template>

<xsl:template match="eit:sortOptions">	
    <xsl:if test="../@shortName = $db">
        <xsl:for-each select="eit:sort">
            <option>
                <xsl:attribute name="value">
                    <xsl:value-of select="@id" />
                </xsl:attribute>
                
                <xsl:value-of select="@name" />
            </option>
        </xsl:for-each>
    </xsl:if>
</xsl:template>

</xsl:stylesheet>