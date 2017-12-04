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