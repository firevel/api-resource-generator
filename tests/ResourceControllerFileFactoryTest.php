<?php

namespace Firevel\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Firevel\ApiResourceGenerator\DirectoryMakerFacade as DirectoryMaker;
use Firevel\ApiResourceGenerator\Factories\ResourceControllerFileFactory;
use Firevel\ApiResourceGenerator\FileMakerFacade as FileMaker;
use Firevel\ApiResourceGenerator\Resource;
use Firevel\ApiResourceGenerator\StubBuilderFacade as StubBuilder;

class ResourceControllerFileFactoryTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_creates_the_controllers_directory_if_it_does_not_exist(): void
    {
        $resource = new Resource($this->faker->word);

        FileMaker::shouldReceive('make')->once();
        StubBuilder::shouldReceive('build')->once();

        DirectoryMaker::shouldReceive('findOrMake')
            ->with(app_path('Http/Controllers/Api'))
            ->once();

        ResourceControllerFileFactory::handle($resource);
    }

    /** @test */
    public function it_calls_stub_builder_with_the_correct_params(): void
    {
        DirectoryMaker::shouldReceive('findOrMake')->once();
        FileMaker::shouldReceive('make')->once();

        $resource = new Resource($this->faker->word);

        StubBuilder::shouldReceive('build')
            ->with('controller', $resource->toArray())
            ->once();

        ResourceControllerFileFactory::handle($resource);
    }

    /** @test */
    public function it_calls_file_maker_with_the_correct_params(): void
    {
        DirectoryMaker::shouldReceive('findOrMake')->once();

        $resource = new Resource($this->faker->word);
        $content = $this->faker->paragraph;

        StubBuilder::shouldReceive('build')->andReturn($content)->once();

        FileMaker::shouldReceive('make')
            ->with(app_path("Http/Controllers/Api/{$resource->pluralPascal()}Controller.php"), $content)
            ->once();

        ResourceControllerFileFactory::handle($resource);
    }
}
