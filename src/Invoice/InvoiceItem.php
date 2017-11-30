<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 16:44
 */

namespace Forestsoft\Billomat\Invoice;


class InvoiceItem implements IInvoiceItem
{
    /**
     * @var string
     */
    protected $unit;

    /**
     * @var float
     */
    protected $unitPrice;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $title;

    /**
     * @param string $unit
     * @return InvoiceItem
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param float $unitPrice
     * @return InvoiceItem
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param int $quantity
     * @return InvoiceItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param string $title
     * @return InvoiceItem
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
}