<?php

namespace Fwartner\TinkerwellSnippets;

use Illuminate\Support\ServiceProvider;

class TinkerwellSnippetsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tinkerwell-snippets');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'tinkerwell-snippets');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('tinkerwell-snippets.php'),
            ], 'tinkerwell-snippets-config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/tinkerwell-snippets'),
            ], 'views');*/

            // Publishing assets.
            $this->publishes([
                __DIR__ . '/../resources/' => base_path('.tinkerwell/'),
            ], 'tinkerwell-snippets-assets');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/tinkerwell-snippets'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'tinkerwell-snippets');

        // Register the main class to use with the facade
        $this->app->singleton('tinkerwell-snippets', function () {
            return new TinkerwellSnippets;
        });
    }
}
