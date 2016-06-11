<?php
//Created by Torben Krieger / 11.06.2013
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use  AppBundle\Model\DBLot;

class MapController extends Controller
{
    /**
     * @Route("/dblot/{lot}", defaults={"lot" = -1}, name="db_parkinglots")
     */
    public function getParkingLot($lot){
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


}