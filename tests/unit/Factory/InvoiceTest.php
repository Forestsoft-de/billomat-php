<?php
/**
 * ForestSoft Billomat PHP
 * @link https://github.com/Forestsoft-de/billomat-php
 * @copyright Copyright (c) 2018. ForestSoft Sebastian Förster
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

namespace Forestsoft\Billomat\Test\Factory;

use Forestsoft\Billomat\Factory\Invoice;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\Test\AbstractFactoryTest;

class InvoiceTest extends AbstractFactoryTest
{

    /**
     * @var Invoice
     */
    protected $_object;

    /**
     * @return mixed
     */
    protected function getResourceInterface()
    {
        return 'Forestsoft\Billomat\Invoice\IInvoice';
    }

    /**
     * @return mixed
     */
    protected function getObject()
    {
        return new Invoice();
    }


    /**
     * @group unit
     * @dataProvider dp_defaults
     */
    public function testGetInstanceSetDefaults($key, $expectedValue)
    {
        $this->assertFactorySetDefault($key, $expectedValue);
    }
    
    public function dp_defaults() 
    {
      return [
        "netGross" => [
            "netGross", IPrice::BASE_NET
        ],
      ];
    }
}