<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 15:12
 */

namespace Forestsoft\Billomat\Invoice;


interface IInvoice
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
}