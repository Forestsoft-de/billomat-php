<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 19-Nov-17
 * Time: 08:50
 */

namespace Forestsoft\Billomat;

use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    protected function getMethod($_object, $method)
    {
        $reflection = new \ReflectionMethod(get_class($_object), $method);
        $reflection->setAccessible(true);

        return $reflection;
    }


    /**
     * @param $property
     * @param $value
     */
    protected function performGetterSetterTest($property, $value)
    {
        $setter = "set" . ucfirst($property);
        $getter = "get" . ucfirst($property);
        $boolGetter = "is" . ucfirst($property);
        $boolGetter2 = "has" . ucfirst($property);

        if (is_callable(array($this->_object, $setter))) {
            $this->_object->$setter($value);
            if (is_callable(array($this->_object, $getter))) {
                $this->assertEquals($value, $this->_object->$getter());
            } else if (is_callable(array($this->_object, $boolGetter))) {
                $this->assertEquals($value, $this->_object->$boolGetter());
            } else if (is_callable(array($this->_object, $boolGetter2))) {
                $this->assertEquals($value, $this->_object->$boolGetter2());
            }
        } else {
            $this->fail(sprintf("Property %s does not exist", $property));
        }
    }
}
