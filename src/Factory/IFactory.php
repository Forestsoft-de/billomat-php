<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 14:20
 */

namespace Forestsoft\Billomat\Factory;


interface IFactory
{

    /**
     * @return IFactory
     */
    public static function getInstance();

}