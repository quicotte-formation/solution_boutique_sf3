<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
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
