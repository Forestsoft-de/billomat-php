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

use Forestsoft\Billomat\Invoice\Invoice;
use Forestsoft\Billomat\Invoice\ISupplyDate;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\Payment\IPayment;
use PHPUnit\Framework\TestCase;

class InvoiceTest extends AbstractResourceTest
{

    /**
     * @var Invoice
     */
    protected $_object = null;

    protected function setUp()
    {
        $factory = \Forestsoft\Billomat\Invoice\Factory::getInstance();
        $config = \Forestsoft\Billomat\TestHelper::getConfig();
        $factory->setConfig(
            $config['integration']['billomat']
        );
        $this->_object = $factory->create();
    }

    public function testcreate()
    {
        $customer = \Forestsoft\Billomat\Factory\Customer::getInstance()->create();
        $customer->setId(1624078);

        $this->_object->setClient($customer);

        $this->_object->setAddress("Schloss-Dyck-Str. 88b, 41238 Mönchengladbach");
        $this->_object->setDate(date("Y-m-d"));
        $this->_object->setCurrencyCode("EUR");
        $this->_object->setNetGross(IPrice::BASE_NET);
        $this->_object->setSupplyDate(date("Y-m-d"));
        $this->_object->setSupplyDateType(ISupplyDate::DELIVERY_DATE);
        $this->_object->setPaymentTypes(new \ArrayObject([IPayment::TYPE_BANK_TRANSFER]));

        $invoiceItemFactory = \Forestsoft\Billomat\Factory\InvoiceItem::getInstance();
        $invoiceItem = $invoiceItemFactory->create();

        $invoiceItem->setQuantity(1);
        $invoiceItem->setTitle("Telefongespräch");
        $invoiceItem->setUnitPrice(40);
        $invoiceItem->setUnit("Stunde");

        $invoiceItem2 = $invoiceItemFactory->create();


        $article = \Forestsoft\Billomat\Article\Factory::getInstance()->create();
        $article->setId(155945);

        $invoiceItem2->setQuantity(1);
        $invoiceItem2->setTitle("Telefongespräch 10 min");
        $invoiceItem2->setArticleId($article->getId());
        $invoiceItem2->setUnitPrice(10);
        $invoiceItem2->setUnit("Stunde");
        
        $items =  [
            $invoiceItem,
            $invoiceItem2
        ];


        $this->_object->setItems(new \ArrayObject($items));


        $this->_object->create();
    }
}
