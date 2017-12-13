<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 13.12.2017
 * Time: 14:10
 */

namespace Forestsoft\Billomat\Confirmation\Item;


interface IRepository extends \IteratorAggregate
{
    public function add(IItem $item);
}