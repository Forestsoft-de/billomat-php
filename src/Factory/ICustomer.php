<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 14:25
 */

namespace Forestsoft\Billomat\Factory;


interface ICustomer extends IFactory
{
    public function create(): \Forestsoft\Billomat\Customer\ICustomer;
}