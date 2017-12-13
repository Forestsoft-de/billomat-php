<?php

namespace Forestsoft\Billomat\Test\Tax;

use Forestsoft\Billomat\Tax\Repository;
use Forestsoft\Billomat\Test\AbstractRepositoryTest;

class RepositoryTest extends AbstractRepositoryTest
{
    /**
     * @var Repository
     */
    protected $_object;

    protected function getObject()
    {
        return new \Forestsoft\Billomat\Tax\Repository();
    }


    public function getRepositoryInterface()
    {
        return "Forestsoft\Billomat\Tax\IRepository";
    }

    protected function getItemInterface()
    {
        return "Forestsoft\Billomat\Tax\ITax";
    }
}
