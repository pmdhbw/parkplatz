<?php
//created Torben Krieger
namespace AppBundle\Model;

class DBRange{
    private $doctrine;



    public function __construct($doc){
        $this->doctrine = $doc;
    }

    public function getInRadius($radius, $long, $lat){
        //implemented with a sphere!! - not so exact but good enough for PM
        //first select all elements in a sqaure from the db
        //Erdradius im Mittel (SI: Meter)
        $earthRadius = 6371000.785;
        $radius = $radius * 1000;
        $vec = new Vector3();
        $left = new Vector3();
        $left->buildFromGeo($earthRadius, $long, $lat);
        $right = new Vector3();
        $right->buildFromGeo($earthRadius, $long, $lat);

        $vec->build($radius, -$radius, 0);
        //var_dump($vec);
        $left->add($vec);
        $vec->build(-$radius, $radius, 0);
        //var_dump($vec);
        $right->add($vec);

        $geoLeft = $left->buildApproxGeo($earthRadius);
        $geoRight = $right->buildApproxGeo($earthRadius);

        //jetzt enthält geoLeft und geoRight die Eckdaten eines ungefähren Quadrats
        //mit der doppelten Kantenlänge des Radius --> dh alle Elemente des Radius 
        //müssen auch in diesem Quadrat liegen! --> select mit dieser Box
        $em = $this->doctrine->getManager();
        //to get more attributes add column in select statement
        //bis jetzt nur parkplätze gesucht
        //var_dump($geoLeft->getLatDeg());
        //var_dump($geoLeft->getLongDeg());
        //var_dump($geoRight->getLatDeg());
        //var_dump($geoRight->getLongDeg());
        $query = $em->createQuery(
            "SELECT l.parkraumId, l.parkraumBahnhofName, l.parkraumGeoLatitude,
                    l.parkraumGeoLongitude, l.parkraumKennung, l.parkraumKennung, l.parkraumParkart,
                    l.validData, l.category, l.parkraumStellplaetze, l.parkraumOeffnungszeiten, l.parkraumBetreiber,
                    l.zahlungMedien, l.parkraumBemerkung, l.tarif30Min, l.tarif1Std, l.tarif1Tag, l.tarif1Woche,
                    l.text 
             FROM AppBundle:Lot l
             WHERE l.parkraumGeoLongitude >= ".$geoLeft->getLongDeg()." AND l.parkraumGeoLatitude >= ".$geoLeft->getLatDeg()." AND 
                    l.parkraumGeoLongitude <= ".$geoRight->getLongDeg()." AND l.parkraumGeoLatitude <= ".$geoRight->getLatDeg());
        $lots = $query->getResult();
        //var_dump($lots);
        $dblot = new DBLot($this->doctrine);
        return $dblot->objectToXml($lots)->asXML();
    }

}

class Vector3{
        public $x1;
        public $x2;
        public $x3;

        public function build($x1, $x2, $x3){
            $this->x1 = $x1;
            $this->x2 = $x2;
            $this->x3 = $x3;
        }

        public function buildFromGeo($rad, $long, $lat){
            $geo = new Geo();
            $geo->setLongDeg($long);
            $geo->setLatDeg($lat);

            $this->x1 = $rad * cos($geo->getLatRad()) * cos($geo->getLongRad());
            $this->x2 = $rad * cos($geo->getLatRad()) * sin($geo->getLongRad());
            $this->x3 = $rad * sin($geo->getLatRad());
        }

        public function buildApproxGeo($radius){
            $geo = new Geo();
            $geo->setLongRad(atan2($this->x2, $this->x1));
            $geo->setLatRad(acos($this->x2/($radius*sin($geo->getLongRad()))));
            return $geo;
        }

        public function add($vec){
            $this->x1 += $vec->x1;
            $this->x2 += $vec->x2;
            $this->x3 += $vec->x3;
        }
}

class Geo{
    private $long;
    private $lat;

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