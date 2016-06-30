$(document).ready(function () {
    // Load options for stations and initialize map
    startTransform("XSLT_Stations.xsl","parkplatz/web/app.php/dbstation","station");
});

function updateSelect() {
    //set visibility of table rows according to current selection

    //reset table to visible
    var table = document.getElementById("tab");
    for (var i = 1, row; i < table.rows.length; i++) {
        row.style.visibility = "visible";
        row = table.rows[i];
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
    for (var i = 1, row; i < table.rows.length; i++) {
        row = table.rows[i];
        var cell = row.cells[5];
        if ((freeval !== "egal") && (cell.value !== freeval)) {
            row.style.visibility = "hidden";
        }
        cell = row.cells[8];
        if ((payval !== "egal") && (cell.text.indexOf(payval) === -1)) {
            row.style.visibility = "hidden";
        }
        cell = row.cells[1];
        if ((housechecked) && (cell.text.indexOf("Parkhaus") === -1)) {
            row.style.visibility = "hidden";
        }
        cell = row.cells[9];
        if (openchecked && (cell.text.indexOf("24 Stunden, 7 Tage") === -1)) {
            row.style.visibility = "hidden";
        } else if (openchecked) {
            var firstsplit = cell.split(",");
            if (firstsplit.length === 1) {
                var times = firstsplit[0].split(".");
                var time = times[0].split(" - ");
                var start = time[0].split(":");
                var end = time[1].split(":");
                var jetzt = new Date();
                var open = (jetzt.getFullYear, jetzt.getMonth, start[0], start[1], 0);
                var close = (jetzt.getFullYear, jetzt.getMonth, end[0], end[1], 0);
                if (!(jetzt.getTime > open.getTime && jetzt.getTime < close.getTime)) {
                    row.style.visibility = "hidden";
                }
            } else {
                var mo = firstsplit[0].split(": ");
                var mot = mo[1].split(" - ");
                var mostart = mot[0].split(":");
                var moend = mot[1].split(":");
                var sa = firstsplit[1].split(": ");
                var sat = sa[1].split(" - ");
                var sastart = sat[0].split(":");
                var saend = sat[1].split(":");
                var jetzt = new Date();
                if (jetzt.getDay === 0)
                    row.style.visibility = "hidden";
                else if (jetzt.getDay === 6) {
                    var open = (jetzt.getFullYear, jetzt.getMonth, sastart[0], sastart[1], 0);
                    var close = (jetzt.getFullYear, jetzt.getMonth, saend[0], saend[1], 0);
                    if (!(jetzt.getTime > open.getTime && jetzt.getTime < close.getTime))
                        row.style.visibility = "hidden";
                } else {
                    var open = (jetzt.getFullYear, jetzt.getMonth, mostart[0], mostart[1], 0);
                    var close = (jetzt.getFullYear, jetzt.getMonth, moend[0], moend[1], 0);
                    if (!(jetzt.getTime > open.getTime && jetzt.getTime < close.getTime))
                        row.style.visibility = "hidden";
                }
            }
        }
    }
}

function update() {
    //update map after selection of station or radius has changed

    //start by collecting the current data for executing the radius search
    var station = document.getElementById("station");
    var long = station.options[station.selectedIndex].dataset.longitude;
    var lat = station.options[station.selectedIndex].dataset.latitude;
    var radius = document.getElementById("radius").value;

    //concatenate URL
    var url = "?radius=" + encodeURIComponent(radius) + "&long="
            + encodeURIComponent(long) + "&lat=" + encodeURIComponent(lat);
    url = "parkplatz/web/app.php/dbrange" + url;

    //Transformation
    startTransform("XSLT_Lots.xsl",url,"table");
}

function startTransform(xslpath,xmlurl,id){
    var xml;
    var xsl;
    var counter = 0;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            xml = xhttp.responseXML;
            counter++;
            XSLTransform(xml, xsl, counter, id);
        }
    };
    xhttp.open("GET", xmlurl, true);
    xhttp.send();

    d = new Date();
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (xhttp2.readyState === 4 && xhttp2.status === 200) {
            xsl = xhttp2.responseXML;
            counter++;
            XSLTransform(xml, xsl, counter, id);
        }
    };
    xhttp2.open("GET", xslpath + "?_=" + d.valueOf(), true);
    xhttp2.send();
}

function XSLTransform(xml, xsl, counter, id) {
//code for IE
    if (counter === 2) {
        var myNode = document.getElementById(id);
        while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
        }
        //code for IE
        if (window.ActiveXObject) {
            ex = xml.transformNode(xsl);
            document.getElementById(id).innerHTML = ex;
        }
        //code for Chrome, Firefox, Opera, etc.
        else if (document.implementation && document.implementation.createDocument) {
            xsltProcessor = new XSLTProcessor();
            xsltProcessor.importStylesheet(xsl);
            resultDocument = xsltProcessor.transformToFragment(xml, document);
            document.getElementById(id).appendChild(resultDocument);
        }
    }
}