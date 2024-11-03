<?php
namespace App\Services\OrdersService;

use App\Utils\IStringValidator;
use App\Utils\INumberValidator;
use App\Utils\ICurrencyValidator;
use App\Utils\ICurrencyConverter;


class HandlerFactory
{
    private $stringValidator;
    private $numberValidator;
    private $currencyValidator;
    private $currencyConverter;

    public function __construct(
        IStringValidator $stringValidator,
        INumberValidator $numberValidator,
        ICurrencyValidator $currencyValidator,
        ICurrencyConverter $currencyConverter
    ) {
        $this->stringValidator = $stringValidator;
        $this->numberValidator = $numberValidator;
        $this->currencyValidator = $currencyValidator;
        $this->currencyConverter = $currencyConverter;
    }

    public function createHandlers() {
        return [
            new NameAlphaHandler($this->stringValidator),
            new NameCapitalizationHandler($this->stringValidator),
            new PriceLimitHandler($this->numberValidator),
            new CurrencyValidationHandler($this->currencyValidator),
            new CurrencyConversionHandler($this->currencyConverter),
        ];
    }
}