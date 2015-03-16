<?php

namespace Supplier\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="supplier")
 */
class Supplier {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $supplier_name;

    /**
     * @ORM\ManyToMany(targetEntity="Address", inversedBy="Supplier")
     * @ORM\JoinTable(name="supplier_addresses",
     *      joinColumns={@ORM\JoinColumn(name="supplier_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")}
     *      )
     */
    private $addresses;


    public function __construct() {
        $this->addresses = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getSupplierName() {
        return $this->supplier_name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setSupplierName($supplier_name) {
        $this->supplier_name = $supplier_name;
    }

    public function getAddresses() {
        return $this->addresses;
    }

    public function setAddresses($addresses) {
        $this->addresses = $addresses;
    }

    public function toArray() {
        return get_object_vars($this);
    }
}
