<?php
//Created Torben Krieger
//Fetchs content for DB REST Service and provide them in the Database
//Keeps track of updating contant regually
namespace AppBundle\Model;

use Doctrine\ORM\Query\ResultSetMapping;

class ContentSupplier {
    private $lastUpdateTime;
    private $entityMgr;
    public function __constructor($entityMgr) {
        $this->entityMgr = $entityMgr;
        $this->checkUpdateTime('lot');
    }

    private function checkUpdateTime($table) {
        $statement = "SELECT UPDATE_TIME 
                      FROM information_schema.tables
                      WHERE TABLE_SCHEMA = 'parkplatz'
                        AND TABLE_NAME = '$table'";
        $query = $entityMgr->createQuery($statement);
        $date = $query->getResults();
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
