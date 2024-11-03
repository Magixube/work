<?php
namespace App\Utils;

class CurrencyValidator implements ICurrencyValidator
{
    public function isSupportedCurrency($currency): bool
    {
        $supportedCurrencies = config('currency.supported_currencies');
        return in_array($currency, $supportedCurrencies);
    }
}