<?php
namespace App\Utils;

class NumberValidator implements INumberValidator
{
    public function isLessThanOrEqual($value, $limit): bool
    {
        return $value <= $limit;
    }
}