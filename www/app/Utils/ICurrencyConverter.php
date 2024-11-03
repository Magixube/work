<?php
namespace App\Utils;

interface ICurrencyConverter {
    public function convertToTWD($value, $currency): float;
}