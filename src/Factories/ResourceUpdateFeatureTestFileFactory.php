<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourceUpdateFeatureTestFileFactory
 * @package Firevel\ApiResourceGenerator\Factories
 */
class ResourceUpdateFeatureTestFileFactory extends StubbedResourceFileFactory
{
    /**
     * Get resource file type.
     *
     * @return string
     */
    protected static function getFileType(): string
    {
        return 'feature-tests/update';
    }

    /**
     * Get resource file name.
     *
     * @param Resource $resource
     * @return string
     */
    protected static function getFileName(Resource $resource): string
    {
        return "Update{$resource->pluralPascal()}Test.php";
    }

    /**
     * Get resource file directory.
     *
     * @param Resource $resource
     * @return string
     */
    protected static function getFileDirectory(Resource $resource): string
    {
        return base_path("tests/Feature/{$resource->pluralPascal()}");
    }
}
