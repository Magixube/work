<?php
namespace App\Services;

use App\Services\OrdersService\CurrencyConversionHandler;
use App\Services\OrdersService\CurrencyValidationHandler;
use App\Services\OrdersService\NameAlphaHandler;
use App\Services\OrdersService\NameCapitalizationHandler;
use App\Services\OrdersService\PriceLimitHandler;


class OrdersService {
    public function process(array $parameters)
    {
        $operators = [
            NameAlphaHandler::class,
            NameCapitalizationHandler::class,
            PriceLimitHandler::class,
            CurrencyValidationHandler::class,
            CurrencyConversionHandler::class,
        ];

        foreach ($operators as $class) {
            $operator = app()->make($class);
            $parameters = $operator->handle($parameters);
        }

        return $parameters;
    }
}