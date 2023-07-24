<?php

namespace App\Providers;

use App\Models\FactsInterface;
use App\Services\NumberApiFacts;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FactsInterface::class, function ($app) {
            return new NumberApiFacts();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
