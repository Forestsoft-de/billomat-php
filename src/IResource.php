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


use Zend\Http\Client;

interface IResource
{
    const SETTINGS_TYPE_SETTING = "SETTINGS";
    const SETTINGS_TYPE_ABSOLUTE = "ABSOLUTE";
    const SETTINGS_TYPE_RELATIVE = "RELATIVE";
    
    /**
     * Billomat API Key 
     * @param string $key
     * 
     * @return IResource
     */
    public function setApiKey($key);

    /**
     * @param string $id
     * 
     * @return IResource
     */
    public function setBillomatId($id);

    /**
     * @param int $page
     * 
     * @return IResource
     */
    public function setPage($page);

    /**
     * @param int $perPage
     * 
     * @return IResource
     */
    public function setPerPage($perPage);

    /**
     * @param string $order
     *
     * @return mixed
     */
    public function setOrder($order);

    /**
     * 
     * @param string $language
     * 
     * @return IResource
     */
    public function setLanguage($language);

    /**
     * Create Resource
     *
     * @return ICustomer
     */
    public function create();

    /**
     * Update Resource
     * 
     * @return ICustomer
     */
    public function update();

    /**
     * Delete Resource
     * 
     * @return bool
     */
    public function delete();
    

    /**
     * @param \Forestsoft\Billomat\Factory\IClient $client
     * @return mixed
     */
    public function setClientFactory(\Forestsoft\Billomat\Factory\IClient $client);

    /**
     * @param Mapper\IResourceMapper $mapper
     * @return mixed
     */
    public function setMapper(\Forestsoft\Billomat\Mapper\IResourceMapper $mapper);

    /**
     * @return string
     */
    public function getResourceName();

    /**
     * @return string
     */
    public function getSingularResource();

    /**
     * @return IResource
     */
    public function createResource();
}