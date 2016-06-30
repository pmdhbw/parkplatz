<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
		<table id="tab">
			<thead>
				<tr>
					<th>Name</th>
					<th>Parkart</th>
					<th>Zufahrt</th>
					<th>Entfernung</th>
					<th>Stellplätze</th>
					<th>Stellplätze frei</th>
					<th>Öffnungszeiten</th>
					<th>Betreiber</th>
					<th>Zahlung</th>
					<th>Bemerkungen</th>
				</tr>
			</thead>
			<tbody id="tablebody">	
      <xsl:for-each select="sites/lot">   
		<tr>
			<td><xsl:value-of select="parkraumKennung"/></td>
			<td><xsl:value-of select="parkraumParkart"/></td>
			<td><xsl:value-of select="parkraumBahnhofName"/></td>
			<td><xsl:value-of select="parkraumEntfernung"/></td>
			<td><xsl:value-of select="parkraumStellplaetze"/></td>
			<td><xsl:value-of select="text"/></td>
			<td><xsl:value-of select="parkraumOeffnungszeiten"/></td>
			<td><xsl:value-of select="parkraumBetreiber"/></td>
			<td><xsl:value-of select="zahlungMedien"/></td>
			<td><xsl:value-of select="parkraumBemerkung"/></td>	
		</tr>
      </xsl:for-each>
	  	</tbody>
		</table>
</xsl:template>
</xsl:stylesheet>
