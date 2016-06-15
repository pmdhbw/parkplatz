function init() {
  $.ajax({
    url: "/parkplatz/web/app_dev.php/dblot",
    context: document.body
  }).done(function(param) {
    console.log("done");
	writeHTML(param, "/XSLT_Stations.xsl", station)
  });
}

function mapinit() {				//initialize map for first display
	
}

function update() {					//update map (id="map") and table on bottom of page (id="tablebody")
	
															//!!!!!!! mapcode
	
	writeHTML(xml, xslfortable, tablebody)					//!!!!!!!insert parkinglot XML and corresponding XSLT
	
}

function loadXMLDoc(filename)		//used for init function to open XML Document
{
if (window.ActiveXObject)
  {
  xhttp = new ActiveXObject("Msxml2.XMLHTTP");
  }
else 
  {
  xhttp = new XMLHttpRequest();
  }
xhttp.open("GET", filename, false);
try {xhttp.responseType = "msxml-document"} catch(err) {} // Helping IE11
xhttp.send("");
return xhttp.responseXML;
}

function writeHTML(xml, xsl, id)					//takes
{
xsl = loadXMLDoc(xsl);
// code for IE
if (window.ActiveXObject || xhttp.responseType == "msxml-document")
  {
  ex = xml.transformNode(xsl);
  document.getElementById(id).innerHTML = ex;									//inserted id of field to input
  }
// code for Chrome, Firefox, Opera, etc.
else if (document.implementation && document.implementation.createDocument)
  {
  xsltProcessor = new XSLTProcessor();
  xsltProcessor.importStylesheet(xsl);
  resultDocument = xsltProcessor.transformToFragment(xml, document);
  document.getElementById(id).appendChild(resultDocument);							//inserted id of field to input
  }
}