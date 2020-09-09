<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Illuminate\Support\Facades\Artisan;
use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourceUnitTestFileFactory
 * @package Sl0wik\ApiResourceGenerator\Factories
 */
class ResourceUnitTestFileFactory implements ResourceFileFactory
{
    /**
     * Create a unit test for the resource.
     *
     * @param Resource $resource
     */
    public static function handle(Resource $resource): void
    {
        Artisan::call('make:test', [
            'name' => "{$resource->singularPascal()}Test",
            '--unit' => true,
        ]);
    }
}
