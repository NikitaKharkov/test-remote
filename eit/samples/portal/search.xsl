<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:eit="http://epnet.com/webservices/SearchService/Response/2007/07/" exclude-result-prefixes="eit">
<xsl:output method="html" doctype-system="http://www.w3.org/TR/xhtml4/DTD/strict.dtd" doctype-public="-//W3C//DTD XHTML 4.01 Strict//EN" encoding="UTF-8" media-type="text/html" />

<xsl:variable name="hits">
    <xsl:value-of select="//wrapper/searchResponse/eit:Hits" />
</xsl:variable>

<xsl:template match='/'>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="en-us" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
<script src="clmenu.js" type="text/javascript"></script>
 <link href="clmenu.css" type="text/css" rel="stylesheet" />
<title>CompanyX Portal - EIT Demonstration</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="_styles.css" media="screen" />

</head>
<body>

<div id="container">
    <table class="main_table">
        <tr>
            <td colspan="4" class="header">
            <img src="images/header.jpg" style="vertical-align: bottom;width:1270px;height:100px" alt="" />
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <p class="links">
                    <a href="index.php">
                        <img border="0px" src="images/home_btn.jpg" style="vertical-align: bottom" alt="" />
                    </a>
                    <img src="images/contacts_btn.jpg" style="vertical-align: bottom" alt="" />
                </p>
            </td>
        </tr>
        
        <tr class="content_holder">
        
        <td style="text-align: center; width:350px;">
                <div class="content_middle">
                    <br />
                    <div id="box">
                        <p class="title">
                            <span style="margin-left: 25px;">Search using EBSCOhost WEb Service API
                                <input type="image" src="images/demo_btn.gif" onMouseOver="toggle_display('search_help')" onMouseOut="toggle_display('search_help')" style="vertical-align: top;" /> 
                            </span>
                            <div id="search_help" class="help_box" style="margin-left: 265px; margin-top: -145px; display: none;" >
                                This component features EBSCOhost's <span class="definition">Web Service</span> functionality.  The user types in a search, the portal makes a search request to the web service,
                                and the results are returned in XML format.  The results can be displayed directly in your portal.
                            </div>
                        </p>
                        
                        <form action="index.php" method="get">
                        
                        <p class="body">
                            <font style="font-weight: bold">Welcome to the Company X Demonstration Portal</font>!  The components
                            on this page demonstrate the different ways you can use the EBSCOhost Integration Toolkit.  
                            For more information on each component, click the 
                            <img style="vertical-align: top;" src="images/demo_btn.gif" alt=""/> button.
                            <br />
                            <br />
                            <hr />
                            <br />
                            <table style="margin-left: 25px;">
                                <tr>
                                    <td style=" vertical-align: top;">
                                        <input type="text" name="query" class="text_input"/>
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
                            <iframe src="rss.php" height="250px" width="310px" frameborder="0" scrolling="yes" ></iframe>
                        </p>
                    </div>
                </div>
            </td>
            
            
            <td colspan="1">
                <div class="search_area_right">
                    <div id="box_search_right">
                        <p class="title">
                            <span style="margin-left: 25px;">Search Results</span>
                        </p>
                        <p class="body">
                            <xsl:choose>
                                <xsl:when test="$hits > 0">
                                    <table style="width: 100%">
                                        <tr>
                                            <td style="text-align: left; vertical-align: top;">
                                                <xsl:call-template name="breadcrumbs" />
                                            </td>
                                            <td style="text-align: right; vertical-align: top; width: 250px;">
                                                <xsl:call-template name="controls" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <hr style="padding: 0px; margin: 0px;" />
                                            </td>
                                        </tr>
                                    </table>
                                    <table style="vertical-align: center; border-collapse:collapse; width: 100%">
                                        <xsl:apply-templates select="//wrapper/searchResponse/eit:SearchResults/records" />
                                    </table>
                                </xsl:when>
                                <xsl:otherwise>
                                    <table style="width: 100%">
                                        <tr>
                                            <td style="text-align: left;">
                                                <xsl:call-template name="breadcrumbs" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <br />
                                                <hr />
                                                <br />
                                                
                                                <xsl:choose>
                                                    <xsl:when test="//no_data">
                                                        <xsl:value-of select="//wrapper/no_data" />
                                                    </xsl:when>
                                                    <xsl:otherwise>
                                                Your search returned no results.
                                                    </xsl:otherwise>
                                                </xsl:choose>
                                            </td>
                                        </tr>
                                    </table>
                                </xsl:otherwise>
                            </xsl:choose>
                            <br />
                            <hr />
                            <img src="images/pdf.png" alt="" /> = PDF Available (Hover over to see size.) <br />
                            <img src="images/document.png" alt="" /> = Full Text HTML Available. <br />
                            <br />
                        </p>
                    </div>
                </div>
            </td>
            
            
            <td>
                <div class="search_area_left">
                    <div id="box_search_left">
                        <p class="title">
                            <span style="margin-left: 25px;">Narrow By Subjects</span>
                        </p>
                        <p class="body">
                            <table style="width: 100%; border-collapse:collapse;">
                            <xsl:apply-templates select="wrapper/eit_subjects" />
                            </table>
                        </p>
                    </div>
                    
					<div class="mC">
                        <xsl:for-each select="//wrapper/clusterResponse/eit:ClusterCategory">
                            <div id="box_search_left">
                                <div class="mH"><xsl:attribute name="onclick">toggleMenu("<xsl:value-of select="@ID"/>")</xsl:attribute>
                                     <p class="title" style="width: 200px">
                                    <input type="image" src="images/cluster_arrow.png" style="vertical-align: top;" />
                                   
                                        <span style="margin-left: 25px;"><xsl:value-of select="@ID"/></span>
                                  </p>
                                </div>
                                <p class="body">
                                    <div class="mL" style="display: none;">
                                    <xsl:attribute name="id"><xsl:value-of select="@ID"/></xsl:attribute>
                                        <xsl:variable name="tag">
                                            <xsl:value-of select="@Tag" />
                                        </xsl:variable>
                                        <xsl:for-each select="eit:Cluster">
                                            <table style="width: 100%; border-collapse:collapse;">
                                                <tr class="search_row">
                                                    <td class="search_result">
                                                        <a class="mO">
                                                        <xsl:attribute name="href">
                                                        <xsl:value-of select="concat('index.php?query=', //query, '+AND+(',../@Tag,'+', ., ')', '&amp;qo=', //query_original)" />
                                                        </xsl:attribute>
                                                        <xsl:value-of select="." />
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </xsl:for-each>
                                    </div>
                                </p>
                            </div>
                        </xsl:for-each>
                    </div>
                        
                </div>
            </td>
            
            
            <td style="text-align: center; width:130px;">
                <div class="content_right">
                    <div id="box_right">
                    <p class="title">
                            <span style="margin-left: 25px;">Quotes</span>
                        </p>
                        <p class="body">
                            <img src="images/quotes_area.jpg" alt="" style="width:210px;height:230px;"/>
                        </p>
                    
                    
                    </div>
                </div>
                <div id="fading_box_right" class="content_right" style="opacity: .4;">
                    <div id="box_right">
                        <p class="title">
                            <span style="margin-left: 12px;"><img src="images/calendar_controls.jpg" alt="" style="width:210px;"/></span>
                        </p>
                        <p class="body">
                            <img src="images/calendar_area.jpg" alt="" style="width:210px;height:140px;"/>
                        </p>
                    </div>
                </div>
            </td>    
        </tr>
        
        
        <tr class="content_holder">
            <td colspan="4" style="text-align: center">
                <br />
                <br />
                <br />
                <a href="http://support.ebscohost.com/eit/">
                <span>Visit the EBSCOhost Integration Toolkit Website</span>
                </a>
                <br />
                <br />
            </td>
        </tr>
    </table>
