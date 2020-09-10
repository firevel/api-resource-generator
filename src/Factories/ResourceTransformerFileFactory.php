<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

/**
 * Class ResourceTransformerFileFactory
 * @package Firevel\ApiResourceGenerator\Factories
 */
class ResourceTransformerFileFactory extends StubbedResourceFileFactory
{
    /**
     * Get resource file type.
     *
     * @return string
     */
    protected static function getFileType(): string
    {
        return 'transformer';
    }

    /**
     * Get resource file name.
     *
     * @param Resource $resource
     * @return string
     */
    protected static function getFileName(Resource $resource): string
    {
        return "{$resource->singularPascal()}Transformer.php";
    }

    /**
     * Get resource file directory.
     *
     * @return string
     */
    protected static function getFileDirectory(): string
    {
        return app_path('Transformers');
    }
}
