<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 15:13
 */

namespace Forestsoft\Billomat;

use Forestsoft\Billomat\Invoice\Invoice;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Invoice\IInvoice;

class InvoiceTest extends BaseTest
{
    /**
     * @var Invoice
     */
    protected $_sut;

    public function setUp()
    {
        $this->_sut = new Invoice();
    }

    /**
     * @group unit
     */
    public function testIsResource()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\IResource', $this->_sut);
    }

    /**
     * @group unit
     */
    public function testIsInvoice()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\Invoice\IInvoice', $this->_sut);
    }
}
