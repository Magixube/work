<?php
namespace App\Services\OrdersService;

use App\Utils\ICurrencyValidator;

class CurrencyValidationHandler extends AbstractHandler
{
    private $currencyValidator;

    public function __construct(ICurrencyValidator $currencyValidator)
    {
        $this->currencyValidator = $currencyValidator;
    }

    public function handle(array $request): array
    {
        if (!$this->currencyValidator->isSupportedCurrency($request['currency'])) {
            throw new \Exception("Currency format is wrong");
        }
        return parent::handle($request);
    }
}