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


use Forestsoft\Billomat\Invoice\ISupplyDate;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\Payment\IPayment;
use Forestsoft\Billomat\TestHelper;

class InvoiceDataset
{
    public static function getMock()
    {
        return TestHelper::getMock('Forestsoft\Billomat\Invoice\IInvoice');
    }
    public static function getRequest()
    {
        return [
            "client_id" => 1010,
            "contact_id" => 1050,
            "address" => "Musterstrasse 1",
            "number_pre" => "0123",
            "number" => "456",
            "number_length" => "6",
            "date" => date("Y-m-d"),
            "supply_date" => date("Y-m-d"),
            "supply_date_type" => ISupplyDate::DELIVERY_DATE,
            "due_date" => date("Y-m-d"),
            "discount_rate" => "",
            "discount_date" => date("Y-m-d"),
            "title" => "My Invoice",
            "label" => "My Label",
            "intro" => "My Intro",
            "note" => "My Note",
            "reduction" => "20%",
            "currency_code" => "EUR",
            "net_gross" => IPrice::BASE_GROSS,
            "quote" => 1.000,
            "payment_types" => IPayment::TYPE_BANK_TRANSFER,
            "invoice_id" => null,
            "offer_id" => 1,
            "confirmation_id" => 1,
            "recurring_id" => 1,
            "free_text_id" => 1,
            "template_id" => 10,
        ];
    }

    public static function getInvoice()
    {
        $customer = CustomerDataset::getMock();
        $customer->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(1010);

        $contact = ContactDataset::getMock();
        $contact->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(1050);

        $offer = OfferDataset::getMock();
        $offer->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(1);

        $freetext = FreetextDataset::getMock();
        $freetext->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(1);

        $confirmation = ConfirmationDataset::getMock();
        $confirmation->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(1);

        $recurring = RecurringDataset::getMock();
        $recurring->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(1);

        $template = TemplateDataset::getMock();
        $template->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getId")->willReturn(10);

        $item = ItemDataset::getMock();
        $item->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getQuantity")->willReturn(1);
        $item->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getUnitPrice")->willReturn(90);
        $item->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getTitle")->willReturn("Arbeiten");
        $item->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getUnit")->willReturn("Stunde");
        $item->expects(new \PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount())->method("getArticleId")->willReturn(123456);

        return [
            "client" => $customer,
            "contact" => $contact,
            "id" => 1020,
            "address" => "Musterstrasse 1",
            "number_pre" => "0123",
            "number" => "456",
            "number_length" => "6",
            "date" => date("Y-m-d"),
            "supply_date" => date("Y-m-d"),
            "supply_date_type" => ISupplyDate::DELIVERY_DATE,
            "due_date" => date("Y-m-d"),
            "discount_rate" => "",
            "discount_date" => date("Y-m-d"),
            "title" => "My Invoice",
            "label" => "My Label",
            "intro" => "My Intro",
            "note" => "My Note",
            "reduction" => "20%",
            "currency_code" => "EUR",
            "net_gross" => IPrice::BASE_GROSS,
            "quote" => 1.0,
            "payment_types" => IPayment::TYPE_BANK_TRANSFER,
            "invoice_id" => "",
            "offer" => $offer,
            "confirmation" => $confirmation,
            "recurring" => $recurring,
            "freetext" => $freetext,
            "template" => $template,
            "items" => new \ArrayObject([$item])
        ];
    }
}