<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 12:54
 */

namespace Forestsoft\Billomat\Client;


interface IClient
{
    public function getUri();

    public function request($data = []);

    /**
     * @return mixed|\Zend\Stdlib\ParametersInterface
     */
    public function getQuery();
}