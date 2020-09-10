<?php

namespace Firevel\ApiResourceGenerator;

/**
 * Class DirectoryMaker
 * @package Firevel\ApiResourceGenerator
 */
class DirectoryMaker
{
    /**
     * Create directory is it does not exist.
     *
     * @param string $directory
     */
    public function findOrMake(string $directory): void
    {
        if (! is_dir($directory)) {
            mkdir($directory);
        }
    }
}
