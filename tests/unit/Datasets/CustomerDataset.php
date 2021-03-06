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


use Forestsoft\Billomat\Factory\Customer;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\Mapper\Mapper;
use Forestsoft\Billomat\Payment\IPayment;
use Forestsoft\Billomat\Settings\IType;
use Forestsoft\Billomat\Tax\ITax;
use Forestsoft\Billomat\TestHelper;

class CustomerDataset
{

    public static function getCustomerRequest()
    {
        return [
            "first_name" => "Max",
            "last_name" => "Mustermann",
            'archived' => true,
            'number_pre' => "CUS",
            'number' => 1050,
            'number_length' => 4,
            'name' => "ForestSoft",
            'street' => "Musterstraße 1",
            'zip' => "12345",
            'city' => "Musterhausen",
            'state' => "NRW",
            'country_code' => "DE",
            'salutation' => "Herr",
            'phone' => "0306479473",
            'fax' => "0306479472",
            'mobile' => "0150123456",
            'email' => "max@mustermann.de",
            'www' => "https://www.forestsoft.de",
            'tax_number' => "317/12547",
            'vat_number' => "DE456781147",
            'bank_account_number' => "011114444555",
            'bank_account_owner' => "Max Mustermann",
            'bank_number' => "44050199",
            'bank_name' => "Spasskasse",
            'bank_swift' => "COBADE5750",
            'bank_iban' => "DE4445556666",
            'sepa_mandate' => "123-456-789",
            'sepa_mandate_date' => "2017-03-01",
            'locale' => "de_DE",
            'tax_rule' => "TAX",
            'net_gross' => IPrice::BASE_GROSS,
            'default_payment_types' => IPayment::TYPE_BANK_PAYPAL . "," . IPayment::TYPE_CASH,
            'note' => "My personal Note",
            'reduction' => 20,
            'discount_rate_type' => IType::SETTINGS,
            'discount_rate' => null,
            'discount_days_type' => null,
            'discount_days' => null,
            'due_days_type' => null,
            'due_days' => null,
            'reminder_due_days_type' => null,
            'reminder_due_days' => null,
            'offer_validity_days_type' => null,
            'offer_validity_days' => null,
            'currency_code' => null,
            'price_group' => null,
            'debitor_account_number' => null,
        ];
    }

    public static function getCustomerUpdateRequest()
    {
        return ["id" => 1010] + self::getCustomerRequest();
    }

    public static function getCustomerUpdate()
    {
        return ["id" => 1010] + self::getCustomerArray();
    }

    public static function getCustomer()
    {
        $factory = Customer::getInstance();
        $customer = $factory->create();

        $mapper = new Mapper();
        $mapper->map($customer, new \ArrayObject(self::getCustomerArray()));

        return $customer;
    }

    public static function getCustomerArray()
    {
        return [
            "id" => 1010,
            'archived' => true,
            'numberPre' => "CUS",
            'number' => 1050,
            'numberLength' => 4,
            'name' => "ForestSoft",
            'street' => "Musterstraße 1",
            'zip' => "12345",
            'city' => "Musterhausen",
            'state' => "NRW",
            'countryCode' => "DE",
            'firstName' => 'Max',
            'lastName' => 'Mustermann',
            'salutation' => "Herr",
            'phone' => "0306479473",
            'fax' => "0306479472",
            'mobile' => "0150123456",
            'email' => "max@mustermann.de",
            'www' => "https://www.forestsoft.de",
            'taxNumber' => "317/12547",
            'vatNumber' => "DE456781147",
            'bankAccountNumber' => "011114444555",
            'bankAccountOwner' => "Max Mustermann",
            'bankNumber' => "44050199",
            'bankName' => "Spasskasse",
            'bankSwift' => "COBADE5750",
            'bankIban' => "DE4445556666",
            'sepaMandate' => "123-456-789",
            'sepaMandateDate' => "2017-03-01",
            'locale' => "de_DE",
            'taxRule' => ITax::RULE_TAX,
            'netGross' => IPrice::BASE_GROSS,
            'defaultPaymentTypes' => IPayment::TYPE_BANK_PAYPAL . "," . IPayment::TYPE_CASH,
            'note' => "My personal Note",
            'reduction' => 20,
            'discountRateType' => IType::SETTINGS,
            'discountRate' => null,
            'discountDaysType' => null,
            'discountDays' => null,
            'dueDaysType' => null,
            'dueDays' => null,
            'reminderDueDaysType' => null,
            'reminderDueDays' => null,
            'offerValidityDaysType' => null,
            'offerValidityDays' => null,
            'currencyCode' => null,
            'priceGroup' => null,
            'debitorAccountNumber' => null,
        ];
    }

    public static function getMock()
    {
        return TestHelper::getMock('Forestsoft\Billomat\Customer\ICustomer');
    }
}