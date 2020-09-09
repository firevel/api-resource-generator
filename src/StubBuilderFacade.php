<?php

namespace Firevel\ApiResourceGenerator;

use Illuminate\Support\Facades\Facade;

/**
 * Class StubBuilderFacade
 * @package Firevel\ApiResourceGenerator
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
