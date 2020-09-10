<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\FileMakerFacade as FileMaker;
use Firevel\ApiResourceGenerator\Resource;
use Firevel\ApiResourceGenerator\StubBuilderFacade as StubBuilder;

/**
 * Class ResourceFileFromStub
 * @package Firevel\ApiResourceGenerator\Factories
 */
abstract class StubbedResourceFileFactory implements ResourceFileFactory
{
    /**
     * Create a resource file.
     *
     * @param Resource $resource
     */
    public static function handle(Resource $resource): void
    {
        $content = StubBuilder::build(static::getFileType(), $resource->toArray());
        $path = static::getFilePath($resource);

        FileMaker::make($path, $content);
    }

    /**
     * Get resource file type.
     *
     * @return string
     */
    abstract static function getFileType(): string;

    /**
     * Get resource file path.
     *
     * @param Resource $resource
     * @return string
     */
    abstract static function getFilePath(Resource $resource): string;
}
