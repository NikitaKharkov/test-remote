<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:eit="http://epnet.com/webservices/SearchService/Response/2007/07/" exclude-result-prefixes="eit">
<xsl:output method="html" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="UTF-8" media-type="text/html" />

<xsl:variable name="result_start">
    <xsl:value-of select="//wrapper/searchResponse/eit:SearchResults/records/rec/@recordID" />
</xsl:variable>

<xsl:variable name="result_end">
    <xsl:value-of select="$result_start + 9" />
</xsl:variable>

<xsl:variable name="hits">
    <xsl:value-of select="//wrapper/hits" />
</xsl:variable>

<xsl:variable name="page_num">
    <xsl:value-of select="ceiling($result_end div 10)" />
</xsl:variable>

<xsl:variable name="page_max">
    <xsl:value-of select="ceiling(($hits + 10) div 10)" />
</xsl:variable>

<xsl:variable name="page">
    <xsl:value-of select="//wrapper/page" />
</xsl:variable>

<xsl:variable name="totalrecs">
    <xsl:value-of select="//wrapper/totalrecs" />
</xsl:variable>

<xsl:variable name="page_list_begin">
    <xsl:choose>
        <xsl:when test="0 > ($page_num - 5)">
            1
        </xsl:when>
        <xsl:otherwise>
            <xsl:value-of select="($page_num - 4)" />
        </xsl:otherwise>
    </xsl:choose>
</xsl:variable>

<xsl:variable name="page_list_end">
    <xsl:value-of select="$page_list_begin + 8" />
</xsl:variable>

<xsl:variable name="nextpage">
    <xsl:value-of select="//wrapper/nextpage" />
</xsl:variable>

<xsl:variable name="thispage">
    <xsl:value-of select="//wrapper/thispage" />
</xsl:variable>

<xsl:variable name="prevpage">
    <xsl:value-of select="//wrapper/prevpage" />
</xsl:variable>

<xsl:template match='/'>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="en-us" />
<title>The University Collection - Search using EBSCOhost</title>
<script src="coltab.js" type="text/javascript"></script>
 <link href="coltab.css" type="text/css" rel="stylesheet" />
<link rel='stylesheet' href='eds.css' type='text/css' />
<script src="clmenu.js" type="text/javascript"></script>
 <link href="clmenu.css" type="text/css" rel="stylesheet" />
<script language="javascript">


var EDSmouseOverFlag;
var EDStimerID = 0;

function __getElementY( element )
{
    e = document.getElementById( element );
    
    var y_value = 0;

    while( e != null ) {
        y_value += e.offsetTop;
        e = e.offsetParent;
    }
    
    return y_value;
}

function __getElementX( element )
{
    e = document.getElementById( element );
    
    var x_value = 0;
    
    while( e != null ) {
        x_value += e.offsetLeft;
        e = e.offsetParent;
    }
    
    return x_value;
}


function __iPopup( p1, p2, p3 )
{
    if( !p3 )
    {
        pFunc = "__iPopup( \"" + p1 + "\", \"" + p2 + "\" , true )";
        EDStimerID = setTimeout( pFunc, 750 );
    } else
    {
        if( EDSmouseOverFlag == true )
        {
            locX = __getElementX( p2 );
            locY = __getElementY( p2 );
                        
            widthX = document.getElementById( p1 ).offsetWidth;
            widthY = document.getElementById( p1 ).offsetHeight;
            
            if( window.innerWidth == undefined )
            {
               windowWidth = document.documentElement.clientWidth;
               windowHeight = document.documentElement.clientHeight;
               windowScroll = document.documentElement.scrollTop;
            } 
            else
            {
                windowWidth = window.innerWidth;
                  windowHeight = window.innerHeight;
                  windowScroll = window.scrollY;
            }
            
            if( ( locX + widthX ) > windowWidth )
            {
                locX -= widthX + 10;
            }
            
            while( ( ( locY + widthY ) - windowScroll ) > windowHeight )
            {
                locY -= 50;	
            }
            
            document.getElementById( p1 ).style.top = locY + "px";
            document.getElementById( p1 ).style.left = locX + "px";
            document.getElementById( p1 ).style.visibility = "visible";
        }
    }
}

function __iPopupClose( id )
{ 
    document.getElementById( id ).style.visibility = "hidden";
}

