<?php
//Created by Torben Krieger 

namespace AppBundle\Model;

class DBStation{
    private $doctrine;

    public function __construct($doc){
        $this->doctrine = $doc;
        
    }

    public function getStation($id){
		$repo = $this->doctrine->getRepository('AppBundle:Station');
        $station = $repo->find($id);
        return $this->objectToXml($station)->asXML();
    }

    public function getStations(){
       $em = $this->doctrine->getManager();
        //to get more attributes add column in select statement
        $repo = $this->doctrine->getRepository('AppBundle:Station');
        $stations = $repo->findAll();
        return $this->objectToXml($stations)->asXML();
    }

	
	private function objectToXml(&$stations){
	$xml = new \SimpleXmlElement("<stations></stations>");
	if(is_array($stations)){
		foreach ($stations as $station) {
			$this->addChildXml($station, $xml);
		}
	} else {
		$this->addChildXml($stations, $xml);
	}
	return $xml;
    }
	
	private function addChildXml(&$station, &$xml){
		$child = $xml->addChild("station");
		foreach ($station as $key => $value) {
			$child->addChild($key, htmlspecialchars((string) $value));
		}
    }
}