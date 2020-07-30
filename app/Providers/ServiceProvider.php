<?php

namespace ScaryLayer\Hush\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as Provider;
use ScaryLayer\Hush\Commands\HushImagable;
use ScaryLayer\Hush\Commands\HushPage;
use ScaryLayer\Hush\Commands\HushSync;
use ScaryLayer\Hush\Commands\HushTranslatable;
use ScaryLayer\Hush\Helpers\Constructor;
use ScaryLayer\Hush\Helpers\Input;
use ScaryLayer\Hush\Middleware\Permission;

class ServiceProvider extends Provider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'hush');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'hush');

        $this->publishes([
            __DIR__ . '/../../config'              => config_path('hush'),
            __DIR__ . '/../../database/seeds'      => database_path('seeds'),
            __DIR__ . '/../../public'              => public_path('vendor/hush'),
            __DIR__ . '/../../resources/lang'      => resource_path('lang/vendor/hush')
        ], 'hush');

        $loader = AliasLoader::getInstance();
        $loader->alias('Constructor', Constructor::class);
        $loader->alias('Input', Input::class);

        app('router')->aliasMiddleware('permission', Permission::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                HushPage::class,
                HushSync::class,
                HushImagable::class,
                HushTranslatable::class
            ]);
        }
    }
}
