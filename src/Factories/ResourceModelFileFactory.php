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
    static function getFilePath(Resource $resource): string
    {
        return app_path("Models/{$resource->singularPascal()}.php");
    }
}
