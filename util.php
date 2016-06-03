<?php
//Created 03.06.16 by Enrico Kaack
//
//Contains the json_xml converter and the connection handler
class Utils{


public function getConnection($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
return $result;
}

private function convertJsonToXml($json){
	return $xml;
}

}

//$utils = new Utils();
//echo($utils->getConnection("http://opendata.dbbahnpark.info/api/beta/stations"));
?>