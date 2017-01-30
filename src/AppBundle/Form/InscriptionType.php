<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form;

/**
 * Description of InscriptionType
 *
 * @author tom
 */
class InscriptionType extends \Symfony\Component\Form\AbstractType{
    
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        
        $builder->add("login")
                ->add("email")
                ->add("mdp1", \Symfony\Component\Form\Extension\Core\Type\PasswordType::class)
                ->add("mdp2", \Symfony\Component\Form\Extension\Core\Type\PasswordType::class)
                ->add("submit", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
    }

}
