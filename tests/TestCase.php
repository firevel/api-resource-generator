<?php

namespace Sl0wik\ApiResourceGenerator\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Sl0wik\ApiResourceGenerator\ServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }
}
