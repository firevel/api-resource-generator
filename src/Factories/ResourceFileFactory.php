<?php

namespace Sl0wik\ApiResourceGenerator\Factories;

use Sl0wik\ApiResourceGenerator\Resource;

/**
 * Interface ResourceFileFactory
 * @package Sl0wik\ApiResourceGenerator\Factories
 */
interface ResourceFileFactory
{
    /**
     * Create a resource file.
     *
     * @param Resource $resource
     */
    public static function handle(Resource $resource): void;
}
