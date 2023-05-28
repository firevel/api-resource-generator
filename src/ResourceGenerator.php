<?php

namespace Firevel\ApiResourceGenerator;

use Firevel\ApiResourceGenerator\Resource;

class ResourceGenerator
{
    protected $resource;
    protected $generators;
    protected $logger;

    public function __construct(Resource $resource, array $generators)
    {
        $this->resource = $resource;
        $this->generators = $generators;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function logger()
    {
        return $this->logger;
    }

    public function generate()
    {
        foreach ($this->generators as $name => $class) {
            $generatorInstance = new $class($this->resource);
            $generatorInstance->setLogger($this->logger());
            $generatorInstance->generate();
            $this->logger()->info('');
        }
    }
}