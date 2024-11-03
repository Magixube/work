<?php
namespace App\Services;

use App\Services\OrdersService\HandlerFactory;


class OrdersService implements IOrdersService
{
    private $handlerFactory;
    public function __construct(HandlerFactory $handlerFactory)
    {
        $this->handlerFactory = $handlerFactory;
    }
    
    public function process(array $parameters)
    {
        $operators = $this->handlerFactory->createHandlers();

        foreach ($operators as $operator) {
            $parameters = $operator->handle($parameters);
        }

        return $parameters;
    }
}