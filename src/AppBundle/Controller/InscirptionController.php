<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Description of InscirptionController
 *
 * @author tom
 */
class InscirptionController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller{
    
    /**
     * @Route("/inscription2")
     */
    public function inscriptionAction(\Symfony\Component\HttpFoundation\Request $req){
        
        $dto = new \AppBundle\DTO\InscriptionDTO2();// Crée DTO
        $form = $this->createForm(\AppBundle\Form\InscriptionType2::class, $dto);// Crée formulaire
        $form->handleRequest($req);// Applique form binding
        
        if( $form->isSubmitted() && $form->isValid() ){// Si formulaire a été envoyé et valide
            
            // Ajoutera l'util en base de données
            
            $client = new \AppBundle\Entity\Client();
            $client->setLogin( $dto->getLogin() );
            $client->setMdp( $dto->getMdp1() );
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            
            return $this->render("::message.html.twig",
                    array("message"=>"Inscription réussie"));
        }
        
        // Le formulaire soit pas POSTé (cas d'un GET) ou invalide
        
        return $this->render(   "AppBundle:Inscription:inscription.html.twig",
                array("monForm"=>$form->createView() ));
            
    }
}
