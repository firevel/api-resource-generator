<?php

namespace Firevel\ApiResourceGenerator;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Firevel\ApiResourceGenerator\Console\Commands\MakeApiResource;

/**
 * Class ServiceProvider
 * @package Firevel\ApiResourceGenerator
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

        $this->publishes([
            __DIR__.'/../resources/stubs' => resource_path('stubs'),
        ]);
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

        $this->app->bind('DirectoryMaker', function () {
            return new DirectoryMaker();
        });
    }
}