</div>

</body>
</html>

</xsl:template>

<xsl:template match="records">
    <xsl:for-each select="rec">
        <tr class="search_row">
            <td class="search_result" width="50px">
                <a>
                    <xsl:attribute name="href">
                        <xsl:value-of select="plink" />
                    </xsl:attribute>
                    
                    <xsl:if test="header/controlInfo/artinfo/formats/fmt/@type = 'T'">
                        <img border="0px" src="images/document.png" alt="" />
                    </xsl:if>
                    
                    <xsl:if test="header/controlInfo/artinfo/formats/fmt/@type = 'P'">
                        <img>
                            <xsl:attribute name="border">0px</xsl:attribute>
                            <xsl:attribute name="src">images/pdf.png</xsl:attribute>
                            <xsl:attribute name="alt"></xsl:attribute>
                            <xsl:attribute name="title">Size: <xsl:value-of select="header/controlInfo/artinfo/formats/fmt/@size" /></xsl:attribute>
                        </img>
                    </xsl:if>
                    
                </a>
            </td>
            <td class="search_result">
                <a>
                    <xsl:attribute name="href">
                        <xsl:value-of select="plink" />
                    </xsl:attribute>
                    <div class="search_details">
                        <span class="result_title">
                            <xsl:value-of select="@recordID" />.   
                            <xsl:value-of select="header/controlInfo/artinfo/tig/atl" />
                        </span>
                        <br />
                        <span class="result_details">
                            <xsl:if test="header/controlInfo/artinfo/aug/au">
                                <span style="margin-right: 25px">Authors: <xsl:value-of select="header/controlInfo/artinfo/aug/au" /></span>
                            </xsl:if>
                            <span style="margin-right: 25px"><xsl:value-of select="header/controlInfo/jinfo/jtl" /></span> 
                            <xsl:value-of select="header/controlInfo/pubinfo/dt" />
                        </span>
                    </div>
                </a>
            </td>
        </tr>
    </xsl:for-each>