function EDSresultPopup( p1, p2 )
{
    EDSmouseOverFlag = true;
    __iPopup( p1, p2, false );
}

function EDSresultPopupHalt( p1 )
{
    EDSmouseOverFlag = false;
    clearTimeout( EDStimerID );
    setTimeout( "EDSresultPopupClose( \"" + p1 + "\" )", 50 );
}

function EDSresultPopupClose( p1 )
{
    if( EDSmouseOverFlag == false )
    {
        __iPopupClose( p1 );
    }
}

function EDSresultPopupMOver()
{
    EDSmouseOverFlag = true;
}

</script>

</head>
<body>
<div id="container">
    <xsl:call-template name="info_boxes" />
    <div id="header">
        <div class="top">
            <a href="index.php">New Search</a>
        </div>
              <div class="middle">
          <img src="images/logo_main_png.gif" style="float:left" alt="" />
          <img src="images/logo_right.png" style="float:right" alt="" />
          <table>
            <tr>
              <td>
                <div class="inactive_button" style="margin-left: 50px;">
                  Home
                </div>
              </td>
              <td>
                <div class="active_button">
                  <a href="index.php" style="color: #FFF; text-decoration: none;">Search</a>
                </div>
              </td>
              <td>
                <div class="inactive_button">
                  Subject Guides
                </div>
              </td>
              <td>
                <div class="inactive_button">
                  A-Z Publications
                </div>
              </td>
            </tr>
          </table>
        </div>
        <div class="bottom"></div>
    </div>
    <div id="search_content">
        <div class="box">
            <div class="side_bar">
            
            <form action="search.php" method="get">
          
            <input type="text" name="advset" style="display: none;" value="1"/>
                <div class="white_area_top">
                      
                    <input type="text" name="query" style="width: 190px">
                        <xsl:attribute name="value">
                            <xsl:value-of select="//wrapper/query_req" />
                        </xsl:attribute>
                    </input>
                    
                    <input name="s1" type="text" style="display:none;">
            <xsl:attribute name="value">
                <xsl:value-of select="wrapper/s1" />
            </xsl:attribute>
            </input>
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
                
                </div>
                <p class="main">
                    <input name="ft" type="checkbox">
                        <xsl:if test="//wrapper/ft">
                            <xsl:attribute name="checked">yes</xsl:attribute>
                        </xsl:if>
                    </input>
                     Full Text <br />
                    <input name="sch" type="checkbox">
                        <xsl:if test="//wrapper/sch">
                            <xsl:attribute name="checked">yes</xsl:attribute>
                        </xsl:if>
                    </input> Scholarly (Peer Reviewed) <br />
					
					<select name="sort" style="display:none">
                        <option value="date"><xsl:if test="//wrapper/sort = 'date'"><xsl:attribute name="selected">yes</xsl:attribute></xsl:if>Date</option>
                        <option value="relevance"><xsl:if test="//wrapper/sort = 'relevance'"><xsl:attribute name="selected">yes</xsl:attribute></xsl:if>Relevance</option>
                    </select>
                    
                    <table>
                        <tr>
                            <td colspan="3" style="text-align: left">
                                <b>Publication Date:</b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                From:
                            </td>
                            <td>
                                <select name="from_month">
                                    <option value="01">
                                        <xsl:if test="//wrapper/from_month = 1">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        January
                                    </option>
                                    <option value="02">
                                        <xsl:if test="//wrapper/from_month = 2">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        February
                                    </option>
                                    <option value="03">
                                        <xsl:if test="//wrapper/from_month = 3">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        March
                                    </option>
                                    <option value="04">
                                        <xsl:if test="//wrapper/from_month = 4">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        April
                                    </option>
                                    <option value="05">
                                        <xsl:if test="//wrapper/from_month = 5">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        May
                                    </option>
                                    <option value="06">
                                        <xsl:if test="//wrapper/from_month = 6">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        June
                                    </option>
                                    <option value="07">
                                        <xsl:if test="//wrapper/from_month = 7">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        July
                                    </option>
                                    <option value="08">
                                        <xsl:if test="//wrapper/from_month = 8">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        August
                                    </option>
                                    <option value="09">
                                        <xsl:if test="//wrapper/from_month = 9">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        September
                                    </option>
                                    <option value="10">
                                        <xsl:if test="//wrapper/from_month = 10">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        October
                                    </option>
                                    <option value="11">
                                        <xsl:if test="//wrapper/from_month = 11">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        November
                                    </option>
                                    <option value="12">
                                        <xsl:if test="//wrapper/from_month = 12">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        December
                                    </option>
                                </select>
                            </td>
                            <td>
                                of <input name="from_year" type="text" style="width: 50px">
                                    <xsl:attribute name="value"><xsl:value-of select="//wrapper/from_year" /></xsl:attribute>
                                </input>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                to
                            </td>
                            <td>
                                <select name="to_month">
                                    <option value="01">
                                        <xsl:if test="//wrapper/to_month = 1">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        January
                                    </option>
                                    <option value="02">
                                        <xsl:if test="//wrapper/to_month = 2">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        February
                                    </option>
                                    <option value="03">
                                        <xsl:if test="//wrapper/to_month = 3">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        March
                                    </option>
                                    <option value="04">
                                        <xsl:if test="//wrapper/to_month = 4">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        April
                                    </option>
                                    <option value="05">
                                        <xsl:if test="//wrapper/to_month = 5">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        May
                                    </option>
                                    <option value="06">
                                        <xsl:if test="//wrapper/to_month = 6">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        June
                                    </option>
                                    <option value="07">
                                        <xsl:if test="//wrapper/to_month = 7">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        July
                                    </option>
                                    <option value="08">
                                        <xsl:if test="//wrapper/to_month = 8">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        August
                                    </option>
                                    <option value="09">
                                        <xsl:if test="//wrapper/to_month = 9">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        September
                                    </option>
                                    <option value="10">
                                        <xsl:if test="//wrapper/to_month = 10">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        October
                                    </option>
                                    <option value="11">
                                        <xsl:if test="//wrapper/to_month = 11">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        November
                                    </option>
                                    <option value="12">
                                        <xsl:if test="//wrapper/to_month = 12">
                                            <xsl:attribute name="selected">yes</xsl:attribute>
                                        </xsl:if>
                                        December
                                    </option>
                                </select>
                            </td>
                            <td>
                                of <input name="to_year" type="text" style="width: 50px">
                                    <xsl:attribute name="value"><xsl:value-of select="//wrapper/to_year" /></xsl:attribute>
                                </input>
                            </td>
                        </tr>
                    </table>
                    <br />
                </p>
                <div class="white_area_bottom">
                    <input type="submit" value="Search" />
                </div>
            </form>
            
            
            <div class="mC" style="width: 220px;">
                <xsl:for-each select="//wrapper/clusterResponse/eit:ClusterCategory">
                    <div class="mH"><xsl:attribute name="onclick">toggleMenu("<xsl:value-of select="@ID"/>")</xsl:attribute>
                                    <p class="main" style="width: 200px;background-image: url( 'images/tfoot_bck.png' );font-weight: bold;">
                                        <img src="images/cluster_arrow.png"/><span style="margin-left: 25px;"><xsl:value-of select="@ID"/> </span>   
                                    </p>
                                </div>
                                <p>
                                    <div class="mL" style="display: none; padding-left:5px">
                                    <xsl:attribute name="id"><xsl:value-of select="@ID"/></xsl:attribute>
                                        <xsl:variable name="tag">
                                            <xsl:value-of select="@Tag" />
                                        </xsl:variable>
                                        <xsl:for-each select="eit:Cluster">
                                            <table style="width: 100%; border-collapse:collapse;background-color: #CCE0FF;">
                                                
                                                    <tr>
                                                    <td>
                                                       <b> <a class="mO"  style="color:#104E8B;">
                                                        <xsl:attribute name="href">
                                                        
                                                         <xsl:value-of select="concat('search.php?query=', //wrapper/query,'+AND+(',../@Tag,'+', ., ')','&amp;s1=', //wrapper/s1,'&amp;t1=', //wrapper/t1,'&amp;d1=', //wrapper/d1,'&amp;s2=', //wrapper/s2,'&amp;t2=', //wrapper/t2,'&amp;d2=', //wrapper/d2,'&amp;s3=', //wrapper/s3,'&amp;t3=', //wrapper/t3, '&amp;sort=', //wrapper/sort,'&amp;from_month=', //wrapper/from_month, '&amp;from_year=', //wrapper/from_year, '&amp;to_month=', //wrapper/to_month, '&amp;to_year=', //wrapper/to_year,'&amp;advset=1')" />
                                                        </xsl:attribute>
                                                        <xsl:value-of select="." />
                                                        </a></b>
                                                    </td>
                                                </tr>
                                            </table>
                                        </xsl:for-each>
                                    </div>
                                </p>
                </xsl:for-each>
            </div>       
        </div>
            
        
            <div class="results_box">
                <xsl:if test="1 > //wrapper/noresults">
                    <span style="padding-left: 5px"><b>Showing Results <xsl:value-of select="($page * 10) - 9"/> - <xsl:value-of select="(($page * 10) - 9) + ($totalrecs - 1)"/> of <xsl:value-of select="$hits" /></b></span>
                    | <xsl:call-template name="build_page_list"/>
                    <span style="padding-left: 450px"><b>
                    Sort by
                    <select name="sort" ONCHANGE="window.location.href=this.options[this.selectedIndex].value">
                        <option>
                        <xsl:attribute name="value">
                            <xsl:value-of select="concat('search.php?query=', //wrapper/query,'&amp;s1=', //wrapper/s1,'&amp;t1=', //wrapper/t1,'&amp;d1=', //wrapper/d1,'&amp;s2=', //wrapper/s2,'&amp;t2=', //wrapper/t2,'&amp;d2=', //wrapper/d2,'&amp;s3=', //wrapper/s3,'&amp;t3=', //wrapper/t3, '&amp;sort=Date', '&amp;from_month=', //wrapper/from_month, '&amp;from_year=', //wrapper/from_year, '&amp;to_month=', //wrapper/to_month, '&amp;to_year=', //wrapper/to_year,'&amp;advset=1')" />
                         </xsl:attribute>
                         <xsl:if test="//wrapper/sort = 'date'"><xsl:attribute name="selected">yes</xsl:attribute></xsl:if>
                            Date
                        </option>
                        <option>
                         <xsl:attribute name="value">
                            <xsl:value-of select="concat('search.php?query=', //wrapper/query,'&amp;s1=', //wrapper/s1,'&amp;t1=', //wrapper/t1,'&amp;d1=', //wrapper/d1,'&amp;s2=', //wrapper/s2,'&amp;t2=', //wrapper/t2,'&amp;d2=', //wrapper/d2,'&amp;s3=', //wrapper/s3,'&amp;t3=', //wrapper/t3, '&amp;sort=relevance', '&amp;from_month=', //wrapper/from_month, '&amp;from_year=', //wrapper/from_year, '&amp;to_month=', //wrapper/to_month, '&amp;to_year=', //wrapper/to_year,'&amp;advset=1')" />
                         </xsl:attribute>
                        <xsl:if test="//wrapper/sort = 'relevance'"><xsl:attribute name="selected">yes</xsl:attribute></xsl:if>Relevance</option>
                    </select>
                    <a href="index.php"> Refine Search</a></b></span>
                </xsl:if>
                <div class="results_area">
                    <xsl:choose>
                        <xsl:when test="1 > //wrapper/noresults">
                    <table>
                        <xsl:apply-templates select="//wrapper/searchResponse/eit:SearchResults/records/rec" />
                    </table>
                        </xsl:when>
                        <xsl:otherwise>
                            <span>Your search returned no results.</span>
                        </xsl:otherwise>
                    </xsl:choose>
                </div>
                <xsl:if test="1 > //wrapper/noresults">
                    <span style="padding-left: 5px"><b>Showing Results <xsl:value-of select="($page * 10) - 9"/> - <xsl:value-of select="(($page * 10) - 9) + ($totalrecs - 1)"/> of <xsl:value-of select="$hits" /></b></span>
                    | <xsl:call-template name="build_page_list"/>
                    <span style="padding-left: 500px"><b>
                    Sort by
                    <select name="sort" ONCHANGE="window.location.href=this.options[this.selectedIndex].value">
                        <option>
                        <xsl:attribute name="value">
                            <xsl:value-of select="concat('search.php?query=', //wrapper/query,'&amp;s1=', //wrapper/s1,'&amp;t1=', //wrapper/t1,'&amp;d1=', //wrapper/d1,'&amp;s2=', //wrapper/s2,'&amp;t2=', //wrapper/t2,'&amp;d2=', //wrapper/d2,'&amp;s3=', //wrapper/s3,'&amp;t3=', //wrapper/t3, '&amp;sort=Date', '&amp;from_month=', //wrapper/from_month, '&amp;from_year=', //wrapper/from_year, '&amp;to_month=', //wrapper/to_month, '&amp;to_year=', //wrapper/to_year,'&amp;advset=1')" />
                         </xsl:attribute>
                         <xsl:if test="//wrapper/sort = 'date'"><xsl:attribute name="selected">yes</xsl:attribute></xsl:if>
                            Date
                        </option>
                        <option>
                         <xsl:attribute name="value">
                            <xsl:value-of select="concat('search.php?query=', //wrapper/query,'&amp;s1=', //wrapper/s1,'&amp;t1=', //wrapper/t1,'&amp;d1=', //wrapper/d1,'&amp;s2=', //wrapper/s2,'&amp;t2=', //wrapper/t2,'&amp;d2=', //wrapper/d2,'&amp;s3=', //wrapper/s3,'&amp;t3=', //wrapper/t3, '&amp;sort=relevance', '&amp;from_month=', //wrapper/from_month, '&amp;from_year=', //wrapper/from_year, '&amp;to_month=', //wrapper/to_month, '&amp;to_year=', //wrapper/to_year,'&amp;advset=1')" />
                         </xsl:attribute>
                        <xsl:if test="//wrapper/sort = 'relevance'"><xsl:attribute name="selected">yes</xsl:attribute></xsl:if>Relevance</option>
                    </select>
                    <a href="index.php"> Refine Search</a></b></span>
                </xsl:if>  
            </div>
        <div style="clear: both;"></div>
        </div>
    </div>
    <div id="footer">
        <a href="http://support.ebscohost.com/eit/">Back to EBSCOhost Integration Toolkit Home</a>
    </div>
