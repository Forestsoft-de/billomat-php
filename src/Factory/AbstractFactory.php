<?php
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