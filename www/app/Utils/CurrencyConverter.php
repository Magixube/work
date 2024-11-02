<?php
namespace App\Utils;

class CurrencyConverter {
    public static function convertToTWD($value, $currency) {
        $exchangeRate = config('currency.currency_to_twd_rate');
        return $value * $exchangeRate[$currency];
    }
}