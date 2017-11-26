<?php
/**
 * Created by PhpStorm.
 * User: Forest
 * Date: 26-Nov-17
 * Time: 20:43
 */

namespace Forestsoft\Billomat\Customer;


interface ISearch
{
    const PARAM_NAME = "name";
    const PARAM_FIRST_NAME = "first_name";
    const PARAM_LAST_NAME = "last_name";
    const PARAM_EMAIL = "email";
    const PARAM_CLIENT_NUMBER = "client_number";
    const PARAM_NOTE = "note";
    const PARAM_INVOICE_ID = "invoice_id";
    const PARAM_TAGS = "tags";
    const PARAM_COUNTRY_CODE = "country_code";
}