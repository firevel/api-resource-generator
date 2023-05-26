<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class TransformerGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $name = $resource->name() . 'Transformer';

        $this->artisan(
            'make:transformer',
            [
                'name' => $name,
            ]
        );
        $this->logger()->info("# Transformer created: {$name}");
        $this->logger()->info('- [Optional] Set transformer fields');
        $this->logger()->info('- [Optional] Set $availableIncludes fields');
        $this->logger()->info('  - Documentation https://fractal.thephpleague.com/transformers/#including-data');
    }
}