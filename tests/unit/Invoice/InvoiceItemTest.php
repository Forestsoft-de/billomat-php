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
