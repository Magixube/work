<?php
namespace App\Utils;

interface ICurrencyValidator {
    public function isSupportedCurrency($currency): bool;
}