</div>
</body>
</html>

</xsl:template>



<xsl:template match="rec">
    <tr>
    <td valign="top" style="padding-top: 25px;padding-bottom: 5px;"><xsl:value-of select="@recordID" />. </td>
        <td style="width: 150px; text-align: center;">
            <div>
                <img style="border: 0px;" src="images/pdf.png" />
            </div>
            <br />
            <span style="color: #666666"><xsl:value-of select="header/controlInfo/artinfo/pubtype" /></span>
        </td>
        <td>
            <a class="title" style="color:#30773F;">
                <xsl:attribute name="href">
                    <xsl:value-of select="plink" />
                </xsl:attribute>
                <xsl:value-of select="header/controlInfo/artinfo/tig/atl" />
            </a>
            <span id="link" onMouseOver="EDSresultPopup('disp_obj','link')" onMouseOut="EDSresultPopupHalt('disp_obj')" >
                <xsl:attribute name="id"><xsl:value-of select="concat( 'link_', header/@uiTerm )" /></xsl:attribute>
                <xsl:attribute name="onMouseOver">EDSresultPopup("<xsl:value-of select="concat( 'info_', header/@uiTerm )" />", "<xsl:value-of select="concat( 'link_', header/@uiTerm )" />")</xsl:attribute>
                <xsl:attribute name="onMouseOut">EDSresultPopupHalt("<xsl:value-of select="concat( 'info_', header/@uiTerm )" />")</xsl:attribute>
                <img style="border: 0px;" src="images/details.jpg" />
            </span>
            <br />
                <table class="footcollapse" summary="CDs I listened to recently">
                    <caption></caption>
                    <tfoot>
                        <tr>
                            <th style="color:#104E8B;text-decoration: none;cursor: pointer;">Click to Check Details:</th>
                            <td colspan="2">
                            <a href="#">
                            </a>
                            </td>
                        </tr>
                    </tfoot>
                    <tbody style="display: none;">
                    <tr style="background-image: url( 'images/tfoot_bck.png' );">
                            <td align="center"><b>About <xsl:value-of select="header/controlInfo/artinfo/pubtype" /></b></td>
                            <td align="center"><b>Details</b></td>
                            <td align="center"><b>More Information</b></td>
                        </tr>
                        <tr class="odd">
                            <td style="padding-left:5px;"><b>Title : </b><xsl:value-of select="header/controlInfo/artinfo/tig/atl" /></td>
                            <td style="padding-left:5px;"><b>Journal : </b> 
                            <xsl:choose>
                                <xsl:when test="string-length(header/controlInfo/jinfo/jtl) > 0">
                                    <xsl:value-of select="header/controlInfo/jinfo/jtl" />
                                </xsl:when>
                                <xsl:otherwise>
                                    Information not available
                                </xsl:otherwise>
                            </xsl:choose></td>
                            <td style="padding-left:5px;">
                            <b>Subjects : </b><br/> 
                            <xsl:choose>
                                <xsl:when test="header/controlInfo/artinfo/su">
                                    <xsl:for-each select="header/controlInfo/artinfo/su">
                                        <xsl:value-of select="." /><br/>
                                    </xsl:for-each>
                                </xsl:when>
                                <xsl:otherwise>
                                    Information not available
                                </xsl:otherwise>
                            </xsl:choose>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td style="padding-left:5px;">
                            <b>Author : </b><br/> 
                            <xsl:choose>
                                <xsl:when test="header/controlInfo/artinfo/aug/au">
                                    <xsl:for-each select="header/controlInfo/artinfo/aug/au">
                                        <xsl:value-of select="." /><br/>
                                    </xsl:for-each>
                                </xsl:when>
                                <xsl:otherwise>
                                    Information not available
                                </xsl:otherwise>
                            </xsl:choose>
                            </td>
                            <td style="padding-left:5px;"><b>Volume : </b> 
                            <xsl:choose>
                                <xsl:when test="header/controlInfo/pubinfo/vid">
                                    <xsl:value-of select="header/controlInfo/pubinfo/vid" />    
                                </xsl:when>
                                <xsl:otherwise>
                                    Information not available
                                </xsl:otherwise>
                            </xsl:choose>
                            </td>
                            <td style="padding-left:5px;"><b>Database : </b><xsl:value-of select="header/@longDbName" /> (<xsl:value-of select="header/@shortDbName" />)</td>
                        </tr>
                        <tr class="odd">
                            <td style="padding-left:5px;"><b>Date : </b><xsl:value-of select="header/controlInfo/pubinfo/dt/@year" /></td>
                            <td style="padding-left:5px;"><b>Issue : </b> 
                            <xsl:choose>
                                <xsl:when test="header/controlInfo/pubinfo/iid">
                                    <xsl:value-of select="header/controlInfo/pubinfo/iid" />
                                </xsl:when>
                                <xsl:otherwise>
                                    Information not available
                                </xsl:otherwise>
                            </xsl:choose>
                            </td>
                            <td style="padding-left:5px;"><b>ACC. # : </b><xsl:value-of select="header/@uiTerm" /></td>
                        </tr>
                        <tr class="odd">
                            <td style="padding-left:5px;"><b>Read Through : </b> 
                            <xsl:choose>
                                <xsl:when test="string-length(header/controlInfo/artinfo/ab) > 20">
                                    <xsl:value-of select="substring( header/controlInfo/artinfo/ab, 0, 150 )" />...
                                </xsl:when>
                                <xsl:otherwise>
                                    Information not available
                                </xsl:otherwise>
                            </xsl:choose>
                            </td>
                            <td style="padding-left:5px;"><b>Page : </b> 
                            <xsl:choose>
                                <xsl:when test="header/controlInfo/artinfo/ppf">
                                    <xsl:value-of select="header/controlInfo/artinfo/ppf" />
                                </xsl:when>
                                <xsl:otherwise>
                                    Information not available
                                </xsl:otherwise>
                            </xsl:choose>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
        </td>
    </tr>
