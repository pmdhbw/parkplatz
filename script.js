$(document).ready(function() {
  // Load options for stations.
  new Transformation()
  .setXml("/parkplatz/web/app_dev.php/dblot")
  .setXslt("/XSLT_Stations.xsl")
  .transform("station");
});
