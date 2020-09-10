<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourceModelFileFactory
 * @package Firevel\ApiResourceGenerator\Factories
 */
class ResourceModelFileFactory extends StubbedResourceFileFactory
{
    /**
     * Get resource file type.
     *
     * @return string
     */
    static function getFileType(): string
    {
        return 'model';
    }

    /**
     * Get resource file path.
     *
     * @param Resource $resource
     * @return string
     */
    static function getFileName(Resource $resource): string
    {
        return "{$resource->singularPascal()}.php";
    }

    /**
     * Get resource file directory.
     *
     * @return string
     */
    static function getFileDirectory(): string
    {
        return app_path('Models');
    }
}
