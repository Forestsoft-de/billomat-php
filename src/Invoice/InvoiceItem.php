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


use Forestsoft\Billomat\Article\Article;
use Forestsoft\Billomat\Article\IArticle;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Resource;
use Forestsoft\Billomat\Tax\ITax;

class InvoiceItem extends Resource implements IInvoiceItem
{

    protected $_resourceName = "invoice-items";

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
     * @var int
     */
    protected $id;

    /**
     * @var IInvoice
     */
    protected $invoice;

    /**
     * @var int 
     */
    protected $position = 1;
    
    /**
     * @var IArticle
     */
    protected $article;

    protected $reduction = 0;

    protected $description;

    /**
     * @return int
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * @param int $reduction
     * @return InvoiceItem
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
        return $this;
    }

    /**
     * @return ITax
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param ITax $tax
     * @return InvoiceItem
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @var ITax
     */
    protected $tax;

    /**
     * @return int
     */
    public function getArticleId()
    {
        return $this->getArticle()->getId();
    }

    /**
     * @return IArticle
     */
    public function getArticle()
    {
        if ($this->article == null) {
            return \Forestsoft\Billomat\Article\Factory::getInstance()->create();
        }
        return $this->article;
    }

    /**
     * @param int $articleId
     * @return InvoiceItem
     */
    public function setArticle(IArticle $article)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return mixed
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

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
        $this->unitPrice = floatval($unitPrice);
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
        $this->quantity = intval($quantity);
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

    /**
     * @return IResource
     */
    public function createResource()
    {
        $factory = \Forestsoft\Billomat\Factory\InvoiceItem::getInstance();
        $invoiceItem = $factory->create();
        return $invoiceItem;
    }

    /**
     * @return mixed
     */
    protected function prepareData()
    {
           $item = [
               "position" => $this->position,
               "reduction" => $this->getReduction(),
           ];

           if ($this->getId()) {
               $item["id"] = $this->getId();
           }

           if ($this->getArticleId()) {
               $item["article_id"] = $this->getArticleId();
           }

           if ($this->getInvoice()->getId()) {
               $item["invoice_id"] = $this->getInvoice()->getId();
           }
           if ($this->getUnitPrice()) {
               $item["unit_price"] = $this->getUnitPrice();

               $totalGross = $this->getQuantity() * $this->getUnitPrice() - $this->getReduction();
               $totalGrossUnreduced = $this->getQuantity() * $this->getUnitPrice();

               $taxRate = ($this->getTax()->getRate() / 100);
               $totalNet = number_format($totalGross / (1 + $taxRate), 2);

               $totalNetUnreduced = number_format($totalGrossUnreduced / (1 + $taxRate), 2);

               $item["total_gross"]  = $totalGross;
               $item["total_net"]    = $totalNet;
               $item["total_gross_unreduced"] = $totalGrossUnreduced;
               $item["total_net_unreduced"] = $totalNetUnreduced;

           }
           if ($this->getUnit()) {
               $item["unit"] = $this->getUnit();
           }

           if ($this->getTitle()) {
                $item["title"] = $this->getTitle();
           }
           if ($this->getQuantity()) {
                $item["quantity"] = $this->getQuantity();
           }

           if ($this->getTax()->getRate()) {
               $item["tax_rate"] = $this->getTax()->getRate();
           }

           if ($this->getTax()->getName()) {
               $item["tax_name"] = $this->getTax()->getName();
           }

           if ($this->getDescription()) {
               $item["description"] = $this->getDescription();
           }

        return [ "invoice-item" => $item];
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
     * @return InvoiceItem
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return IInvoice
     */
    public function getInvoice()
    {
        if ($this->invoice == null) {
            return \Forestsoft\Billomat\Invoice\Factory::getInstance()->create();
        }
        return $this->invoice;
    }

    /**
     * @param IInvoice $invoice
     * @return InvoiceItem
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return InvoiceItem
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }
}