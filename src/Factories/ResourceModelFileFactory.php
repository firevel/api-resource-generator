<?php

namespace Sl0wik\ApiResourceGenerator\Factories;

use Sl0wik\ApiResourceGenerator\FileMakerFacade as FileMaker;
use Sl0wik\ApiResourceGenerator\Resource;
use Sl0wik\ApiResourceGenerator\StubBuilderFacade as StubBuilder;

/**
 * Class ResourceModelFileFactory
 * @package Sl0wik\ApiResourceGenerator\Factories
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