</xsl:template>

<xsl:template name="info_boxes">
    <xsl:for-each select="//wrapper/searchResponse/eit:SearchResults/records/rec">
    <div class="popup_box">
        <xsl:attribute name="id"><xsl:value-of select="concat( 'info_', header/@uiTerm )" /></xsl:attribute>
        <xsl:attribute name="onMouseOver">EDSresultPopupMOver()</xsl:attribute>
        <xsl:attribute name="onMouseOut">EDSresultPopupHalt('<xsl:value-of select="concat( 'info_', header/@uiTerm )" />')</xsl:attribute>
        <table style="width: 350px">
            <tr>
                <td style="text-align: right">
                    <b>Title: </b>
                </td>
                <td style="text-align: left">
                    <xsl:value-of select="header/controlInfo/artinfo/tig/atl" />
                </td>
            </tr>
            <xsl:if test="header/controlInfo/artinfo/aug/au">
                <tr>
                    <td style="text-align: right">
                        <b>Authors:</b>
                    </td>
                    <td style="text-align: left">
                        <xsl:for-each select="header/controlInfo/artinfo/aug/au">
                            <xsl:value-of select="." />. 
                        </xsl:for-each>
                    </td>
                </tr>
            </xsl:if>
            <tr>
                <td style="text-align: right">
                    <b>Date: </b>
                </td>
                <td style="text-align: left">
                    <xsl:value-of select="header/controlInfo/pubinfo/dt/@year" />
                </td>
            </tr>
            <xsl:if test="string-length(header/controlInfo/artinfo/ab) > 20">
                <tr>
                    <td style="text-align: right">
                        <b>Abstract:</b>
                    </td>
                    <td style="text-align: left">
                        <xsl:value-of select="substring( header/controlInfo/artinfo/ab, 0, 150 )" />...
                    </td>
                </tr>
            </xsl:if>
            <tr>
                <td colspan="2">
                    <hr />
                </td>
            </tr>
            <xsl:if test="string-length(header/controlInfo/jinfo/jtl) > 0">
            <tr>
                <td style="text-align: right">
                    <b>Journal:</b>
                </td>
                <td style="text-align: left">
                     <xsl:value-of select="header/controlInfo/jinfo/jtl" />
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    <b>Volume:</b>
                </td>
                <td style="text-align: left">
                     <xsl:value-of select="header/controlInfo/pubinfo/vid" />
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    <b>Issue:</b>
                </td>
                <td style="text-align: left">
                     <xsl:value-of select="header/controlInfo/pubinfo/iid" />
                </td>
            </tr>
            <tr style="text-align: right">
                <td>
                    <b>Page:</b>
                </td>
                <td style="text-align: left">
                     <xsl:value-of select="header/controlInfo/artinfo/ppf" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr />
                </td>
            </tr>
            </xsl:if>
            <tr>
                <td style="text-align: right">
                    <b>Database:</b>
                </td>
                <td style="text-align: left">
                    <xsl:value-of select="header/@longDbName" /> (<xsl:value-of select="header/@shortDbName" />)
                </td>
                
            </tr>
            <tr>
                <td style="text-align: right">
                    <b>Acc. #:</b>
                </td>
                <td style="text-align: left">
                    <xsl:value-of select="header/@uiTerm" />
                </td>
            </tr>
        </table>
    </div>
    </xsl:for-each>
