<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 14:08
 */

namespace Forestsoft\Billomat\Customer;

use Forestsoft\Billomat\BaseTest;
use Forestsoft\Billomat\Mapper\Mapper;
use Forestsoft\Billomat\Payment\IPayment;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\Tax\ITax;
use Forestsoft\Billomat\Settings\IType;

class CustomerTest extends BaseTest
{
    /**
     * @var Customer
     */
    private $_object;

    protected $_expectedOptions =   [
        "billomat" => [
            "billomatId" => "myBillomatId",
            'apiKey' => null,
        ]
    ];
    private $_customerFactory;
    private $_factory;
    private $_client;

    public function testCreateShouldPost()
    {
        $client = $this->getMockBuilder('Forestsoft\Billomat\Client\IClient')->getMock();
        $factory = $this->getMockBuilder('Forestsoft\Billomat\Factory\IClient')->getMock();

        $this->_object->setBillomatId("myBillomatId");

        $factory->expects($this->once())->method("create")->with("clients/create", $this->_expectedOptions)->willReturn($client);

        $this->_object->setClientFactory($factory);

        $this->_object->create();
    }

    public function testCreateShouldReturnCustomer()
    {
        $this->_factory->expects($this->once())->method("create")->with("clients/create", $this->_expectedOptions)->willReturn($this->_client);
        $customerResponse = ["client" => ["id" => 1010, "name" => "Luca Benakovic"]];
        $this->_client->expects($this->once())->method("request")->willReturn($customerResponse);

        $this->_object->setClientFactory($this->_factory);

        $actual = $this->_object->create();

        $this->assertInstanceOf(get_class($this->_object), $actual);
        $this->assertEquals(1010, $actual->getId());
        $this->assertEquals('Luca Benakovic', $actual->getName());
    }

    protected function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub

