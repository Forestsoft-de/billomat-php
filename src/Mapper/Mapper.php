<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 19-Nov-17
 * Time: 10:25
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
                call_user_func([$resource, $setter], $value);
            }
        }
    }

    private function camelCasing($key)
    {
        $key = ucwords($key, "_");
        return str_replace("_", "", $key);
    }
}