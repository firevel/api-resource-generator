<?php

namespace Firevel\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Firevel\ApiResourceGenerator\Factories\ResourceControllerFileFactory;
use Firevel\ApiResourceGenerator\FileMakerFacade as FileMaker;
use Firevel\ApiResourceGenerator\Resource;
use Firevel\ApiResourceGenerator\StubBuilderFacade as StubBuilder;

class ResourceControllerFileFactoryTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_calls_stub_builder_with_the_correct_params(): void
    {
        FileMaker::shouldReceive('make')->once();

        $resource = new Resource($this->faker->word);

        StubBuilder::shouldReceive('build')
            ->with('api-controller', $resource->toArray())
            ->once();

        ResourceControllerFileFactory::handle($resource);
    }

    /** @test */
    public function it_calls_file_maker_with_the_correct_params(): void
    {
        $resource = new Resource($this->faker->word);
        $content = $this->faker->paragraph;

        StubBuilder::shouldReceive('build')->andReturn($content)->once();

        FileMaker::shouldReceive('make')
            ->with(app_path("Http/Controllers/Api/{$resource->pluralPascal()}Controller.php"), $content)
            ->once();

        ResourceControllerFileFactory::handle($resource);
    }
}
