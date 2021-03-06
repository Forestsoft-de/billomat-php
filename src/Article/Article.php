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

namespace Forestsoft\Billomat\Article;


use Forestsoft\Billomat\ICustomer;
use Forestsoft\Billomat\IResource;
use Forestsoft\Billomat\Resource;

class Article extends Resource implements IArticle
{

    /**
     * @var 
     */
    protected $_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     * @return Article
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @var string
     */
    protected $_resourceName = "articles";

    /**
     * @return mixed
     */
    public function createResource()
    {
        return Factory::getInstance()->create();
    }

    /**
     * @return mixed
     */
    protected function prepareData()
    {
        // TODO: Implement prepareData() method.
    }

}