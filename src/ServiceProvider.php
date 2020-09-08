<?php

namespace Firevel\ApiResourceGenerator;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        'Firevel\ApiResourceGenerator\Commands\MakeApiResource',
    ];

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }
    }
}
