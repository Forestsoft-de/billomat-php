<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 14:17
 */

namespace Forestsoft\Billomat\Factory;

class Customer extends AbstractFactory implements IFactory, ICustomer
{

    protected static $factoryInstance;
    
    public function create(): \Forestsoft\Billomat\Customer\ICustomer
    {
          $customer = new \Forestsoft\Billomat\Customer\Customer();

          $this->populateSettings($customer);

          return $customer;
    }


    public static function getInstance(): \Forestsoft\Billomat\Factory\IFactory
    {
        if (self::$factoryInstance == null) {
            self::$factoryInstance = new self();
        }
        return self::$factoryInstance;
    }
}