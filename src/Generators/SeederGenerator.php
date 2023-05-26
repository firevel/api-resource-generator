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
        $this->logger()->info("# Seeder {$name} created.");
        $this->logger()->info("- Optional: Add factory to seeder. Example: {$name}::factory()->count(50)->create()";
    }
}