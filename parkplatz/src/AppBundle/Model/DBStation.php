<?php
//Created by Torben Krieger 

namespace AppBundle\Model;

class DBStation{
    private $doctrine;
    private $workingNode;

    public function __construct(){
        $utils = new Utils();
        $this->stationXml = $utils->getConnection('http://opendata.dbbahnpark.info/api/beta/stations');
    }

    public function getStation($id){
        
    }

    public function getStations(){
        return $this->stationXml->asXML();
    }

}