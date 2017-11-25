<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 10:42
 */

namespace Forestsoft\Billomat\Factory;

use Forestsoft\Billomat\Client\Http;
use Zend\Http\Request;
use Zend\Stdlib\Parameters;

class Client extends AbstractFactory implements IClient, IFactory
{
    /**
     * @var \Zend\Http\Client
     */
    private static $instance = null;

    /**
     * @param string $uri
     * @param array $config
     * @return mixed
     */
    public static function factory($uri = "", $config = [])
    {
        $instance = self::getInstance();
        return $instance->create($uri, $config);
    }

    public static function singleton($uri = "", $config = [])
    {
        if (self::$instance == null) {
            self::$instance = self::factory($uri, $config);
        }

        return self::$instance;
    }

    /**
     * @param \Forestsoft\Billomat\Client\IClient $client
     */
    private function populateMethod(\Forestsoft\Billomat\Client\IClient $client)
    {
        $action = "";

        $uri = (string)$client->getUri();
        
        if (preg_match("#/(delete|update|create)(.*)?$#i", $uri, $matches)) {
            $action = strtolower($matches[1]);

            $uri = preg_replace("#^(http(?:s)?://.*?/api/.*?)/(?:$action/?)(.*)$#", "\\1\\2", $uri);
            $client->getRequest()->setUri($uri);
        }
        switch ($action) {
            case "update":
                $client->setMethod(Request::METHOD_PUT);
                break;
            case "delete":
                $client->setMethod(Request::METHOD_DELETE);
                break;
            case "create":
                $client->setMethod(Request::METHOD_POST);
                break;
            default:
                $client->setMethod(Request::METHOD_GET);
        }

    }

    /**
     * @return IFactory
     */
    public static function getInstance()
    {
        if (self::$factoryInstance == null) {
            self::$factoryInstance = new self();
        }
        return self::$factoryInstance;
    }

    /**
     * @param string $uri
     * @param array $config
     * @return \Forestsoft\Billomat\Client\IClient
     */
    public function create($uri = "", $config = [])
    {
        $defaults = $this->getDefaultConfig();
        
        if (array_key_exists('billomat', $config)) {
            $config['billomat'] = array_merge($defaults['billomat'], $config['billomat']);
        } else {
            $config['billomat'] = $defaults['billomat'];
        }
        if (array_key_exists('billomatId', $config['billomat'])) {
            $billoMatId = $config['billomat']['billomatId'];
        }

        if (!preg_match("#^http(s*)://#", $uri)) {
            $uri = "https://$billoMatId.billomat.net/api/" . $uri;
        }

        $client = $this->createHttpClient($uri, $config);

        $this->populateQuery($config, $client);
        $this->populateMethod($client);

        return $client;
    }

    private function getDefaultConfig()
    {
        return [
               "billomat" => [
                   "format" => "json",
                   "billomatId" => "foo",
                   "apiKey" => "bar",
               ]
            
        ];
    }

    /**
     * @param $uri
     * @param $config
     * @return Http
     */
    protected function createHttpClient($uri, $config)
    {
        $client = new Http($uri, $config);
        return $client;
    }

    private function populateQuery($config, $client)
    {

        $possibleKeys = ["page", "order_by", "per_page", "language"];

        $client->getRequest()->getQuery()->set("format", $config['billomat']['format']);
        $client->getRequest()->getQuery()->set("api_key", $config['billomat']['apiKey']);
        
        foreach ($possibleKeys as $key) {
            if (!empty($config['billomat'][$key])) {
                $client->getRequest()->getQuery()->set($key, $config['billomat'][$key]);
            }
        }
    }
}