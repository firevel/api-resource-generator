<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class RouteGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $name = str_replace('_', '-', $resource->pluralSnake());

        $this->logger()->info("# Generating route");
        $this->logger()->info("- [Required] Register the API route: Route::apiResource('{$name}', \\App\\Http\\Controllers\\Api\\{$resource->pluralPascal()}Controller::class);");
    }
}
