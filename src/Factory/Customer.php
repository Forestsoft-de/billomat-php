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

    /**
     * @return \Forestsoft\Billomat\Customer\ICustomer
     */
    public function create()
    {
          $customer = new \Forestsoft\Billomat\Customer\Customer();

          $this->populateSettings($customer);

          return $customer;
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
}