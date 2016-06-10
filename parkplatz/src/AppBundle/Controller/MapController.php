<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// require '../util.php';

class MapController extends Controller
{
    /**
     * @Route("/dblots", name="db_parkinglots")
     */
    public function view(Request $req){
        // $utils = new Util();
        
        // return new Response(
        //     $utils->getConnection("http://opendata.dbbahnpark.info/api/beta/stations"),
        //     200,
        //     array('Content-Type' => 'application/XML')
        // );
        return new Response("Hello World from Map!");
    }
}