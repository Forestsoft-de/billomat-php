<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 16-Nov-17
 * Time: 21:52
 */

namespace Forestsoft\Billomat\Customer;

use Forestsoft\Billomat\IResource;

interface ICustomer extends IResource
{
    /**
     * @param bool $archived
     *
     * @return ICustomer
     */
    public function setArchived($archived);

    /**
     * @param string $clientNumber
     * 
     * @return ICustomer
     */
    public function setClientNumber($clientNumber);

    /**
     *
     * @param int $number
     * 
     * @return ICustomer
     */
    public function setNumber($number);

    /**
     * @param string $pre
     * 
     * @return ICustomer
     */
    public function setNumberPre($pre);

    /**
     * @param int $length
     *
     * @return ICustomer
     */
    public function setNumberLength($length);

    /**
     * @param string $name
     * 
     * @return ICustomer
     */
    public function setName($name);

    /**
     * @param string $salutation
     * 
     * @return ICustomer
     */
    public function setSalutation($salutation);

    /**
     * @param string $firstName
     * 
     * @return ICustomer
     */
    public function setFirstName($firstName);

    /**
     * @param string $lastName
     *
     * @return ICustomer
     */
    public function setLastName($lastName);

    /**
     * @param string $street
     *
     * @return ICustomer
     */
    public function setStreet($street);

    /**
     * @param string $zip
     *
     * @return ICustomer
     */
    public function setZip($zip);

    /**
     * @param string $city
     *
     * @return ICustomer
     */
    public function setCity($city);

    /**
     * @param string $state
     *
     * @return ICustomer
     */
    public function setState($state);

    /**
     * @param string $countryCode
     * 
     * @return ICustomer
     */
    public function setCountryCode($countryCode);

    /**
     * @param string $phone
     * 
     * @return ICustomer
     */
    public function setPhone($phone);

    /**
     * @param string $fax
     * 
     * @return ICustomer
     */
    public function setFax($fax);

    /**
     * @param string $mobile
     * 
     * @return ICustomer
     */
    public function setMobile($mobile);

    /**
     * @param string $email
     *
     * @return ICustomer
     */
    public function setEmail($email);

    /**
     * @param string $www
     * 
     * @return ICustomer
     */
    public function setWww($www);

    /**
     * @param string $taxNumber
     * 
     * @return ICustomer
     */
    public function setTaxNumber($taxNumber);

    /**
     * @param string $vatNumber
     * 
     * @return ICustomer
     */
    public function setVatNumber($vatNumber);

    /**
     * @param string $bankAccountOwner
     * 
     * @return ICustomer
     */
    public function setBankAccountOwner($bankAccountOwner);

    /**
     * @param string $bankNumber
     * 
     * @return ICustomer
     */
    public function setBankNumber($bankNumber);

    /**
     * @param string $bankName
     * 
     * @return ICustomer
     */
    public function setBankName($bankName);

    /**
     * @param string $bankAccountNumber
     * 
     * @return ICustomer
     */
    public function setBankAccountNumber($bankAccountNumber);

    /**
     * @param string $bankSwift
     * 
     * @return ICustomer
     */
    public function setBankSwift($bankSwift);

    /**
     * @param string $bankIBAN
     * 
     * @return ICustomer
     */
    public function setBankIBAN($bankIBAN);

    /**
     * @param bool $enableCustomerportal
     * 
     * @return ICustomer
     */
    public function setEnabledCustomerPortal($enableCustomerportal);

    /**
     * @param string $customerportalUrl
     * 
     * @return ICustomer
     */
    public function setCustomerportalUrl($customerportalUrl);

    /**
     * @param string $sepaMandate
     * 
     * @return ICustomer
     */
    public function setSepaMandate($sepaMandate);

    /**
     * @param string $sepaMandateDate
     * 
     * @return ICustomer
     */
    public function setSepaMandateDate($sepaMandateDate);

    /**
     *
     * @param string $locale
     * 
     * @return ICustomer
     */
    public function setLocale($locale);

    /**
     * One of ITax::RULE_*
     *
     * @param string $taxRule
     * 
     * @return ICustomer
     */
    public function setTaxRule($taxRule);

    /**
     * One of IPrice::BASE_*
     * 
     * @param string $netGross
     * 
     * @return ICustomer
     */
    public function setNetGross($netGross);

    /**
     * Comma seperated list of IPayment::TYPE
     *
     * @param string $defaultPaymentTypes
     * 
     * @return ICustomer
     */
    public function setDefaultPaymentTypes($defaultPaymentTypes);

    /**
     * @param float $reduction
     *
     * @return ICustomer
     */
    public function setReduction($reduction);

    /**
     * One of ISettings::TYPE_*
     * 
     * @param string  $discountRateType
     * 
     * @return ICustomer
     */
    public function setDiscountRateType($discountRateType);

    /**
     * @param $discountRate
     * 
     * @return ICustomer
     */
    public function setDiscountRate($discountRate);

