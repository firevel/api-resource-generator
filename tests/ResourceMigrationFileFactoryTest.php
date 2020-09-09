<?php

namespace Sl0wik\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Sl0wik\ApiResourceGenerator\Resource;
use Sl0wik\ApiResourceGenerator\Factories\ResourceMigrationFileFactory;

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
                '--table' => $resource->pluralSnake(),
            ])
            ->once();

        ResourceMigrationFileFactory::handle($resource);
    }
}
