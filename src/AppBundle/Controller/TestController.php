<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends Controller
{
    /**
     * @Route("/com_cli_1_prod_1", name="com_cli_1_prod_1")
     */
    public function listerCommandesClient1Prod1Action(){
        
        // Requete DB
        $dlq = ""
                . "SELECT   cmd "
                . "FROM     AppBundle:Commande cmd "
                . "         JOIN cmd.client cli "
                . "         JOIN cmd.produits prod "
                . "WHERE    cli.id=1 "
                . "         AND prod.id=1";
        $commandes = $this->getDoctrine()->getManager()->createQuery( $dlq )->getResult();
        
        // Renvoie vers vue twig
        return $this->render("AppBundle:Test:com_cli_1_prod_1.html.twig", 
                array( "commandes"=>$commandes ));
    }


    /**
     * @Route("/lister_produits", name="lister_produits")
     */
    public function listerProduitsAction(){
        
        // Récup ts produits en DB
        $produitsRepo = $this->getDoctrine()->getRepository("AppBundle:Produit");
        $produits = $produitsRepo->findAll();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits,
                      'titre'=>"Liste de ts les produits"));
    }
    
    /**
     * @Route("/lister_prod_par_cat_id", name="lister_prod_par_cat_id")
     */
    public function prodParCatAction(){
        
        // Recup produits par catid en BD
        $em = $this->getDoctrine()->getManager();
        $produits = $em->createQuery("SELECT p FROM AppBundle:Produit p JOIN p.categories c WHERE c.id=2")->getResult();
        
        // Envoie la var 'mesProduits' 
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits,
                      'titre'=>"Liste des produits d'id 2"));
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
