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

interface IContact extends IResource
{

    /**
     * @param int $id
     * @return Icontact
     */
    public function setId($id);

    /**
     * @return int
     */
     public function getId();

    /**
     * @return IContact[]
     */
    public function findAll($limit = 10, $start = 1);

    /**
     * @param ICustomer $customer
     * @return IContact
     */
    public function setClient(ICustomer $customer);

    /**
     * @return ICustomer
     */
    public function getClient();

    /**
     * @param string $name
     * @return IContact
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $salutation
     * @return IContact
     */
    public function setSalutation($salutation);

    /**
     * @return string
     */
    public function getSalutation();

    /**
     * @param string $firstName
     * @return IContact
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $lastName
     * @return IContact
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $street
     * @return IContact
     */
    public function setStreet($street);

    /**
     * @return IContact
     */
    public function getStreet();

    /**
     * @param string $zip
     * @return IContact
     */
    public function setZip($zip);

    /**
     * @return string
     */
    public function getZip();

    /**
     * @param string $city
     * @return IContact
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $state
     * @return IContact
     */
    public function setState($state);

    /**
     * @return string
     */
    public function getState();

    /**
     * @param string $countryCode
     * @return IContact
     */
    public function setCountryCode($countryCode);

    /**
     * @return string
     */
    public function getCountryCode();

    /**
     * @param string $phone
     * @return IContact
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $fax
     * @return IContact
     */
    public function setFax($fax);

    /**
     * @return string
     */
    public function getFax();

    /**
     * @param string $mobile
     * @return IContact
     */
    public function setMobile($mobile);

    /**
     * @return string
     */
    public function getMobile();

    /**
     * @param string $email
     * @return IContact
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $www
     * @return IContact
     */
    public function setWww($www);

    /**
     * @return string
     */
    public function getWww();
}