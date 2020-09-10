<?php

namespace Firevel\ApiResourceGenerator\Console\Commands;

use Firevel\ApiResourceGenerator\Factories\ResourceControllerFileFactory;
use Firevel\ApiResourceGenerator\Factories\ResourceModelFileFactory;
use Illuminate\Console\Command;
use Firevel\ApiResourceGenerator\Resource;
use Illuminate\Support\Str;

/**
 * Class MakeApiResource
 * @package Firevel\ApiResourceGenerator\Console\Commands
 */
class MakeApiResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api-resource {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API resource.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $name = $this->argument('name');

        $resource = new Resource($name);
        $resourceFileTypes = config('api-resource-generator.types');

        foreach ($resourceFileTypes as $type) {
            $name = "\\Firevel\\ApiResourceGenerator\\Factories\\Resource{$type}FileFactory";

            ($name)::handle($resource);

            $this->info("{$resource->singularPascal()} {$type} created.");
        }

        $this->info('Done.');
    }
}
