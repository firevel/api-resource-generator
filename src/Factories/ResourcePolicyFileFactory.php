<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourcePolicyFileFactory
 * @package Firevel\ApiResourceGenerator\Factories
 */
class ResourcePolicyFileFactory extends StubbedResourceFileFactory
{
    /**
     * Get resource file type.
     *
     * @return string
     */
    protected static function getFileType(): string
    {
        return 'policy';
    }

    /**
     * Get resource file name.
     *
     * @param Resource $resource
     * @return string
     */
    protected static function getFileName(Resource $resource): string
    {
        return "{$resource->singularPascal()}Policy.php";
    }

    /**
     * Get resource file directory.
     *
     * @return string
     */
    protected static function getFileDirectory(): string
    {
        return app_path('Policies');
    }
}
