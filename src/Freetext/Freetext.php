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
 * User: Forest
 * Date: 03-Dec-17
 * Time: 20:02
 */

namespace Forestsoft\Billomat\Freetext;


use Forestsoft\Billomat\ICustomer;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Resource;

class Freetext extends Resource implements IFreetext
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Freetext
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @var int
     */
    protected $id;

    /**
     * @return mixed
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * @return mixed
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return mixed
     */
    public function getResourceName()
    {
        // TODO: Implement getResourceName() method.
    }

    /**
     * @return mixed
     */
    public function createResource()
    {
        return Factory::getInstance()->create();
    }

    /**
     * @return mixed
     */
    protected function prepareData()
    {
        // TODO: Implement prepareData() method.
    }

}