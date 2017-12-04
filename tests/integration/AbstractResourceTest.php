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

namespace Forestsoft\Billomat\Test\Integration;

use PHPUnit\Framework\TestCase;

abstract class AbstractResourceTest extends TestCase
{
    /**
     * @var \Forestsoft\Billomat\Factory\Customer
     */
    protected $_customerFactory;

    /**
     * @var  \Forestsoft\Billomat\Contact\Factory
     */
    protected $_contactFactory;

    /**
     * @var \Forestsoft\Billomat\Invoice\Factory
     */
    private $_invoiceFactory;


    protected function setUp()
    {
        $this->_customerFactory = \Forestsoft\Billomat\Factory\Customer::getInstance();
        $this->setConfigToFactory($this->_customerFactory);

        $this->_contactFactory = \Forestsoft\Billomat\Contact\Factory::getInstance();
        $this->setConfigToFactory($this->_contactFactory);

        $this->_invoiceFactory = \Forestsoft\Billomat\Invoice\Factory::getInstance();
        $this->setConfigToFactory($this->_invoiceFactory);
    }

    /**
     * @param $factory
     */
    protected function setConfigToFactory($factory)
    {
        $config = \Forestsoft\Billomat\TestHelper::getConfig();
        $factory->setConfig(
            $config['integration']['billomat']
        );
    }
}
