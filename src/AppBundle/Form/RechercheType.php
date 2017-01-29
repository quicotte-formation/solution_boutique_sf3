<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form;

/**
 * Description of RechercheType
 *
 * @author tom
 */
class RechercheType extends \Symfony\Component\Form\AbstractType{

    private function createProduitQueryBuilder(\Doctrine\ORM\EntityRepository $er){
        
        return $er->createQueryBuilder("p")->orderBy("p.titre");
    }
    
    private function createClientQueryBuilder(\Doctrine\ORM\EntityRepository $er){
        
        return $er->createQueryBuilder("c")->orderBy("c.login");
    }
    
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        
        $builder    ->add("client", \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, 
                        array(  "class"=>"AppBundle\Entity\Client", 
                                "required"=>false,
                                "query_builder"=>function(\Doctrine\ORM\EntityRepository $er){
                                    
                                    return $this->createClientQueryBuilder($er);
                                } ))
                    ->add("dateCommandeMin", \Symfony\Component\Form\Extension\Core\Type\DateType::class, array("required"=>false) )
                    ->add("dateCommandeMax", \Symfony\Component\Form\Extension\Core\Type\DateType::class, array("required"=>false) )
                    ->add("produit", \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, 
                            array(  "class"=>"AppBundle\Entity\Produit",
                                    "required"=>false,
                                    "query_builder"=>function(\Doctrine\ORM\EntityRepository $er){
                                           
                                        return $this->createProduitQueryBuilder($er);
                                    }))
                    ->add("submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
    }

}
