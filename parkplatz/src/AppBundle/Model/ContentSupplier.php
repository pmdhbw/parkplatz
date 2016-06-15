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
    
	private loadGeoCoordinates(){
		//Load the list of all stations in table stations
		
		//delete elements containing geocoordinates
		
		//Loop throw all remaining elements
		
		//Call to google geocoding API
		//ATENTION: at the most of 10 requests per second
		//API-KEY: AIzaSyCqaY1zPxlWWJTZQ1eEWDB4QYOR2jBZL04
		$ch = curl_init("http://maps.googleapis.com/maps/api/geocode/json");
		$data = array (
        'key' => 'AIzaSyCqaY1zPxlWWJTZQ1eEWDB4QYOR2jBZL04',
		'address ' => '' 
        );
        
        $params = '';
		foreach($data as $key=>$value)
                $params .= $key.'='.$value.'&';
         
        $params = trim($params, '&');
	}
}
