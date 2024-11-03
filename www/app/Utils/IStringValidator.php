<?php
namespace App\Utils;

interface IStringValidator {
    public function isAlpha($value): bool;
    public function isCapitalizedWords($value): bool;
}