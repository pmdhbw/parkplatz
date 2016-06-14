<?php
//Created by Torben Krieger / 11.06.2013
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Exception;

use AppBundle\Model\DBLot;
use AppBundle\Model\DBStation;
use AppBundle\Entity\Lot;
use AppBundle\Entity\MasterStation;
use AppBundle\Entity\Station;

class MapController extends Controller
{
    /**
     * @Route("/dblot/{lot}", defaults={"lot" = -1}, name="db_parkinglots")
     */
    public function getParkingLot($lot){

        $this->checkDB();
        $dbLot= new DBLot();
        $rspString = '';
        if($lot == -1) // return all
        {
            $rspString = $dbLot->getLots();
            
        } else { // return only the wished lot
            $rspString = $dbLot->getLot($lot);
        }
        return new Response(
            $rspString,
            200,
            array('Content-Type' => 'application/XML')
        );
    }

    //ACHTUNG!!!: DBStation für spezielle ID noch nicht implementiert!
    /**
     * @Route("/dbstation/{station}", defaults={"station" = -1}, name="db_stations")
     */
    public function getStations($station){

        $this->checkDB();
        $dbStation = new DBStation();
                $rspString = '';
        if($station == -1) // return all
        {
            $rspString = $dbStation->getStations();
            
        } else { // return only the wished lot
            $rspString = $dbLot->getStation($station);
        }
        return new Response(
            $rspString,
            200,
            array('Content-Type' => 'application/XML')
        );
    }

    private function checkDB() {
        try {
        $schemaManager = $this->getDoctrine()->getConnection()->getSchemaManager();
            $tables = $schemaManager->listTables();
            $countOfTables = 0;
            foreach ($tables as $table){
                if($table->getName() == "lot" || $table->getName() == "station" || $table->getName() == "masterstation"){
                    $countOfTables++;
                }
            }

            if($countOfTables < 3){
                $this->execCommand(array("command" => "doctrine:schema:update","--force" => true));
            }
        } catch ( Exception $ex) {
            $this->execCommand(array("command" => "doctrine:database:create"));
            $this->execCommand(array("command" => "doctrine:schema:update","--force" => true));
        }

    }

    private function execCommand($command){
        $kernel = $this->get('kernel');
        $application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
        $application->setAutoExit(false);
        $application->run(new \Symfony\Component\Console\Input\ArrayInput($command));
    }
}