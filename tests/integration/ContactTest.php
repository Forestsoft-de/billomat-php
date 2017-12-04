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

namespace Forestsoft\Billomat\Test\Integration;

use Forestsoft\Billomat\Contact\Contact;
use Forestsoft\Billomat\Contact\Factory;
use Forestsoft\Billomat\Factory\Customer;
use PHPUnit\Framework\TestCase;

class ContactTest extends AbstractResourceTest
{

    /**
     * @var ContactTest
     */
    protected $_object = null;

    protected function setUp()
    {
        parent::setUp();
        $this->_object = $this->_contactFactory->create();
    }

    /**
     * @group unit
     */
    public function testFindAll()
    {
        $customer = $this->_customerFactory->create();
        $customer = $customer->find(563795);

        $this->_object->setCustomer($customer);
        
        $actual = $this->_object->findAll(100, 1);
        $this->assertContainsOnly('Forestsoft\Billomat\Contact\IContact', $actual);
    }
}
