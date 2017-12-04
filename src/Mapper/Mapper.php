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



namespace Forestsoft\Billomat\Mapper;

use ArrayObject;
use Forestsoft\Billomat\IResource;

class Mapper implements IResourceMapper
{

    public function map(IResource $resource, ArrayObject $source)
    {
        foreach ($source as $key => $value) {

            $setter = "set" . $this->camelCasing($key);

            if (is_callable(array($resource, $setter))) {
                try {
                    $r = new \ReflectionMethod($resource, $setter);
                    $params = $r->getParameters();
                    /** @var \ReflectionParameter $info */
                    $info = $params[0];
                    if ($info->isArray() && !is_array($value)) {
                        if (stristr($value, ",")) {
                            $value = explode(",", $value);
                        } else {
                            $value = [$value];
                        }
                    } elseif ($info->hasType()) {
                        $value = $this->_mapType($info, $value);
                    }
                } catch (Exception $e) {
                }

                call_user_func([$resource, $setter], $value);
            }
        }
    }

    private function camelCasing($key)
    {
        $key = ucwords($key, "_");
        return str_replace("_", "", $key);
    }

    /**
     * @param \ReflectionParameter $getType
     * @param mixed $value
     * 
     * @return mixed
     */
    private function _mapType($param, $value)
    {
        $typeName = $param->getClass();
        
        switch ($typeName) {

            default:
                return $value;
        }

    }
}