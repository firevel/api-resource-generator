<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;
use Illuminate\Support\Facades\Artisan;

abstract class BaseGenerator
{
    protected $resource;
    protected $logger;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    protected function artisan($command, $parameters = [])
    {
        Artisan::call($command, $parameters);
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function logger()
    {
        return $this->logger;
    }

    public function resource() {
        return $this->resource;
    }

    public function getStub(string $path): string
    {
        $path = __DIR__ . '/../../stub/' . $path . '.stub';

        if (! file_exists($path)) {
            throw new \Exception("Stub {$path} does not exist");
        }

        return file_get_contents($path);
    }

    public function buildStub(string $stub, array $params = []): string
    {
        return str_replace(
            array_map(function($k){ return '{$_' . $k . '}'; }, array_keys($params)),
            array_values($params),
            $stub
        );
    }

    protected function createFile($path, $content)
    {
        // Get the directory name from the file path
        $dir = dirname($path);

        // Check if the directory exists
        if (!is_dir($dir)) {
            // If the directory does not exist, create it
            mkdir($dir, 0755, true);
        }

        // Create or update the file
        file_put_contents($path, $content);
    }

    abstract public function generate();
}

