<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 14:17
 */

namespace Forestsoft\Billomat\Factory;

use Forestsoft\Billomat\Test\AbstractFactoryTest;

class CustomerTest extends AbstractFactoryTest
{
    /**
     * @var Customer
     */
    protected $_object;

    protected function getObject()
    {
        return new Customer();
    }

    protected function getResourceInterface()
    {
       return 'Forestsoft\Billomat\Customer\ICustomer';
    }
}
