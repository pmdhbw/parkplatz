<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <div class="list-group" data-tarif30Min="{tarif30Min}" data-tarif1Std="{tarif1Std}" data-tarif1Tag="{tarif1Tag}" data-tarif1Woche="{tarif1Woche}" data-comment="{parkraumBemerkung}">
	<xsl:for-each select="sites/lot">   

		 <div class="list-group-item"><xsl:value-of select="parkraumKennung"/></div>
            <div class="list-group-item"><xsl:value-of select="parkraumParkart"/></div>
            <div class="list-group-item"><xsl:value-of select="parkraumZufahrt"/></div>
            <div class="list-group-item"><xsl:value-of select="parkraumEntfernung"/></div>
            <div class="list-group-item"><xsl:value-of select="parkraumStellplaetze"/></div>
            <div class="list-group-item" data-value="{category}"><xsl:value-of select="text"/></div>
            <div class="list-group-item"><xsl:value-of select="parkraumOeffnungszeiten"/></div>
            <div class="list-group-item">
              <xsl:variable name="betreiber" select="parkraumBetreiber"/>
              <xsl:if test="contains($betreiber, 'www.')">
                <xsl:variable name="betreiberName" select="substring-before($betreiber, '(www.')"/>
                <xsl:value-of select="$betreiberName"/>
                (<a target="_blank">
                <xsl:attribute name="href">
                <xsl:value-of select="concat('http://', substring-before(substring-after($betreiber, '('),')'))"/>
                </xsl:attribute>Link</a>)
              </xsl:if>
              <xsl:if test="not(contains($betreiber, 'www.'))">
                <xsl:value-of select="$betreiber"/>
              </xsl:if>
            </div>
            <div class="list-group-item"><xsl:value-of select="zahlungMedien"/></div>
            <div class="list-group-item">
              <xsl:choose>
                <xsl:when test="tarif30Min = '' and tarif1Std = '' and tarif1Tag = '' and tarif1Woche = ''">Ja</xsl:when>
                <xsl:otherwise>Nein</xsl:otherwise>
              </xsl:choose>
            </div>

	</xsl:for-each>
	


</div>
	  

</xsl:template>
</xsl:stylesheet>
