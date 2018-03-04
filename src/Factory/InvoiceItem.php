<?php
/**
 * ForestSoft Billomat PHP
 * @link https://github.com/Forestsoft-de/billomat-php
 * @copyright Copyright (c) 2018. ForestSoft Sebastian Förster
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

namespace Forestsoft\Billomat\Factory;
use Forestsoft\Billomat\Tax\UstNormal;

/**
 * Class InvoiceItem
 * @package Forestsoft\Billomat\Factory
 * 
 * @method \Forestsoft\Billomat\Factory\InvoiceItem getInstance()
 */
class InvoiceItem extends AbstractFactory implements IFactory
{
    protected static $factoryInstance;
    
    /**
     * @return \Forestsoft\Billomat\Invoice\InvoiceItem
     */
    public function create()
    {
        $item = new \Forestsoft\Billomat\Invoice\InvoiceItem();

        $this->populateSettings($item);

        $item->setQuantity(1);

        $tax = new UstNormal();
        $item->setTax($tax);
        
        return $item;
    }

}