<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
      <xsl:for-each select="sites/lot">   
		<tr data-tarif30Min="{tarif30Min}" data-tarif1Std="{tarif1Std}" data-tarif1Tag="{tarif1Tag}" data-tarif1Woche="{tarif1Woche}">
			<td><xsl:value-of select="parkraumBahnhofName"/></td>
			<td><xsl:value-of select="parkraumParkart"/></td>
			<td><xsl:value-of select="parkraumBahnhofName"/>TBD</td>
			<td><xsl:value-of select="parkraumEntfernung"/></td>
			<td><xsl:value-of select="parkraumStellplaetze"/></td>
			<td><xsl:value-of select="text"/></td>
			<td><xsl:value-of select="parkraumOeffnungszeiten"/></td>
			<td><xsl:value-of select="parkraumBetreiber"/></td>
			<td><xsl:value-of select="zahlungMedien"/></td>
			<td><xsl:value-of select="parkraumBemerkung"/></td>	
		</tr>
      </xsl:for-each>
</xsl:template>
</xsl:stylesheet>
