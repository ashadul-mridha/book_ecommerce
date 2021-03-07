<?php


function formatNumber($number, $currency = 'TK')
{
    if ($currency == 'USD') {
        return number_format($number, 2, '.', ',');
    }
    return number_format($number, 0, '.', ',');
}


function currency_type($price, $type = "Tk.")
{
    return $type . ' ' . formatNumber($price);
}
function text_formate($text)
{
    return ucwords(str_replace(array('-', '_'), ' ', $text));
}

// Order Status

function order_status()
{
    return [
        'PROCESSING',
        'APPROVED',
        'ON_SHIPPING',
        'SHIPPED',
        'COMPLETED',
        'CANCELLED',
        'RETURNED',
    ];
}
function order_payment_getway()
{
    return [
        'cash_on_delivery',
        'bkash_pay',
        'rocket_pay'
    ];
}
function order_cancel_reason () {
    return [
        'Not sure of the product(s)',
        'Test Order',
        'Faster delivery required',
        'Shipping charge is too high',
        'Ordered wrong product',
        'Duplicate Order',
        'Missed an offer',
        'Buy Later',
    ];
}

function bx_discount( $discount, $s1 = '-', $s2 = '%') {
    return $s1 . $discount . $s2;
}
