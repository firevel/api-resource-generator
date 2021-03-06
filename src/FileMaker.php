<?php

namespace Firevel\ApiResourceGenerator;

/**
 * Class FileMaker
 * @package Firevel\ApiResourceGenerator
 */
class FileMaker
{
    /**
     * Create a file.
     *
     * @param string $path
     * @param string $content
     */
    public function make(string $path, string $content): void
    {
        file_put_contents($path, $content);
    }
}
