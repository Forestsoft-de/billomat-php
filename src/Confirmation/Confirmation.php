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



namespace Forestsoft\Billomat\Confirmation;


use Forestsoft\Billomat\Contact\IContact;
use Forestsoft\Billomat\Freetext\IFreetext;
use Forestsoft\Billomat\ICustomer;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Resource;
use Forestsoft\Billomat\Tax\IRepository;
use Forestsoft\Billomat\Template\ITemplate;

class Confirmation extends Resource implements IConfirmation
{
    /**
     * @var string
     */
    protected $_resourceName = "confirmations";

    /**
     * @var int
     */
    protected $_id = null;

    /**
     * @var ICustomer
     */
    protected $_client = null;

    /**
     * @var IContact
     */
    protected $_contact = null;

    /**
     * @var string
     */
    protected $_created = null;

    /**
     * @var string
     */
    protected $confirmationNumber;

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    protected $numberPre;

    /**
     * @var string
     */
    protected $numberLength;

    /**
     * @var string
     */
    protected $status = "DRAFT";

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $intro;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var string
     */
    protected $totalGross;

    /**
     * @var string
     */
    protected $totalNet;

    /**
     * @var string
     */
    protected $netGross;

    /**
     * @var string
     */
    protected $reduction;

    /**
     * @var string
     */
    protected $totalGrossUnreduced;

    /**
     * @var string
     */
    protected $totalNetUnreduced;

    /**
     * @var string
     */
    protected $currencyCode;

    /**
     * @var float
     */
    protected $quote;
    /**
     * @var string
     */
    protected $customerportalUrl;

    /**
     * @var string
     */
    protected $taxes;

    /**
     * @var IOffer
     */
    protected $offer;

    /**
     * @var ITemplate
     */
    protected $template;

    /**
     * @var IFreetext
     */
    protected $freeText;

    /**
     * @var IRepo
     */
    protected $items;

    /**
     * @return ITemplate
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param ITemplate $template
     * @return Confirmation
     */
    public function setTemplate(ITemplate $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return IFreetext
     */
    public function getFreeText()
    {
        return $this->freeText;
    }

    /**
     * @param IFreetext $freeText
     * @return Confirmation
     */
    public function setFreeText(IFreetext $freeText)
    {
        $this->freeText = $freeText;
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
     * @return mixed
     */
    public function createResource()
    {
        return Factory::getInstance()->create();
    }

    /**
     * @param null $id
     * @return Confirmation
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function prepareData()
    {
        // TODO: Implement prepareData() method.
    }

    /**
     * @return string
     */
    public function getConfirmationNumber()
    {
        return $this->confirmationNumber;
    }

    /**
     * @param string $confirmationNumber
     * @return Confirmation
     */
    public function setConfirmationNumber($confirmationNumber)
    {
        $this->confirmationNumber = $confirmationNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Confirmation
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumberPre()
    {
        return $this->numberPre;
    }

    /**
     * @param string $numberPre
     * @return Confirmation
     */
    public function setNumberPre($numberPre)
    {
        $this->numberPre = $numberPre;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumberLength()
    {
        return $this->numberLength;
    }

    /**
     * @param string $numberLength
     * @return Confirmation
     */
    public function setNumberLength($numberLength)
    {
        $this->numberLength = $numberLength;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Confirmation
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Confirmation
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Confirmation
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Confirmation
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Confirmation
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * @param string $intro
     * @return Confirmation
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
        return $this;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Confirmation
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalGross()
    {
        return $this->totalGross;
    }

    /**
     * @param string $totalGross
     * @return Confirmation
     */
    public function setTotalGross($totalGross)
    {
        $this->totalGross = $totalGross;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalNet()
    {
        return $this->totalNet;
    }

    /**
     * @param string $totalNet
     * @return Confirmation
     */
    public function setTotalNet($totalNet)
    {
        $this->totalNet = $totalNet;
        return $this;
    }

    /**
     * @return string
     */
    public function getNetGross()
    {
        return $this->netGross;
    }

    /**
     * @param string $netGross
     * @return Confirmation
     */
    public function setNetGross($netGross)
    {
        $this->netGross = $netGross;
        return $this;
    }

    /**
     * @return string
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * @param string $reduction
     * @return Confirmation
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalGrossUnreduced()
    {
        return $this->totalGrossUnreduced;
    }

    /**
     * @param string $totalGrossUnreduced
     * @return Confirmation
     */
    public function setTotalGrossUnreduced($totalGrossUnreduced)
    {
        $this->totalGrossUnreduced = $totalGrossUnreduced;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalNetUnreduced()
    {
        return $this->totalNetUnreduced;
    }

    /**
     * @param string $totalNetUnreduced
     * @return Confirmation
     */
    public function setTotalNetUnreduced($totalNetUnreduced)
    {
        $this->totalNetUnreduced = $totalNetUnreduced;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     * @return Confirmation
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * @param float $quote
     * @return Confirmation
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerportalUrl()
    {
        return $this->customerportalUrl;
    }

    /**
     * @param string $customerportalUrl
     * @return Confirmation
     */
    public function setCustomerportalUrl($customerportalUrl)
    {
        $this->customerportalUrl = $customerportalUrl;
        return $this;
    }

    /**
     * @return IRepository
     */
    public function getTaxes()
    {
        return $this->taxes;
    }

    /**
     * @param IRepository $taxes
     *
     * @return Confirmation
     */
    public function setTaxes(IRepository $taxes)
    {
        $this->taxes = $taxes;
        return $this;
    }

    /**
     * @return IOffer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * @param IOffer $offer
     * @return Confirmation
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;
        return $this;
    }

    /**
     * @return ICustomer
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * @param ICustomer $client
     * @return Confirmation
     */
    public function setClient(\Forestsoft\Billomat\Customer\ICustomer $client)
    {
        $this->_client = $client;
        return $this;
    }

    /**
     * @return IContact
     */
    public function getContact()
    {
        return $this->_contact;
    }

    /**
     * @param IContact $contact
     * @return Confirmation
     */
    public function setContact(IContact $contact)
    {
        $this->_contact = $contact;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated()
    {
        return $this->_created;
    }

    /**
     * @param string $created
     * @return Confirmation
     */
    public function setCreated($created)
    {
        $this->_created = $created;
        return $this;
    }
}