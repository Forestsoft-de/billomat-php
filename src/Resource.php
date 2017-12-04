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



namespace Forestsoft\Billomat;


use Forestsoft\Billomat\Customer\ICustomer;
use Forestsoft\Billomat\Mapper\Factory;
use Forestsoft\Billomat\Mapper\Mapper;
use PHPUnit\Runner\Exception;
use Zend\Http\Client;

abstract class Resource implements IResource
{

    private $_billomatId;
    private $_apikey;
    private $_page = 1;
    private $_perPage = 50;
    private $_language = "de_DE";
    private $_order;

    /**
     * @var \Forestsoft\Billomat\Client\IClient
     */
    private $_client;

    /**
     * @var
     */
    private $_clientFactory;

    /**
     * @var Mapper
     */
    private $_mapper;

    /**
     * @param string $key
     * @return $this|IResource
     */
    public function setApiKey($key)
    {
        $this->_apikey = $key;
        return $this;
    }


    /**
     * @param string $id
     * @return $this|IResource
     */
    public function setBillomatId($id)
    {
        $this->_billomatId = $id;
        return $this;
    }

    /**
     * @param int $page
     * @return $this|IResource
     */
    public function setPage($page)
    {
        $this->_page = $page;
        return $this;
    }

    /**
     * @param int $perPage
     * @return $this|IResource
     */
    public function setPerPage($perPage)
    {
        $this->_perPage = $perPage;
        return $this;
    }

    /**
     * @param string $order
     * @return $this|mixed
     */
    public function setOrder($order)
    {
        $this->_order = $order;
        return $this;
    }

    /**
     * @param string $language
     * @return $this|IResource
     */
    public function setLanguage($language)
    {
        $this->_language = $language;
        return $this;
    }


    public function setMapper(\Forestsoft\Billomat\Mapper\IResourceMapper $mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    /**
     * @return Mapper
     */
    protected function createMapper()
    {
        return $this->_mapper;
    }

    public function __construct()
    {
        $this->_mapper = Factory::getInstance()->create();
    }


    /**
     * @return Factory\IClient
     */
    public function getClientFactory()
    {
        if ($this->_clientFactory == null) {
            $this->setClientFactory(\Forestsoft\Billomat\Factory\Client::getInstance());
        }
        return $this->_clientFactory;
    }

    public function setClientFactory(\Forestsoft\Billomat\Factory\IClient $factory)
    {
        $this->_clientFactory = $factory;
        return $this;
    }

    protected function getOptions($addOptions = [])
    {
        $options =  [
            "billomat" => [
                "billomatId" => $this->_billomatId,
                "apiKey" => $this->_apikey,
//                "language" => $this->_language,
//                "page" => $this->_page,
//                "per_page" => $this->_perPage,
//                "order" => $this->_order,
            ]
        ];

        if (!empty($addOptions["billomat"])) {
            $options["billomat"] = array_merge($options["billomat"], $addOptions["billomat"]);
        }

        return $options;
    }

    protected function validate($type, $value, $propertyName)
    {
        switch ($type) {
            case "date":
                $date = \DateTime::createFromFormat("Y-m-d", $value);
                if (!$date) {
                    throw new \InvalidArgumentException(sprintf("%s for property %s is not a valid date format. Use Y-m-d", $value, $propertyName));
                }
                break;
        }
    }

    /**
     * @param $action
     * @return mixed
     */
    protected function performCrUpAction($action)
    {
        if ($action === "update") {
            $action = $this->getId() . "/" . $action;
        }
        
        $client = $this->getClientFactory()->create($this->getResourceName() . "/" . $action, $this->getOptions());
        $data = $this->prepareData();
        $customerResponse = $client->request($data);
        $customer = $this->createResource();

        $index = $this->getSingularResource();

        if (in_array($client->getResponse()->getStatusCode(), [200,201])) {
            if (!empty($customerResponse[$index])) {
                $mapper = $this->createMapper();
                $mapper->map($customer, new \ArrayObject($customerResponse[$index]));
            }
        }

        return $customer;
    }

    /**
     * @param $interfaceName
     * @param $value
     * @param $propertyName
     */
    protected function validateInterface($interfaceName, $value, $propertyName)
    {
        $oClass = new \ReflectionClass($interfaceName);
        $constants =  $oClass->getConstants();

        if (!in_array($value, $constants)) {
            throw new \InvalidArgumentException(sprintf("%s is not a valid %s. Please use one of %s::*", $value, $propertyName, $interfaceName));
        }
    }

    /**
     * @param $array
     */
    protected function validateSearch($array)
    {
        foreach ($array as $key => $value) {
            $this->validateInterface("Forestsoft\Billomat\\" . ucfirst($this->getSingularResource()) . "\ISearch", $key, "search");
        }
    }

    /**
     * @return bool
     */
    protected function performDelete()
    {
        $client = $this->getClientFactory()->create($this->getResourceName() . "/" . $this->getId() . "/delete", $this->getOptions());
        $client->request();

        return $client->getResponse()->getStatusCode() == 200;
    }

    protected function getSingularResource()
    {
        return substr($this->getResourceName(), 0, strlen($this->getResourceName()) -1);
    }

    abstract protected function prepareData();
}