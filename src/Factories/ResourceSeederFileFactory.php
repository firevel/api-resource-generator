<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourceSeederFileFactory
 * @package Firevel\ApiResourceGenerator\Factories
 */
class ResourceSeederFileFactory extends StubbedResourceFileFactory
{
    /**
     * Get resource file type.
     *
     * @return string
     */
    protected static function getFileType(): string
    {
        return 'seeder';
    }

    /**
     * Get resource file name.
     *
     * @param Resource $resource
     * @return string
     */
    protected static function getFileName(Resource $resource): string
    {
        return "{$resource->pluralPascal()}TableSeeder.php";
    }

    /**
     * Get resource file directory.
     *
     * @return string
     */
    protected static function getFileDirectory(): string
    {
        return database_path('seeders');
    }
}
