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



namespace Forestsoft\Billomat\Customer;


use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\ISettings;
use Forestsoft\Billomat\Mapper\Mapper;
use Forestsoft\Billomat\Payment\IPayment;
use Forestsoft\Billomat\Resource;
use Forestsoft\Billomat\Tax\ITax;

/**
 * Class Customer
 * @package Forestsoft\Billomat\Customer
 */
class Customer extends Resource implements ICustomer
{
    protected $_archived;
    protected $_numberPre;
    protected $_number = 1;
    protected $_numberLength = 4;
    protected $_name;
    protected $_street;
    protected $_zip;
    protected $_city;
    protected $_state;
    protected $_countryCode = "DE";
    protected $_firstName;
    protected $_lastName;
    protected $_salutation;
    protected $_phone;
    protected $_fax;
    protected $_mobile;
    protected $_email;
    protected $_www;
    protected $_taxNumber;
    protected $_vatNumber;
    protected $_bankAccountNumber;
    protected $_bankAccountOwner;
    protected $_bankNumber;
    protected $_bankName;
    protected $_bankSwift;
    protected $_bankIban;
    protected $_sepaMandate;
    protected $_sepaMandateDate;
    protected $_locale;
    protected $_taxRule = ITax::RULE_TAX;
    protected $_netGross = IPrice::BASE_SETTINGS;
    protected $_defaultPaymentTypes = IPayment::TYPE_BANK_TRANSFER;
    protected $_note;
    protected $_reduction;
    protected $_discountRateType = ISettings::TYPE_SETTING;
    protected $_discountRate;
    protected $_discountDaysType = ISettings::TYPE_SETTING;
    protected $_discountDays;
    protected $_dueDaysType  = ISettings::TYPE_SETTING;
    protected $_dueDays;
    protected $_reminderDueDaysType = ISettings::TYPE_SETTING;
    protected $_reminderDueDays;
    protected $_offerValidityDaysType = ISettings::TYPE_SETTING;
    protected $_offerValidityDays;
    protected $_currencyCode;
    protected $_priceGroup;
    protected $_debitorAccountNumber;

    /**
     * @var bool
     */
    protected $_dunningRun;

    protected $_id;
    protected $_created;
    protected $_address;
    protected $_revenueGross;
    protected $_revenueNet;

    protected $_clientNumber;


    /**
     * @var bool
     */
    protected $_enabledCustomerPortal;

    protected $_customerPortalUrl;


    /**
     * @return bool
     */
    public function isEnabledCustomerPortal()
    {
        return $this->_enableCustomerPortal;
    }

    /**
     * @param bool $enableCustomerPortal
     * @return Customer
     */
    public function setEnabledCustomerPortal($enableCustomerPortal)
    {
        $this->_enableCustomerPortal = $enableCustomerPortal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     * @return Customer
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->_created;
    }

