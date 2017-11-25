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
}
