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



namespace Forestsoft\Billomat\Invoice;


use Forestsoft\Billomat\Confirmation\IConfirmation;
use Forestsoft\Billomat\Contact\IContact;
use Forestsoft\Billomat\Customer\ICustomer;
use Forestsoft\Billomat\Factory\IFactory;
use Forestsoft\Billomat\Freetext\IFreetext;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Offer\IOffer;
use Forestsoft\Billomat\Payment\IPayment;
use Forestsoft\Billomat\Resource;
use Forestsoft\Billomat\Template\ITemplate;

class Invoice extends Resource implements IResource, IInvoice
{
    /**
     * @var ICustomer
     */
    protected $client;

    /**
     * @var IContact
     */
    protected $contact;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $numberPre;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var int
     */
    protected $numberLength;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $supplyDate;

    /**
     * Typeof ISupplyDate::*
     *
     * @var string
     */
    protected $supplyDateType;

    /**
     * @var string
     */
    protected $dueDate;

    /**
     * @var string
     */
    protected $discountRate;

    /**
     * @var string
     */
    protected $discountDate;

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
    protected $reduction;

    /**
     * @var string
     */
    protected $currencyCode;

    /**
     * @var string
     */
    protected $netGross;

    /**
     * @var float
     */
    protected $quote = 1.0;

    /**
     * List of IPayment::*
     *
     * @var array
     */
    protected $paymentTypes = [];

    /**
     * @var IInvoice
     */
    protected $invoice;

    /**
     * @var IOffer
     */
    protected $offer;

    /**
     * @var IFreetext
     */
    protected $freetext;

    /**
     * @var IConfirmation
     */
    protected $confirmation;

    /**
     * @var ITemplate
     */
    protected $template;

    /**
     * @var int
     */
    protected $id;

    /**
     * Invoice constructor.
     * @param ICustomer $client
     * @param IContact $contact
     * @param IOffer $offer
     * @param IFreetext $freetext
     * @param IConfirmation $confirmation
     * @param ITemplate $template
     * @param IRecurring $recurring
     * @param IInvoiceItem[] $items
     */
    public function __construct(
        ICustomer $client = null,
        IContact $contact = null,
        IOffer $offer = null,
        IFreetext $freetext = null,
        IConfirmation $confirmation = null,
        ITemplate $template = null,
        IRecurring $recurring = null,
        IInvoice $invoice = null,
        array $items = null)
    {
        $this->client =       $this->_createOrSet($client, "Forestsoft\Billomat\Factory\Customer");
        $this->contact =      $this->_createOrSet($contact, "Forestsoft\Billomat\Contact\Factory");
        $this->offer =        $this->_createOrSet($offer, "Forestsoft\Billomat\Offer\Factory");
        $this->freetext =     $this->_createOrSet($freetext, "Forestsoft\Billomat\Freetext\Factory");
        $this->confirmation = $this->_createOrSet($confirmation, "Forestsoft\Billomat\Confirmation\Factory");
        $this->template =     $this->_createOrSet($template, "Forestsoft\Billomat\Template\Factory");
        $this->recurring =    $this->_createOrSet($recurring, "Forestsoft\Billomat\Recurring\Factory");
        $this->invoice =      $invoice; //prevent loop
        $this->items =        $items;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Invoice
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return IRecurring
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * @param IRecurring $recurring
     * @return Invoice
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;
        return $this;
    }

    /**
     * @var IRecurring
     */
    protected $recurring;

    /**
     * @var IInvoiceItem[]
     */
    protected $items;



    public function getResourceName()
    {
        return "invoices";
    }

    public function createResource()
    {
        $factory = Factory::getInstance();
        $invoice = $factory->create();
        return $invoice;
    }

    /**
     * @param int $limit
     * @param int $start
     *
     * @return IInvoice[]
     */
    public function findAll($limit = 10, $start = 1)
    {

    }

