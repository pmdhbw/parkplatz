<?php
//Created by Torben Krieger
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Exception;

use AppBundle\Model\DBLot;
use AppBundle\Model\DBStation;
use AppBundle\Model\DBRange;
use AppBundle\Model\ContentSupplier;
use AppBundle\Entity\Lot;
use AppBundle\Entity\MasterStation;
use AppBundle\Entity\Station;

class MapController extends Controller
{
    /**
     * @Route("/dblot/{lot}", defaults={"lot" = -1}, name="db_parkinglots")
     */
    public function getParkingLot($lot){

        $this->init(); //can be removed as far as frontend uses /init route
        $csup = new ContentSupplier($this->getDoctrine()->getManager(), $this->get('database_connection'));
        $dbLot= new DBLot($this->getDoctrine());
        $rspString = '';
        if($lot == -1) // return all
        {
            $rspString = $dbLot->getDBLots();
            
        } else { // return only the wished lot
            $rspString = $dbLot->getDBLot($lot);
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

        $this->init(); //can be removed as far as frontend uses /init route
        $dbStation = new DBStation($this->getDoctrine());
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

    /**
     * @Route("/init", name="init_data")
     */
    public function init(){ //kritische perfomance probleme 
        $this->checkDB();
        $csup = new ContentSupplier($this->getDoctrine()->getManager(), $this->get('database_connection'));
        $csup->refresh();
    }

    //url: /dbrange?radius={in km}&lat={geoLatitude}&long={geoLongitude}
    /**
    * @Route("/dbrange", name="db_range")
    */
    public function getRange(Request $req){
        $this->init();
        $geoLong = $req->query->get('lat');
        $geoLat = $req->query->get('long');
        $radius = $req->query->get('radius');
        if(isset($geoLong) && isset($geoLat) && isset($radius)){
            if(is_numeric($geoLong) && is_numeric($geoLat) && is_numeric($radius)){
                $dbrange = new DBRange($this->getDoctrine());
                $xmlString = $dbrange->getInRadius((float) $radius, (float) $geoLong, (float) $geoLat);
                return new Response(
                    $xmlString,
                    200,
                    array('Content-Type' => 'application/XML')
                );
            }
        }
        return new Response(
            "Malformed Parameters - should be: /dbrange?radius={in km}&long={geoLongitude}&lat={geoLatitude}",
            400
        );
    }


    private function checkDB() { //achtung veränderungen vom db model werden nicht registriert/reloaded
        try {
            $schemaManager = $this->getDoctrine()->getConnection()->getSchemaManager();
            $tables = $schemaManager->listTables();
            $countOfTables = 0;
            foreach ($tables as $table){
                if($table->getName() == "lot" || $table->getName() == "station" || $table->getName() == "masterstation"){
                    $countOfTables++;
                }
            }

            if($countOfTables != 3){
                $this->execCommand(array("command" => "doctrine:schema:update", "--force" => true));
            }
        } catch ( Exception $ex) {
            $this->execCommand(array("command" => "doctrine:database:create"));
            $this->execCommand(array("command" => "doctrine:schema:update", "--force" => true));
        }

    }

    private function execCommand($command){
        $kernel = $this->get('kernel');
        $application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
        $application->setAutoExit(false);
        $application->run(new \Symfony\Component\Console\Input\ArrayInput($command));
    }
}