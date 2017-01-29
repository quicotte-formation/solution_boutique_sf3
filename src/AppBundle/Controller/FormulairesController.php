<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FormulairesController extends Controller
{
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
