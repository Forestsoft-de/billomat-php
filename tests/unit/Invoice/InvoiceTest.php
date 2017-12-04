<?php
/**
 * ForestSoft Billomat PHP
 * @link https://github.com/Forestsoft-de/billomat-php
 * @copyright Copyright (c) 2017. ForestSoft Sebastian Förster
 * @license Apache 2.0 https://github.com/Forestsoft-de/billomat-php/blob/master/LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */



namespace Forestsoft\Billomat\Invoice;

use Forestsoft\Billomat\AbstractResourceTest;
use Forestsoft\Billomat\Datasets\CustomerDataset;
use Forestsoft\Billomat\Datasets\InvoiceDataset;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\Payment\IPayment;
use Forestsoft\Billomat\TestHelper;
use Zend\Stdlib\ArrayObject;

class InvoiceTest extends AbstractResourceTest
{
    /**
     * @return mixed
     */
    public function getFactoryClassName()
    {
        return "Forestsoft\Billomat\Invoice\Factory";
    }
    
    protected function getObject()
    {
       return new Invoice();
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
     * @dataProvider dp_invoices
     */
    public function testcreate($expectedRequest, $data, $response)
    {
        $this->assertCreateWorks("invoices", $data, $expectedRequest, $response);
    }

    public function dp_invoices()
    {
        return [
            "Sebastian Förster" => [
                "expectedRequest" => [
                    "invoice" => InvoiceDataset::getRequest()
                ],
                "invoice" => InvoiceDataset::getInvoice(),
                "response" => [
                    "invoice" => InvoiceDataset::getRequest()
                ]
            ],
        ];
    }

    /**
     * @param string $property
     * @param string $expectedInterface
     * 
     * @dataProvider dp_dependencies
     */
    public function testCreateDependencyAutomatic($property, $expectedInterface)
    {
        $getter = "get" .ucfirst($property);
        $actual = call_user_func([$this->_object, $getter]);
        $this->assertInstanceOf($expectedInterface, $actual);

        $this->assertNull($actual->getId());
    }

    public function dp_dependencies()
    {
      return [
            "Client" => ["client", "Forestsoft\Billomat\Customer\ICustomer",],
            "contact" => ["contact", "Forestsoft\Billomat\Contact\IContact"],
            "invoice" => ["invoice", "Forestsoft\Billomat\Invoice\IInvoice"],
            "confirmation" => ["confirmation", "Forestsoft\Billomat\Confirmation\IConfirmation"],
            "recurring" => ["recurring", "Forestsoft\Billomat\Recurring\IRecurring"],
            "freetext" => ["freetext", "Forestsoft\Billomat\Freetext\IFreetext"],
            "template" => ["template", "Forestsoft\Billomat\Template\ITemplate"],
      ];
    }

    public function getResourceInterfaceName()
    {
        return 'Forestsoft\Billomat\Invoice\IInvoice';
    }


    public function getResourceFactoryInterfaceName()
    {
        return 'Forestsoft\Billomat\Factory\IFactory';
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
        $client = CustomerDataset::getMock();

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
