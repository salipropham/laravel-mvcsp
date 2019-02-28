<?php

namespace SaliproPham\LaravelMVCSP;

use Illuminate\Support\ServiceProvider;
use SaliproPham\LaravelMVCSP\Commands\CreatePresenter;
use SaliproPham\LaravelMVCSP\Commands\CreateService;

class LaravelMVCSPServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-mvcsp.php', 'laravelmvcsp');

        // Register package's commands
        $this->commands([
            CreatePresenter::class,
            CreateService::class
        ]);

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelmvcsp'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/laravel-mvcsp.php' => config_path('laravel-mvcsp.php'),
        ], 'laravelmvcsp.config');

    }
}
