<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form;

/**
 * Description of FiltreType
 *
 * @author tom
 */
class FiltreType extends \Symfony\Component\Form\AbstractType{

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        
        $builder->add(  "client", 
                        \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, 
                        array("class"=>"AppBundle:Client", "required"=>false))
                ->add(  "dateMin", 
                        \Symfony\Component\Form\Extension\Core\Type\DateType::class,
                        array("required"=>false))
                ->add(  "dateMax", 
                        \Symfony\Component\Form\Extension\Core\Type\DateType::class,
                        array("required"=>false))
                ->add("submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
    }

}
