<?php

namespace Sl0wik\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Sl0wik\ApiResourceGenerator\StubBuilderFacade as StubBuilder;

class StubBuilderTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_gets_the_stub_content(): void
    {
        config(['api-resource-generator.stubs_path' => __DIR__ . '/stubs']);

        $stubContent = StubBuilder::getStub('simple');

        $this->assertTrue(
            (bool) preg_match('/simple stub/', $stubContent)
        );
    }

    /** @test */
    public function it_builds_the_stub_with_the_params(): void
    {
        config(['api-resource-generator.stubs_path' => __DIR__ . '/stubs']);

        $param1 = $this->faker->unique()->word();
        $param2 = $this->faker->unique()->word();

        $stubContent = StubBuilder::build('params', [
            '{$_param_1}' => $param1,
            '{$_param_2}' => $param2,
        ]);

        $this->assertTrue(
            (bool) preg_match("/stub with params: {$param1} and {$param2}/", $stubContent)
        );
    }
}
