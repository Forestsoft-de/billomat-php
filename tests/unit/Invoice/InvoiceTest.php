<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 15:13
 */

namespace Forestsoft\Billomat;

use Forestsoft\Billomat\Invoice\Invoice;
use Forestsoft\Billomat\Invoice\ISupplyDate;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Invoice\IInvoice;
use Forestsoft\Billomat\Payment\IPayment;
use Zend\Stdlib\ArrayObject;

class InvoiceTest extends AbstractResourceTest
{
    /**
     * @var Invoice
     */
    protected $_object;

    public function setUp()
    {
        $this->_object = new Invoice();
    }

    /**
     * @group unit
     */
    public function testIsResource()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\IResource', $this->_object);
    }

    /**
     * @group unit
     */
    public function testIsInvoice()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\Invoice\IInvoice', $this->_object);
    }

   

    /**
     * @group unit
     * @dataProvider dp_gettersetter
     */
    public function testGetterSetter($property, $value)
    {
        $this->performGetterSetterTest($property, $value);
    }

    public function dp_gettersetter()
    {
        $contact = TestHelper::getMock("Forestsoft\Billomat\Contact\IContact");
        $client = TestHelper::getMock("Forestsoft\Billomat\Customer\ICustomer");

        $invoice = TestHelper::getMock("Forestsoft\Billomat\Invoice\IInvoice");
        $offer = TestHelper::getMock("Forestsoft\Billomat\Offer\IOffer");
        $freetext = TestHelper::getMock("Forestsoft\Billomat\Freetext\IFreetext");

        $confirmation = TestHelper::getMock("Forestsoft\Billomat\Confirmation\IConfirmation");
        $template = TestHelper::getMock("Forestsoft\Billomat\Template\ITemplate");
        $invoiceItem = TestHelper::getMock("Forestsoft\Billomat\Invoice\IInvoiceItem");

        return [
            "client" => ["client", $client],
            "contact" => ["contact", $contact],
            "address" => ["address", "Musterstraße 1"],
            "number_pre" => ["numberPre", "INV"],
            "number" => ["number", 12345],
            "numberLength" => ["numberLength", 5],
            "date" => ["date", "2017-12-01"],
            "supply_date" => ["supplyDate", "2017-12-01"],
            "supply_date_type" => ["supplyDateType", ISupplyDate::DELIVERY_DATE],
            "due_date" => ["dueDate", "2017-12-30"],
            "discount_rate" => ["discountRate", 10],
            "title" => ["title", "My new Invoice"],
            "label" => ["label", "My new Label"],
            "intro" => ["intro", "Dear Mr. Schenider"],
            "note" => ["note", "My custom note"],
            "reduction" => ["reduction", "10%"],
            "currencyCode" => ["currencyCode", "EUR"],
            "netGross" => ["netGross", IPrice::BASE_GROSS],
            "quote" => ["quote", 20.35],
            "payment_types" => ["paymentTypes", [IPayment::TYPE_BANK_PAYPAL, IPayment::TYPE_CASH]],
            "invoice" => ["invoice", $invoice],
            "offer" => ["offer", $offer],
            "discountDate" => ["discountDate", "2017-12-24"],
            "freetext" => ["freetext", $freetext],
            "confirmation" => ["confirmation", $confirmation],
            "template" => ["template", $template],
            "items" => ["items", new ArrayObject([$invoiceItem])]
        ];
    }

    /**
     * @param $property
     * @param $value
     * @dataProvider dp_invalidinput
     */
    public function testInputValidation($property, $value, $expectedException)
    {
        $this->assertSetterThrowException($this->_object, $property, $value, $expectedException);
    }

    public function dp_invalidinput()
    {
        $invoiceItem = TestHelper::getMock("Forestsoft\Billomat\Invoice\IInvoiceItem");

        return [
            "0 is an invalid date" => [
                "date", "0", new \InvalidArgumentException("0 for property date is not a valid date format. Use Y-m-d")
            ],
            "0 is an invalid supply date" => [
                "supplyDate", "0", new \InvalidArgumentException("0 for property supplyDate is not a valid date format. Use Y-m-d")
            ],
            "2017 is an invalid supply date" => [
                "dueDate", "2017", new \InvalidArgumentException("2017 for property dueDate is not a valid date format. Use Y-m-d")
            ],
            "2017 is an invalid discount date" => [
                "discountDate", "2017", new \InvalidArgumentException("2017 for property dicountDate is not a valid date format. Use Y-m-d")
            ],
            "hurz is not a valid supplydatetype" => [
                "supplyDateType", "hurz", new \InvalidArgumentException("hurz is not a valid supplydatetype. Please use one of ISupplyDate::*")
            ],

            "hurz is not a valid netGross" => [
                "netGross", "hurz", new \InvalidArgumentException("hurz is not a valid netGross. Please use one of Forestsoft\Billomat\IPrice::*")
            ],
            "stones is not a valid payment type" => [
                "paymentTypes", ["stones"], new \InvalidArgumentException("stones is not a valid paymentType. Please use one of Forestsoft\Billomat\Payment\IPayment::*")
            ],
            "there is an invalid InvoiceItem" => [
                "items", new ArrayObject([$invoiceItem, "stones", $invoiceItem]), new \InvalidArgumentException("There is an invalid invoice item in item collection")
            ],
        ];
    }
}
