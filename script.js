$(document).ready(function () {
    // Load options for stations and initialize map
    new Transformation()
            .setXml("parkplatz/web/app.php/dbstation")
            .setXslt("XSLT_Stations.xsl")
            .transform("station");
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

    //acquire XML and XSL
    var xml;
    var xsl;
    var counter = 0;
    var temp = retrieveXML(url, counter);
    counter = temp.counter;
    xml = temp.xml;
    temp = loadXSL("XSLT_Lots.xsl", counter);
    counter = temp.counter;
    xsl = temp.xsl;

    XSLTransform(xml, xsl, counter, "tablebody");
}

function retrieveXML(url, counter) {
    var xml = {counter:0,xml:null};
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            counter++;
            xml.counter = counter;
            xml.xml = xhttp.responseXML;
            return xml;
        }
    };
    xhttp.open("GET", url, false);
    xhttp.send();
}

function loadXSL(path, counter) {
    var d = new Date();
    var xsl = {counter:0,xsl:null};
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            counter++;
            xsl.counter = counter;
            xsl.xsl = xhttp.responseXML;
            return xsl;
        }
    };
    xhttp.open("GET", path + d.valueOf(), false);
    xhttp.send();
}

function XSLTransform(xml, xsl, counter, id) {
//code for IE
    if (counter === 2) {
        if (window.ActiveXObject) {
            ex = xml.transformNode(xsl);
            document.getElementById(id).innerHTML = ex;
        }
        //code for Chrome, Firefox, Opera, etc.
        else if (document.implementation && document.implementation.createDocument) {
            var myNode = document.getElementById(id);
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            xsltProcessor = new XSLTProcessor();
            xsltProcessor.importStylesheet(xsl);
            resultDocument = xsltProcessor.transformToFragment(xml, document);
            document.getElementById(id).appendChild(resultDocument);
        }
    }
}