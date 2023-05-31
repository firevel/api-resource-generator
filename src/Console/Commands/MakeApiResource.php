<?php

namespace Firevel\ApiResourceGenerator\Console\Commands;

use Firevel\ApiResourceGenerator\Factories\ResourceControllerFileFactory;
use Firevel\ApiResourceGenerator\Factories\ResourceModelFileFactory;
use Firevel\ApiResourceGenerator\Resource;
use Firevel\ApiResourceGenerator\ResourceGenerator;
use Illuminate\Console\Command;
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
    protected $signature = 'make:api-resource {name} {--only=}';

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
    public function handle()
    {
        $name = $this->argument('name');

        if (Str::plural($name) == Str::singular($name)) {
            $this->error("{$name} is not countable and cant be used as resource name");
            return 1;
        }

        if (ctype_lower($name[0])) {
            $this->error("The name of the resource must begin with a capital letter (ex.: User, UserActions)");
            return 1;
        }

        $resource = new Resource($name);
        $geneators = config('api-resource-generator.generators');

        if (!empty($this->option('only'))) {
            $only = explode(',', $this->option('only'));
            $geneators = array_intersect_key($geneators, array_fill_keys($only, ''));
        }

        $geneator = new ResourceGenerator($resource, $geneators);
        $geneator->setLogger($this);
        $geneator->generate();
    }
}
