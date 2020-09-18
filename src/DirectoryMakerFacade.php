<?php

namespace Firevel\ApiResourceGenerator;

use Illuminate\Support\Facades\Facade;

/**
 * Class DirectoryMakerFacade
 * @package Firevel\ApiResourceGenerator
 */
class DirectoryMakerFacade extends Facade
{
    /**
     * Get facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'DirectoryMaker';
    }
}
