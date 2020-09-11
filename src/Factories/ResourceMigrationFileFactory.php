<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Illuminate\Support\Facades\Artisan;
use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourceMigrationFileFactory
 * @package Firevel\ApiResourceGenerator\Factories
 */
class ResourceMigrationFileFactory implements ResourceFileFactory
{
    /**
     * Create a migration for the resource.
     *
     * @param Resource $resource
     */
    public static function handle(Resource $resource): void
    {
        Artisan::call('make:migration', [
            'name' => "create_{$resource->pluralSnake()}_table",
            '--table' => $resource->pluralSnake(),
        ]);
    }
}
