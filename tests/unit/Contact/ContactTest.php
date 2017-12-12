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



namespace Forestsoft\Billomat\Test\Contact;

use Forestsoft\Billomat\AbstractResourceTest;
use Forestsoft\Billomat\Contact\Contact;
use Forestsoft\Billomat\Datasets\ContactDataset;
use Forestsoft\Billomat\Datasets\CustomerDataset;
use Forestsoft\Billomat\TestHelper;
use PHPUnit\Framework\TestCase;

class ContactTest extends AbstractResourceTest
{

    /**
     * @var Contact
     */
    protected $_object;

    /**
     *
     */
    public function testfindAll()
    {
        $this->_expectedOptions["billomat"] = array_merge($this->_expectedOptions["billomat"], ["page" => 2, "per_page" => 10, "client_id" => 1010]);

        $this->_prepareRequest("contacts", [], [], ["contacts" => ["contact" => [ContactDataset::getArray()]] ], 200);
        $this->_object->setClient(CustomerDataset::getCustomer());
        
        $contacts = $this->_object->findAll(10, 2);

        $this->assertInternalType('array', $contacts);
        $this->assertContainsOnly('Forestsoft\Billomat\Contact\IContact', $contacts);
    }

    /**
     * @group unit
     */
    public function testfindallThrowExpectionIfCustomerIsNotSet()
    {
        $this->expectExceptionObject(new \InvalidArgumentException("Cannot find contacts because Customer is not set"));
        $this->_object->findAll(1,1);
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
        $client = CustomerDataset::getMock();
        return [
            "client" => ["client", $client],
            "name" => ["name","Max Mustermann"],
            "salutation" => ["salutation","Mr."],
            "first_name" => ["firstName","Max"],
            "last_name" => ["lastName","Mustermann"],
            "street" => ["street","Musterstrasse 1"],
            "zip" => ["zip","12345"],
            "city" => ["city","Musterhausen"],
            "state" => ["state","NRW"],
            "country_code" => ["countryCode","DE"],
            "phone" => ["phone","012345"],
            "fax" => ["fax","054321"],
            "mobile" => ["mobile","0151/123456"],
            "email" => ["email","muster@mustermann.de"],
            "www" => ["www","http://www.mustermann.de"],
        ];
    }

    /**
     * @return mixed
     */
    public function getFactoryClassName()
    {
        return "Forestsoft\Billomat\Contact\Factory";
    }
    
    public function getResourceInterfaceName()
    {
        return 'Forestsoft\Billomat\Contact\IContact';
    }

    protected function getObject()
    {
        return new Contact();
    }
}
