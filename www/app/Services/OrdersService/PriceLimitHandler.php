<?php
namespace App\Services\OrdersService;

use App\Utils\INumberValidator;

class PriceLimitHandler extends AbstractHandler 
{
    private $numberValidator;

    public function __construct(INumberValidator $numberValidator)
    {
        $this->numberValidator = $numberValidator;
    }

    public function handle(array $request): array 
    {
        if (!$this->numberValidator->isLessThanOrEqual($request['price'], 2000)) {
            throw new \Exception("Price is over 2000");
        }
        return parent::handle($request);
    }
}