<?php
/**
 * Created by PhpStorm.
 * User: sebastian.foerster
 * Date: 30.11.2017
 * Time: 15:27
 */

namespace Forestsoft\Billomat\Invoice;


interface IStatus
{
    const DRAFT = "DRAFT";
    const OPEN = "OPEN";
    const PAID = "PAID";
    const OVERDUE = "OVERDUE";
    const CANCELED = "CANCELED";
}