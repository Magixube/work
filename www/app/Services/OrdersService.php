<?php
namespace App\Services;

use App\Services\OrdersService\CurrencyConversionHandler;
use App\Services\OrdersService\CurrencyValidationHandler;
use App\Services\OrdersService\NameAlphaHandler;
use App\Services\OrdersService\NameCapitalizationHandler;
use App\Services\OrdersService\PriceLimitHandler;

use App\Utils\StringValidator;
use App\Utils\NumberValidator;
use App\Utils\CurrencyValidator;
use App\Utils\CurrencyConverter;


class OrdersService implements IOrdersService
{
    public function process(array $parameters)
    {
        // $operators = [
        //     NameAlphaHandler::class,
        //     NameCapitalizationHandler::class,
        //     PriceLimitHandler::class,
        //     CurrencyValidationHandler::class,
        //     CurrencyConversionHandler::class,
        // ];
        $stringValidator = new StringValidator();
        $numberValidator = new NumberValidator();
        $currencyValidator = new CurrencyValidator();
        $currencyConverter = new CurrencyConverter();

        $operators = [
            new NameAlphaHandler($stringValidator),
            new NameCapitalizationHandler($stringValidator),
            new PriceLimitHandler($numberValidator),
            new CurrencyValidationHandler($currencyValidator),
            new CurrencyConversionHandler($currencyConverter),
        ];

        foreach ($operators as $operator) {
            $parameters = $operator->handle($parameters);
        }

        return $parameters;
    }
}