<?php
namespace App\Services\OrdersService;

use App\Utils\CurrencyConverter;

class CurrencyConversionHandler extends AbstractHandler {
    public function handle(array $request): array {
        if ($request['currency'] === 'USD') {
            $request['price'] = CurrencyConverter::convertToTWD($request['price'], $request['currency']);
            $request['currency'] = 'TWD';
        }
        return parent::handle($request);
    }
}