<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 13.12.2017
 * Time: 11:39
 */

namespace Forestsoft\Billomat\Tax;


class Repository extends \ArrayObject implements IRepository
{

    public function add(ITax $tax)
    {
        $this->append($tax);
    }
}