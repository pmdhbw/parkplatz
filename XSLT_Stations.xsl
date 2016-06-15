<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
    <select>
      <xsl:for-each select="parkingLot/parkraumBahnhofName"> <--- TODO: insert correct node --->
      
      <option><xsl:value-of select="title"/></option>
    
      
      </xsl:for-each>
    </select>

</xsl:template>
</xsl:stylesheet>