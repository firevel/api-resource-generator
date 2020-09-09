<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\FileMakerFacade as FileMaker;
use Firevel\ApiResourceGenerator\Resource;
use Firevel\ApiResourceGenerator\StubBuilderFacade as StubBuilder;

/**
 * Class ResourceControllerFileFactory
 * @package Sl0wik\ApiResourceGenerator\Factories
 */
class ResourceControllerFileFactory implements ResourceFileFactory
{
    /**
     * Create a controller for the resource.
     *
     * @param Resource $resource
     */
    public static function handle(Resource $resource): void
    {
        $content = StubBuilder::build('api-controller', $resource->toArray());
        $path = app_path("Http/Controllers/Api/{$resource->pluralPascal()}Controller.php");

        FileMaker::make($path, $content);
    }
}
