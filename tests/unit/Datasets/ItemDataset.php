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



namespace Forestsoft\Billomat\Datasets;


use Forestsoft\Billomat\TestHelper;

class ItemDataset
{
     public static function getMock()
     {
         return TestHelper::getMock('Forestsoft\Billomat\Invoice\InvoiceItem');
     }

    public static function getRequest()
    {
        return [
            "article_id" => 12345,
            "invoice_id" => 12345,
            "position" => 1,
            "unit" => "Stunde",
            "quantity" => 1,
            "unit_price" => 90.0,
            "tax_name" => "Ust",
            "tax_rate" => 19.0,
            "title" => "Dienstleistung",
            "description" => "Dienstleistung lt. Anlage",
            "total_gross" => 80.0,
            "total_net" => '67.23',
            "reduction" => 10,
            "total_gross_unreduced" => 90.0,
            "total_net_unreduced" => '75.63',
        ];
    }

    public static function getItem()
    {
        $article = ArticleDataset::getMock();
        $article->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(12345);

        $invoice = InvoiceDataset::getMock();
        $invoice->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(12345);

        return [
            "id" => "",
            "article" => $article,
            "invoice" => $invoice,
            "position" => 1,
            "unit" => "Stunde",
            "quantity" => "1",
            "unit_price" => "90",
            "tax_name" => "Ust",
            "tax_rate" => "19",
            "title" => "Dienstleistung",
            "description" => "Dienstleistung lt. Anlage",
            "total_gross" => 49.98,
            "total_net" => 42,
            "reduction" => 10,
            "total_gross_unreduced" => 61.88,
            "total_net_unreduced" => 52.0,
        ];
    }
}