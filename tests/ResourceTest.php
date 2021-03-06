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
    public function it_has_a_singular_name_in_snakecase(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $singularInSnake = Str::snake(Str::singular($name));

        $this->assertEquals($singularInSnake, $sut->singularSnake());
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
    public function it_has_a_singular_name_with_the_first_character_in_lowercase(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $singularLcFirst = lcfirst(Str::singular($name));

        $this->assertEquals($singularLcFirst, $sut->singularLowercaseFirst());
    }

    /** @test */
    public function it_has_a_pluralized_name_with_the_first_character_in_lowercase(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $pluralLcFirst = lcfirst(Str::plural($name));

        $this->assertEquals($pluralLcFirst, $sut->pluralLowercaseFirst());
    }


    /** @test */
    public function it_has_a_pluralized_name_in_kebab_case(): void
    {
        $name = $this->faker->sentence;

        $sut = new Resource($name);

        $pluralKebab = Str::kebab(Str::plural($name));

        $this->assertEquals($pluralKebab, $sut->pluralKebab());
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
            '{$_singular_snake}' => $sut->singularSnake(),
            '{$_plural_snake}' => $sut->pluralSnake(),
            '{$_singular_pascal}' => $sut->singularPascal(),
            '{$_plural_pascal}' => $sut->pluralPascal(),
            '{$_singular_lcfirst}' => $sut->singularLowercaseFirst(),
            '{$_plural_lcfirst}' => $sut->pluralLowercaseFirst(),
            '{$_plural_kebab}' => $sut->pluralKebab(),
        ], $sut->toArray());
    }
}
