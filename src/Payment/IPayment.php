<?php
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