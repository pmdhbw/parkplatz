<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <div class="responsive-table">
    <table id="tab" class="table table-bordered">
      <thead>
        <tr>
          <th>Nr</th>
          <th>Parkart</th>
          <th>Zufahrt</th>
          <th>Entfernung</th>
          <th>Stellplätze</th>
          <th>Stellplätze frei</th>
          <th>Öffnungszeiten</th>
          <th>Betreiber</th>
          <th>Zahlung</th>
          <th>gebüh-<br/>renfrei</th>
          
        </tr>
      </thead>
      <tbody id="tablebody">  
        <xsl:for-each select="sites/lot">   
          <tr data-tarif30Min="{tarif30Min}" data-tarif1Std="{tarif1Std}" data-tarif1Tag="{tarif1Tag}" data-tarif1Woche="{tarif1Woche}" data-comment="{parkraumBemerkung}">
            <td><xsl:value-of select="parkraumKennung"/></td>
            <td><xsl:value-of select="parkraumParkart"/></td>
            <td><xsl:value-of select="parkraumZufahrt"/></td>
            <td><xsl:value-of select="parkraumEntfernung"/></td>
            <td><xsl:value-of select="parkraumStellplaetze"/></td>
            <td data-value="{category}"><xsl:value-of select="text"/></td>
            <td><xsl:value-of select="parkraumOeffnungszeiten"/></td>
            <td>
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
            </td>
            <td><xsl:value-of select="zahlungMedien"/></td>
            <td>
              <xsl:choose>
                <xsl:when test="tarif30Min = '' and tarif1Std = '' and tarif1Tag = '' and tarif1Woche = ''">Ja</xsl:when>
                <xsl:otherwise>Nein</xsl:otherwise>
              </xsl:choose>
            </td>
          </tr>
        </xsl:for-each>
      </tbody>
    </table>
  </div>
</xsl:template>
</xsl:stylesheet>
