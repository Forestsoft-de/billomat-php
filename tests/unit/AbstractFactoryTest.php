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



namespace Forestsoft\Billomat\Test;

use Forestsoft\Billomat\BaseTest;

abstract class AbstractFactoryTest extends BaseTest
{

    protected $_object;

    protected function setUp()
    {
        $this->_object = $this->getObject();
    }

    public function testInstanceOfIFactory()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\Factory\IFactory', $this->_object);
    }

    /**
     * @depepnds testInstanceOfIFactory
     */
    public function testGetInstance()
    {
        $actual = call_user_func([$this->_object, "getInstance"]);
        $this->assertInstanceOf(get_class($this->_object), $actual);
    }

    /**
     * @depends testInstanceOfIFactory
     */
    public function testcreate()
    {
        $this->assertInstanceOf($this->getResourceInterface(), $this->_object->create());
    }

    /**
     * @param $key
     * @param $expectedValue
     */
    protected function assertFactorySetDefault($key, $expectedValue)
    {
        $object = $this->_object->create();
        $this->assertAttributeEquals($expectedValue, $key, $object, sprintf('Property "%s" of %s is not set to "%s"', $key, get_class($object), $expectedValue));
    }

    abstract protected function getResourceInterface();
    
    abstract protected function getObject();
}