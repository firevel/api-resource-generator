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
        $this->logger()->info("# Transformer {$name} created.");
        $this->logger()->info('- Optional: Set transformer fields.');
    }
}