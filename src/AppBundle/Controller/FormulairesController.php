<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FormulairesController extends Controller
{
     /**
     * Exemple avec un DTO et Objet Form externe (+entity)
     * @Route("form_ex3")
     */
    public function formEx3Action(\Symfony\Component\HttpFoundation\Request $req){
        
        $dto = new \AppBundle\DTO\RechercheDTO();
        $form = $this->createForm(\AppBundle\Form\RechercheType::class, $dto);
        
        $form->handleRequest( $req );
        if( $form->isSubmitted() && $form->isValid() ){
            
            $dto = $form->getData();// Gets data from form

            // Dynalically creates query from dto
            $qb = new \Doctrine\ORM\QueryBuilder($this->getDoctrine()->getManager());
            $qb->select("p");
            $qb->from("AppBundle:Produit", "p");
            $qb->orderBy("p.titre");
            if( $dto->getClient()!=null ){
                $qb->join("p.commandes", "cmd");
                $qb->join("cmd.client", "cli");
                $qb->andWhere("cli.id=:clientId");
                $qb->setParameter("clientId", $dto->getClient()->getId());
            }
            
            $produits = $qb->getQuery()->getResult();
            
            return $this->render(
                "AppBundle:Formulaires:formEx3_POST.html.twig",
                array("produits"=>$produits));
        }
        
        // Form not submitted or invalid
        
        return $this->render(
                "AppBundle:Formulaires:formEx3_GET.html.twig",
                array("f"=>$form->createView() ));
    }
    
    /**
     * Exemple avec un DTO
     * @Route("form_ex2")
     * @Method({"POST"})
     */
    public function formEx2POSTAction(\Symfony\Component\HttpFoundation\Request $request){
        
        // Builds the form
        $dto = new \AppBundle\DTO\CompteDTO();
        $fb = $this->createFormBuilder( $dto );
        $fb->add( "cardNumber")->add("bic")->add("iban")->add("email")->add("creationDate");
        $fb->add( "submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class );
        $form = $fb->getForm();
        
        // Process form binding
        $form->handleRequest($request);
        
        if( ! $form->isSubmitted() )
            throw new \RuntimeException ("Formulaire non envoyé!");
        if( ! $form->isValid() )
            return $this->render(
                "AppBundle:Formulaires:formEx2.html.twig",
                array("dto"=>$form->createView() ));
        
        return $this->render(
                "AppBundle:Formulaires:formEx2_POST.html.twig",
                array("dto"=>$form->getData() ));
    }
    
    /**
     * Exemple avec un DTO
     * @Route("form_ex2")
     * @Method({"GET"})
     */
    public function formEx2GetAction(){
        
        $cli = new \AppBundle\DTO\CompteDTO();
        
        $fb = $this->createFormBuilder( $cli );// Données initiales utiisées pour Form Binding ascendant
        $fb->add( "cardNumber")->add("bic")->add("iban")->add("email")->add("creationDate");
        $fb->add( "submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class );
        
        return $this->render(
                "AppBundle:Formulaires:formEx2.html.twig", 
                array("dto"=>$fb->getForm()->createView()) );
    }
    
    /**
     * Exemple avec une entité client
     * @Route("form_ex1")
     * @Method({"POST"})
     */
    public function formEx1POSTAction(\Symfony\Component\HttpFoundation\Request $request){
        
        $cli = new \AppBundle\Entity\Client();
        $fb = $this->createFormBuilder($cli);
        $fb->add( "login" );
        $fb->add( "mdp", \Symfony\Component\Form\Extension\Core\Type\PasswordType::class );
        $fb->add( "submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class );
        $form = $fb->getForm();
        
        // Form bining descendant
        $form->handleRequest($request);// Détermine si le formulaire a été soumis et a
        if( ! $form->isSubmitted() )
            throw new \RuntimeException ("Formulaire non envoyé!");
        if( ! $form->isValid() )
            return $this->render(
                "AppBundle:Formulaires:formEx1.html.twig", 
                array("monFormulaire"=>$form->createView()) );
        
        return $this->render(
                "AppBundle:Formulaires:formEx1_POST.html.twig",
                array("monClient"=>$form->getData() ));
    }
    
    /**
     * Exemple avec une entité client
     * @Route("form_ex1")
     * @Method({"GET"})
     */
    public function formEx1GetAction(){
        
        $cli = new \AppBundle\Entity\Client();
        $cli->setLogin("admin");
        $cli->setMdp("admin");
        
        $fb = $this->createFormBuilder( $cli );// Données initiales utiisées pour Form Binding ascendant
        $fb->add( "login" );
        $fb->add( "mdp", \Symfony\Component\Form\Extension\Core\Type\PasswordType::class );
        $fb->add( "submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class );
        
        return $this->render(
                "AppBundle:Formulaires:formEx1.html.twig", 
                array("monFormulaire"=>$fb->getForm()->createView()) );
    }
}
