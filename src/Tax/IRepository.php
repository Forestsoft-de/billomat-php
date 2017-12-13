<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 13.12.2017
 * Time: 11:51
 */

namespace Forestsoft\Billomat\Tax;

interface IRepository extends \IteratorAggregate
{
    public function add(ITax $tax);
}