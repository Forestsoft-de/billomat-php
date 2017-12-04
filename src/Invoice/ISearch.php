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

namespace Forestsoft\Billomat\Invoice;


interface ISearch
{
    const PARAM_CLIENT_ID = "client_id";
    const PARAM_CONTACT_ID = "contact_id";

    const PARAM_INVOICE_NUMBER = "invoice_number";
    const PARAM_STATUS = "status";
    const PARAM_PAYMENT_TYPE = "payment_type";
    const PARAM_FROM = "from";
    const PARAM_TO = "to";
    const PARAM_LABEL = "label";
    const PARAM_INTRO = "intro";
    const PARAM_NOTE = "note";
    const PARAM_TAGS = "tags";
    const PARAM_ARTICLE_ID = "article_id";
}