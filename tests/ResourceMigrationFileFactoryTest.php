<?php

namespace Firevel\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Firevel\ApiResourceGenerator\Resource;
use Firevel\ApiResourceGenerator\Factories\ResourceMigrationFileFactory;

class ResourceMigrationFileFactoryTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_calls_the_artisan_command_to_make_a_migration(): void
    {
        $resource = new Resource($this->faker->word);

        Artisan::shouldReceive('call')
            ->with('make:migration', [
                'name' => "create_{$resource->pluralSnake()}_table",
                '--create' => $resource->pluralSnake(),
            ])
            ->once();

        ResourceMigrationFileFactory::handle($resource);
    }
}
