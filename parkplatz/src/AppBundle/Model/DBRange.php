<?php
//created Torben Krieger
namespace AppBundle\Model;

class DBRange{
    private $doctrine;
    private $geoOrg;


    public function __construct($doc){
        $this->doctrine = $doc;
    }

    public function getInRadius($radius, $lat, $long){
        $radius = $radius;
    
        $geoRight = new Geo();
        $geoRight->setLatDeg($lat);
        $geoRight->setLongDeg($long);
        $geoRight->move($radius, $radius);

        $geoLeft = new Geo();
        $geoLeft->setLatDeg($lat);
        $geoLeft->setLongDeg($long);
        $geoLeft->move(-$radius, -$radius);

        $em = $this->doctrine->getManager();

        $query = $em->createQuery(
            "SELECT l.parkraumId, l.parkraumBahnhofName, l.parkraumGeoLatitude,
                    l.parkraumGeoLongitude, l.parkraumKennung, l.parkraumKennung, l.parkraumParkart,
                    l.validData, l.parkraumEntfernung, l.category, l.parkraumStellplaetze, l.parkraumOeffnungszeiten, l.parkraumBetreiber,
                    l.zahlungMedien, l.parkraumBemerkung, l.tarif30Min, l.tarif1Std, l.tarif1Tag, l.tarif1Woche,
                    l.text 
             FROM AppBundle:Lot l
             WHERE l.parkraumGeoLongitude >= ".$geoLeft->getLongDeg()." AND l.parkraumGeoLatitude >= ".$geoLeft->getLatDeg()." AND 
                    l.parkraumGeoLongitude <= ".$geoRight->getLongDeg()." AND l.parkraumGeoLatitude <= ".$geoRight->getLatDeg());
        $lots = $query->getResult();
        $result = array();

        $this->geoOrg = new Geo();
        $this->geoOrg->setLatDeg($lat);
        $this->geoOrg->setLongDeg($long);
        $xml = new \SimpleXmlElement("<sites></sites>");

        $dblot = new DBLot($this->doctrine);
        foreach ($lots as $lot) {
            if($this->proofRadiusLot($lot, $radius)){
                $dblot->addChildXml($lot, $xml);
            }
        }

        $query = $em->createQuery(
            "SELECT s 
             FROM AppBundle:Station s
             WHERE s.stationGeoLongitude >= ".$geoLeft->getLongDeg()." AND s.stationGeoLatitude >= ".$geoLeft->getLatDeg()." AND 
                   s.stationGeoLongitude<= ".$geoRight->getLongDeg()." AND s.stationGeoLatitude <= ".$geoRight->getLatDeg());
        $stations = $query->getResult();
        $dbstation = new DBStation($this->doctrine);
        foreach ($stations as $station) {
            if($this->proofRadiusStation($station, $radius)){
                $dbstation->addChildXml($station, $xml);
            }
        }
        // var_dump($result);
        
        return $xml->asXML();
    }

    private function proofRadiusLot(&$lot, $rad){
        $geoSite = new Geo();
        $geoSite->setLatDeg($lot['parkraumGeoLatitude']);
        $geoSite->setLongDeg($lot['parkraumGeoLongitude']);
        $distance = $geoSite->getDistanceTo($this->geoOrg);
        if($distance <= $rad){
            $lot['parkraumEntfernung'] = (Integer) $distance;
            return true;
        }
        return false;
    }

    private function proofRadiusStation($station, $rad){
        $geoSite = new Geo();
        $geoSite->setLongDeg($station->stationGeoLongitude);
        $geoSite->setLatDeg($station->stationGeoLatitude);
        if($geoSite->getDistanceTo($this->geoOrg) <= $rad){
            return true;
        }
        return false;
    }
   
}

class Geo{
    private $long;
    private $lat;

    public function move($difLat, $difLong){
        if(isset($this->lat, $this->long)){
            $latPm = 1/(111.32 * 1000);
            $longPm = 1/(111.32*1000*cos($this->lat));
            $this->setLatDeg($this->getLatDeg() + $difLat * $latPm);
            $this->setLongDeg($this->getLongDeg() + $difLong * $longPm);
        }
    }

    public function getDistanceTo(&$geo){
        $earthRadius = 6371000.785;
        $cosg = sin($this->lat) * sin($geo->lat) + cos($this->lat) * cos($geo->lat) * cos($geo->long - $this->long);
        return $earthRadius*acos($cosg);
    }

    public function getLongRad(){
        return $this->long;
    }
    public function getLongDeg(){
        return $this->long * 180 / M_PI;
    }
    public function getLatRad(){
        return $this->lat;
    }
    public function getLatDeg(){
        return $this->lat * 180 / M_PI;
    }

    public function setLongRad($var){
        $this->long = $var;
    }
    public function setLongDeg($var){
        $this->long = $var * M_PI / 180;
    }
    public function setLatRad($var){
        $this->lat = $var;
    }
    public function setLatDeg($var){
        $this->lat = $var * M_PI / 180;
    }
}