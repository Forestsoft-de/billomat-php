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

namespace Forestsoft\Billomat\Test\Integration;

use Forestsoft\Billomat\Factory\InvoiceItem;
use Forestsoft\Billomat\Invoice\Invoice;


class InvoiceItemTest extends AbstractResourceTest
{

    /**
     * @var Invoice
     */
    protected $_object = null;

    protected function setUp()
    {
        $factory = InvoiceItem::getInstance();
        $config = \Forestsoft\Billomat\TestHelper::getConfig();
        $factory->setConfig(
            $config['integration']['billomat']
        );
        $this->_object = $factory->create();
    }

    public function testcreate()
    {
        $invoice = \Forestsoft\Billomat\Factory\Invoice::getInstance()->create();
        $invoice->setId(3662000);

        $this->_object->setInvoice($invoice);
        $this->_object->setArticle(\Forestsoft\Billomat\Article\Factory::getInstance()->create()->setId(155945));

        $this->_object->create();
    }
}
