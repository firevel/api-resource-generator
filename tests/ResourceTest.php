<?php

namespace Firevel\ApiResourceGenerator\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Firevel\ApiResourceGenerator\Resource;

class ResourceTest extends TestCase
{
    use WithFaker;

    /** @test **/
    public function it_has_a_raw_name(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $this->assertEquals($name, $sut->raw());
    }

    /** @test */
    public function it_has_a_singular_name(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $singular = Str::singular($name);

        $this->assertEquals($singular, $sut->singular());
    }

    /** @test */
    public function it_has_a_pluralized_name(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $plural = Str::plural($name);

        $this->assertEquals($plural, $sut->plural());
    }

    /** @test */
    public function it_has_a_singular_name_in_camelcase(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $singularInCamel = Str::camel(Str::singular($name));

        $this->assertEquals($singularInCamel, $sut->singularCamel());
    }

    /** @test */
    public function it_has_a_pluralized_name_in_camelcase(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $pluralInCamel = Str::camel(Str::plural($name));

        $this->assertEquals($pluralInCamel, $sut->pluralCamel());
    }

    /** @test */
    public function it_has_a_pluralized_name_in_snakecase(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $pluralInSnake = Str::snake(Str::plural($name));

        $this->assertEquals($pluralInSnake, $sut->pluralSnake());
    }

    /** @test */
    public function it_has_a_singular_name_in_pascalcase(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $pluralInPascal = Str::studly(Str::singular($name));

        $this->assertEquals($pluralInPascal, $sut->singularPascal());
    }

    /** @test */
    public function it_has_a_pluralized_name_in_pascalcase(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $pluralInSnake = Str::studly(Str::plural($name));

        $this->assertEquals($pluralInSnake, $sut->pluralPascal());
    }

    /** @test */
    public function it_can_be_converted_to_an_array(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $this->assertEquals([
            '{$_name}' => $sut->raw(),
            '{$_singular}' => $sut->singular(),
            '{$_plural}' => $sut->plural(),
            '{$_singular_camel}' => $sut->singularCamel(),
            '{$_plural_camel}' => $sut->pluralCamel(),
            '{$_plural_snake}' => $sut->pluralSnake(),
            '{$_singular_pascal}' => $sut->singularPascal(),
            '{$_plural_pascal}' => $sut->pluralPascal(),
        ], $sut->toArray());
    }
}
