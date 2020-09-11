<?php

namespace Firevel\ApiResourceGenerator;

use Illuminate\Support\Facades\Facade;

/**
 * Class FileMakerFacade
 * @package Firevel\ApiResourceGenerator
 */
class FileMakerFacade extends Facade
{
    /**
     * Get facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'FileMaker';
    }
}
