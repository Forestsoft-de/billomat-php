<?php
/**
 * ForestSoft Billomat PHP
 * @link https://github.com/Forestsoft-de/billomat-php
 * @copyright Copyright (c) 2017. ForestSoft Sebastian Förster
 * @license Apache 2.0 https://github.com/Forestsoft-de/billomat-php/blob/master/LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

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
        $getter = "get" . ucfirst($property);
        $boolGetter = "is" . ucfirst($property);
        $boolGetter2 = "has" . ucfirst($property);

        $this->setPropertyValue($this->_object, $property, $value);

        if (is_callable(array($this->_object, $getter))) {
            $this->assertEquals($value, $this->_object->$getter());
        } else if (is_callable(array($this->_object, $boolGetter))) {
            $this->assertEquals($value, $this->_object->$boolGetter());
        } else if (is_callable(array($this->_object, $boolGetter2))) {
            $this->assertEquals($value, $this->_object->$boolGetter2());
        } else {
            $this->fail(sprintf("There is no get method for property %s", $property));
        }
    }

    private function setPropertyValue($object, $property, $value)
    {
        $setter = "set" . ucfirst($property);
        if (is_callable(array($this->_object, $setter))) {
            call_user_func([$object, $setter], $value);
        } else {
            $this->fail(sprintf("Property %s does not exist", $property));
        }
    }

    public function expectExceptionObject(\Exception $exception)
    {
        $this->expectException(\get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());
        $this->expectExceptionCode($exception->getCode());
    }

    protected function assertSetterThrowException($_object, $property, $value, $expectedException)
    {
        $this->expectExceptionObject($expectedException);
        $this->setPropertyValue($_object, $property, $value, $expectedException);
    }
}
