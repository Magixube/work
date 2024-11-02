<?php
namespace App\Services\OrdersService;

use App\Utils\StringValidator;

class NameAlphaHandler extends AbstractHandler
{
    public function handle(array $request): array
    {
        if (!StringValidator::isAlpha($request['name'])) {
            throw new \Exception("Name contains non-English characters");
        }
        return parent::handle($request);
    }
}