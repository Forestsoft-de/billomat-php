<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 16:57
 */
namespace Forestsoft\Billomat\Invoice;

interface IInvoiceItem
{
    /**
     * @param string $unit
     * @return InvoiceItem
     */
    public function setUnit($unit);

    /**
     * @return string
     */
    public function getUnit();

    /**
     * @param float $unitPrice
     * @return InvoiceItem
     */
    public function setUnitPrice($unitPrice);

    /**
     * @return float
     */
    public function getUnitPrice();

    /**
     * @param int $quantity
     * @return InvoiceItem
     */
    public function setQuantity($quantity);

    /**
     * @return int
     */
    public function getQuantity();

    /**
     * @param string $title
     * @return InvoiceItem
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();
}