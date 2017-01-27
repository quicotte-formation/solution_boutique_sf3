<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SolutionsDQLController extends Controller
{
    /**
     * @Route("/ex1")
     */
    public function ex1Action()
    {
        $dql = ""
                . "SELECT   p "
                . "FROM     AppBundle:Produit p "
                . "WHERE    p.prix BETWEEN 100 AND 5000";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
        
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$res,
                      'titre'=>"Liste de ts les produits"));
    }

    /**
     * @Route("/ex2")
     */
    public function ex2Action()
    {
        $dql = ""
                . "SELECT   p "
                . "FROM     AppBundle:Produit p "
                . "WHERE    p.id IN (1,2,3)";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
        
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$res,
                      'titre'=>"Liste de ts les produits"));
    }
    
    /**
     * @Route("/ex3")
     */
    public function ex3Action()
    {
        $dql = ""
                . "SELECT   co "
                . "FROM     AppBundle:Commande co "
                . "         JOIN co.client c "
                . "WHERE    c.login='Antoine'";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
    
        return $this->render("AppBundle:Test:lister_commandes.html.twig",
                array('resultats'=>$res));
        
    }
    
    /**
     * @Route("/ex4")
     */
    public function ex4Action()
    {
        $dql = ""
                . "SELECT   co "
                . "FROM     AppBundle:Commande co "
                . "         JOIN co.client c "
                . "WHERE    c.login='Wars' "
                . "ORDER BY co.dateheureCreation";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
    }
    
    /**
     * @Route("/ex5")
     */
    public function ex5Action()
    {
        $dql = ""
                . "SELECT   p "
                . "FROM     AppBundle:Produit p "
                . "         JOIN p.commandes cmd "
                . "         JOIN cmd.client cli "
                . "WHERE    cli.login='Florence' "
                . "ORDER BY p.titre";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
    }
    
    /**
     * @Route("/ex6")
     */
    public function ex6Action()
    {
        $dql = ""
                . "SELECT   c "
                . "FROM     AppBundle:Commande c "
                . "         JOIN c.produits cp "
                . "WHERE    cp.titre='Pelle'";

        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
    
        return $this->render("AppBundle:Test:lister_commandes.html.twig",
                array('resultats'=>$res));
    }
    
    
    
    /**
     * @Route("/ex7")
     */
    public function ex7Action()
    {
        $dql = ""
                . "SELECT   p "
                . "FROM     AppBundle:Produit p "
                . "         JOIN p.commandes c";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
        
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$res,
                      'titre'=>"Liste de ts les produits"));
    }
    
    /**
     * @Route("/ex8")
     */
    public function ex8Action()
    {
        $dql = ""
                . "SELECT   p "
                . "FROM     AppBundle:Produit p "
                . "WHERE    p NOT IN ("
                . "             SELECT  pr "
                . "             FROM    AppBundle:Produit pr "
                . "             JOIN    pr.commandes cmd )"
                . "         ";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
        
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$res,
                      'titre'=>"Liste de ts les produits"));
    }
    
    /**
     * @Route("/ex9")
     */
    public function ex9Action()
    {
        $dql = ""
                . "SELECT   pro "
                . "FROM     AppBundle:Produit pro "
                . "         JOIN pro.commandes co "
                . "         JOIN co.client cl "
                . "WHERE    cl.login='Florence' "
                . "         AND pro.id NOT IN ("
                . "             SELECT  prod.id "
                . "             FROM    AppBundle:Produit prod "
                . "                     JOIN prod.commandes com "
                . "                     JOIN com.client cli "
                . "             WHERE cli.login='Trump')"
                . "         ";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
        
        return $this->render("AppBundle:Test:lister_produits.html.twig",
                array('mesProduits'=>$res,
                      'titre'=>"Liste de ts les produits"));
    }
    
    /**
     * @Route("/ex10")
     */
    public function ex10Action()
    {
        $dql = ""
                . "SELECT   COUNT(cmd.id) nbProd, p produit "
                . "FROM     AppBundle:Produit p "
                . "         LEFT JOIN p.commandes cmd "
                . "GROUP BY p.id "
                . "ORDER BY p.titre";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
        return $this->render("AppBundle:Test:ex10.html.twig",
                array('resultats'=>$res));
        
    }
    
    /**
     * @Route("/ex11")
     */
    public function ex11Action()
    {
        $dql = ""
                . "SELECT   COUNT(cmd.id) nbProd, p produit "
                . "FROM     AppBundle:Produit p "
                . "         JOIN p.commandes cmd "
                . "GROUP BY p.id "
                . "HAVING   nbProd>1 AND nbProd>=2 "
                . "ORDER BY p.titre";
        
        $res = $this->getDoctrine()->getManager()->createQuery($dql)->getResult();
        return $this->render("AppBundle:Test:ex10.html.twig",
                array('resultats'=>$res));
        
    }
}
