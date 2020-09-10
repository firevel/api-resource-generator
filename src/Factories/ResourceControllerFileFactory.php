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
    static function getFileType(): string
    {
        return 'api-controller';
    }

    /**
     * Get resource file path.
     *
     * @param Resource $resource
     * @return string
     */
    static function getFilePath(Resource $resource): string
    {
        return app_path("Http/Controllers/Api/{$resource->pluralPascal()}Controller.php");
    }
}
