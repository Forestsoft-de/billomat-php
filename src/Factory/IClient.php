<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 12:36
 */

namespace Forestsoft\Billomat\Factory;

interface IClient
{
    /**
     * @param string $uri
     * @param array $config
     * @return \Forestsoft\Billomat\Client\IClient
     */
    public function create($uri = "", $config = []): \Forestsoft\Billomat\Client\IClient;
    
    /**
     * @param string $uri
     * @param array $config
     * 
     * @return \Zend\Http\Client
     */
    public static function factory($uri = "", $config = []): \Forestsoft\Billomat\Client\IClient;

}