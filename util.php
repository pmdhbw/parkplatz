<?php
//Created 03.06.16 by Enrico Kaack
//
//Contains the json_xml converter and the connection handler
class Utils{


public function getConnection($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec($ch);
	curl_close($ch);
	return $this->convertJsonToXml($result);
}

public function convertJsonToXml($json){
	
	$array = json_decode ($json, true);
	$xml = new SimpleXMLElement("<root></root>");
	$this->arrayToXml($array, $xml);
	header('Content-Type: application/xml');
	return $xml->asXML();
}

private function arrayToXml($array, &$xml){
   foreach($array as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $xml->addChild("$key");
                $this->arrayToXml($value, $subnode);
            }else{
                $subnode = $xml->addChild("element$key");
                $this->arrayToXml($value, $subnode);
            }
        }else {
            $xml->addChild("$key",htmlspecialchars("$value"));
        }
    }
}	
}

//TESTING ONLY
//$utils = new Utils();
//echo($utils->getConnection("http://opendata.dbbahnpark.info/api/beta/stations"));



?>