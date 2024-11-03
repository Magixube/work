<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\IOrdersService;
use App\Services\OrdersService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IOrdersService::class, OrdersService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
