<?php

namespace Firevel\ApiResourceGenerator\Console\Commands;

use Illuminate\Console\Command;
use Firevel\ApiResourceGenerator\Resource;

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

        $this->makeModel($resource);
    }

    /**
     * Make model.
     *
     * @param Resource $resource
     * @return void
     */
    public function makeModel(Resource $resource): void
    {
        $this->info("{$resource->singularCamel()} model created.");
    }
}
