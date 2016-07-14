<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <div class="list-group lots-list">
    <xsl:for-each select="sites/lot">   
      <xsl:variable name="id" select="generate-id()"/>
      <div id="{$id}" class="modal lotDialog" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-label="Close" data-dismiss="modal" class="close" type="button">
                <span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title">Parkplatz Nr. <xsl:value-of select="parkraumKennung"/></h4>
            </div>
            <div class="modal-body">
              <div class="markerTable">
                <table>
                  <tbody>
                    <xsl:if test="parkraumKennung[text()]"><tr><th>Name</th><td>Parkplatz Nr. <xsl:value-of select="parkraumKennung"/></td></tr></xsl:if>
                    <xsl:if test="parkraumKennung[text()]"><tr><th>Nr</th><td><xsl:value-of select="parkraumKennung"/></td></tr></xsl:if>
                    <xsl:if test="parkraumParkart[text()]"><tr><th>Parkart</th><td><xsl:value-of select="parkraumParkart"/></td></tr></xsl:if>
                    <xsl:if test="parkraumZufahrt[text()]"><tr><th>Zufahrt</th><td><xsl:value-of select="parkraumZufahrt"/></td></tr></xsl:if>
                    <xsl:if test="parkraumEntfernung[text()]"><tr><th>Entfernung</th><td><xsl:value-of select="parkraumEntfernung"/></td></tr></xsl:if>
                    <xsl:if test="parkraumStellplaetze[text()]"><tr><th>Stellplätze</th><td><xsl:value-of select="parkraumStellplaetze"/></td></tr></xsl:if>
                    <xsl:if test="category[text()]"><tr><th>Freie Stellplätze</th>
                      <td>
                        <xsl:if test="category[text()='1']">1 - 10</xsl:if>
                        <xsl:if test="category[text()='2']">11 - 30</xsl:if>
                        <xsl:if test="category[text()='3']">31 - 50</xsl:if>
                        <xsl:if test="category[text()='4']">51+</xsl:if>
                      </td>
                    </tr></xsl:if>

                    <xsl:if test="parkraumOeffnungszeiten[text()]"><tr><th>Öffnungszeiten</th><td><xsl:value-of select="parkraumOeffnungszeiten"/></td></tr></xsl:if>
                    <xsl:if test="parkraumBetreiber[text()]"><tr><th>Betreiber</th><td><xsl:value-of select="parkraumBetreiber"/></td></tr></xsl:if>
                    <xsl:if test="zahlungMedien[text()]"><tr><th>Zahlung</th><td><xsl:value-of select="zahlungMedien"/></td></tr></xsl:if>
                    <xsl:if test="tarif30Min[text()]"><tr><th>Preis für 30 Minuten</th><td><xsl:value-of select="tarif30Min"/></td></tr></xsl:if>
                    <xsl:if test="tarif1Std[text()]"><tr><th>Preis für 1 Stunde</th><td><xsl:value-of select="tarif1Std"/></td></tr></xsl:if>
                    <xsl:if test="tarif1Tag[text()]"><tr><th>Preis für 1 Tag</th><td><xsl:value-of select="tarif1Tag"/></td></tr></xsl:if>
                    <xsl:if test="tarif1Woche[text()]"><tr><th>Preis für 1 Woche</th><td><xsl:value-of select="tarif1Woche"/></td></tr></xsl:if>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-inverse" type="button">
                Schließen
              </button>
            </div>
          </div>
        </div>
      </div>
      <a
        class="list-group-item"
        data-target="#{$id}"
        data-toggle="modal"
        href="#{$id}"
        data-parkraumKennung="{parkraumKennung}"
        data-parkraumParkart="{parkraumParkart}"
        data-parkraumZufahrt="{parkraumZufahrt}"
        data-parkraumEntfernung="{parkraumEntfernung}"
        data-parkraumStellplaetze="{parkraumStellplaetze}"
        data-category="{category}"
        data-parkraumOeffnungszeiten="{parkraumOeffnungszeiten}"
        data-parkraumBetreiber="{parkraumBetreiber}"
        data-zahlungMedien="{zahlungMedien}"
        data-tarif30Min="{tarif30Min}"
        data-tarif1Std="{tarif1Std}"
        data-tarif1Tag="{tarif1Tag}"
        data-tarif1Woche="{tarif1Woche}"
      >
        <span class="badge pull-right"><xsl:value-of select="parkraumEntfernung"/> m</span>
        <img width="32" height="37" src="img/parkinggarage.png"/>
        <strong><xsl:value-of select="parkraumZufahrt"/></strong><br/>
        <xsl:if test="parkraumStellplaetze[text()]">Stellplätze: <strong><xsl:value-of select="parkraumStellplaetze"/></strong><br/></xsl:if>
        <xsl:if test="category[text()]">Freie Stellplätze:
          <strong>
            <xsl:if test="category[text()='1']">1 - 10</xsl:if>
            <xsl:if test="category[text()='2']">11 - 30</xsl:if>
            <xsl:if test="category[text()='3']">31 - 50</xsl:if>
            <xsl:if test="category[text()='4']">51+</xsl:if>
          </strong>
          <br/>
        </xsl:if>
        <xsl:if test="parkraumOeffnungszeiten[text()]">Öffnungszeiten: <strong><xsl:value-of select="parkraumOeffnungszeiten"/></strong><br/></xsl:if>
      </a>
    </xsl:for-each>
  </div>
</xsl:template>
</xsl:stylesheet>
