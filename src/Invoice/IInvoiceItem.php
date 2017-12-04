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