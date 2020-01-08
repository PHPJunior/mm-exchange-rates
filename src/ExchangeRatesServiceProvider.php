<?php

namespace PhpJunior\ExchangeRates;

use Illuminate\Support\ServiceProvider;

class ExchangeRatesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/mm-exchange-rates.php' => config_path('mm-exchange-rates.php'),
            ], 'mm-exchange-rates-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mm-exchange-rates.php', 'mm-exchange-rates');

        $this->app->singleton('mm-exchange-rates', function () {
            return new ExchangeRates;
        });
    }
}
