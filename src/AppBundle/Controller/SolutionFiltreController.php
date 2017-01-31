<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SolutionFiltreController extends Controller {

    /**
     * @Route("/solutionFiltre")
     */
    public function solutionFiltreAction(\Symfony\Component\HttpFoundation\Request $req) {
        // Crée DTO et l'associe à mon form
        $dto = new \AppBundle\DTO\FiltreDTO();
        $form = $this->createForm(\AppBundle\Form\FiltreType::class, $dto);

        // Form binding
        $form->handleRequest($req);

        // Crée query bulder
        $qb = new \Doctrine\ORM\QueryBuilder($this->getDoctrine()->getManager());
        $qb     ->select("p")
                ->from("AppBundle:Produit", "p")
                ->join ("p.commandes", "cmd")
                ->orderBy("p.titre");

        if( $dto->getClient()!=null )
                $qb->join ("cmd.client", "cli")
                ->andWhere ("cli.id=:cliId")
                ->setParameter("cliId", $dto->getClient()->getId());
        
        if( $dto->getDateMin()!=null )
            $qb->andWhere ("cmd.dateheureCreation>=:dateheureMin")->setParameter ("dateheureMin", $dto->getDateMin ());
        
        if( $dto->getDateMax()!=null )
            $qb->andWhere ("cmd.dateheureCreation<=:dateheureMax")->setParameter ("dateheureMax", $dto->getDateMax ());

        $produits = $qb->getQuery()->getResult();

        // Rendu
        return $this->render('AppBundle:SolutionFiltre:solution_filtre.html.twig', array(
                    "monForm" => $form->createView(),
                    "produits" => $produits
        ));
    }

}