    protected function prepareData()
    {
        $invoice = [];
        
        if ($this->getContact()->getId()) {
            $invoice["contact_id"] = $this->getContact()->getId();
        };

        return [
            "invoice" => array_merge(
                [
                "client_id" => $this->getClient()->getId(),
                "address" => "",
                "number_pre" => "",
                "number" => "",
                "number_length" => "",
                "date" => date("Y-m-d"),
                "supply_date" => date("Y-m-d"),
                "supply_date_type" => ISupplyDate::DELIVERY_DATE,
                "due_date" => date("Y-m-d"),
                "discount_rate" => "",
                "discount_date" => date("Y-m-d"),
                "title" => "",
                "label" => "",
                "intro" => "",
                "note" => "",
                "reduction" => "",
                "currency_code" => "",
                "net_gross" => IPrice::BASE_GROSS,
                "quote" => "",
                "payment_types" => [IPayment::TYPE_BANK_TRANSFER],
                "invoice_id" => $this->getInvoice()->getId(),
                "offer_id" => $this->getOffer()->getId(),
                "confirmation_id" => $this->getConfirmation()->getId(),
                "recurring_id" => $this->getRecurring()->getId(),
                "free_text_id" => $this->getFreetext()->getId(),
                "template_id" => $this->getTemplate()->getId()
                ],
                $invoice
            )
        ];
    }


    /**
     *
     */
    public function create()
    {
        return $this->performCrUpAction("create");
    }

    public function update()
    {
        return $this->performCrUpAction("update");
    }

    public function delete()
    {
        return $this->performDelete();
    }

    /**
     * @param $id
     * @return IInvoice
     */
    public function find($id)
    {
        $client = $this->getClientFactory()->create($this->getResourceName() . "/$id", $this->getOptions());

        $customers = $client->request();

        $invoice = $this->createResource();

        $index = $this->getSingularResource(); 

        if ($client->getResponse()->getStatusCode() == 200) {
            if (!empty($customers[$index])) {
                $mapper = $this->createMapper();
                $mapper->map($invoice, new \ArrayObject($customers[$index]));
            }
        }
        return $invoice;
    }

    /**
     * @param $array
     * @return Invoice[]
     */
    public function findBy($array)
    {
        $this->validateSearch($array);

        $search  = ["search" => $array];

        $options = array_merge($search, $this->getOptions());

        $client = $this->getClientFactory()->create($this->getResourceName(), $options);

        $customerResponse = $client->request();

        $customers = [];

        $index = $this->getSingularResource();
        $indexPlural = $this->getResourceName();
        
        if ($client->getResponse()->getStatusCode() == 200) {
            if (!empty($customerResponse[$indexPlural][$index])) {
                foreach ($customerResponse[$indexPlural][$index] as $client) {
                    $customer = $this->createResource();
                    $mapper = $this->createMapper();
                    $mapper->map($customer, new \ArrayObject($client));

                    $customers[] = $customer;
                }
            }
        }
        return $customers;
    }

