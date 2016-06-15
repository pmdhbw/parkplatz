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
    
}
