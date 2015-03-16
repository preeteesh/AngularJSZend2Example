<?php

namespace Supplier\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $address_line_1;
	
	/** @ORM\Column(type="string") */
    private $address_line_2;
	
	/** @ORM\Column(type="string") */
    private $town;
	
	/** @ORM\Column(type="string") */
    private $post_code;
	
	/** @ORM\Column(type="string") */
    private $telephone;
	
	/** @ORM\Column(type="string") */
    private $fax;

    	/** @ORM\Column(type="string") */
    private $email;

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
    
	function getAddress_line_1() {
        return $this->address_line_1;
    }

    function getAddress_line_2() {
        return $this->address_line_2;
    }

    function getTown() {
        return $this->town;
    }

    function getPost_code() {
        return $this->post_code;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getFax() {
        return $this->fax;
    }

    function getEmail() {
        return $this->email;
    }

    function setAddress_line_1($address_line_1) {
        $this->address_line_1 = $address_line_1;
    }

    function setAddress_line_2($address_line_2) {
        $this->address_line_2 = $address_line_2;
    }

    function setTown($town) {
        $this->town = $town;
    }

    function setPost_code($post_code) {
        $this->post_code = $post_code;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setFax($fax) {
        $this->fax = $fax;
    }

    function setEmail($email) {
        $this->email = $email;
    }
	

	//more setter/getter if needed
}
