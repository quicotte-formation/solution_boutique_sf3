<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestTomController extends Controller
{

    /**
     * @Route("/qb")
     */
    public function queryBuilderAction(){
        
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
        $qb->select("cmd");
        $qb->from("AppBundle:Commande", "cmd");
        $qb->join("cmd.client", "cli");
        $qb->where("cli.id=:cliId");
        $qb->setParameter("cliId", 1);
        
        $res = $qb->getQuery()->getResult();
    }
    
    /**
     * @Route("/json")
     */
    public function jsonAction(){
        
        $clients = $this->getDoctrine()->getRepository("AppBundle:Client")->findAll();
        
        $tabRes = array();
        foreach ($clients as $client){
            $tabRes[] = array( 
                'id'=>$client->getId(),
                'login'=>$client->getLogin() );
        }
        
        return $this->json( $tabRes );
    }
    
    /**
     * @Route("/response")
     */
    public function createResponseAction(){
        
        return new \Symfony\Component\HttpFoundation\Response("<html><body>Coucou</body></html>");
    }
    
    /**
     * @Route("/forward")
     */
    public function forwardAction(){
        
        // Renvoie vers l'action TestTomController:createResponseAction
        return $this->forward("AppBundle:TestTom:createResponse", array('p1=>val1', 'p2=>val2'));
    }
}
