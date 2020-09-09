<?php

namespace Firevel\ApiResourceGenerator\Factories;

use Firevel\ApiResourceGenerator\Resource;

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
