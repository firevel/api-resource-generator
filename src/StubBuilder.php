<?php

namespace Firevel\ApiResourceGenerator;

/**
 * Class StubBuilder
 * @package Firevel\ApiResourceGenerator
 */
class StubBuilder
{
    /**
     * Read stub content.
     *
     * @param string $path
     * @return string
     */
    public function getStub(string $path): string
    {
        $path = config('api-resource-generator.stubs_path') . "/{$path}.stub";

        return file_get_contents($path);
    }

    /**
     * Build stub by replacing the wildcards with the params.
     *
     * @param string $path
     * @param array $params
     * @return string
     */
    public function build(string $path, array $params = []): string
    {
        $stub = $this->getStub($path);

        return str_replace(
            array_keys($params),
            array_values($params),
            $stub
        );
    }
}
