<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ViaCepService;

class ViaCepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ViaCepService::class, function ($app) {
            return new ViaCepService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

