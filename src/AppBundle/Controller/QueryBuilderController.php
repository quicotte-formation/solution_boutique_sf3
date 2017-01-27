<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class QueryBuilderController extends Controller {

    /**
     * @Route("/qb")
     */
    public function qbAction() {
        
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
//        $qb = new \Doctrine\ORM\QueryBuilder();
        $qb->select("p");
        $qb->from("AppBundle:Produit", "p");
        $qb->join("p.commandes", "cmd");
        $qb->join("cmd.client", "cli");
        $qb->andWhere("cli.login LIKE :login");
        $qb->andWhere("p.prix BETWEEN :min AND :max");
        $qb->setParameter("login", "%War%");
        $qb->setParameter("min", 50);
        $qb->setParameter("max", 5000);
        $query = $qb->getQuery();
        $produits = $query->getResult();
        
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$produits,
                      'titre'=>"Liste de ts les produits"));
    }

}
