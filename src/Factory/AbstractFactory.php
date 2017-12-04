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
 * Date: 18-Nov-17
 * Time: 12:37
 */

namespace Forestsoft\Billomat\Factory;

use Forestsoft\Billomat\IResource;

abstract class AbstractFactory implements IFactory
{


    private $_config = [];

    protected static $factoryInstance;

    /**
     * @param mixed $factoryInstance
     */
    public static function setFactoryInstance(\Forestsoft\Billomat\Factory\IFactory $factoryInstance = null)
    {
        static::$factoryInstance = $factoryInstance;
    }


    /**
     * @return IFactory
     */
    public static function getInstance()
    {
        if (static::$factoryInstance == null) {
            static::$factoryInstance = new static();
        }
        return static::$factoryInstance;
    }

    public function setConfig($config)
    {
        $this->_config = $config;
        return $this;
    }

    public function populateSettings(IResource $resource)
    {
        foreach ($this->_config as $key => $value) {
            $method = "set" . strtoupper($key);
            if (is_callable(array($resource, $method))) {
                $resource->$method($value);
            }
        }
    }
}