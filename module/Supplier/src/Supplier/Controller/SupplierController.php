<?php

namespace Supplier\Controller;

use Supplier\Model\Supplier;
use Supplier\Model\Address;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class SupplierController extends AbstractRestfulController {

    public function getList() {
        $em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $results= $em->createQuery('select a, u from Supplier\Model\Supplier a left join a.addresses u')->getArrayResult();

       
        return new JsonModel(array(
            'data' => $results)
        );
    }
	
	private function _getArrayForId($id)
	{
		$em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $supplier = $em->find('Supplier\Model\Supplier', $id);
        
        $results= $em->createQuery('select a, u from Supplier\Model\Supplier a left join a.addresses u where a.id=:id')
                ->setParameter("id", $id)
                ->getArrayResult();
				
		return $results[0];
	}

    public function get($id) {
        $results = $this->_getArrayForId($id);
        return new JsonModel($results);
    }

    public function create($data) { 
        $em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $supplier = new Supplier();
        $supplier->setSupplierName($data['supplier_name']);
        $em->persist($supplier);
        
        foreach ($data['addresses'] as $address) {
            $newAddress = new Address();
            $newAddress->setAddress_line_1($address['address_line_1']);
            $newAddress->setAddress_line_2($address['address_line_2']);
            $newAddress->setEmail($address['email']);
            $newAddress->setPost_code($address['post_code']);
            $newAddress->setFax($address['fax']);
            $newAddress->setTelephone($address['telephone']);
            $newAddress->setTown($address['town']);
            $supplier->getAddresses()->add($newAddress);
            $em->persist($newAddress);
        }
        $em->flush();
        
        
        

        return new JsonModel(array(
            'data' => $supplier->getId(),
        ));
    }

    public function update($id, $data) {
        $em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $supplier = $em->find('Supplier\Model\Supplier', $id);

        $supplier->setSupplierName($data['supplier_name']);

        $supplier = $em->merge($supplier);  
        
        $supplier->getAddresses()->clear();
        file_put_contents(getcwd(). '/filetext', json_encode($data['addresses']));
        foreach ($data['addresses'] as $address) {
            $newAddress = new Address();
            $newAddress->setAddress_line_1($address['address_line_1']);
            $newAddress->setAddress_line_2($address['address_line_2']);
            $newAddress->setEmail($address['email']);
            $newAddress->setPost_code($address['post_code']);
            $newAddress->setFax($address['fax']);
            $newAddress->setTelephone($address['telephone']);
            $newAddress->setTown($address['town']);
            $supplier->getAddresses()->add($newAddress);
            $em->persist($newAddress);
        }
        
        $em->flush();

        return new JsonModel(array(
            'data' => array(
                'supplier' => $supplier->getId(), 
            ),
        ));
    }

    public function delete($id) {
        $em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');
		
		$em = $this
                ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $supplier = $em->find('Supplier\Model\Supplier', $id);
        
        $results= $em->createQuery('select a, u from Supplier\Model\Supplier a left join a.addresses u where a.id=:id')
                ->setParameter("id", $id)
                ->getArrayResult();
				
		$addrArray = $this->_getArrayForId($id)["addresses"];
			
        $supplier = $em->find('Supplier\Model\Supplier', $id);
        $em->remove($supplier);
        $em->flush();
		
		foreach($addrArray as $item) { 
			$addr_id = $item['id']; 
			$addr = $em->find('Supplier\Model\Address', $addr_id);
			$em->remove($addr);
		}
		$em->flush();
		
        return new JsonModel(array(
            'data' => 'deleted',
        ));
    }

}
