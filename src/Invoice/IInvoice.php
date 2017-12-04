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
 * Time: 15:12
 */

namespace Forestsoft\Billomat\Invoice;


use Forestsoft\Billomat\IResource;

interface IInvoice extends IResource
{
    /**
     * @return IInvoice[]
     */
    public function findAll($limit = 10, $start = 1);

    /**
     * @param $id
     * @return IInvoice
     */
    public function find($id);

    /**
     * @param $array
     * @return Invoice[]
     */
    public function findBy($array);

    /**
     * @return IInvoice
     */
    public function createResource();

    /**
     * @return int
     */
    public function getId();
}