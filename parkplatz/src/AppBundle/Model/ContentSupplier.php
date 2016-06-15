<?php
//Created Torben Krieger
//Fetchs content for DB REST Service and provide them in the Database
//Keeps track of updating contant regually
namespace AppBundle\Model;

use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Model\Utils;
use AppBundle\Entity\Lot;
use AppBundle\Entity\MasterStation;
use AppBundle\Entity\Station;

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
			$this->updateDBData();
        }

        if((time() - $this->checkUpdateTime('masterstation')) > $this->masterLifetime ){

        }
    }

    private function checkUpdateTime($table) {
        $statement = "SELECT time_created 
                      FROM $table
                      LIMIT 1";
        $res = $this->dbCon->fetchAll($statement);
		$time = &$res[0];
        return $time["time_created"];
    }

	private function updateDBData(){
		//empty table
		$statement = "DELETE FROM lot";
        $this->dbCon->query($statement);

		$util = new Utils();
		$dbLots = $util->runService('http://opendata.dbbahnpark.info/api/beta/sites');
		$dboccs = $util->runService('http://opendata.dbbahnpark.info/api/beta/occupancy');
		$occ_map = $this->buildMap($dboccs);

		foreach ($dbLots->results as $dblot) {
			$lot = new Lot();
			foreach ($dblot as $name => $value) {
				$func = 'set'.$this->makeGenericFuncName($name);
				$lot->$func($value); //generic call of getter and setter
				//add occ data if exists
				if(array_key_exists($dblot->parkraumId, $occ_map)){
					$dbocc = $dboccs->allocations[$occ_map[$dblot->parkraumId]]->allocation;
					$lot->setValidData($dbocc->validData);
					$lot->setTimestamp($dbocc->timestamp);
					$lot->setTimeSegment($dbocc->timeSegment);
					$lot->setCategory($dbocc->category);
					$lot->setText($dbocc->text);
				}
				$lot->setTimeCreated(time());
				
			}
			$this->entityMgr->persist($lot);
		}
		$this->entityMgr->flush();
	}

	//builds map to determine existing occ data
	private function buildMap(&$dboccs){
		$count = 0;
		$map = array();
		foreach ($dboccs->allocations as $occElm) {
			$map[$occElm->site->id] = $count;
			$count++;
		}
		return $map;
	}

	//generates the funcname for get/set out of the member object (without get or set)
	private function makeGenericFuncName($name){ 
		$firstLetter = substr($name, 0, 1);
		$func = strtoupper($firstLetter).substr($name, 1);
		$func = str_replace('_e', 'E', $func);
		return $func;
	}
	
	private function loadStationList(){
		$list = array();
			
		$ch = curl_init("http://data.deutschebahn.com/datasets/haltestellen/D_Bahnhof_2016_01_alle.csv");
		$result = curl_exec($ch);
		
		$rows = \explode("\n", $result);
		foreach($rows as $item){
			$cell = \explode(";", $item);
			$entity = new MasterStation();
			$entity->setBahnhofsNummer($cell[0]);
			$entity->setName($cell[2]);
			$entity->setLongitude($cell[4]);
			$entity->setLatitude($cell[5]);
			$entity->setTime(time());
			$list[] = $entity;
		}
		
		// TODO: write on DB after succesfull testing
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
