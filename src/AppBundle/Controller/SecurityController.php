<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class SecurityController extends Controller
{
    /**
     * @Route("secuByController")
     */
    public function secuByControllerAction(){
        
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        
        return $this->render('AppBundle:Security:firewall.html.twig', array(
            // ...
        ));
    }


    /**
     * @Route("/secuByAnnotation")
     * @Security("has_role('ROLE_USER')")
     */
    public function secuByAnnotationAction(){
        
        return $this->render('AppBundle:Security:firewall.html.twig', array(
            // ...
        ));
    }
    
    /**
     * @Route("/firewall")
     */
    public function firewallAction()
    {
        return $this->render('AppBundle:Security:firewall.html.twig', array(
            // ...
        ));
    }

}
