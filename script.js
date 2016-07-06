$(document).ready(function () {
    // Load options for stations and initialize map
    startTransform("XSLT_Stations.xsl","parkplatz/web/app.php/dbstation","station");
});

function init(){
    //asynchronus request to start app.php/init
    //if database is old it will be refreshed here, hopefully before document ready is called
    //otherwise we rely on database integrity
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "parkplatz/web/app.php/init", true);
    xhttp.send();
}


function updateSelect() {
    //set visibility of table rows according to current selection

    //reset table to visible
    var table = document.getElementById("tab");
    for (var i = 1, row; i < table.rows.length; i++) {
        row = table.rows[i];
         row.style.display="";
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
    
    var freeofcharge = document.getElementById("freeofcharge");
    var freechecked = freeofcharge.checked;

    //set collapses
    for (var i = 1, row; i < table.rows.length; i++) {
        row = table.rows[i];
        //free parking spaces
        var cell = row.cells[5];
        if ((freeval !== "0")
                //this checks whether no data is available, then the row is hidden too
                && ((cell.dataset.value<freeval)) || (cell.dataset.value === true)) {
            row.style.display="none";
        }
        //payment options
        cell = row.cells[8];
        if ((payval !== "0") && (cell.textContent !== "")) {
            if ((payval === "1") && (cell.textContent.indexOf("EC-Karte") === -1)){
                row.style.display="none";
            }
            if ((payval === "2") && (cell.textContent.indexOf("Kreditkarte") === -1)){
                row.style.display="none";
            }
            if ((payval === "3") && (cell.textContent.indexOf(unescape("M%FCnzen")) === -1)){
                row.style.display="none";
            }
        }
        //parking house/ underground parking
        cell = row.cells[1];
        if (((housechecked) && (cell.textContent !== "") && (cell.textContent.indexOf("Parkhaus") === -1))
            && ((housechecked) && (cell.textContent !== "") && (cell.textContent.indexOf("Tiefgarage") === -1))){
            row.style.display="none";
        }
        //only free of charge
        cell = row.cells[9];
        if ((freechecked) && !(cell.textContent.trim().includes("Ja"))){
            row.style.display="none";
        }
        //open or not
        cell = row.cells[6];
        if (openchecked) {
            var firstsplit = cell.textContent.split(",");
            if (firstsplit.length === 1) { //only times are provided, every day the same
                var times = firstsplit[0].split(".");
                var time = times[0].split(" - ");
                var start = time[0].split(":");
                var end = time[1].split(":");
                end[1] = end[1].split(" ")[0];
                var jetzt = new Date();
                var open = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(),start[0], start[1], "0");
                var close = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(), end[0], end[1], "0");
                if (!(jetzt.getTime() > open.getTime() && jetzt.getTime() < close.getTime())) {
                     row.style.display="none";
                }
            } else if (firstsplit.length === 3){ //different times for weekdays, saturdays, sundays are closed
                var mo = firstsplit[0].split(": ");
                var mot = mo[1].split(" - ");
                var mostart = mot[0].split(":");
                var moend = mot[1].split(":");
                moend[1] = moend[1].split(" ")[0];
                var sa = firstsplit[1].split(": ");
                var sat = sa[1].split(" - ");
                var sastart = sat[0].split(":");
                var saend = sat[1].split(":");
                saend[1] = saend[1].split(" ")[0];
                var jetzt = new Date();
                if (jetzt.getDay === 0)
                     row.style.display="none";
                else if (jetzt.getDay === 6) {
                    var open = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(), sastart[0], sastart[1], "0");
                    var close = new Date(jetzt.getFullYear(), jetzt.getMonth(),jetzt.getDate(), saend[0], saend[1], "0");
                    if (!(jetzt.getTime > open.getTime() && jetzt.getTime() < close.getTime())){
                         row.style.display="none";
                    }
                } else {
                    var open = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(), mostart[0], mostart[1], "0");
                    var close = new Date(jetzt.getFullYear(), jetzt.getMonth(), jetzt.getDate(), moend[0], moend[1], "0");
                    if ((jetzt < open) || (jetzt > close)){
                         row.style.display="none";
                    }
                }
            }
        }
    }
}

function update() {
    //update table after selection of station or radius has changed

    //start by collecting the current data for executing the radius search
    var station = document.getElementById("station");
    var long = station.options[station.selectedIndex].dataset.longitude;
    var lat = station.options[station.selectedIndex].dataset.latitude;
    var radius = document.getElementById("radius").value;

    //concatenate URL
    var url = "?radius=" + encodeURIComponent(radius) + "&long="
            + encodeURIComponent(long) + "&lat=" + encodeURIComponent(lat);
    url = "parkplatz/web/app.php/dbrange" + url;

    //load XML from php and transformation
    startTransform("XSLT_Lots.xsl",url,"table");
}

function startTransform(xslpath,xmlurl,id){
    var xml;
    var xsl;
    var counter = 0;
    //request for loading the XML from php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            xml = xhttp.responseXML;
            counter++;
            XSLTransform(xml, xsl, counter, id);
            if (counter === 2){
                updateSelect();
            }
        }
    };
    xhttp.open("GET", xmlurl, true);
    try { xhttp.responseType = "msxml-document"; } catch (e) { }; //required in IE11
    xhttp.send();
    //request for loading the XSL as a file
    d = new Date();
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (xhttp2.readyState === 4 && xhttp2.status === 200) {
            xsl = xhttp2.responseXML;
            counter++;
            XSLTransform(xml, xsl, counter, id);
            if (counter === 2){
                updateSelect();
            }
        }
    };
    xhttp2.open("GET", xslpath + "?_=" + d.valueOf(), true);
    try { xhttp2.responseType = "msxml-document"; } catch (e) { }; //required in IE11
    xhttp2.send();
}

function XSLTransform(xml, xsl, counter, id) {
    //makes shure that both XSL and XML are loaded
    if (counter === 2) {
        //delete the current table data
        var myNode = document.getElementById(id);
        while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
        }
        //code for IE for filling
        if (window.ActiveXObject || "ActiveXObject" in window) {
            ex = xml.transformNode(xsl);
            document.getElementById(id).innerHTML = ex;
        }
        //code for Chrome, Firefox, Opera, etc. for filling 
        else if (document.implementation && document.implementation.createDocument) {
            xsltProcessor = new XSLTProcessor();
            xsltProcessor.importStylesheet(xsl);
            resultDocument = xsltProcessor.transformToFragment(xml, document);
            document.getElementById(id).appendChild(resultDocument);
        }
    }
}