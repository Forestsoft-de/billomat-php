<?php

namespace Forestsoft\Billomat\Test\Tax;

use Forestsoft\Billomat\Tax\Repository;

class RepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Repository
     */
    protected $_object;

    public function setUp()
    {
        $this->_object = new Repository();
    }

    /**
     * @group unit
     */
    public function testInstanceOfIterator()
    {
        $this->assertInstanceOf('\IteratorAggregate', $this->_object);
    }

    /**
     * @group unit
     */
    public function testInstanceOfRepositoryInterface()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\Tax\IRepository', $this->_object);
    }

    public function testAdd()
    {
        $item1 = $this->getMockBuilder('Forestsoft\Billomat\Tax\ITax')->getMock();
        $item2 = $this->getMockBuilder('Forestsoft\Billomat\Tax\ITax')->getMock();

        $this->_object->add($item1);
        $this->_object->add($item2);

        $this->assertEquals(2, count($this->_object));
    }
}
