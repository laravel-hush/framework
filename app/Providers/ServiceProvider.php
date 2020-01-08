<?php

namespace ScaryLayer\Hush\Providers;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'hush');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'hush');

        $this->publishes([
            __DIR__ . '/../../config'              => config_path('hush'),
            __DIR__ . '/../../public'              => public_path('vendor/hush'),
            __DIR__ . '/../../resources/lang'      => resource_path('lang/vendor/hush')
        ]);
    }
}
