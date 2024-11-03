<?php
namespace App\Utils;

class StringValidator implements IStringValidator
{
    public function isAlpha($value): bool
    {
        return preg_match('/^[A-Za-z\s]+$/', $value);
    }

    public function isCapitalizedWords($value): bool
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