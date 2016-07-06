<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
      <option data-longitude="10.188076" data-latitude="51.314118">Bitte auswählen</option>
      <xsl:for-each select="dbstations/dbstation">      
      <option data-longitude="{stationGeoLongitude}" data-latitude="{stationGeoLatitude}"><xsl:value-of select="station"/></option>   
      </xsl:for-each>
</xsl:template>
</xsl:stylesheet>
