<?php

namespace Firevel\ApiResourceGenerator;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

/**
 * Class Resource
 * @package Firevel\ApiResourceGenerator
 */
class Resource implements Arrayable
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Resource constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get name as it was passed to the constructor.
     *
     * @return string
     */
    public function raw(): string
    {
        return $this->name;
    }

    /**
     * Get singular resource name.
     *
     * @return string
     */
    public function singular(): string
    {
        return Str::singular($this->name);
    }

    /**
     * Get plural resource name.
     *
     * @return string
     */
    public function plural(): string
    {
        return Str::plural($this->name);
    }

    /**
     * Get singular resource name in camel case.
     *
     * @return string
     */
    public function singularCamel(): string
    {
        return Str::camel($this->singular());
    }

    /**
     * Get plural resource name in camel case.
     *
     * @return string
     */
    public function pluralCamel(): string
    {
        return Str::camel($this->plural());
    }

    /**
     * Get singular resource name in snake case.
     *
     * @return string
     */
    public function singularSnake(): string
    {
        return Str::snake($this->singular());
    }

    /**
     * Get plural resource name in snake case.
     *
     * @return string
     */
    public function pluralSnake(): string
    {
        return Str::snake($this->plural());
    }

    /**
     * Get singular resource name in pascal case.
     *
     * @return string
     */
    public function singularPascal(): string
    {
        return Str::studly($this->singular());
    }


    /**
     * Get plural resource name in pascal case.
     *
     * @return string
     */
    public function pluralPascal(): string
    {
        return Str::studly($this->plural());
    }

    /**
     * Get singular resource name with the first character in lower case.
     * @return string
     */
    public function singularLowercaseFirst(): string
    {
        return lcfirst($this->singular());
    }

    /**
     * Get plural resource name with the first character in lower case.
     * @return string
     */
    public function pluralLowercaseFirst(): string
    {
        return lcfirst($this->plural());
    }

    /**
     * Get plural resource name in kebab case.
     * @return string
     */
    public function pluralKebab(): string
    {
        return Str::kebab($this->plural());
    }

    /**
     * Get all forms of the resource name as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            '{$_name}' => $this->raw(),
            '{$_singular}' => $this->singular(),
            '{$_plural}' => $this->plural(),
            '{$_singular_camel}' => $this->singularCamel(),
            '{$_plural_camel}' => $this->pluralCamel(),
            '{$_singular_snake}' => $this->singularSnake(),
            '{$_plural_snake}' => $this->pluralSnake(),
            '{$_singular_pascal}' => $this->singularPascal(),
            '{$_plural_pascal}' => $this->pluralPascal(),
            '{$_singular_lcfirst}' => $this->singularLowercaseFirst(),
            '{$_plural_lcfirst}' => $this->pluralLowercaseFirst(),
            '{$_plural_kebab}' => $this->pluralKebab(),
        ];
    }
}
