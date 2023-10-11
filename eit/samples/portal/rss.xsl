<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:eit="http://epnet.com/webservices/SearchService/Response/2007/07/">
    <xsl:output method="html" encoding="UTF-8"/>
    <xsl:template match="/">
    <html>
        <head>
            <title>RSS Feed</title>
            <link rel='stylesheet' href='rss.css' type='text/css' />
        </head>
        <body style="background-color:transparent">
            <div id="header">
                        <div id="eit_logo"> </div>
                        </div>

            <div id='full_text_page'>
                
                <div id="result">
                    <xsl:apply-templates />
                </div>
            </div>
        </body>
    </html>
    </xsl:template>

    <!-- #region channel --> 
    <xsl:template match="item[position() &lt; 11]">
            <div id="links">
                <a>
                    <xsl:attribute name="href">
                        <xsl:value-of select="link" />
                    </xsl:attribute>
                    <xsl:attribute name="target">_blank</xsl:attribute>
                    <xsl:value-of select="title" /> 
                    <xsl:text> </xsl:text>

                    <xsl:variable name="pubinfo" select="substring-before(description, '&lt;')" />



                    <xsl:choose>
                        <xsl:when test="contains($pubinfo, '(')">
                            <xsl:value-of select="concat(substring-before($pubinfo, '('), substring-after($pubinfo, ')'))" />
                        </xsl:when>
                        <xsl:otherwise>
                            <xsl:value-of select="$pubinfo" />
                        </xsl:otherwise>
                    </xsl:choose>
                </a>
            </div>
    </xsl:template>
    
    <!-- hide everything we didn't match -->
    <xsl:template match="text()" />

</xsl:stylesheet>
