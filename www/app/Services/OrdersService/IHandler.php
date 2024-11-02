<?php
namespace App\Services\OrdersService;

interface IHandler {
    public function setNext(IHandler $handler): IHandler;
    public function handle(array $request): array;
}