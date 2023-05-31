<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class SeederGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $name = $resource->name() . 'Seeder';
        $stub = $this->getStub('seeder');
        $source = $this->buildStub($stub, $resource->toArray());
        $path = database_path('seeders') . '/' . "{$name}.php";
        $this->createFile($path, $source);

        $this->logger()->info("# Seeder created: {$name}");
        $this->logger()->info("- [Optional] Add factory to seeder");
        $this->logger()->info("  - Example: \\App\Models\\" . $resource->name() . "::factory()->count(50)->create();");
        $this->logger()->info("- [Optional] Add seeder to DatabaseSeeder");
        $this->logger()->info("  - Add `$this->call({$name}::class);` to database/seeders/DatabaseSeeder.php");

    }
}