        \Forestsoft\Billomat\Factory\Customer::setFactoryInstance(null);
    }


    public function testfindAll()
    {
        $client = $this->getMockBuilder('Forestsoft\Billomat\Client\IClient')->getMock();
        $factory = $this->getMockBuilder('Forestsoft\Billomat\Factory\IClient')->getMock();
        $customerFactory = $this->getMockBuilder('Forestsoft\Billomat\Factory\ICustomer')->getMock();

        \Forestsoft\Billomat\Factory\Customer::setFactoryInstance($customerFactory);

        $this->_object->setBillomatId("myBillomatId");

        $client->expects($this->once())->method("request")->willReturn(["clients" => ["client" => [["name" => "Sebastian"]]]]);

        $options["billomat"] = array_merge($this->_expectedOptions["billomat"], ["page" => 2, "per_page" => 10]);

        $factory->expects($this->once())->method("create")->with("clients", $options)->willReturn($client);

        $this->_object->setClientFactory($factory);


        $list = $this->_object->findAll(10, 2);

        $this->assertCount(1, $list);
        $this->assertContainsOnly('Forestsoft\Billomat\Customer\ICustomer', $list);
    }

    /**
     * @dataProvider dp_gettersetter
     */
    public function testGetterAndSetter($property, $value)
    {
        $setter = "set". ucfirst($property);
        $getter = "get". ucfirst($property);
        $boolGetter = "is". ucfirst($property);
        $boolGetter2 = "has". ucfirst($property);

        if (is_callable(array($this->_object, $setter))) {
            $this->_object->$setter($value);
            if (is_callable(array($this->_object, $getter))) {
                $this->assertEquals($value, $this->_object->$getter());
            } else if (is_callable(array($this->_object, $boolGetter))) {
                $this->assertEquals($value, $this->_object->$boolGetter());
            }
            else if (is_callable(array($this->_object, $boolGetter2))) {
                $this->assertEquals($value, $this->_object->$boolGetter2());
            }
        } else {
            $this->fail(sprintf("Property %s does not exist", $property));
        }
    }

    public function dp_gettersetter()
    {
        return [
            "archived" => ["archived", true],
            "numberPre" => ["numberPre", "test"],
            "number" => ["number", "test"],
            "numberLength" => ["numberLength", "test"],
            "name" => ["name", "test"],
            "street" => ["street", "test"],
            "zip" => ["zip", "test"],
            "city" => ["city", "test"],
            "state" => ["state", "test"],
            "countryCode" => ["countryCode", "test"],
            "firstName" => ["firstName", "test"],
            "lastName" => ["lastName", "test"],
            "salutation" => ["salutation", "test"],
            "phone" => ["phone", "test"],
            "fax" => ["fax", "test"],
            "mobile" => ["mobile", "test"],
            "email" => ["email", "test"],
            "www" => ["www", "test"],
            "taxNumber" => ["taxNumber", "test"],
            "vatNumber" => ["vatNumber", "test"],
            "bankAccountNumber" => ["bankAccountNumber", "test"],
            "bankAccountOwner" => ["bankAccountOwner", "test"],
            "bankNumber" => ["bankNumber", "test"],
            "bankName" => ["bankName", "test"],
            "bankSwift" => ["bankSwift", "test"],
            "bankIban" => ["bankIban", "test"],
            "sepaMandate" => ["sepaMandate", "test"],
            "sepaMandateDate" => ["sepaMandateDate", "test"],
            "locale" => ["locale", "test"],
            "taxRule" => ["taxRule", ITax::RULE_NO],
            "netGross" => ["netGross", "test"],
            "defaultPaymentTypes" => ["defaultPaymentTypes", IPayment::TYPE_BANK_PAYPAL . "," . IPayment::TYPE_CASH],
            "note" => ["note", "test"],
            "reduction" => ["reduction", "test"],
            "discountRateType" => ["discountRateType", "test"],
            "discountRate" => ["discountRate", "test"],
            "discountDaysType" => ["discountDaysType", "test"],
            "discountDays" => ["discountDays", "test"],
            "dueDaysType" => ["dueDaysType", "test"],
            "dueDays" => ["dueDays", "test"],
            "reminderDueDaysType" => ["reminderDueDaysType", "test"],
            "reminderDueDays" => ["reminderDueDays", "test"],
            "offerValidityDaysType" => ["offerValidityDaysType", "test"],
            "offerValidityDays" => ["offerValidityDays", "test"],
            "currencyCode" => ["currencyCode", "test"],
            "priceGroup" => ["priceGroup", "test"],
            "debitorAccountNumber" => ["debitorAccountNumber", "test"],
            "dunningRun" => ["dunningRun", "test"],
            "created"  => ["created", "2017-01-01"],
            "RevenueNet"  => ["RevenueNet", "10000"],
            "RevenueGross"  => ["RevenueGross", "10000"],
            "address" => ["address", "herleshausen"],
            "enabledCustomerPortal" => ["enabledCustomerPortal", true],
            "id" => ["id", 10],
            "clientNumber" => ["clientNumber", 50],
            "customerPortalUrl" => ["customerPortalUrl", "http://customer.local"],
        ];
    }


    public function testfind()
    {
        $client = $this->getMockBuilder('Forestsoft\Billomat\Client\IClient')->getMock();
        $factory = $this->getMockBuilder('Forestsoft\Billomat\Factory\IClient')->getMock();
        $customerFactory = $this->getMockBuilder('Forestsoft\Billomat\Factory\ICustomer')->getMock();

        \Forestsoft\Billomat\Factory\Customer::setFactoryInstance($customerFactory);

        $this->_object->setBillomatId("myBillomatId");

        $client->expects($this->once())->method("request")->willReturn(["client" => ["name" => "Sebastian", "id" => 1010]]);

        $factory->expects($this->once())->method("create")->with("clients/1010", $this->_expectedOptions)->willReturn($client);

        $this->_object->setClientFactory($factory);

        $customer = $this->_object->find(1010);

        $this->assertInstanceOf('Forestsoft\Billomat\Customer\ICustomer', $customer);

        $this->assertEquals(1010, $customer->getId());
        $this->assertEquals("Sebastian", $customer->getName());
    }

    public function testDelete()
    {
        $this->_object->setId(1010);
        
        $this->_client->expects($this->once())->method("request")->willReturn(["clients" => ["client" => [["name" => "Sebastian"]]]]);

        $responseMock = $this->getMockBuilder('Zend\Http\Response')->getMock();
        $this->_client->expects($this->once())->method("getResponse")->willReturn($responseMock);

        $responseMock->expects($this->atLeastOnce())->method("getStatusCode")->willReturn(200);

        


        $this->_factory->expects($this->once())->method("create")->with("clients/1010/delete", $this->_expectedOptions)->willReturn($this->_client);

        $this->_object->setClientFactory($this->_factory);

        $this->assertTrue($this->_object->delete());

    }


    /**
     * @dataProvider dp_customers
     */
    public function testcreate($expectedRequest, $customer)
    {
        $client = $this->getMockBuilder('Forestsoft\Billomat\Client\IClient')->getMock();
        $factory = $this->getMockBuilder('Forestsoft\Billomat\Factory\IClient')->getMock();
        $customerFactory = $this->getMockBuilder('Forestsoft\Billomat\Factory\ICustomer')->getMock();

        \Forestsoft\Billomat\Factory\Customer::setFactoryInstance($customerFactory);

        $this->_object->setBillomatId("myBillomatId");

        $mapper = new Mapper();
        $mapper->map($this->_object, new \ArrayObject($customer));

        $client->expects($this->once())->method("request")
            ->with($expectedRequest)
            ->willReturn(true);

        $factory->expects($this->once())->method("create")->with("clients/create", $this->_expectedOptions)->willReturn($client);

        $this->_object->setClientFactory($factory);

        $this->_object->create();
    }

    public function dp_customers()
    {
      return [
        "Sebastian Förster" => [
            "expectedRequest" => [
                "client" => [
                    "first_name" => "Max",
                    "last_name" => "Mustermann",
                    'archived' => true,
                    'number_pre' => "CUS",
                    'number' => 1050,
                    'number_length' => 4,
                    'name' => "ForestSoft",
                    'street' => "Musterstraße 1",
                    'zip' => "12345",
                    'city' => "Musterhausen",
                    'state' => "NRW",
                    'country_code' => "DE",
                    'salutation' => "Herr",
                    'phone' => "0306479473",
                    'fax' => "0306479472",
                    'mobile' => "0150123456",
                    'email' => "max@mustermann.de",
                    'www' => "https://www.forestsoft.de",
                    'tax_number' => "317/12547",
                    'vat_number' => "DE456781147",
                    'bank_account_number' => "011114444555",
                    'bank_account_owner' => "Max Mustermann",
                    'bank_number' => "44050199",
                    'bank_name' => "Spasskasse",
                    'bank_swift' => "COBADE5750",
                    'bank_iban' => "DE4445556666",
                    'sepa_mandate' => "123-456-789",
                    'sepa_mandate_date' => "2017-03-01",
                    'locale' => "de_DE",
                    'tax_rule' => "TAX",
                    'net_gross' => IPrice::BASE_GROSS,
                    'default_payment_types' => IPayment::TYPE_BANK_PAYPAL . "," . IPayment::TYPE_CASH,
                    'note' => "My personal Note",
                    'reduction' => 20,
                    'discount_rate_type' => IType::SETTINGS,
                    'discount_rate' => null,
                    'discount_days_type' => null,
                    'discount_days' => null,
                    'due_days_type' => null,
                    'due_days' => null,
                    'reminder_due_days_type' => null,
                    'reminder_due_days' => null,
                    'offer_validity_days_type' => null,
                    'offer_validity_days' => null,
                    'currency_code' => null,
                    'price_group' => null,
                    'debitor_account_number' => null,
                ]
            ],
            "customer" => [
                'archived' => true,
                'numberPre' => "CUS",
                'number' => 1050,
                'numberLength' => 4,
                'name' => "ForestSoft",
                'street' => "Musterstraße 1",
                'zip' => "12345",
                'city' => "Musterhausen",
                'state' => "NRW",
                'countryCode' => "DE",
                'firstName' => 'Max',
                'lastName' => 'Mustermann',
                'salutation' => "Herr",
                'phone' => "0306479473",
                'fax' => "0306479472",
                'mobile' => "0150123456",
                'email' => "max@mustermann.de",
                'www' => "https://www.forestsoft.de",
                'taxNumber' => "317/12547",
                'vatNumber' => "DE456781147",
                'bankAccountNumber' => "011114444555",
                'bankAccountOwner' => "Max Mustermann",
                'bankNumber' => "44050199",
                'bankName' => "Spasskasse",
                'bankSwift' => "COBADE5750",
                'bankIban' => "DE4445556666",
                'sepaMandate' => "123-456-789",
                'sepaMandateDate' => "2017-03-01",
                'locale' => "de_DE",
                'taxRule' => ITax::RULE_TAX,
                'netGross' => IPrice::BASE_GROSS,
                'defaultPaymentTypes' => IPayment::TYPE_BANK_PAYPAL . "," . IPayment::TYPE_CASH,
                'note' => "My personal Note",
                'reduction' => 20,
                'discountRateType' => IType::SETTINGS,
                'discountRate' => null,
                'discountDaysType' => null,
                'discountDays' => null,
                'dueDaysType' => null,
                'dueDays' => null,
                'reminderDueDaysType' => null,
                'reminderDueDays' => null,
                'offerValidityDaysType' => null,
                'offerValidityDays' => null,
                'currencyCode' => null,
                'priceGroup' => null,
                'debitorAccountNumber' => null,

            ]
        ],
      ];
    }

    /**
     * @dataProvider dp_taxes
     */
    public function testSetTaxThrowExcpetions($rule, $exception = null)
    {
        if ($exception) {
            $this->expectExceptionObject($exception);
        }

        $this->_object->setTaxRule($rule);

        if (!$exception) {
            $this->assertEquals($rule, $this->_object->getTaxRule());
        }
    }

    public function expectExceptionObject(\Exception $exception)
    {
        $this->expectException(\get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());
        $this->expectExceptionCode($exception->getCode());
    }

    public function dp_taxes()
    {
        return [
            "Foobar" => [
                "foobar",
                new \InvalidArgumentException("foobar is not a valid tax rule. Choose one of ITax::RULE_*")
            ],
            "RULE_TAX" => [
                ITax::RULE_TAX
            ],
        ];
    }

    /**
     * @group unit
     * @dataProvider dp_paymentTypes
     */
    public function testDefaultPaymentTypes($types, $exception = null)
    {
        if ($exception) {
            $this->expectExceptionObject($exception);
        }
        $this->_object->setDefaultPaymentTypes($types);

        if (!$exception) {
            $this->assertEquals($types, $this->_object->getDefaultPaymentTypes());
        }
    }

    public function dp_paymentTypes()
    {
      return [
        "All of Them" => [
            IPayment::TYPE_CASH
            . "," . IPayment::TYPE_BANK_PAYPAL
            . "," . IPayment::TYPE_BANK_CARD
            . "," . IPayment::TYPE_BANK_TRANSFER
            . "," . IPayment::TYPE_CHECK
            . "," . IPayment::TYPE_CASH
            . "," . IPayment::TYPE_CREDIT_CARD
            . "," . IPayment::TYPE_CREDIT_COUPON
            . "," . IPayment::TYPE_CREDIT_NOTE
            . "," . IPayment::TYPE_MISC
            . "," . IPayment::TYPE_INVOICE_CORRECTION
            . "," . IPayment::TYPE_DEBIT
        ],
        "Empty" => [
            "",
        ],
        "Barzahlung" => [
            "Barzahlung",
            new \InvalidArgumentException("Barzahlung is not a valid payment method. Choose one of IPayment::TYPE_*")
        ],
        "One of them Invalid" => [
            IPayment::TYPE_CASH
            . ",Barzahlung"
            . "," . IPayment::TYPE_BANK_CARD,
            new \InvalidArgumentException("Barzahlung is not a valid payment method. Choose one of IPayment::TYPE_*")
        ]
      ];
    }

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->_object = new Customer();

        $this->_object->setBillomatId("myBillomatId");
        
        $this->_client = $this->getMockBuilder('Forestsoft\Billomat\Client\IClient')->getMock();
        $this->_factory = $this->getMockBuilder('Forestsoft\Billomat\Factory\IClient')->getMock();
        $this->_customerFactory = $this->getMockBuilder('Forestsoft\Billomat\Factory\ICustomer')->getMock();

        \Forestsoft\Billomat\Factory\Customer::setFactoryInstance($this->_customerFactory);
    }
}
