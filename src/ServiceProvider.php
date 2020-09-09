<?php

namespace Sl0wik\ApiResourceGenerator;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;;
use Sl0wik\ApiResourceGenerator\Console\Commands\MakeApiResource;

/**
 * Class ServiceProvider
 * @package Sl0wik\ApiResourceGenerator
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeApiResource::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('api-resource-generator.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'api-resource-generator');

        $this->app->bind('StubBuilder', function () {
            return new StubBuilder();
        });

        $this->app->bind('FileMaker', function () {
            return new FileMaker();
        });
    }
}
