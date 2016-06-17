<?php
//Created by Enrico Kaack
//
//Contains the json_xml converter and the connection handler
namespace AppBundle\Model; 
class Utils{


public function getConnection($url){
	return $this->convertJsonToXml(json_encode($this->runService($url))); //chaged --> returns now the xml object and not the string! TK
}

public function runService($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec($ch);
	curl_close($ch);
	return json_decode($result); //chaged --> returns now object and not the string! TK
}

public function convertJsonToXml($json){
	$array = json_decode ($json, true);
	$xml = new \SimpleXMLElement("<root></root>");
	$this->arrayToXml($array, $xml);
	return $xml;  //chaged --> returns now the xml object and not the string! TK
}

public function objectToXml($obj){
    $xml = new \SimpleXMLElement("<root></root>");
	$this->arrayToXml($obj, $xml);
	return $xml;
}

private function arrayToXml($array, &$xml){
   foreach($array as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $xml->addChild($key);
                $this->arrayToXml($value, $subnode);
            }else{
                $subnode = $xml->addChild("element");  //stop inserting useless elements TK
                $this->arrayToXml($value, $subnode);
            }
        }else {
            $xml->addChild($key,htmlspecialchars((string) $value));
        }
    }
}	
}

//TESTING ONLY
// $utils = new Utils();
// header('Content-Type: application/xml');
// echo($utils->getConnection("http://opendata.dbbahnpark.info/api/beta/occupancy"));



?>