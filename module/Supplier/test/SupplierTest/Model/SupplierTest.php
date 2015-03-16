<?php

namespace SupplierTest\Model;

use Supplier\Model\Supplier;
use PHPUnit_Framework_TestCase;

class SupplierTest extends PHPUnit_Framework_TestCase {

    public function testSupplierInitialState() {
        $supplier = new Supplier();

        $this->assertNull(
                $supplier->supplier_name, '"supplier_name" should initially be null'
        );
        $this->assertNull(
                $supplier->id, '"id" should initially be null'
        );
    }

    public function testExchangeArraySetsPropertiesCorrectly() {
        $supplier = new Supplier();
        $data = array('supplier_name' => 'some supplier',
            'id' => 123);

        $supplier->exchangeArray($data);

        $this->assertSame(
                $data['supplier_name'], $supplier->supplier_name, '"supplier_name" was not set correctly'
        );
        $this->assertSame(
                $data['id'], $supplier->id, '"id" was not set correctly'
        );
    }


    public function testInputFiltersAreSetCorrectly() {
        $supplier = new Supplier();

        $inputFilter = $supplier->getInputFilter();

        $this->assertSame(2, $inputFilter->count());
        $this->assertTrue($inputFilter->has('supplier_name'));
        $this->assertTrue($inputFilter->has('id'));
    }

}
