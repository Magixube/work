<?php
namespace App\Services\OrdersService;

use App\Utils\StringValidator;

class NameCapitalizationHandler extends AbstractHandler
{
    public function handle(array $request): array
    {
        if (!StringValidator::isCapitalizedWords($request['name'])) {
            throw new \Exception("Name is not capitalized");
        }
        return parent::handle($request);
    }
}