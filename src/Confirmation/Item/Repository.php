<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 13.12.2017
 * Time: 14:36
 */

namespace Forestsoft\Billomat\Confirmation\Item;


class Repository extends \ArrayObject implements IRepository
{
    public function add(IItem $item)
    {
        $this->append($item);
    }
}