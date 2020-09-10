<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

class ResourcePolicyFileFactory extends StubbedResourceFileFactory
{
    protected static function getFileType(): string
    {
        return 'policy';
    }

    protected static function getFileName(Resource $resource): string
    {
        return "{$resource->singularPascal()}Policy.php";
    }

    protected static function getFileDirectory(): string
    {
        return app_path('Policies');
    }
}
