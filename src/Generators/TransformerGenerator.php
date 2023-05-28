<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class TransformerGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $name = $resource->singularPascal() . 'Transformer';

        $stub = $this->getStub('transformer');
        $source = $this->buildStub($stub, $resource->toArray());
        $path = app_path('Transformers') . '/' . "{$name}.php";

        $this->createFile($path, $source);

        $this->logger()->info("# Transformer created: {$name}");
        $this->logger()->info('- [Optional] Set transformer fields');
        $this->logger()->info('- [Optional] Set $availableIncludes fields and relationships');
        $this->logger()->info('  - Documentation https://fractal.thephpleague.com/transformers/#including-data');
    }
}