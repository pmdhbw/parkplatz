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
    
}
