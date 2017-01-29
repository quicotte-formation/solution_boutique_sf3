<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DTO;

/**
 * Description of RechercheDTO
 *
 * @author tom
 */
class RechercheDTO {
    
    private $client;
    
    private $dateCommandeMin;
    
    private $dateCommandeMax;
    
    private $produit;
    
    function getClient() {
        return $this->client;
    }

    function getDateCommandeMin() {
        return $this->dateCommandeMin;
    }

    function getDateCommandeMax() {
        return $this->dateCommandeMax;
    }

    function getProduit() {
        return $this->produit;
    }

    function setClient($client) {
        $this->client = $client;
    }

    function setDateCommandeMin($dateCommandeMin) {
        $this->dateCommandeMin = $dateCommandeMin;
    }

    function setDateCommandeMax($dateCommandeMax) {
        $this->dateCommandeMax = $dateCommandeMax;
    }

    function setProduit($produit) {
        $this->produit = $produit;
    }


}
