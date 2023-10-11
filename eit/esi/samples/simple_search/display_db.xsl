<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:eit="http://epnet.com/webservices/SearchService/Response/2007/07/" exclude-result-prefixes="eit">
<xsl:output method="html" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" encoding="UTF-8" media-type="text/html" />
<xsl:template match='/'>
<html>
<head>
	<title>Display Databases</title>
</head>
<body>
Please choose a database: <br />
<p>
	<xsl:apply-templates select="info/eit:dbInfo"/>
</p>
</body>
</html>
</xsl:template>

<xsl:template match="eit:db">
	<a>
		<xsl:attribute name="href">
			<xsl:value-of select="concat('search.php?db=',@shortName)" />
		</xsl:attribute>
		<xsl:value-of select="@longName"/>
	</a>
	<br />
</xsl:template>

</xsl:stylesheet>