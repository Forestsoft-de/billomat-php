<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 10:48
 */

namespace Forestsoft\Billomat\Factory;

use PHPUnit\Framework\TestCase;
use Zend\Http\Request;

class ClientTest extends TestCase
{
    const EXPECTED_INSTANCE = 'Zend\Http\Client';
    public static $billoMatId = "forestsoft";

    public static $apiKey = "123APIKey";

    public function testCreateSingleton()
    {
        $first = Client::singleton();
        $second = Client::singleton();

        $this->assertInstanceOf(self::EXPECTED_INSTANCE, $first);
        
        $this->assertSame($first,$second);
    }

    public function testCreateZendClient()
    {
        $actual = Client::factory();
        $this->assertInstanceOf(self::EXPECTED_INSTANCE, $actual);
    }
    

    /**
     * @depends testCreateZendClient
     * @dataProvider dp_config
     */
    public function testCreateClient($expectedUri, $expectedOptions, $uri, $options, $expectedMethod, $expectedQuery = [])
    {
        $client = Client::factory($uri, $options);

        $query = $client->getQuery()->toArray();

        $this->assertEquals($expectedUri, (string)$client->getUri());
        $this->assertAttributeContains($expectedOptions, 'config', $client);
        $this->assertEquals($expectedMethod, $client->getMethod());

        $this->assertEquals($expectedQuery, $query);
    }

    public function dp_config()
    {
        $defaultQuery = [
            'format' => 'json',
            'api_key' => 'bar',
        ];

        return [
            "Standard With URL" => [
                "expectedUri" => "http://expected.local/",
                "expectedOptions" => ['maxredirects' => 1, 'timeout' => 30],
                "uri" => "http://expected.local/",
                "options" => ['maxredirects' => 1, 'timeout' => 30],
                "expectedMethod" => Request::METHOD_GET,
                "expectedQuery" => $defaultQuery
            ],
            "Only Path should set Billomat URI" => [
                "expectedUri" => "https://" . self::$billoMatId . ".billomat.net/api/clients",
                "expectedOptions" => ['maxredirects' => 1, 'timeout' => 30],
                "uri" => "clients/create",
                "options" => ['maxredirects' => 1, 'timeout' => 30, 'billomat' => ["billomatId" => self::$billoMatId]],
                "expectedMethod" => Request::METHOD_POST,
                "expectedQuery" => $defaultQuery
            ],
            "Update Should Set Put Method" => [
                "expectedUri" => "https://" . self::$billoMatId . ".billomat.net/api/clients/id/10",
                "expectedOptions" => ['maxredirects' => 1, 'timeout' => 30],
                "uri" => "clients/id/10/update",
                "options" => ['maxredirects' => 1, 'timeout' => 30, 'billomat' => ["billomatId" => self::$billoMatId]],
                "expectedMethod" => Request::METHOD_PUT,
                "expectedQuery" => $defaultQuery
            ],
            "DELETE Should Set DELETE Method" => [
                "expectedUri" => "https://" . self::$billoMatId . ".billomat.net/api/clients/10",
                "expectedOptions" => ['maxredirects' => 1, 'timeout' => 30],
                "uri" => "clients/10/delete",
                "options" => ['maxredirects' => 1, 'timeout' => 30, 'billomat' => ["billomatId" => self::$billoMatId]],
                "expectedMethod" => Request::METHOD_DELETE,
                "expectedQuery" => $defaultQuery
            ],
            "Create Method with Parameter" => [
                "expectedUri" => "https://" . self::$billoMatId . ".billomat.net/api/clients?format=json",
                "expectedOptions" => ['maxredirects' => 1, 'timeout' => 30],
                "uri" => "clients/create?format=json",
                "options" => ['maxredirects' => 1, 'timeout' => 30, 'billomat' => ["billomatId" => self::$billoMatId]],
                "expectedMethod" => Request::METHOD_POST,
                "expectedQuery" => $defaultQuery
            ],
            "Avatar Request" => [
                "expectedUri" => "https://" . self::$billoMatId . ".billomat.net/api/clients/10/avatar?size=150",
                "expectedOptions" => ['maxredirects' => 1, 'timeout' => 30],
                "uri" => "clients/10/avatar?size=150",
                "options" => ['maxredirects' => 1, 'timeout' => 30, 'billomat' => ["billomatId" => self::$billoMatId]],
                "expectedMethod" => Request::METHOD_GET,
                "expectedQuery" => $defaultQuery
            ],
            "All possible options in list" => [
                "expectedUri" => "https://" . self::$billoMatId . ".billomat.net/api/clients?format=json",
                "expectedOptions" => ['maxredirects' => 1, 'timeout' => 30],
                "uri" => "clients?format=json",
                "options" => [
                    'maxredirects' => 1,
                    'timeout' => 30,
                    'billomat' => [
                        "billomatId" => self::$billoMatId,
                        "per_page" => 10,
                        "page" => 5,
                        "language" => "de_DE",
                        "apiKey" => self::$apiKey,
                        "order_by" => "id+desc,name+asc"
                    ]
                ],
                "expectedMethod" => Request::METHOD_GET,
                "expectedQuery" => [
                    "api_key" => self::$apiKey,
                    "per_page" => 10,
                    "format"  => "json",
                    "page" => 5,
                    "language" => "de_DE",
                    "order_by" => "id+desc,name+asc"
                ]
            ],

        ];
    }

    public function testGetInstance()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\Factory\Client', Client::getInstance());
    }

    /**
     * @depends testGetInstance
     */
    public function testImplementsInterface()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\Factory\IClient', Client::getInstance());
    }


    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->_object = new Client();
    }
}
