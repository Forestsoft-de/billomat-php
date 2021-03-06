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


use Forestsoft\Billomat\Mapper\Mapper;

abstract class AbstractResourceTest extends BaseTest
{
    /**
     * @var \Forestsoft\Billomat\Factory\ICustomer
     */
    protected $_resourceFactory;

    /**
     * @var IClient
     */
    protected $clientFactory;

    /**
     * @var \Forestsoft\Billomat\Client\IClient
     */
    protected $_client;

    protected $_expectedOptions =   [
        "billomat" => [
            "billomatId" => "myBillomatId",
            'apiKey' => null,
        ]
    ];

    /**
     * @var Mapper
     */
    protected $_mapperMock;

    
    protected $_resource;

    protected $_responseMock;

    protected $_object;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->_object = $this->getObject();

        $this->_object->setBillomatId("myBillomatId");


        $this->clientFactory = $this->getMockBuilder('Forestsoft\Billomat\Factory\IClient')->getMock();
        $this->_resourceFactory = $this->getMockBuilder($this->getResourceFactoryInterfaceName())->getMock();
        $this->_resource = $this->getMockBuilder($this->getResourceInterfaceName())->getMock();
        $this->_resourceFactory->expects($this->any())->method("create")->willReturn($this->_resource);
        $this->_responseMock = $this->getMockBuilder('Zend\Http\Response')->getMock();

        $this->_mapperMock = $this->getMockBuilder('Forestsoft\Billomat\Mapper\IResourceMapper')->getMock();

        $this->_client = $this->getMockBuilder('Forestsoft\Billomat\Client\IClient')->getMock();
        $this->_client->expects($this->any())->method('getResponse')->willReturn($this->_responseMock);

        $this->_object->setMapper($this->_mapperMock);
        $this->_object->setClientFactory($this->clientFactory);

        call_user_func([$this->getFactoryClassName(), "setFactoryInstance"], $this->_resourceFactory);

    }


    protected function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        call_user_func([$this->getFactoryClassName(), "setFactoryInstance"], null);
    }

    public function assertCreateWorks($resource, $data, $expectedRequest, $response)
    {
        $this->_prepareRequest($resource . "/create", $data, $expectedRequest, $response);

        $actual = $this->_object->create();

        $this->assertSame($this->_resource, $actual, "Returned Resource of " . $resource . "/create is not an instance of created resource");
    }

    public function assertDeleteWorks($resource, $data, $expectedResult = true, $httpStatusCode = 200)
    {
        $uri = $resource;
        if (array_key_exists('id', $data)) {
            $uri .= "/" . $data['id'] . "/delete";
        } else {
            $this->fail("No id identifier to perform delete action on resource");
        }

        $this->_prepareRequest($uri, $data, [], [], $httpStatusCode);

        $actual = $this->_object->delete();
        $this->assertEquals($expectedResult, $actual);
    }

    public function assertUpdateWorks($resource, $data, $expectedRequest, $response, $httpStatusCode = 200)
    {
        $uri = $resource;
        if (array_key_exists('id', $data)) {
            $uri .= "/" . $data['id'] . "/update";
        } else {
            $this->fail("No id identifier to perform update action on resource");
        }
        $this->_prepareRequest($uri, $data, $expectedRequest, $response, $httpStatusCode);

        $actual = $this->_object->update();
        $this->assertSame($this->_resource, $actual);
    }

    /**
     * @param $uri
     * @param array $dataToMap
     * @param array $expectedRequest
     * @param array $response
     * @param int $httpStatusCode
     */
    protected function _prepareRequest($uri, $dataToMap = [], $expectedRequest = [], $response = [], $httpStatusCode = 201)
    {
        $mapper = new Mapper();
        $mapper->map($this->_object, new \ArrayObject($dataToMap));

        $this->_client->expects($this->once())->method("request")
            ->with($expectedRequest)
            ->willReturn($response);

        $this->_client->expects($this->once())->method("getResponse")->willReturn($this->_responseMock);
        $this->_responseMock->expects($this->any())->method("getStatusCode")->willReturn($httpStatusCode);

        $this->clientFactory->expects($this->once())->method("create")->with($uri, $this->_expectedOptions)->willReturn($this->_client);

        if (!stristr($uri, "delete")) {
            $this->_mapperMock->expects($this->once())->method('map')->with($this->_resource)->willReturn($this->_resource);
        }

        $this->_object->setClientFactory($this->clientFactory);
    }

    public function testGetResourceName()
    {
        $actual = $this->_object->getResourceName();
        $this->assertNotNull($actual);
        $actual = strtolower(str_replace("-","", $actual));

        $expected = $this->_getSutClassName();

        $this->assertContains($expected, $actual);
    }

    private function _getSutClassName()
    {
        $reflect = new \ReflectionClass($this->getObject());
        $expected = $reflect->getShortName();
        $expected = strtolower($expected);
        $expected = str_replace("customer", "client", $expected);

        return $expected;
    }

    /**
     * @depends testGetResourceName
     */
    public function testGetSingularResource()
    {
        $actual = $this->_object->getSingularResource();
        $actual = strtolower(str_replace("-","", $actual));
        $this->assertNotNull($actual);
        $expected = $this->_getSutClassName();
        $this->assertContains($expected, $actual);
    }


    public function testCreateResource()
    {
        $this->assertInstanceOf($this->getResourceInterfaceName(), $this->_object->createResource());
    }

    abstract public function getResourceInterfaceName();

    public function getResourceFactoryInterfaceName()
    {
        return 'Forestsoft\Billomat\Factory\IFactory';
    }

    abstract public function getFactoryClassName();

    abstract protected function getObject();
}