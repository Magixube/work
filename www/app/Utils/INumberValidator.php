<?php
namespace App\Utils;

interface INumberValidator {
    public function isLessThanOrEqual($value, $limit): bool;
}