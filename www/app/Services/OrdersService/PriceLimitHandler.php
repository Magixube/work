<?php
namespace App\Services\OrdersService;

use App\Utils\NumberValidator;

class PriceLimitHandler extends AbstractHandler 
{
    public function handle(array $request): array 
    {
        if (!NumberValidator::isLessThanOrEqual($request['price'], 2000)) {
            throw new \Exception("Price is over 2000");
        }
        return parent::handle($request);
    }
}