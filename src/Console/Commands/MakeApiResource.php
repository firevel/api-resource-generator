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

        $this->info("\n");
        $this->info('To do:');
        $this->info("1. Setup migration database/migrations/create_{$resource->pluralSnake()}_table.php");
        $this->info("2. Setup \$fillables in app/Models/{$resource->singularPascal()}.php");
        $this->info('3. Setup the transformer at app/Transformers/{$resource->singularPascal()}Transformer.php');
        $this->info("4. Setup permissions in app/Policies/{$resource->pluralPascal()}Policy::class");
        $this->info("5. Register the policy: {$resource->pluralPascal()}::class => {$resource->pluralPascal()}Policy::class.");
        $this->info("6. Register the API route: Route::apiResource('{$resource->pluralSnake()}', '{$resource->pluralPascal()}Controller');.");
        $this->info("\n");
        $this->info('Optional:');
        $this->info("- Setup factory at database/factories/{$resource->singularPascal()}Factory.php");
        $this->info("- Setup seeder at database/seeds/{$resource->pluralPascal()}Seeder.php");
        $this->info("- Add {$resource->pluralPascal()}Seeder.php to database/seeds/DatabaseSeeder.php.");
        $this->info("- Setup validation at Http/Requests/{$resource->singularPascal()}");
        $this->info("- Setup unit tests at tests/Feature/{$resource->singularPascal()}");
    }
}
