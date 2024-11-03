<?php
namespace App\Services\OrdersService;

use App\Utils\IStringValidator;

class NameAlphaHandler extends AbstractHandler
{
    private $stringValidator;

    public function __construct(IStringValidator $stringValidator)
    {
        $this->stringValidator = $stringValidator;
    }

    public function handle(array $request): array
    {
        if (!$this->stringValidator->isAlpha($request['name'])) {
            throw new \Exception("Name contains non-English characters");
        }
        return parent::handle($request);
    }
}