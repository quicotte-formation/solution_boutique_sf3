<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DTO;

use Symfony\Component\Validator\Constraints\Expression;
use Symfony\Component\Validator\Constraints\Callback;

class FiltreDTO {
    
    private $client;
    private $dateMin;
    private $dateMax;
    
    /**
     * @Callback
     */
    public function maCallback(\Symfony\Component\Validator\Context\ExecutionContextInterface $context, $payload){
        
        if( $this->getClient()==null && $this->getDateMax()==null && $this->getDateMin()==null ){
            $context->buildViolation("Spécifiez au moins un critère")->addViolation();
        }
    }
    
    function getClient() {
        return $this->client;
    }

    function getDateMin() {
        return $this->dateMin;
    }

    function getDateMax() {
        return $this->dateMax;
    }

    function setClient($client) {
        $this->client = $client;
    }

    function setDateMin($dateMin) {
        $this->dateMin = $dateMin;
    }

    function setDateMax($dateMax) {
        $this->dateMax = $dateMax;
    }


}
