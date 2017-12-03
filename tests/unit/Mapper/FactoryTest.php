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
 * Date: 03-Dec-17
 * Time: 10:45
 */

namespace Forestsoft\Billomat\Mapper;

use Forestsoft\Billomat\Mapper\Factory;
use Forestsoft\Billomat\Test\AbstractFactoryTest;
use PHPUnit\Framework\TestCase;

class FactoryTest extends AbstractFactoryTest
{

    protected $_object;


    protected function getObject()
    {
        return new \Forestsoft\Billomat\Mapper\Factory();
    }


    public function testgetInstance()
    {
        $this->assertInstanceOf('Forestsoft\Billomat\Mapper\Factory', Factory::getInstance());
    }

    protected function getResourceInterface()
    {
        return 'Forestsoft\Billomat\Mapper\IResourceMapper';
    }
}
