<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourceControllerFileFactory
 * @package Firevel\ApiResourceGenerator\Factories
 */
class ResourceControllerFileFactory extends StubbedResourceFileFactory
{
    /**
     * Get resource file type.
     *
     * @return string
     */
    protected static function getFileType(): string
    {
        return 'api-controller';
    }

    /**
     * Get resource file path.
     *
     * @param Resource $resource
     * @return string
     */
    protected static function getFileName(Resource $resource): string
    {
        return "{$resource->pluralPascal()}Controller.php";
    }

    /**
     * Get resource file directory.
     *
     * @return string
     */
    protected static function getFileDirectory(): string
    {
        return app_path('Http/Controllers/Api');
    }
}
