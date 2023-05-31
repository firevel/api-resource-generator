<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class MigrationGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $name = "create_{$resource->pluralSnake()}_table";

        $this->artisan(
            'make:migration',
            [
                'name' => $name,
                '--create' => $resource->pluralSnake(),
            ]
        );
        $this->logger()->info("# Migration created: {$name}");
        $this->logger()->info('- [Required] Set migration');
        $this->logger()->info('  - Available column types https://laravel.com/docs/migrations#available-column-types)');
    }
}