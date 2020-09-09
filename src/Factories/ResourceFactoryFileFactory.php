<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Illuminate\Support\Facades\Artisan;
use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourceFactoryFileFactory
 * @package Sl0wik\ApiResourceGenerator\Factories
 */
class ResourceFactoryFileFactory implements ResourceFileFactory
{
    /**
     * Create a factory for the resource.
     *
     * @param Resource $resource
     */
    public static function handle(Resource $resource): void
    {
        Artisan::call('make:factory', [
            'name' => "{$resource->singularCamel()}Factory",
            '--model' => "Models\\{$resource->singularCamel()}",
        ]);
    }
}
