<?php
namespace App\Utils;

class NumberValidator {
    public static function isLessThanOrEqual($value, $limit): bool
    {
        return $value <= $limit;
    }
}