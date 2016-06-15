function init() {
  $.ajax({
    url: "/parkplatz/web/app_dev.php/dblot",
    context: document.body
  }).done(function(param) {
    console.log("done");
	  writeHTML(param, "/XSLT_Stations.xsl", station)
  });
}


function mapinit() {			                                   	//initialize map for first display
	
}

function update() {				                                  	//update map (id="map") and table on bottom of page (id="tablebody")
	
														    	//!!!!!!! mapcode

//-----------------------------------------------------------------------------------------------------------

function loadXMLDoc(filename)                                 //used for init function to open XML Document
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
try {xhttp.responseType = "msxml-document"} catch(err) {}     // Helping IE11
xhttp.send("");
return xhttp.responseXML;
}

function writeHTML(xml, xsl, id)				                    	//takes xml and xsl and id of object to insert html at this point
{
xsldoc = loadXMLDoc(xsl);
xmldoc = xml;
// code for IE
if (window.ActiveXObject || xhttp.responseType == "msxml-document")
  {
  ex = xmldoc.transformNode(xsl);
  document.getElementById(id).innerHTML = ex;									//insert parsed HTML as innerHTML of id
  }
// code for Chrome, Firefox, Opera, etc.
else if (document.implementation && document.implementation.createDocument)
  {
  xsltProcessor = new XSLTProcessor();
  xsltProcessor.importStylesheet(sxldoc);
  resultDocument = xsltProcessor.transformToFragment(xmldoc, document);
  document.getElementById(id).appendChild(resultDocument);		 //insert pares HTML as innerHTML of id
  }
}