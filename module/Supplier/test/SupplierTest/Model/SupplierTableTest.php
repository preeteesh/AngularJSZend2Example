<?php

namespace SupplierTest\Model;

use Supplier\Model\Supplier;
use Supplier\Model\SupplierTable;
use Exception;
use PHPUnit_Framework_TestCase;
use Zend\Db\ResultSet\ResultSet;

class SupplierTableTest extends PHPUnit_Framework_TestCase {

    public function testFetchAllReturnsAllSuppliers() {
        $resultSet = new ResultSet();
        $mockTableGateway = $this->getMock(
                'Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false
        );
        $mockTableGateway->expects($this->once())
                ->method('select')
                ->with()
                ->will($this->returnValue($resultSet));

        $supplierTable = new SupplierTable($mockTableGateway);

        $this->assertSame($resultSet, $supplierTable->fetchAll());
    }

    public function testCanRetrieveAnSupplierByItsId() {
        $supplier = new Supplier();
        $supplier->exchangeArray(array('id' => 123,
            'supplier_name' => 'My Supplier'));

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Supplier());
        $resultSet->initialize(array($supplier));

        $mockTableGateway = $this->getMock(
                'Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false
        );
        $mockTableGateway->expects($this->once())
                ->method('select')
                ->with(array('id' => 123))
                ->will($this->returnValue($resultSet));

        $supplierTable = new SupplierTable($mockTableGateway);

        $this->assertSame($supplier, $supplierTable->getSupplier(123));
    }

    public function testCanDeleteAnSupplierByItsId() {
        $mockTableGateway = $this->getMock(
                'Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false
        );
        $mockTableGateway->expects($this->once())
                ->method('delete')
                ->with(array('id' => 123));

        $supplierTable = new SupplierTable($mockTableGateway);
        $supplierTable->deleteSupplier(123);
    }

    public function testSaveSupplierWillInsertNewSupplierIfTheyDontAlreadyHaveAnId() {
        $supplierData = array(
            'supplier_name' => 'New Supplier'
        );
        $supplier = new Supplier();
        $supplier->exchangeArray($supplierData);

        $mockTableGateway = $this->getMock(
                'Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false
        );
        $mockTableGateway->expects($this->once())
                ->method('insert')
                ->with($supplierData);

        $supplierTable = new SupplierTable($mockTableGateway);
        $supplierTable->saveSupplier($supplier);
    }

    public function testSaveSupplierWillUpdateExistingSupplierIfTheyAlreadyHaveAnId() {
        $supplierData = array(
            'id' => 123,
            'supplier_name' => 'My Supplier'
        );
        $supplier = new Supplier();
        $supplier->exchangeArray($supplierData);

        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Supplier());
        $resultSet->initialize(array($supplier));

        $mockTableGateway = $this->getMock(
                'Zend\Db\TableGateway\TableGateway', array('select', 'update'), array(), '', false
        );
        $mockTableGateway->expects($this->once())
                ->method('select')
                ->with(array('id' => 123))
                ->will($this->returnValue($resultSet));
        $mockTableGateway->expects($this->once())
                ->method('update')
                ->with(
                        array(
                    'supplier_name' => 'My Supplier'
                        ), array('id' => 123)
        );

        $supplierTable = new SupplierTable($mockTableGateway);
        $supplierTable->saveSupplier($supplier);
    }


}
