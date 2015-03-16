<?php

namespace SupplierTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class SupplierControllerTest extends AbstractHttpControllerTestCase {

    public function setUp() {
        $this->setApplicationConfig(
                include 'config/application.config.php'
        );
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed() {
        $supplierTableMock = $this->getMockBuilder('Supplier\Model\SupplierTable')
                ->disableOriginalConstructor()
                ->getMock();

        $supplierTableMock->expects($this->once())
                ->method('fetchAll')
                ->will($this->returnValue(array()));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('Supplier\Model\SupplierTable', $supplierTableMock);

        $this->dispatch('/supplier');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Supplier');
        $this->assertControllerName('Supplier\Controller\Supplier');
        $this->assertControllerClass('SupplierController');
        $this->assertMatchedRouteName('supplier');
    }

    public function testAddActionRedirectsAfterValidPost() {
        $supplierTableMock = $this->getMockBuilder('Supplier\Model\SupplierTable')
                ->disableOriginalConstructor()
                ->getMock();

        $supplierTableMock->expects($this->once())
                ->method('saveSupplier')
                ->will($this->returnValue(null));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService('Supplier\Model\SupplierTable', $supplierTableMock);

        $postData = array(
            'supplier_name' => 'Supplier Test1'
        );
        $this->dispatch('/supplier/add', 'POST', $postData);
        $this->assertResponseStatusCode(302);

        $this->assertRedirectTo('/supplier');
    }

}