</xsl:template>

<xsl:template match="eit_subject">
    <tr class="search_row">
        <td class="search_result">
            <a>
                <xsl:attribute name="href">
                    <xsl:value-of select="concat('index.php?query=', //query, '+AND+(SU+', ., ')', '&amp;qo=', //query_original)" />
                </xsl:attribute>
                <xsl:value-of select="." />
            </a>
        </td>
    </tr>
</xsl:template>

<xsl:template name="controls">
    Displaying <xsl:value-of select="//min" /> - <xsl:value-of select="//max" />
     of <xsl:value-of select="$hits" /> Results
     
     <br />
     
     <xsl:choose>
         <xsl:when test="//min > 9">
             <a>
                 <xsl:attribute name="href">
                     <xsl:value-of select="concat('index.php?query=', //query, '&amp;start=', (//min - 10) , '&amp;qo=', //query_original)" />
                 </xsl:attribute>
                 Prev</a>
         </xsl:when>
         <xsl:otherwise>
             Prev
         </xsl:otherwise>
     </xsl:choose>
     |
     <xsl:choose>
         <xsl:when test="$hits > (//min + 9)">
             <a>
                 <xsl:attribute name="href">
                     <xsl:value-of select="concat('index.php?query=', //query, '&amp;start=', (//min + 10) , '&amp;qo=', //query_original)" />
                 </xsl:attribute>
                 Next</a>
         </xsl:when>
         <xsl:otherwise>
             Next
         </xsl:otherwise>
     </xsl:choose>
     <br />
     <br />
</xsl:template>

<xsl:template name="breadcrumbs">
    <xsl:for-each select="//wrapper/breadcrumbs/bc">
        <a>
            <xsl:attribute name="href">
                <xsl:value-of select="concat('index.php?query=', ., '&amp;qo=', //query_original)" />
            </xsl:attribute>
            <xsl:value-of select="@name" />
        </a>
         >>>
    </xsl:for-each>
    Results
</xsl:template>

</xsl:stylesheet>