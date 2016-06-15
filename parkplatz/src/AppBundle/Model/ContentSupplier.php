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
    
}