</xsl:template>

<xsl:template name="build_page_list">
    <xsl:choose>
        <xsl:when test="$page > 1">
            <a href="javascript: history.back()" style="color:#104E8B;">Prev</a>
        </xsl:when>
        <xsl:otherwise>
            Prev
        </xsl:otherwise>
    </xsl:choose> - 
    <xsl:choose>
        <xsl:when test="$nextpage > 0">
            <a style="color:#104E8B;">
                <xsl:attribute name="href">
                    <xsl:value-of select="concat('search.php?query=', //wrapper/query,'&amp;s1=', //wrapper/s1,'&amp;t1=', //wrapper/t1,'&amp;d1=', //wrapper/d1,'&amp;s2=', //wrapper/s2,'&amp;t2=', //wrapper/t2,'&amp;d2=', //wrapper/d2,'&amp;s3=', //wrapper/s3,'&amp;t3=', //wrapper/t3, '&amp;sort=', //wrapper/sort,'&amp;from_month=', //wrapper/from_month, '&amp;from_year=', //wrapper/from_year, '&amp;to_month=', //wrapper/to_month, '&amp;to_year=', //wrapper/to_year, '&amp;ft=', //wrapper/ft/@ft, '&amp;pubtype=', //wrapper/pubtype, '&amp;sch=', //wrapper/sch/@sch ,'&amp;advset=1', '&amp;start=', $nextpage, '&amp;page=', $page + 1)" />
                </xsl:attribute>
                Next
            </a>
        </xsl:when>
        <xsl:otherwise>
            Next
        </xsl:otherwise>
    </xsl:choose> 
</xsl:template>

</xsl:stylesheet>