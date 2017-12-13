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



namespace Forestsoft\Billomat\Test\Confirmation;


use Forestsoft\Billomat\AbstractResourceTest;
use Forestsoft\Billomat\Confirmation\Confirmation;
use Forestsoft\Billomat\Datasets\CustomerDataset;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\TestHelper;

class ConfirmationTest extends AbstractResourceTest
{
    /**
     * @return mixed
     */
    public function getResourceInterfaceName()
    {
        return "Forestsoft\Billomat\Confirmation\IConfirmation";
    }

    /**
     * @return mixed
     */
    public function getFactoryClassName()
    {
        return "Forestsoft\Billomat\Confirmation\Factory";
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

        $offer = TestHelper::getMock("Forestsoft\Billomat\Offer\IOffer");
        $freetext = TestHelper::getMock("Forestsoft\Billomat\Freetext\IFreetext");

        $template = TestHelper::getMock("Forestsoft\Billomat\Template\ITemplate");

        return [
            "id"    => ["id", "1010"],
            "client" => ["client", $client],
            "contact" => ["contact", $contact],
            "address" => ["address", "Musterstraße 1"],
            "number_pre" => ["numberPre", "INV"],
            "number" => ["number", 12345],
            "numberLength" => ["numberLength", 5],
            "created" => ["created", "2017-12-01"],
            "title" => ["title", "My new Invoice"],
            "label" => ["label", "My new Label"],
            "intro" => ["intro", "Dear Mr. Schenider"],
            "note" => ["note", "My custom note"],
            "reduction" => ["reduction", "10%"],
            "currencyCode" => ["currencyCode", "EUR"],
            "netGross" => ["netGross", IPrice::BASE_GROSS],
            "quote" => ["quote", 20.35],
            "offer" => ["offer", $offer],
            "freetext" => ["freetext", $freetext],
            "template" => ["template", $template],
        ];
    }

    /**
     * @return mixed
     */
    protected function getObject()
    {
        return new Confirmation();
    }

}