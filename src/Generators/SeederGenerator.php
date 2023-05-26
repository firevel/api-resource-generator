<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class SeederGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $name = $resource->name() . 'Seeder';

        $this->artisan(
            'make:seeder',
            [
                'name' => $name,
            ]
        );
        $this->logger()->info("# Seeder created: {$name}");
        $this->logger()->info("- [Optional] Add factory to seeder");
        $this->logger()->info("  - Example: {$name}::factory()->count(50)->create()");
    }
}