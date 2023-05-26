<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class FactoryGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();

        $this->artisan(
            'make:factory',
            [
                'name' => $resource->name(),
            ]
        );
        $this->logger()->info("# Factory {$name} created.");
        $this->logger()->info('- Optional: set factory fields.');
    }
}