<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{
    /**
     * @Route("/lister_produits")
     */
    public function listerProduitsAction(){
        
        // Récup ts produits en DB
        $produitsRepo = $this->getDoctrine()->getRepository("AppBundle:Produit");
        $produits = $produitsRepo->findAll();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits));
    }
    
    /**
     * @Route("")
     */
    public function prodParCatAction(){
        
    }
    
    /**
     * @Route("/lister_tous_clients")
     */
    public function test1Action()
    {
        return $this->render('AppBundle:Test:lister_tous_clients.html.twig', array(
            // ...
        ));
    }

}
