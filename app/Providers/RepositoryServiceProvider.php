<?php

namespace App\Providers;

use App\Repositories\CurrencyRepository;
use App\Repositories\PriceRepository;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PriceRepositoryInterface;
use App\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            PriceRepositoryInterface::class,
            PriceRepository::class
        );
        $this->app->bind(
            CurrencyRepositoryInterface::class,
            CurrencyRepository::class
        );
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
    }
}
