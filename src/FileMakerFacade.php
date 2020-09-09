<?php

namespace Sl0wik\ApiResourceGenerator;

use Illuminate\Support\Facades\Facade;

/**
 * Class FileMakerFacade
 * @package Sl0wik\ApiResourceGenerator
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
