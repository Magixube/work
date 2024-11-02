<?php
namespace App\Services\OrdersService;

use App\Services\OrdersService\IHandler;

abstract class AbstractHandler implements IHandler
{
    private $nextHandler;

    public function setNext(IHandler $handler): IHandler {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(array $request): array {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }
        return $request;
    }
}