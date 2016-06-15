<?php
//Created by Torben Krieger
//Probleme: sehr langsam durch vielzahl an Schleifen!
namespace AppBundle\Model;

class DBLot{

        private $allOccs;
        private $occMap;

        public function getLots() {
            $utils = new Utils();
            $lotXml = $utils->getConnection('http://opendata.dbbahnpark.info/api/beta/sites');
            $returnXml = new \SimpleXMLElement("<root></root>");
            $this->mapOcc();

            $allLots = $lotXml->results;
            foreach ($allLots->children() as $parkingLot) {
                    $subnode = $returnXml->addChild('parkingLot');
                    $this->filterAttributes($parkingLot, $subnode);
                    $this->appendOcc($parkingLot->parkraumId->__toString(), $subnode);
            }
            return $returnXml->asXML();
        }

        public function getLot($lot){
            $utils = new Utils();
            $lotXml = $utils->getConnection('http://opendata.dbbahnpark.info/api/beta/sites');
            $returnXml = new \SimpleXMLElement("<root></root>");

            $allLots = $lotXml->results;
            foreach ($allLots->children() as $parkingLot) {
                     if($this->hasId($lot, $parkingLot)){
                        $subnode = $returnXml->addChild('parkingLot');
                        $this->fillAttributes($parkingLot, $subnode);
                        $this->mergeCorrOcc($lot, $subnode);
                    }
            }
            
            return $returnXml->asXML();
        }

        private function mapOcc(){
            $utils = new Utils();
            $occXml = $utils->getConnection("http://opendata.dbbahnpark.info/api/beta/occupancy");
            $this->allOccs = $occXml->allocations;
            $this->occMap = array();
            $counter = 0;
            foreach ($this->allOccs->children() as $aOcc) {
                $impNode = $aOcc->site;
                $this->occMap[$impNode->flaechenNummer->__toString()] = $counter;  
                $counter++;
            }
        }

        private function appendOcc($pId, $node){
            if (array_key_exists($pId, $this->occMap)){
                $occNode = $this->allOccs->element->allocation;
                foreach ($occNode->children() as $key => $value) {
                    $node->addChild($key, htmlspecialchars($value));
                }
            }
        }

        private function mergeCorrOcc($id, &$parkingLot){
            $utils = new Utils();
            $occXml = $utils->getConnection("http://opendata.dbbahnpark.info/api/beta/occupancy/$id");
            if (!isset($occXml->code)){
                $stage1 = $occXml->allocation;
                foreach ($stage1->children() as $key => $value) {
                    $parkingLot->addChild($key, htmlspecialchars($value));
                }
            }
        }

        private function hasId($id, &$lotXml){
            if($lotXml->parkraumId == $id)
                    return true;
            return false;
        }

        private function filterAttributes(&$lotXml, &$newXml){
            $keys = array(              'parkraumBahnhofName',
                                        'parkraumGeoLatitude',
                                        'parkraumGeoLongitude',
                                        'parkraumKennung',
                                        'parkraumId'
                                 );

            foreach ($keys as $key) {
                $newXml->addChild($key, $lotXml->$key);
            }
        }

        private function fillAttributes(&$lotXml, &$newXml){
            foreach ($lotXml as $key => $value) {
                $newXml->addChild($key, $value);
            }
        }
}