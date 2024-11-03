<?php
namespace App\Services\OrdersService;

use App\Utils\IStringValidator;

class NameCapitalizationHandler extends AbstractHandler
{
    private $stringValidator;

    public function __construct(IStringValidator $stringValidator)
    {
        $this->stringValidator = $stringValidator;
    }
    
    public function handle(array $request): array
    {
        if (!$this->stringValidator->isCapitalizedWords($request['name'])) {
            throw new \Exception("Name is not capitalized");
        }
        return parent::handle($request);
    }
}