<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:template match="/">
  <html>
  <body>
  <h2>Discografica</h2>
<table border="1">
<tr bgcolor="#9acd32">
<th>Album</th>
<th>Grupo</th>
<th>Generos</th>
<th>Integrantes</th>
<th>Precio</th>
</tr>
<xsl:for-each select="/discografica/albumes/album">
<tr>
<td bgcolor="cyan"><xsl:value-of select="@nombre"/></td>
<td bgcolor="yellow"><xsl:value-of select="grupo"/></td>
<td bgcolor="green"><xsl:value-of select="generos"/></td>
<td bgcolor="pink"><xsl:value-of select="integrantes"/></td>
<td bgcolor="blue"><xsl:value-of select="precio"/></td>
</tr>
</xsl:for-each>
</table>



  <h2>Grupos ordenados alfabeticamente</h2>
  <xsl:for-each select="/discografica/albumes/album">
  <xsl:sort case-order="Aa-Zz"/>
  <p><xsl:value-of select="grupo"/></p>
  </xsl:for-each>
  
  
  <h2>Albumes ordenados por precio</h2>
  <xsl:for-each select="/discografica/albumes/album">
  <xsl:sort select="precio"/>
  <p><xsl:value-of select="@nombre"/> = <xsl:value-of select="precio"/></p>
  </xsl:for-each>
  
<h2>Albumes con duracion mayor a 50 minutos en verde y menores en rojo</h2>
<table border="1">
<tr bgcolor="#9acd32">
<th>Nombre</th>
<th>Duracion</th>
</tr>
<xsl:for-each select="/discografica/albumes/album">
<tr>
<td><xsl:value-of select="@nombre"/></td>
<xsl:choose>
<xsl:when test="duracion >= 50">
<td bgcolor="green">
<xsl:value-of select="duracion"/>
</td>
</xsl:when>
<xsl:otherwise>
<td bgcolor="red">
<xsl:value-of select="duracion"/>
</td>
</xsl:otherwise>
</xsl:choose>
</tr>
</xsl:for-each>
  </table>

  <h2>Estado actual de los grupos</h2>
  <xsl:for-each select="/discografica/albumes/album">
  <xsl:sort select="estado"/>
  <ul>
  <li><xsl:value-of select="grupo"/> = <xsl:value-of select="estado"/></li>
  </ul>
  </xsl:for-each>
</body>
  </html>
  </xsl:template>
</xsl:stylesheet>