    /**
     * @param mixed $created
     * @return Customer
     */
    public function setCreated($created)
    {
        $this->_created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * @param mixed $address
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->_address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRevenueGross()
    {
        return $this->_revenueGross;
    }

    /**
     * @param mixed $revenueGross
     * @return Customer
     */
    public function setRevenueGross($revenueGross)
    {
        $this->_revenueGross = $revenueGross;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRevenueNet()
    {
        return $this->_revenueNet;
    }

    /**
     * @param mixed $revenueNet
     * @return Customer
     */
    public function setRevenueNet($revenueNet)
    {
        $this->_revenueNet = $revenueNet;
        return $this;
    }

    /**
     * @return ICustomer
     */
    public function create()
    {
        return $this->performCrUpAction("create");
    }

    /**
     * @return ICustomer
     */
    public function update()
    {
        return $this->performCrUpAction("update");
    }

    /**
     * @return mixed
     */
    public function getCustomerPortalUrl()
    {
        return $this->_customerPortalUrl;
    }

    /**
     * @param mixed $customerPortalUrl
     * @return Customer
     */
    public function setCustomerPortalUrl($customerPortalUrl)
    {
        $this->_customerPortalUrl = $customerPortalUrl;
        return $this;
    }

    /**
     *
     */
    public function delete()
    {
        $client = $this->getClientFactory()->create("clients/" . $this->getId() . "/delete", $this->getOptions());
        $client->request();

        return $client->getResponse()->getStatusCode() == 200;
    }

    /**
     * @param $id
     * @return ICustomer
     */
    public function find($id)
    {
        $client = $this->getClientFactory()->create("clients/$id", $this->getOptions());

        $customers = $client->request();

        $customer = $this->createCustomer();

        if (!empty($customers["client"])) {
            $mapper = $this->createMapper();
            $mapper->map($customer, new \ArrayObject($customers["client"]));
        }

        return $customer;
        
    }

    /**
     *
     */
    public function findAll($limit = 10, $start = 1)
    {
        $list = [];
        $client = $this->getClientFactory()->create("clients", $this->getOptions(["billomat" => ["per_page" => $limit, "page" => $start]]));

        $customers = $client->request();

        if (!empty($customers['clients']['client'])) {
            $factory = \Forestsoft\Billomat\Factory\Customer::getInstance();

            foreach ($customers['clients']['client'] as $customers) {
                $customer = $factory->create();

                $mapper = $this->createMapper();
                $mapper->map($customer, new \ArrayObject($customers));

                $list[] = $customer;
            }

        }
        return $list;
    }

    /**
     * @return mixed
     */
    public function isArchived()
    {
        return $this->_archived;
    }

    /**
     * @param mixed $archived
     * @return Customer
     */
    public function setArchived($archived)
    {
        $this->_archived = $archived;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberPre()
    {
        return $this->_numberPre;
    }

    /**
     * @param mixed $numberPre
     * @return Customer
     */
    public function setNumberPre($numberPre)
    {
        $this->_numberPre = $numberPre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->_number;
    }

    /**
     * @param mixed $number
     * @return Customer
     */
    public function setNumber($number)
    {
        $this->_number = $number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberLength()
    {
        return $this->_numberLength;
    }

    /**
     * @param mixed $numberLength
     * @return Customer
     */
    public function setNumberLength($numberLength)
    {
        $this->_numberLength = $numberLength;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     * @return Customer
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->_street;
    }

    /**
     * @param mixed $street
     * @return Customer
     */
    public function setStreet($street)
    {
        $this->_street = $street;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /**
     * @param mixed $zip
     * @return Customer
     */
    public function setZip($zip)
    {
        $this->_zip = $zip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param mixed $city
     * @return Customer
     */
    public function setCity($city)
    {
        $this->_city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     * @return Customer
     */
    public function setState($state)
    {
        $this->_state = $state;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->_countryCode;
    }

    /**
     * @param mixed $countryCode
     * @return Customer
     */
    public function setCountryCode($countryCode)
    {
        $this->_countryCode = $countryCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @param mixed $firstName
     * @return Customer
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param mixed $lastName
     * @return Customer
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalutation()
    {
        return $this->_salutation;
    }

    /**
     * @param mixed $salutation
     * @return Customer
     */
    public function setSalutation($salutation)
    {
        $this->_salutation = $salutation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     * @return Customer
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->_fax;
    }

    /**
     * @param mixed $fax
     * @return Customer
     */
    public function setFax($fax)
    {
        $this->_fax = $fax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->_mobile;
    }

    /**
     * @param mixed $mobile
     * @return Customer
     */
    public function setMobile($mobile)
    {
        $this->_mobile = $mobile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWww()
    {
        return $this->_www;
    }

    /**
     * @param mixed $www
     * @return Customer
     */
    public function setWww($www)
    {
        $this->_www = $www;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxNumber()
    {
        return $this->_taxNumber;
    }

    /**
     * @param mixed $taxNumber
     * @return Customer
     */
    public function setTaxNumber($taxNumber)
    {
        $this->_taxNumber = $taxNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVatNumber()
    {
        return $this->_vatNumber;
    }

    /**
     * @param mixed $vatNumber
     * @return Customer
     */
    public function setVatNumber($vatNumber)
    {
        $this->_vatNumber = $vatNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankAccountNumber()
    {
        return $this->_bankAccountNumber;
    }

    /**
     * @param mixed $bankAccountNumber
     * @return Customer
     */
    public function setBankAccountNumber($bankAccountNumber)
    {
        $this->_bankAccountNumber = $bankAccountNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankAccountOwner()
    {
        return $this->_bankAccountOwner;
    }

    /**
     * @param mixed $bankAccountOwner
     * @return Customer
     */
    public function setBankAccountOwner($bankAccountOwner)
    {
        $this->_bankAccountOwner = $bankAccountOwner;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankNumber()
    {
        return $this->_bankNumber;
    }

    /**
     * @param mixed $bankNumber
     * @return Customer
     */
    public function setBankNumber($bankNumber)
    {
        $this->_bankNumber = $bankNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankName()
    {
        return $this->_bankName;
    }

    /**
     * @param mixed $bankName
     * @return Customer
     */
    public function setBankName($bankName)
    {
        $this->_bankName = $bankName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankSwift()
    {
        return $this->_bankSwift;
    }

    /**
     * @param mixed $bankSwift
     * @return Customer
     */
    public function setBankSwift($bankSwift)
    {
        $this->_bankSwift = $bankSwift;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankIban()
    {
        return $this->_bankIban;
    }

    /**
     * @param mixed $bankIban
     * @return Customer
     */
    public function setBankIban($bankIban)
    {
        $this->_bankIban = $bankIban;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSepaMandate()
    {
        return $this->_sepaMandate;
    }

    /**
     * @param mixed $sepaMandate
     * @return Customer
     */
    public function setSepaMandate($sepaMandate)
    {
        $this->_sepaMandate = $sepaMandate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSepaMandateDate()
    {
        return $this->_sepaMandateDate;
    }

    /**
     * @param mixed $sepaMandateDate
     * @return Customer
     */
    public function setSepaMandateDate($sepaMandateDate)
    {
        $this->_sepaMandateDate = $sepaMandateDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->_locale;
    }

    /**
     * @param mixed $locale
     * @return Customer
     */
    public function setLocale($locale)
    {
        $this->_locale = $locale;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxRule()
    {
        return $this->_taxRule;
    }

    /**
     * @param mixed $taxRule
     * @return Customer
     */
    public function setTaxRule($taxRule)
    {
        switch ($taxRule) {
            case ITax::RULE_NO:
            case ITax::RULE_TAX:
            case ITax::RULE_COUNTRY:
                $this->_taxRule = $taxRule;
                break;
            default:
                if (!empty($taxRule)) {
                    throw new \InvalidArgumentException(sprintf("%s is not a valid tax rule. Choose one of ITax::RULE_*", $taxRule));
                }
        }


        return $this;
    }

    /**
     * @return mixed
     */
    public function getNetGross()
    {
        return $this->_netGross;
    }

    /**
     * @param mixed $netGross
     * @return Customer
     */
    public function setNetGross($netGross)
    {
        $this->_netGross = $netGross;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultPaymentTypes()
    {
        return $this->_defaultPaymentTypes;
    }

    /**
     * @param mixed $defaultPaymentTypes
     * @return Customer
     */
    public function setDefaultPaymentTypes($defaultPaymentTypes)
    {
        $defaultPaymentTypes = rtrim($defaultPaymentTypes, ",");
        
        $defaultPaymentTypes = explode(",", $defaultPaymentTypes);
        $collectedPayments = [];
        foreach ($defaultPaymentTypes as $type) {
            switch ($type) {
                case IPayment::TYPE_CASH:
                case IPayment::TYPE_CHECK:
                case IPayment::TYPE_DEBIT:
                case IPayment::TYPE_BANK_TRANSFER:
                case IPayment::TYPE_BANK_CARD:
                case IPayment::TYPE_BANK_PAYPAL:
                case IPayment::TYPE_INVOICE_CORRECTION:
                case IPayment::TYPE_CREDIT_NOTE:
                case IPayment::TYPE_CREDIT_CARD:
                case IPayment::TYPE_CREDIT_COUPON:
                case IPayment::TYPE_MISC:
                    $collectedPayments[] = $type;
                    break;
                default:
                    if (!empty($type)) {
                        throw new \InvalidArgumentException(sprintf("%s is not a valid payment method. Choose one of IPayment::TYPE_*", $type));
                    }
            }
        }
        $this->_defaultPaymentTypes = implode(",", $collectedPayments);


        return $this;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->_note;
    }

    /**
     * @param mixed $note
     * @return Customer
     */
    public function setNote($note)
    {
        $this->_note = $note;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReduction()
    {
        return $this->_reduction;
    }

    /**
     * @param mixed $reduction
     * @return Customer
     */
    public function setReduction($reduction)
    {
        $this->_reduction = $reduction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountRateType()
    {
        return $this->_discountRateType;
    }

    /**
     * @param mixed $discountRateType
     * @return Customer
     */
    public function setDiscountRateType($discountRateType)
    {
        $this->_discountRateType = $discountRateType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountRate()
    {
        return $this->_discountRate;
    }

    /**
     * @param mixed $discountRate
     * @return Customer
     */
    public function setDiscountRate($discountRate)
    {
        $this->_discountRate = $discountRate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountDaysType()
    {
        return $this->_discountDaysType;
    }

    /**
     * @param mixed $discountDaysType
     * @return Customer
     */
    public function setDiscountDaysType($discountDaysType)
    {
        $this->_discountDaysType = $discountDaysType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiscountDays()
    {
        return $this->_discountDays;
    }

    /**
     * @param mixed $discountDays
     * @return Customer
     */
    public function setDiscountDays($discountDays)
    {
        $this->_discountDays = $discountDays;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDueDaysType()
    {
        return $this->_dueDaysType;
    }

    /**
     * @param mixed $dueDaysType
     * @return Customer
     */
    public function setDueDaysType($dueDaysType)
    {
        $this->_dueDaysType = $dueDaysType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDueDays()
    {
        return $this->_dueDays;
    }

    /**
     * @param mixed $dueDays
     * @return Customer
     */
    public function setDueDays($dueDays)
    {
        $this->_dueDays = $dueDays;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReminderDueDaysType()
    {
        return $this->_reminderDueDaysType;
    }

    /**
     * @param mixed $reminderDueDaysType
     * @return Customer
     */
    public function setReminderDueDaysType($reminderDueDaysType)
    {
        $this->_reminderDueDaysType = $reminderDueDaysType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReminderDueDays()
    {
        return $this->_reminderDueDays;
    }

    /**
     * @param mixed $reminderDueDays
     * @return Customer
     */
    public function setReminderDueDays($reminderDueDays)
    {
        $this->_reminderDueDays = $reminderDueDays;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOfferValidityDaysType()
    {
        return $this->_offerValidityDaysType;
    }

    /**
     * @param mixed $offerValidityDaysType
     * @return Customer
     */
    public function setOfferValidityDaysType($offerValidityDaysType)
    {
        $this->_offerValidityDaysType = $offerValidityDaysType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOfferValidityDays()
    {
        return $this->_offerValidityDays;
    }

    /**
     * @param mixed $offerValidityDays
     * @return Customer
     */
    public function setOfferValidityDays($offerValidityDays)
    {
        $this->_offerValidityDays = $offerValidityDays;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->_currencyCode;
    }

    /**
     * @param mixed $currencyCode
     * @return Customer
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->_currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriceGroup()
    {
        return $this->_priceGroup;
    }

    /**
     * @param mixed $priceGroup
     * @return Customer
     */
    public function setPriceGroup($priceGroup)
    {
        $this->_priceGroup = $priceGroup;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDebitorAccountNumber()
    {
        return $this->_debitorAccountNumber;
    }

    /**
     * @param mixed $debitorAccountNumber
     * @return Customer
     */
    public function setDebitorAccountNumber($debitorAccountNumber)
    {
        $this->_debitorAccountNumber = $debitorAccountNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function hasDunningRun()
    {
        return $this->_dunningRun;
    }

    /**
     * @param mixed $dunningRun
     * @return Customer
     */
    public function setDunningRun($dunningRun)
    {
        $this->_dunningRun = $dunningRun;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientNumber()
    {
        return $this->_clientNumber;
    }

    /**
     * @param mixed $clientNumber
     */
    public function setClientNumber($clientNumber)
    {
        $this->_clientNumber = $clientNumber;
        return $this;
    }

    public function createResource()
    {
        return $this->createCustomer();
    }

    /**
     * @return mixed
     */
    protected function createCustomer()
    {
        $factory = \Forestsoft\Billomat\Factory\Customer::getInstance();
        $customer = $factory->create();
        return $customer;
    }

    public function findBy($array)
    {
        $this->validateSearch($array);

        $search  = ["search" => $array];

        $options = array_merge($search, $this->getOptions());

        $client = $this->getClientFactory()->create("clients", $options);

        $customerResponse = $client->request();

        $customers = [];

        if (!empty($customerResponse["clients"]["client"])) {

            foreach ($customerResponse["clients"]["client"] as $client) {
                $customer = $this->createCustomer();
                $mapper = $this->createMapper();
                $mapper->map($customer, new \ArrayObject($client));

                $customers[] = $customer;
            }
        }

        return $customers;
    }

    private function validateSearch($array)
    {
        foreach ($array as $key => $value) {
            switch ($key) {
                case ISearch::PARAM_LAST_NAME:
                case ISearch::PARAM_FIRST_NAME:
                case ISearch::PARAM_CLIENT_NUMBER:
                case ISearch::PARAM_EMAIL:
                case ISearch::PARAM_NAME:
                case ISearch::PARAM_NOTE:
                case ISearch::PARAM_TAGS:
                case ISearch::PARAM_COUNTRY_CODE:
                case ISearch::PARAM_INVOICE_ID:
                    continue;
                default:
                    throw new \InvalidArgumentException(sprintf("%s is not a valid search. Please see ISearch::PARAM_*", $key));
            }
        }
    }

    /**
     * @return array
     */
    protected function prepareData()
    {
        $data = [
            "client" => [
                "first_name" => $this->getFirstName(),
                "last_name" => $this->getLastName(),
                "archived" => $this->isArchived(),
                "number_pre" => $this->getNumberPre(),
                "number" => $this->getNumber(),
                "number_length" => $this->getNumberLength(),
                "name" => $this->getName(),
                "street" => $this->getStreet(),
                "zip" => $this->getZip(),
                "city" => $this->getCity(),
                "state" => $this->getState(),
                "country_code" => $this->getCountryCode(),
                "salutation" => $this->getSalutation(),
                "phone" => $this->getPhone(),
                "fax" => $this->getFax(),
                "mobile" => $this->getMobile(),
                "email" => $this->getEmail(),
                "www" => $this->getWww(),
                "tax_number" => $this->getTaxNumber(),
                "vat_number" => $this->getVatNumber(),
                "bank_account_number" => $this->getBankAccountNumber(),
                "bank_account_owner" => $this->getBankAccountOwner(),
                "bank_number" => $this->getBankNumber(),
                "bank_name" => $this->getBankName(),
                "bank_swift" => $this->getBankSwift(),
                "bank_iban" => $this->getBankIban(),
                "sepa_mandate" => $this->getSepaMandate(),
                "sepa_mandate_date" => $this->getSepaMandateDate(),
                "locale" => $this->getLocale(),
                "tax_rule" => $this->getTaxRule(),
                "net_gross" => $this->getNetGross(),
                "default_payment_types" => $this->getDefaultPaymentTypes(),
                "note" => $this->getNote(),
                "reduction" => $this->getReduction(),
                "discount_rate_type" => $this->getDiscountRateType(),
                "discount_rate" => $this->getDiscountRate(),
                "discount_days_type" => $this->getDiscountDaysType(),
                "discount_days" => $this->getDiscountDays(),
                "due_days_type" => $this->getDueDaysType(),
                "due_days" => $this->getDueDays(),
                "reminder_due_days_type" => $this->getReminderDueDaysType(),
                "reminder_due_days" => $this->getReminderDueDays(),
                "offer_validity_days_type" => $this->getOfferValidityDaysType(),
                "offer_validity_days" => $this->getOfferValidityDays(),
                "currency_code" => $this->getCurrencyCode(),
                "price_group" => $this->getPriceGroup(),
                "debitor_account_number" => $this->getDebitorAccountNumber(),
            ]
        ];
        return $data;
    }

    /**
     * @return string
     */
    public function getResourceName()
    {
        return "clients";
    }
}