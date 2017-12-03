<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 15:12
 */

namespace Forestsoft\Billomat\Invoice;


use Forestsoft\Billomat\IResource;

interface IInvoice extends IResource
{
    /**
     * @return IInvoice[]
     */
    public function findAll($limit = 10, $start = 1);

    /**
     * @param $id
     * @return IInvoice
     */
    public function find($id);

    /**
     * @param $array
     * @return Invoice[]
     */
    public function findBy($array);

    /**
     * @return IInvoice
     */
    public function createResource();

    /**
     * @return int
     */
    public function getId();
}