<?php
namespace App\Services\OrdersService;

use App\Utils\CurrencyValidator;

class CurrencyValidationHandler extends AbstractHandler
{
    public function handle(array $request): array
    {
        if (!CurrencyValidator::isSupportedCurrency($request['currency'])) {
            throw new \Exception("Currency format is wrong");
        }
        return parent::handle($request);
    }
}