    /**
     * One of ISettings::TYPE_*
     *
     * @paramstring  $discountDaysType
     * 
     * @return ICustomer
     */
    public function setDiscountDaysType($discountDaysType);

    /**
     * @param float $discountDays
     * 
     * @return ICustomer
     */
    public function setDiscountDays($discountDays);

    /**
     * One of ISettings::TYPE_*
     *
     * @param string $dueDaysType
     * 
     * @return ICustomer
     */
    public function setDueDaysType($dueDaysType);

    /**
     * @param int $dueDays
     * 
     * @return ICustomer
     */
    public function setDueDays($dueDays);

    /**
     * One of ISettings::TYPE_*
     *
     * @param string $reminderDueDaysType
     * @return ICustomer
     */
    public function setReminderDueDaysType($reminderDueDaysType);

    /**
     * @param int $reminderDueDays
     * 
     * @return ICustomer
     */
    public function setReminderDueDays($reminderDueDays);

    /**
     * One of ISettings::TYPE_*
     *
     * @param string $offerValidityDaysType
     * 
     * @return ICustomer
     */
    public function setOfferValidityDaysType($offerValidityDaysType);

    /**
     * @param int $offerValidityDays
     * 
     * @return ICustomer
     */
    public function setOfferValidityDays($offerValidityDays);

    /**
     * @param string $currencyCode
     * @return ICustomer
     */
    public function setCurrencyCode($currencyCode);

    /**
     * @param int $priceGroup
     * 
     * @return ICustomer
     */
    public function setPriceGroup($priceGroup);

    /**
     * @param int $debitorAccountNumber
     * 
     * @return ICustomer
     */
    public function setDebitorAccountNumber($debitorAccountNumber);

    /**
     * @param bool $dunningRun
     * 
     * @return ICustomer
     */
    public function setDunningRun($dunningRun);

    /**
     * @param string $note
     * 
     * @return ICustomer
     */
    public function setNote($note);

    /**
     * @return int
     */
    public function getId();

    /**
     * @return DateTime
     */
    public function getCreated();

    /**
     * @return bool
     */
    public function isArchived();

    /**
     * @return string
     */
    public function getClientNumber();

    /**
     * @return int
     */
    public function getNumber();

    /**
     * @return string
     */
    public function getNumberPre();

    /**
     * @return int
     */
    public function getNumberLength();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getSalutation();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @return string
     */
    public function getZip();

    /**
     * @return string
     */
    public function getCity();

    /**
     * @return string
     */
    public function getState();

    /**
     * @return string
     */
    public function getCountryCode();

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @return string
     */
    public function getFax();

    /**
     * @return string
     */
    public function getMobile();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getWww();

    /**
     * @return string
     */
    public function getTaxNumber();

    /**
     * @return string
     */
    public function getVatNumber();

    /**
     * @return string
     */
    public function getBankAccountOwner();

    /**
     * @return string
     */
    public function getBankNumber();

    /**
     * @return string
     */
    public function getBankName();

    /**
     * @return string
     */
    public function getBankAccountNumber();

    /**
     * @return string
     */
    public function getBankSwift();

    /**
     * @return string
     */
    public function getBankIban();

    /**
     * @return bool
     */
    public function isEnabledCustomerportal();

    /**
     * @return string
     */
    public function getCustomerportalUrl();

    /**
     * @return string
     */
    public function getSepaMandate();

    /**
     * @return string
     */
    public function getSepaMandateDate();

    /**
     * @return string
     */
    public function getLocale();

    /**
     * @return string
     */
    public function getTaxRule();

    /**
     * @return string
     */
    public function getNetGross();

    /**
     * @return string
     */
    public function getDefaultPaymentTypes();

    /**
     * @return float
     */
    public function getReduction();

    /**
     * @return string
     */
    public function getDiscountRateType();

    /**
     * @return float
     */
    public function getDiscountRate();

    /**
     * @return string
     */
    public function getDiscountDaysType();

    /**
     * @return float
     */
    public function getDiscountDays();

    /**
     * @return string
     */
    public function getDueDaysType();

    /**
     * @return float
     */
    public function getDueDays();

    /**
     * @return string
     */
    public function getReminderDueDaysType();

    /**
     * @return float
     */
    public function getReminderDueDays();

    /**
     * @return string
     */
    public function getOfferValidityDaysType();

    /**
     * @return float
     */
    public function getOfferValidityDays();

    /**
     * @return string
     */
    public function getCurrencyCode();

    /**
     * @return string
     */
    public function getPriceGroup();

    /**
     * @return string
     */
    public function getDebitorAccountNumber();

    /**
     * @return bool
     */
    public function hasDunningRun();

    /**
     * @return string
     */
    public function getNote();

    /**
     * @return float
     */
    public function getRevenueGross();

    /**
     * @return float
     */
    public function getRevenueNet();

    /**
     * @return ICustomer[]
     */
    public function findAll($limit = 10, $start = 1);

    /**
     * @param $id
     * @return ICustomer
     */
    public function find($id);

    /**
     * @param $array
     * @return mixed
     */
    public function findBy($array);
}