    /**
     * @return IContact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param IContact $contact
     *
     * @return IInvoice
     */
    public function setContact(IContact $contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ICustomer $customer
     *
     * @return IInvoice
     */
    public function setClient(ICustomer $customer)
    {
        $this->client = $customer;
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
     * @return Invoice
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
     * @return Invoice
     */
    public function setNumberPre($numberPre)
    {
        $this->numberPre = $numberPre;
        return $this;
    }

    /**
     * @param int $number
     * @return Invoice
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $numberLength
     * @return Invoice
     */
    public function setNumberLength($numberLength)
    {
        $this->numberLength = $numberLength;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberLength()
    {
        return $this->numberLength;
    }

    /**
     * @param string $date
     * @return Invoice
     */
    public function setDate($date)
    {
        $this->validate('date', $date, 'date');
        $this->date = $date;
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
     * @param string $supplyDate
     * @return Invoice
     */
    public function setSupplyDate($supplyDate)
    {
        $this->validate('date', $supplyDate, 'supplyDate');
        $this->supplyDate = $supplyDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getSupplyDate()
    {
        return $this->supplyDate;
    }

    /**
     * @param string $supplyDateType
     * @return Invoice
     */
    public function setSupplyDateType($supplyDateType)
    {
        switch ($supplyDateType) {
            case ISupplyDate::DELIVERY_DATE:
            case ISupplyDate::DELIVERY_TEXT:
            case ISupplyDate::SUPPLY_DATE:
            case ISupplyDate::SUPPLY_TEXT:
                $this->supplyDateType = $supplyDateType;
                break;
            default:
                throw new \InvalidArgumentException(sprintf("%s is not a valid supplydatetype. Please use one of ISupplyDate::*", $supplyDateType));
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getSupplyDateType()
    {
        return $this->supplyDateType;
    }

    /**
     * @param string $dueDate
     * @return Invoice
     */
    public function setDueDate($dueDate)
    {
        $this->validate('date', $dueDate, "dueDate");
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param string $discountRate
     * @return Invoice
     */
    public function setDiscountRate($discountRate)
    {
        $this->discountRate = $discountRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountRate()
    {
        return $this->discountRate;
    }

    /**
     * @param string $title
     * @return Invoice
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * @param string $label
     * @return Invoice
     */
    public function setLabel($label)
    {
        $this->label = $label;
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
     * @param string $intro
     * @return Invoice
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
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
     * @param string $note
     * @return Invoice
     */
    public function setNote($note)
    {
        $this->note = $note;
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
     * @param string $reduction
     * @return Invoice
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
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
     * @param string $currencyCode
     * @return Invoice
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
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
     * @param string $netGross
     * @return Invoice
     */
    public function setNetGross($netGross)
    {
        $this->validateInterface('Forestsoft\Billomat\IPrice', $netGross, 'netGross');
        $this->netGross = $netGross;
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
     * @param float $quote
     * @return Invoice
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;
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
     * @param array $paymentTypes
     * @return Invoice
     */
    public function setPaymentTypes(array $paymentTypes)
    {
        foreach ($paymentTypes as $type) {
            $this->validateInterface('Forestsoft\Billomat\Payment\IPayment', $type, 'paymentType');
        }
        $this->paymentTypes = $paymentTypes;
        return $this;
    }

    /**
     * @return array
     */
    public function getPaymentTypes()
    {
        return $this->paymentTypes;
    }

    /**
     * @param IInvoice $invoiceId
     *
     * @return Invoice
     */
    public function setInvoice(IInvoice $invoiceId)
    {
        $this->invoice = $invoiceId;
        return $this;
    }

    /**
     * @return IInvoice
     */
    public function getInvoice()
    {
        if ($this->invoice == null) {
            $this->invoice = $this->_createOrSet(null, "Forestsoft\Billomat\Invoice\Factory");
        }
        return $this->invoice;
    }

    /**
     * @param IOffer $offerId
     * @return Invoice
     */
    public function setOffer(IOffer $offerId)
    {
        $this->offer = $offerId;
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
     * @param string $discountDate
     * @return Invoice
     */
    public function setDiscountDate($discountDate)
    {
        $this->validate("date", $discountDate, 'dicountDate');
        $this->discountDate = $discountDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountDate()
    {
        return $this->discountDate;
    }

    /**
     * @param IFreetext $freetext
     * @return Invoice
     */
    public function setFreetext(IFreetext $freetext)
    {
        $this->freetext = $freetext;
        return $this;
    }

    /**
     * @return IFreetext
     */
    public function getFreetext()
    {
        return $this->freetext;
    }

    /**
     * @param IConfirmation $confirmation
     * @return Invoice
     */
    public function setConfirmation(IConfirmation $confirmation)
    {
        $this->confirmation = $confirmation;
        return $this;
    }

    /**
     * @return IConfirmation
     */
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * @param ITemplate $template
     * @return Invoice
     */
    public function setTemplate(ITemplate $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return ITemplate
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param IInvoiceItem[] $items
     * @return Invoice
     */
    public function setItems(\Traversable $items)
    {
        foreach ($items as $item) {
            if (!($item instanceof IInvoiceItem)) {
                throw new \InvalidArgumentException(sprintf("There is an invalid invoice item in item collection"));
            }
        }
        $this->items = $items;
        return $this;
    }

    /**
     * @return IInvoiceItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    private function _createOrSet($object, $factory)
    {
        if (!$object) {
            $factoryMethod = [$factory, "getInstance"];
            if (is_callable($factoryMethod)) {
                $factoryInstance =  call_user_func($factoryMethod);
                if ($factoryInstance instanceof IFactory) {
                    return $factoryInstance->create();
                }
            }
        }
        return $object;
    }
}