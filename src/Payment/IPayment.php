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
 * Date: 16-Nov-17
 * Time: 22:41
 */

namespace Forestsoft\Billomat\Payment;


interface IPayment
{
    const TYPE_CASH                 = "CASH";
    const TYPE_CHECK                = "CHECK";
    const TYPE_DEBIT                = "DEBIT";
    const TYPE_BANK_TRANSFER        = "BANK_TRANSFER";
    const TYPE_BANK_CARD            = "BANK_CARD";
    const TYPE_BANK_PAYPAL          = "PAYPAL";

    const TYPE_INVOICE_CORRECTION   = "INVOICE_CORRECTION";
    const TYPE_CREDIT_NOTE          = "CREDIT_NOTE";
    const TYPE_CREDIT_CARD          = "CREDIT_CARD";
    const TYPE_CREDIT_COUPON        = "CREDIT_COUPON";
    const TYPE_MISC                 = "MISC";
}