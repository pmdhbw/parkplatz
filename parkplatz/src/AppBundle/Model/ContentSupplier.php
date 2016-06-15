<?php
//Created Torben Krieger
//Fetchs content for DB REST Service and provide them in the Database
//Keeps track of updating contant regually
namespace AppBundle\Model;


class ContentSupplier {
    private $lastUpdateTime;
    public function __constructor(){
        $this->checkUpdateTime();
    }

    private function checkUpdateTime(){
        $dbmanager = 0;
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
