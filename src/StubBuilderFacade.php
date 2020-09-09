<?php

namespace Sl0wik\ApiResourceGenerator;

use Illuminate\Support\Facades\Facade;

/**
 * Class StubBuilderFacade
 * @package Sl0wik\ApiResourceGenerator
 */
class StubBuilderFacade extends Facade
{
    /**
     * Get facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'StubBuilder';
    }
}
