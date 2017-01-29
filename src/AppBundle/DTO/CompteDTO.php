<?php

namespace AppBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompteDTO
 *
 * @author tom
 */
class CompteDTO {

    /**
     * @Assert\NotBlank
     * @Assert\CardScheme(schemes={"MAESTRO"})
     * @var string
     */
    private $cardNumber;

    /**
     * @Assert\NotBlank
     * @Assert\Bic
     * @var string
     */
    private $bic;

    /**
     * @Assert\NotBlank
     * @Assert\Iban
     * @var string
     */
    private $iban;

    /**
     * @Assert\NotBlank
     * @Assert\Email
     * @var string
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\Date
     * @var \Date
     */
    private $creationDate;

    function getCardNumber() {
        return $this->cardNumber;
    }

    function getBic() {
        return $this->bic;
    }

    function getIban() {
        return $this->iban;
    }

    function getEmail() {
        return $this->email;
    }

    function getCreationDate() {
        return $this->creationDate;
    }

    function setCardNumber($cardNumber) {
        $this->cardNumber = $cardNumber;
    }

    function setBic($bic) {
        $this->bic = $bic;
    }

    function setIban($iban) {
        $this->iban = $iban;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

}
