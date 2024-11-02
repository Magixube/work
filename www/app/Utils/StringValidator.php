<?php
namespace App\Utils;

class StringValidator
{
    public static function isAlpha($value): bool
    {
        return preg_match('/^[A-Za-z\s]+$/', $value);
    }

    public static function isCapitalizedWords($value): bool
    {
        $words = explode(' ', $value);
        foreach ($words as $word) {
            if (ucfirst(strtolower($word)) !== $word) {
                return false;
            }
        }
        return true;
    }
}