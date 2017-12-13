<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 13.12.2017
 * Time: 14:43
 */

namespace Forestsoft\Billomat\Test\Confirmation;


use Forestsoft\Billomat\Confirmation\Item\Repository;
use Forestsoft\Billomat\Test\AbstractRepositoryTest;

class RepositoryTest extends AbstractRepositoryTest
{
    protected function getObject()
    {
       return new Repository();
    }

    protected function getRepositoryInterface()
    {
        return "Forestsoft\Billomat\Confirmation\Item\IRepository";
    }

    protected function getItemInterface()
    {
        return "Forestsoft\Billomat\Confirmation\Item\IItem";
    }
}