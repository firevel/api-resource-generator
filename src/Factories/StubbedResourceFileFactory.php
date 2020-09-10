<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\DirectoryMakerFacade as DirectoryMaker;
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
        $directory = static::getFileDirectory();

        DirectoryMaker::findOrMake($directory);

        $content = StubBuilder::build(static::getFileType(), $resource->toArray());
        $path = $directory . '/' . static::getFileName($resource);

        FileMaker::make($path, $content);
    }

    /**
     * Get resource file type.
     *
     * @return string
     */
    abstract protected static function getFileType(): string;

    /**
     * Get resource file name.
     *
     * @param Resource $resource
     * @return string
     */
    abstract protected static function getFileName(Resource $resource): string;

    /**
     * Get resource file directory.
     *
     * @return string
     */
    abstract protected static function getFileDirectory(): string;
}
