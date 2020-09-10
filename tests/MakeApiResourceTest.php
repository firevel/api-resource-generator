<?php

namespace Firevel\ApiResourceGenerator\Tests;

use Firevel\ApiResourceGenerator\DirectoryMakerFacade as DirectoryMaker;
use Firevel\ApiResourceGenerator\Factories\ResourceControllerFileFactory;
use Firevel\ApiResourceGenerator\Factories\ResourceModelFileFactory;
use Firevel\ApiResourceGenerator\FileMakerFacade as FileMaker;
use Firevel\ApiResourceGenerator\Resource;
use Firevel\ApiResourceGenerator\StubBuilderFacade as StubBuilder;
use Illuminate\Foundation\Testing\WithFaker;

class MakeApiResourceTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_logs_all_operations_correctly()
    {
        StubBuilder::shouldReceive('build');
        DirectoryMaker::shouldReceive('findOrMake');
        FileMaker::shouldReceive('make');

        config(['api-resource-generator.types' => [
            'Model',
            'Controller',
        ]]);

        $resource = new Resource($this->faker->word);

        $this->artisan("make:api-resource {$resource->raw()}")
            ->expectsOutput("{$resource->singularPascal()} Model created.")
            ->expectsOutput("{$resource->singularPascal()} Controller created.")
            ->assertExitCode(0);
    }
}
