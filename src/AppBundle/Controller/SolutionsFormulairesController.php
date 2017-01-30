<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SolutionsFormulairesController extends Controller
{
    /**
     * @Route("/inscription")
     */
    public function inscriptionAction(\Symfony\Component\HttpFoundation\Request $req)
    {
        $dto = new \AppBundle\DTO\InscriptionDTO();
        $form = $this->createForm(\AppBundle\Form\InscriptionType::class, $dto);
        $form->handleRequest($req);

        if( $form->isSubmitted() && $form->isValid() )
            return $this->render ("AppBundle:SolutionsFormulaires:ok.html.twig");
        
        return $this->render('AppBundle:SolutionsFormulaires:inscription.html.twig', array(
            "f"=>$form->createView()
        ));
    }

}
