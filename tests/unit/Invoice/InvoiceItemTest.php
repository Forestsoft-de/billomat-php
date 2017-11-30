<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 16:53
 */
namespace Forestsoft\Billomat\Invoice;

use Forestsoft\Billomat\BaseTest;

class InvoiceItemTest extends BaseTest
{
    /**
     * @var InvoiceItem
     */
    protected $_object;

    public function setUp()
    {
        $this->_object = new InvoiceItem();
    }

    /**
     * @group unit
     */
    public function testInstanceOfInvoiceItem()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\Invoice\IInvoiceItem', $this->_object);
    }

    /**
     * @group unit
     *
     * @dataProvider dp_gettersetter
     *
     */
    public function testGetterSetter($property, $value)
    {
        $this->performGetterSetterTest($property, $value);
    }

    public function dp_gettersetter()
    {
        return [
            "unit" => ["unit", "Stunde"],
            "unit_price" => ["unitPrice", 10.50],
            "quantity" => ["quantity", 2],
            "title" => ["title", "test"],
        ];
    }
}
