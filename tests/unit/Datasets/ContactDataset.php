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



namespace Forestsoft\Billomat\Datasets;


use Forestsoft\Billomat\TestHelper;

class ContactDataset
{
     public static function getMock()
     {
         return TestHelper::getMock('Forestsoft\Billomat\Contact\IContact');
     }

    public static function getArray()
    {
        return [
                
        ];
    }

    public static function getRequest()
    {
        return [
            "client_id" =>  "10",
            "name" => "Loca Benakovic",
            "salutation" => "Mr.",
            "first_name" => "Luca",
            "last_name" => "benakovic",
            "street" => "Musterstrasse 1",
            "zip" => "12345",
            "city" => "Musterhausen",
            "state" => "NRW",
            "country_code" => "DE",
            "phone" => "012345",
            "fax" => "054321",
            "mobile" => "0151/123456",
            "email" => "muster@mustermann.de",
            "www" => "http://www.mustermann.de",
        ];
    }

    public static function getContact()
    {
        $client = CustomerDataset::getMock();
        $client->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(10);

        return [
            "client" =>  $client,
            "name" => "Loca Benakovic",
            "salutation" => "Mr.",
            "first_name" => "Luca",
            "last_name" => "benakovic",
            "street" => "Musterstrasse 1",
            "zip" => "12345",
            "city" => "Musterhausen",
            "state" => "NRW",
            "country_code" => "DE",
            "phone" => "012345",
            "fax" => "054321",
            "mobile" => "0151/123456",
            "email" => "muster@mustermann.de",
            "www" => "http://www.mustermann.de",
        ];
    }
}