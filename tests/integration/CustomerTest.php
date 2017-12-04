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



use Forestsoft\Billomat\Customer\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends \Forestsoft\Billomat\Test\Integration\AbstractResourceTest
{

    /**
     * @var Customer
     */
    private $_object;

    public function testList()
    {
        $list = $this->_object->findAll();
        $this->assertGreaterThan(0, count($list));
        $this->assertContainsOnly("\Forestsoft\Billomat\Customer\ICustomer", $list);

    }

    /**
     * @group unit
     */
    public function testCreate()
    {
        $this->_object->setFirstName("Luca");
        $this->_object->setLastName("Benakovic");

        $customer = $this->_object->create();

        $this->assertInstanceOf('\Forestsoft\Billomat\Customer\ICustomer', $customer);
        $this->assertNotNull($customer->getId());

        return $customer;
    }

    /**
     * @depends testCreate
     */
    public function testfind($customer)
    {
        $customer = $this->_object->find($customer->getId());

        $this->assertInstanceOf('Forestsoft\Billomat\Customer\ICustomer', $customer);
        $this->assertEquals("Luca", $customer->getFirstName());
        $this->assertEquals("Benakovic", $customer->getLastName());

        return $customer;
    }

    /**
     * 
     */
    public function testfindBy()
    {
        $customers = $this->_object->findBy([\Forestsoft\Billomat\Customer\ISearch::PARAM_FIRST_NAME => "Luca"]);

        $this->assertContainsOnly('Forestsoft\Billomat\Customer\ICustomer', $customers);

        $this->assertEquals("Luca", $customers[0]->getFirstName());
        $this->assertEquals("Benakovic", $customers[0]->getLastName());

        return $customers[0];
    }

    /**
     * @depends testfindBy
     * 
     * @param \Forestsoft\Billomat\Customer\ICustomer $customer
     */
    public function testUpdate($customer)
    {
        $customer->setFirstName("Sebastian");
        $customer->setLastName("Förster");

        $updated = $customer->update();

        $this->assertEquals("Sebastian", $updated->getFirstName());
    }

    /**
     * @depends testfind
     * 
     * @group integration
     */
    public function testdelete($customer)
    {
        $this->assertEquals(true, $customer->delete());
    }

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $factory = \Forestsoft\Billomat\Factory\Customer::getInstance();
        $config = \Forestsoft\Billomat\TestHelper::getConfig();
        $factory->setConfig(
            $config['integration']['billomat']
        );
        $this->_object = $factory->create();
    }
}
