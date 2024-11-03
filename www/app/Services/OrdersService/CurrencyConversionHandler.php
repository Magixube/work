<?php
namespace App\Services\OrdersService;

use App\Utils\ICurrencyConverter;

class CurrencyConversionHandler extends AbstractHandler
{
    private $currencyConverter;

    public function __construct(ICurrencyConverter $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }

    public function handle(array $request): array {
        if ($request['currency'] === 'USD') {
            $request['price'] = $this->currencyConverter->convertToTWD($request['price'], $request['currency']);
            $request['currency'] = 'TWD';
        }
        return parent::handle($request);
    }
}