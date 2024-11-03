<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\IOrdersService;
use App\Services\OrdersService;


use App\Utils\IStringValidator;
use App\Utils\INumberValidator;
use App\Utils\ICurrencyValidator;
use App\Utils\ICurrencyConverter;


use App\Utils\StringValidator;
use App\Utils\NumberValidator;
use App\Utils\CurrencyValidator;
use App\Utils\CurrencyConverter;

use App\Services\OrdersService\HandlerFactory;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IOrdersService::class, OrdersService::class);
        $this->app->bind(IStringValidator::class, StringValidator::class);
        $this->app->bind(INumberValidator::class, NumberValidator::class);
        $this->app->bind(ICurrencyValidator::class, CurrencyValidator::class);
        $this->app->bind(ICurrencyConverter::class, CurrencyConverter::class);
        $this->app->singleton(HandlerFactory::class, function ($app) {
            return new HandlerFactory(
                $app->make(IStringValidator::class),
                $app->make(INumberValidator::class),
                $app->make(ICurrencyValidator::class),
                $app->make(ICurrencyConverter::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
