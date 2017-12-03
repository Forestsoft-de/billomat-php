<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 15:12
 */

namespace Forestsoft\Billomat\Invoice;


use Forestsoft\Billomat\Confirmation\IConfirmation;
use Forestsoft\Billomat\Contact\IContact;
use Forestsoft\Billomat\Customer\ICustomer;
use Forestsoft\Billomat\Freetext\IFreetext;
use Forestsoft\Billomat\IPrice;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Offer\IOffer;
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
     * @var IInvoiceItem[]
     */
    protected $items;

    /**
     * @param int $limit
     * @param int $start
     *
     * @return IInvoice[]
     */
    public function findAll($limit = 10, $start = 1)
    {

    }

    /**
     *
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @return IInvoice
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * @param $array
     * @return Invoice[]
     */
    public function findBy($array)
    {
        // TODO: Implement findBy() method.
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

    protected function validateInterface($interfaceName, $value, $propertyName)
    {
        $oClass = new \ReflectionClass($interfaceName);
        $constants =  $oClass->getConstants();

        if (!in_array($value, $constants)) {
            throw new \InvalidArgumentException(sprintf("%s is not a valid %s. Please use one of %s::*", $value, $propertyName, $interfaceName));
        }
    }
}