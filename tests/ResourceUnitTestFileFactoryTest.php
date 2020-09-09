<?php

namespace Firevel\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Firevel\ApiResourceGenerator\Factories\ResourceUnitTestFileFactory;
use Firevel\ApiResourceGenerator\Resource;

class ResourceUnitTestFileFactoryTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_calls_the_artisan_command_to_make_a_unit_test(): void
    {
        $resource = new Resource($this->faker->word);

        Artisan::shouldReceive('call')
            ->with('make:test', [
                'name' => "{$resource->singularPascal()}Test",
                '--unit' => true,
            ])
            ->once();

        ResourceUnitTestFileFactory::handle($resource);
    }

}
