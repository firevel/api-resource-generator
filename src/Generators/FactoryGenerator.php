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
        $this->logger()->info("# Factory created: {$name}Factory");
        $this->logger()->info('- [Optional] Set factory fields.');
        $this->logger()->info('  - Available formatters https://fakerphp.github.io/');
    }
}