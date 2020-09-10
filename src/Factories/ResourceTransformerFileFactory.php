<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

class ResourceTransformerFileFactory extends StubbedResourceFileFactory
{
    protected static function getFileType(): string
    {
        return 'transformer';
    }

    protected static function getFileName(Resource $resource): string
    {
        return "{$resource->singularPascal()}Transformer.php";
    }

    protected static function getFileDirectory(): string
    {
        return app_path('Transformers');
    }
}
