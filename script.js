$(document).ready(function() {
  // Load options for stations and initialize map
  new Transformation()
  .setXml("parkplatz/web/app.php/dbstation")
  .setXslt("XSLT_Stations.xsl")
  .transform("station");
});

function updateSelect(){
  //set visibility of table rows according to current selection

  //reset table to visible
  var table = document.getElementById("tab");
  for (var i=0, row; row = table.rows[i];i++){
  row.style.display = "inline";
  }

  //declaration of variables for settings
  var free = document.getElementById("free");
  var freeval = free.options[free.selectedIndex].value;
  
  var pay = document.getElementById("pay");
  var payval = pay.options[pay.selectedIndex].value;

  var house = document.getElementById("house");
  var housechecked = house.checked;

  var open = document.getElementById("open");
  var openchecked = open.checked;

  //set collapses
  for (var i = 0, row; row = table.rows[i]; i++) {
    var cell = row.cells[5];
    if (cell.value = freeval){
      row.style.display = "none";
    }
    cell = row.cells[8];
    if ((cell.text.indexOf(val))>-1){
      row.style.display = "none";
    }
    cell = row.cells[1];
    if (housechecked && (cell.text.indexOf("Parkhaus")>-1)){
      row.style.display = "none";
    }
    cell = row.cells[9];
    if (openchecked && (cell.text.indexOf("24 Stunden, 7 Tage")=-1)){
      row.style.display = "none";
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
          row.style.display = "none";
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
          row.style.display = "none";
        else if (jetzt.getDay = 6){
          var open= (jetzt.getFullYear, jetzt.getMonth, sastart[0], sastart[1],0 );
          var close= (jetzt.getFullYear, jetzt.getMonth, saend[0], saend[1],0);
          if (!(jetzt.getTime>open.getTime && jetzt.getTime<close.getTime))
          row.style.display = "none";
        }
        else {
          var open= (jetzt.getFullYear, jetzt.getMonth, mostart[0], mostart[1],0 );
          var close= (jetzt.getFullYear, jetzt.getMonth, moend[0], moend[1],0);
          if (!(jetzt.getTime>open.getTime && jetzt.getTime<close.getTime))
          row.style.display = "none";
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

  //open xhttprequest
  if (window.XMLHttpRequest) {
        var xhttp = new XMLHttpRequest();
    }
  else { //IE
        var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
  xhttp.open("POST","parkplatz/web/app.php/dbrange", false);
  //send data
  xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhttp.send(str);
  //listen for answer from php and post data into table
  xhttp.onreadystatechange=function(){
    if (xhttp.readyState == 4){
        if(xhttp.status != 200){
            alert ("Es ist ein Fehler aufgetreten beim Senden der Daten");
        }
        else if (xhttp.status == 200){
          var xml = xhttp.responseText;
          var xsl = loadXMLDoc("XSL_Lots.xsl");
          XSLTransform(xml, xsl, "tablebody");
        }
    }
  };
}




//XSL Transformation functions for testing with update() function
//will be deleted if tests fail and framework used instead

function loadXMLDoc(filename){
  //loads XML Document from file
  if (window.ActiveXObject){ //IE
    var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  else{ //rest
    var xhttp = new XMLHttpRequest();
  }
  xhttp.open("GET", filename, false);
  try {xhttp.responseType = "msxml-document"} catch(err) {} //throws error on IE11
  xhttp.send("");
  return xhttp.responseXML;
}

function XSLTransform(xml, xsl, id){
//does xsl transformation on xml and pastes it into the note with id
//xml and xsl have to be STRINGS
//code for IE
  if (window.ActiveXObject){
    ex = xml.transformNode(xsl);
    document.getElementById(id).innerHTML = ex;
  }
//code for Chrome, Firefox, Opera, etc.
  else if (document.implementation && document.implementation.createDocument){
    xsltProcessor = new XSLTProcessor();
    xsltProcessor.importStylesheet(xsl);
    resultDocument = xsltProcessor.transformToFragment(xml, document);
    document.getElementById(id).appendChild(resultDocument);
  }
}