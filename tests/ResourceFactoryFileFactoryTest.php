<?php

namespace Firevel\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Firevel\ApiResourceGenerator\Factories\ResourceFactoryFileFactory;
use Firevel\ApiResourceGenerator\Resource;

class ResourceFactoryFileFactoryTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_calls_the_artisan_command_to_make_a_factory(): void
    {
        $resource = new Resource($this->faker->word);

        Artisan::shouldReceive('call')
            ->with('make:factory', [
                'name' => "{$resource->singularPascal()}Factory",
                '--model' => "Models\\{$resource->singularPascal()}",
            ])
            ->once();

        ResourceFactoryFileFactory::handle($resource);
    }
}
