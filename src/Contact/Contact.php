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



namespace Forestsoft\Billomat\Contact;


use Forestsoft\Billomat\Customer\ICustomer;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Resource;

class Contact extends Resource implements IContact
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $_resourceName = "contacts";

    /**
     * @return ICsutomer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param ICsutomer $customer
     * 
     * @return Contact
     */
    public function setCustomer(ICustomer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @var ICsutomer
     */
    protected $customer;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Contact
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * 
     */
    public function findAll($limit = 10, $start = 1)
    {
        if (!$this->getCustomer() || $this->getCustomer()->getId() == null) {
            throw new \InvalidArgumentException("Cannot find contacts because Customer is not set");
        }

        return $this->_performFindRequest($limit, $start, ["client_id" => $this->getCustomer()->getId()]);
    }

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

    protected function prepareData()
    {
        // TODO: Implement prepareData() method.
    }

    public function createResource()
    {
        $resource = Factory::getInstance()->create();
        return $resource;
    }


}