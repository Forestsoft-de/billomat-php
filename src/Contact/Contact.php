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
use Forestsoft\Billomat\Customer\Customer;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Resource;

class Contact extends Customer implements IContact
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
     * @return ICustomer
     */
    public function getClient()
    {
        return $this->customer;
    }

    /**
     * @param ICsutomer $customer
     * 
     * @return Contact
     */
    public function setClient(ICustomer $customer)
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
        if (!$this->getClient() || $this->getClient()->getId() == null) {
            throw new \InvalidArgumentException("Cannot find contacts because Customer is not set");
        }

        return $this->_performFindRequest($limit, $start, ["client_id" => $this->getClient()->getId()]);
    }

    protected function prepareData()
    {
        return [
            "contact" => [
                "client_id" =>  $this->getClient()->getId(),
                "name" => $this->getName(),
                "salutation" => $this->getSalutation(),
                "first_name" => $this->getFirstName(),
                "last_name" => $this->getLastName(),
                "street" => $this->getStreet(),
                "zip" => $this->getZip(),
                "city" => $this->getCity(),
                "state" => $this->getState(),
                "country_code" => $this->getCountryCode(),
                "phone" => $this->getPhone(),
                "fax" => $this->getFax(),
                "mobile" => $this->getMobile(),
                "email" => $this->getEmail(),
                "www" => $this->getWww(),
            ]
        ];
    }

    public function createResource()
    {
        $resource = Factory::getInstance()->create();
        return $resource;
    }
}