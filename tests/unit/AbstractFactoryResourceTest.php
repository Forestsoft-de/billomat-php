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

abstract class AbstractFactoryResourceTest extends AbstractFactoryTest
{

    const EXPECTED_API = "mySecretAPIKey";

    public static $config =  [
        "apiKey" => "mySecretAPIKey",
        "billomatId" => "forestsoft",
        "page" => 1,
        "perPage" => 10,
        "language" => "de_DE",
        "order" => "firstname:asc"
    ];

    protected $_object;

    protected function setUp()
    {
        parent::setUp();
        $this->_object->setConfig(AbstractFactoryResourceTest::$config);
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
     * @depends testcreate
     */
    public function testHasApiKey()
    {
        $this->assertAttributeEquals(self::$config['apiKey'], '_apikey', $this->_object->create());
    }

    /**
     * @depends testcreate
     */
    public function testBillomatId()
    {
        $this->assertAttributeEquals(self::$config['billomatId'], '_billomatId', $this->_object->create());
    }

    /**
     * @depends testcreate
     */
    public function testPage()
    {
        $this->assertAttributeEquals(self::$config['page'], '_page', $this->_object->create());
    }
    
    /**
     * @depends testcreate
     */
    public function testperPage()
    {
        $this->assertAttributeEquals(self::$config['perPage'], '_perPage', $this->_object->create());
    }

    /**
     * @depends testcreate
     */
    public function testLang()
    {
        $this->assertAttributeEquals(self::$config['language'], '_language', $this->_object->create());
    }

    /**
     * @depends testcreate
     */
    public function testOrder()
    {
        $this->assertAttributeEquals(self::$config['order'], '_order', $this->_object->create());
    }
}