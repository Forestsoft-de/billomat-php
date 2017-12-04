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



namespace Forestsoft\Billomat\Customer;

use Forestsoft\Billomat\AbstractResourceTest;
use Forestsoft\Billomat\BaseTest;
use Forestsoft\Billomat\Datasets\CustomerDataset;
use Forestsoft\Billomat\Factory\IClient;
use Forestsoft\Billomat\Mapper\Mapper;
use Forestsoft\Billomat\Payment\IPayment;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\Tax\ITax;
use Forestsoft\Billomat\Settings\IType;
use Psr\Log\InvalidArgumentException;

class CustomerTest extends AbstractResourceTest
{
    /**
     * @var Customer
     */
    protected $_object;

    protected $_expectedOptions =   [
        "billomat" => [
            "billomatId" => "myBillomatId",
            'apiKey' => null,
        ]
    ];

    /**
     * @return mixed
     */
    public function getFactoryClassName()
    {
        return "Forestsoft\Billomat\Factory\Customer";
    }

    /**
     * @dataProvider dp_customers
     */
    public function testcreate($expectedRequest, $customer, $response)
    {
        $this->assertCreateWorks("clients", $customer, $expectedRequest, $response);
    }

    public function dp_customers()
    {
        return [
            "Sebastian Förster" => [
                "expectedRequest" => [
                    "client" => CustomerDataset::getCustomerRequest()
                ],
                "customer" => CustomerDataset::getCustomerArray(),
                "response" => [
                    "client" => CustomerDataset::getCustomerRequest()
                ]
            ],
        ];
    }

    public function testfindAll()
    {
        $this->_client->expects($this->once())->method("request")->willReturn(["clients" => ["client" => [["name" => "Sebastian"]]]]);

        $options["billomat"] = array_merge($this->_expectedOptions["billomat"], ["page" => 2, "per_page" => 10]);

        $this->clientFactory->expects($this->once())->method("create")->with("clients", $options)->willReturn($this->_client);

        $list = $this->_object->findAll(10, 2);

        $this->assertCount(1, $list);
        $this->assertContainsOnly('Forestsoft\Billomat\Customer\ICustomer', $list);
    }

    /**
     * @dataProvider dp_gettersetter
     */
    public function testGetterAndSetter($property, $value)
    {
        $this->performGetterSetterTest($property, $value);
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
        $this->_client->expects($this->once())->method("request")->willReturn(["client" => ["name" => "Sebastian", "id" => 1010]]);

        $this->clientFactory->expects($this->once())->method("create")->with("clients/1010", $this->_expectedOptions)->willReturn($this->_client);
        $this->_mapperMock->expects($this->once())->method('map')->with($this->_resource)->willReturn($this->_resource);
        
        $customer = $this->_object->find(1010);

        $this->assertInstanceOf('Forestsoft\Billomat\Customer\ICustomer', $customer);
    }

    public function testFindBy()
    {
        $this->_mapperMock->expects($this->once())->method('map')->with($this->_resource)->willReturn($this->_resource);
        
        $customer = $this->prepareFindBy([ISearch::PARAM_FIRST_NAME => "Luca", ISearch::PARAM_LAST_NAME => "Benakovic"], ["clients" => ["client" => [["name" => "Luca Benakovic", "id" => 1010]]]]);

        $this->assertContainsOnly('Forestsoft\Billomat\Customer\ICustomer', $customer);
    }

    public function testFindByThrowExceptionIfSearchNotPossible()
    {
        $this->expectExceptionObject(new \InvalidArgumentException("city is not a valid search. Please see ISearch::PARAM_*"));
        $this->_object->findBy(["city" => "Musterhausen"]);
    }

    public function testUpdate()
    {
        $this->_object->setId(1010);
        $this->_client->expects($this->once(2))->method("request")->willReturn(["client" => ["name" => "Sebastian"]]);

        $this->_responseMock->expects($this->any())->method("getStatusCode")->willReturn(200);
        $this->_mapperMock->expects($this->once())->method('map')->with($this->_resource)->willReturn($this->_resource);
        $this->clientFactory->expects($this->once())->method("create")->with("clients/1010/update", $this->_expectedOptions)->willReturn($this->_client);

        $actual = $this->_object->update();

        $this->assertInstanceOf("Forestsoft\Billomat\Customer\ICustomer", $actual);
        $this->assertNotSame($this->_object, $actual);
    }

    public function testDelete()
    {
        $this->_object->setId(1010);
        
        $this->_client->expects($this->once())->method("request")->willReturn(["clients" => ["client" => [["name" => "Sebastian"]]]]);

        $this->_responseMock->expects($this->any())->method("getStatusCode")->willReturn(200);

        $this->clientFactory->expects($this->once())->method("create")->with("clients/1010/delete", $this->_expectedOptions)->willReturn($this->_client);

        $this->assertTrue($this->_object->delete());

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
        
    /**
     * @return mixed|void
     */
    private function prepareFindBy($searchArray, $resultArray)
    {
        $options = $this->_expectedOptions;

        $search = ["search" => $searchArray];

        $options = array_merge($search, $options);

        $this->_client->expects($this->once())->method("request")->willReturn($resultArray);
        $this->clientFactory->expects($this->once())->method("create")->with("clients", $options)->willReturn($this->_client);

        $customer = $this->_object->findBy($searchArray);
        return $customer;
    }

    public function getResourceInterfaceName()
    {
        return 'Forestsoft\Billomat\Customer\ICustomer';
    }

    public function getResourceFactoryInterfaceName()
    {
        return 'Forestsoft\Billomat\Factory\IFactory';
    }

    protected function getObject()
    {
        return new Customer();
    }


}
