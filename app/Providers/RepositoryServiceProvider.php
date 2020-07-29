<?php

namespace App\Providers;

use App\Repositories\Interfaces\PriceRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\PriceRepository;

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
    }
}
