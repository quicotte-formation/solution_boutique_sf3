<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DTO;

use Symfony\Component\Validator\Constraints\Expression;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Callback;

/**
 * @Expression("this.getMdp1()==this.getMdp2()", message="Les mdp doivent être identiques")
 * Description of InscriptionDTO
 *
 * @author tom
 */
class InscriptionDTO {
    
    /**
     * @NotBlank
     * @Length(min=5, max=16)
     * @NotEqualTo("admin")
     */
    private $login;
    
    /**
     * @NotBlank
     * @Email
     */
    private $email;
   
    /**
     * @NotBlank
     * @Length(min=8, max=32)
     * @Regex(pattern="/[a-zA-Z0-9]+/", message="Uniquement des chiffres/lettres")
     */
    private $mdp1;
    
    /**
     * @NotBlank
     * @Length(min=8, max=32)
     */
    private $mdp2;
    
    /**
     * @Callback
     */
    public function maCallback(\Symfony\Component\Validator\Context\ExecutionContextInterface $context, $payload){
        
        if( strcmp( $this->login, $this->mdp1 )==0 )
            $context->buildViolation("Le login et le mdp doivent être différents!")->addViolation ();
    }
            
    function getLogin() {
        return $this->login;
    }

    function getEmail() {
        return $this->email;
    }

    function getMdp1() {
        return $this->mdp1;
    }

    function getMdp2() {
        return $this->mdp2;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setMdp1($mdp1) {
        $this->mdp1 = $mdp1;
    }

    function setMdp2($mdp2) {
        $this->mdp2 = $mdp2;
    }
}
