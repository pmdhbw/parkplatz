$(document).ready(function() {
  // Load options for stations and initialize map
  new Transformation()
  .setXml("parkplatz/web/app.php/dblot")
  .setXslt("XSLT_Stations.xsl")
  .transform("station");
});

function updateSelect(){
  //set visibility of table rows according to current selection

  //reset table to visible
  var table = document.getElementById("tab");
  for (var i=0, row; row = table.rows[i];i++){
  row.style.visibility = "visible";
  }

  //declaration of variables for settings
  var free = document.getElementById("free");
  var freeval = free.options[free.selectedIndex].value;
  
  var pay = document.getElementById("pay");
  var payval = pay.options[pay.selectedIndex].value;

  var house = document.getElementById("house");
  var housechecked = house.options[house.selectedIndex].checked;

  var open = document.getElementById("open");
  var openchecked = open.options[open.selectedIndex].checked;

  //set collapses
  for (var i = 0, row; row = table.rows[i]; i++) {
    var cell = row.cells[5];
    if (cell.value = freeval){
      row.style.visibility = "collapse";
    }
    cell = row.cells[8];
    if ((cell.text.indexOf(val))>-1){
      row.style.visibility = "collapse";
    }
    cell = row.cells[1];
    if (housechecked && (cell.text.indexOf("Parkhaus")>-1)){
      row.style.visibility = "collapse";
    }
    cell = row.cells[9];
    if (openchecked && (cell.text.indexOf("24 Stunden, 7 Tage")=-1)){
      row.style.visibility = "collapse";
    }
    else if (openchecked) {
      var firstsplit = cell.split(",")
      if (firstsplit.length = 1){
        var times = firstsplit[0].split(".");
        var time = times[0].split(" - ");
        var start = time[0].split(":");
        var end = time[1].split(":");
        var jetzt = new Date();
        var open= (jetzt.getFullYear, jetzt.getMonth, start[0], start[1],0 );
        var close= (jetzt.getFullYear, jetzt.getMonth, end[0], end[1],0);
        if (!(jetzt.getTime>open.getTime && jetzt.getTime<close.getTime)){
          row.style.visibility = "collapse";
        }
      }
      else{
        var mo = firstsplit[0].split(": ");
        var mot = mo[1].split(" - ");
        var mostart = mot[0].split(":");
        var moend = mot[1].split(":");
        var sa = firstplit[1].split(": ");
        var sat = sa[1].split(" - ");
        var sastart = sat[0].split(":");
        var saend = sat[1].split(":");
        var jetzt = new Date();
        if (jetzt.getDay = 0)
          row.style.visibility = "collapse";
        else if (jetzt.getDay = 6){
          var open= (jetzt.getFullYear, jetzt.getMonth, sastart[0], sastart[1],0 );
          var close= (jetzt.getFullYear, jetzt.getMonth, saend[0], saend[1],0);
          if (!(jetzt.getTime>open.getTime && jetzt.getTime<close.getTime))
          row.style.visibility = "collapse";
        }
        else {
          var open= (jetzt.getFullYear, jetzt.getMonth, mostart[0], mostart[1],0 );
          var close= (jetzt.getFullYear, jetzt.getMonth, moend[0], moend[1],0);
          if (!(jetzt.getTime>open.getTime && jetzt.getTime<close.getTime))
          row.style.visibility = "collapse";
        }
      }
    }
  }
}

function update(){
  //update map after selection of station or radius has changed

  //start by collecting the current data for executing the radius search
  var station = document.getElementById("station");
  var long = station.getAttribute("data-longitude");
  var lat = station.getAttribute("data-latitude");
  var radius = document.getElementById("radius").value;

  var str = "?radius=" + encodeURIComponent(radius) + "&long="
  + encodeURIComponent(long) + "&lat=" + encodeURIComponent(lat);

  //open httprequest
  if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
  else { 
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
  xmlhttp.open("POST","parkplatz/web/app.php/dbrange", true);
  //send data
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlhttp.send(str);
  //listen for answer from php and post data into table
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState == 4){
        if(xmlhttp.status != 200){
            alert ("Es ist ein Fehler aufgetreten beim Senden der Daten");
        }
        else if (xmlhttp.status == 200){
          var content = xmlhttp.responseText;
          var tablebody = document.getElementById("tablebody");
          tablebody.innerHTML = content;
        }
    }
  };
}