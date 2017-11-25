<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 18-Nov-17
 * Time: 10:24
 */

namespace Forestsoft\Billomat\Mapper;

use ArrayObject;
use Forestsoft\Billomat\IResource;

interface IResourceMapper
{
    public function map(IResource $resource, ArrayObject  $source);
}