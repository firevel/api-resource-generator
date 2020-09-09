<?php

namespace Firevel\ApiResourceGenerator\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Firevel\ApiResourceGenerator\ServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }
}
