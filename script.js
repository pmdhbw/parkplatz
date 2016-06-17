$(document).ready(function() {
  // Load options for stations.
  new Transformation()
  .setXml("parkplatz/web/app_dev.php/dblot")
  .setXslt("XSLT_Stations.xsl")
  .transform("station");
});

function updateSelect(){

  //zurücksetzen der Tabelle auf visible
  var table = document.getElementById("tab");
  for (var i = 0, row; row = table.rows[i];i++)
  row.style.visibility = "visible"

  //check for free setting
  var e = document.getElementById("free");
	var val = e.options[e.selectedIndex].value;
  for (var i = 0, row; row = table.rows[i]; i++) {
    var cell = row.cells[5]
    if (cell.value = val) {
    row.style.visibility = "collapse"
    }
  }
  //check for pay setting
  e = document.getElementById("pay");
  val = e.options[e.selectedIndex].text;
  for (var i = 0, row; row = table.rows[i]; i++) {
      var cell = row.cells[5]
      if ((cell.text.indexOf(val))>-1){
      row.style.visibility = "collapse"
      }
  }
  //check for Parkhaus
  e = document.getElementById("house");
  val = e.options[e.selectedIndex].checked;
  for (var i = 0, row; row = table.rows[i]; i++) {
      var cell = row.cells[5]
      if ((cell.text.indexOf("Parkhaus"))>-1){
      row.style.visibility = "collapse"
      }
  }
  //check for open
  //IMPLEMENT
}
