<?php
//Created Torben Krieger
//Fetchs content for DB REST Service and provide them in the Database
//Keeps track of updating contant regually
namespace AppBundle\Model;

use Doctrine\ORM\Query\ResultSetMapping;

class ContentSupplier {
    private $lotLifetime = 15*60;
    private $masterLifetime = 7*24*60*60; 

    private $lastUpdateTime;
    private $entityMgr;
    private $dbCon;
    public function __construct($entityMgr, $dbCon) {
        $this->entityMgr = $entityMgr;
        $this->dbCon = $dbCon;
    }

    public function refresh(){
        if((time() - $this->checkUpdateTime('lot')) > $this->lotLifetime ){

        }

        if((time() - $this->checkUpdateTime('masterstation')) > $this->masterLifetime ){

        }
    }

    private function checkUpdateTime($table) {
        $statement = "SELECT time_created 
                      FROM $table
                      LIMIT 1";
        $time = $this->dbCon->fetchAll($statement);
        return $time;
    }
	
	private function loadStationList(){
		$list = array();
			
		$ch = curl_init("http://data.deutschebahn.com/datasets/haltestellen/D_Bahnhof_2016_01_alle.csv");
		$result = curl_exec($ch
		
		$rows = explode("\n", $result);
		foreach($rows as $item){
			$cell = explode(";", $item);
			$entity = new MasterStation();
			$entity->setBahnhofsNummer($cell[0]);
			$entity->setName($cell[2]);
			$entity->setLongitude($cell[4]);
			$entity->setLatitude($cell[5]);
			$entity->setTime(time());
			$list[] = $entity;
		}
		
		//TODO: write on DB after succesfull testing
	}
    
	//Deprecated
	private function loadGeoCoordinates(){
		//Load the list of all stations in table stations
		$repository = $entityMgr->getRepository('AppBundle:station');
		
		//Loop throw all remaining elements
		foreach ($repository as $element){
			//Call to google geocoding API
			//ATENTION: at the most of 10 requests per second
			//API-KEY: AIzaSyCqaY1zPxlWWJTZQ1eEWDB4QYOR2jBZL04
			$ch = curl_init();
			generateCurl($ch, $element->getStreet().','.$element->getPlz().' '.$element->getCityTitle());
			$result = curl_exec($ch);
		}

	}
	
	private function generateCurl($ch, $adress){
	$data = array (
        'key' => 'AIzaSyCqaY1zPxlWWJTZQ1eEWDB4QYOR2jBZL04',
		'address' => $adress 
        );
        
        $params = '';
		foreach($data as $key=>$value)
                $params .= $key.'='.$value.'&';
         
        $params = trim($params, '&');
		
		curl_setopt($ch, CURLOPT_URL, "http://maps.googleapis.com/maps/api/geocode/json".'?'.$params );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	}
}
