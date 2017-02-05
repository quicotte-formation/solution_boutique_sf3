<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SolutionSecuriteController extends Controller {

    /**
     * @Route("/programmaticSecu", name="programmaticSecu")
     */
    public function programmaticSecuAction(){
        $this->denyAccessUnlessGranted( 'ROLE_ADMIN' );
        
        return $this->render('AppBundle:SolutionSecurite:secu1.html.twig', array(
                        // ...
        ));
    }
    
    /**
     * @Route("login", name="login")
     */
    public function loginAction() {
        
        // Récupère service d'authentification
        $authenticationUtils = $this->get('security.authentication_utils');

        // Récupère dernière err de login si existe
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier nom d'util entré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        // Renvoie vers le formulaire de login
        return $this->render('AppBundle:SolutionSecurite:login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => $error,
        ));
    }

    /**
     * @Route("/anonSecu1")
     */
    public function anonSecu1Action() {
        return $this->render('AppBundle:SolutionSecurite:secu1.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/userSecu1")
     */
    public function userSecu1Action() {
        return $this->render('AppBundle:SolutionSecurite:secu2.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/adminSecu3")
     */
    public function adminSecu3Action() {

        return $this->render('AppBundle:SolutionSecurite:admin_secu3.html.twig', array(
                        // ...
        ));
    }

    /**
     * @Route("/adminSecu4")
     */
    public function adminSecu4Action() {
        return $this->render('AppBundle:SolutionSecurite:admin_secu4.html.twig', array(
                        // ...
        ));
    }

}
