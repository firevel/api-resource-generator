<?php

namespace Sl0wik\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Sl0wik\ApiResourceGenerator\Factories\ResourceUnitTestFileFactory;
use Sl0wik\ApiResourceGenerator\Resource;

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
