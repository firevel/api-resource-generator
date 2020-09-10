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

        $this->info('To do:');
        $this->info("1. Setup schema in migration file.");
        $this->info("2. Setup \$fillables in model file.");
        $this->info("3. Setup permissions in policy file.");
        $this->info("4. Setup transformer.");
        $this->info("5. Setup api route: Route::apiResource('{$resource->pluralSnake()}', '{$resource->pluralPascal()}Controller');.");

        $this->info('Optional:');
        $this->info("- Setup model factory.");
        $this->info("- Setup model seeder.");
        $this->info("- Setup validation at requests.");
        $this->info("- Setup unit tests for your model.");
    }
}
