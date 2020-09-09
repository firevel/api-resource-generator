<?php

namespace Sl0wik\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Sl0wik\ApiResourceGenerator\Factories\ResourceFactoryFileFactory;
use Sl0wik\ApiResourceGenerator\Resource;

class ResourceFactoryFileFactoryTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_calls_the_artisan_command_to_make_a_factory(): void
    {
        $resource = new Resource($this->faker->word);

        Artisan::shouldReceive('call')
            ->with('make:factory', [
                'name' => "{$resource->singularCamel()}Factory",
                '--model' => "Models\\{$resource->singularCamel()}",
            ])
            ->once();

        ResourceFactoryFileFactory::handle($resource);
    }
}
