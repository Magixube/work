<?php
namespace App\Utils;

class CurrencyConverter implements ICurrencyConverter
{
    public function convertToTWD($value, $currency) : float
    {
        $exchangeRate = config('currency.currency_to_twd_rate');
        return $value * $exchangeRate[$currency];
    }
}