<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\FileMakerFacade as FileMaker;
use Firevel\ApiResourceGenerator\Resource;
use Firevel\ApiResourceGenerator\StubBuilderFacade as StubBuilder;

/**
 * Class ResourceModelFileFactory
 * @package Firevel\ApiResourceGenerator\Factories
 */
class ResourceModelFileFactory implements ResourceFileFactory
{
    /**
     * Create a model for the resource.
     *
     * @param Resource $resource
     */
    public static function handle(Resource $resource): void
    {
        $content = StubBuilder::build('model', $resource->toArray());
        $path = app_path("Models/{$resource->singularPascal()}.php");

        FileMaker::make($path, $content);
    }
}
