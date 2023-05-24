<?php

namespace HenryEjemuta\LaravelMegaSubPlug;

use HenryEjemuta\LaravelMegaSubPlug\Console\InstallLaravelMegaSubPlug;
use Illuminate\Support\ServiceProvider;

class MegaSubPlugServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('megasubplug.php'),
            ], 'config');

            // Registering package commands.
            $this->commands([
                InstallLaravelMegaSubPlug::class,
            ]);

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'megasubplug');

        // Register the main class to use with the facade
        $this->app->singleton('megasubplug', function ($app) {
            $baseUrl = config('megasubplug.base_url');
            $instanceName = 'megasubplug';

            return new MegaSubPlug(
                $baseUrl,
                $instanceName,
                config('megasubplug')
            );
        });

    }
}
