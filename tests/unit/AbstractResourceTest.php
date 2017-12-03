<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 01.12.2017
 * Time: 16:47
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


    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->_object->setBillomatId("myBillomatId");


        $this->clientFactory = $this->getMockBuilder('Forestsoft\Billomat\Factory\IClient')->getMock();
        $this->_resourceFactory = $this->getMockBuilder('Forestsoft\Billomat\Factory\ICustomer')->getMock();
        $this->_resource = $this->getMockBuilder('Forestsoft\Billomat\Customer\ICustomer')->getMock();
        $this->_resourceFactory->expects($this->any())->method("create")->willReturn($this->_resource);
        $this->_responseMock = $this->getMockBuilder('Zend\Http\Response')->getMock();

        $this->_mapperMock = $this->getMockBuilder('Forestsoft\Billomat\Mapper\IResourceMapper')->getMock();

        $this->_client = $this->getMockBuilder('Forestsoft\Billomat\Client\IClient')->getMock();
        $this->_client->expects($this->any())->method('getResponse')->willReturn($this->_responseMock);

        $this->_object->setMapper($this->_mapperMock);
        $this->_object->setClientFactory($this->clientFactory);

        \Forestsoft\Billomat\Factory\Customer::setFactoryInstance($this->_resourceFactory);

    }


    public function assertCreateWorks($resource, $data, $expectedRequest, $response)
    {
        $mapper = new Mapper();
        $mapper->map($this->_object, new \ArrayObject($data));

        $this->_client->expects($this->once())->method("request")
            ->with($expectedRequest)
            ->willReturn($response);

        $this->_client->expects($this->once())->method("getResponse")->willReturn($this->_responseMock);
        $this->_responseMock->expects($this->any())->method("getStatusCode")->willReturn(201);

        $this->clientFactory->expects($this->once())->method("create")->with( $resource . "/create", $this->_expectedOptions)->willReturn($this->_client);
        $this->_mapperMock->expects($this->once())->method('map')->with($this->_resource)->willReturn($this->_resource);
        
        $this->_object->setClientFactory($this->clientFactory);

        $actual = $this->_object->create();

        $this->assertSame($this->_resource, $actual);
    }
}