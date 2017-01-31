<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Doctrine\ORM\QueryBuilder;

class FormController extends Controller {

    /**
     * @Route("/filtre")
     */
    public function filtreAction(\Symfony\Component\HttpFoundation\Request $req) {

        // Crée objet Form à partir du Type et du DTO
        $dto = new \AppBundle\DTO\FiltreDTO(); // Création DTO
        $form = $this->createForm(\AppBundle\Form\FiltreType::class, $dto);

        // Form bining
        $form->handleRequest($req);

        $produits = array();
        if ($form->isSubmitted() && $form->isValid()) {// Formulaire a été posté et valide
            
            // Crée requete en fonction des critères de filtre utilisateur
            $qb = new QueryBuilder($this->getDoctrine()->getManager());
            $qb->select("p")->from("AppBundle:Produit", "p");

            if ($dto->getProduit() != null) {
                $qb->andWhere("p.id=:prodId");
                $qb->setParameter("prodId", $dto->getProduit()->getId());
            }
            
            // Exécution requête
            $produits = $qb->getQuery()->getResult();
        }


        return $this->render('AppBundle:Form:filtre.html.twig', array(
                    "monFormulaire" => $form->createView(),
                    "mesProduits" => $produits
        ));
    }

}
