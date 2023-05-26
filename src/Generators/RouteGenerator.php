<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class RouteGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();

        $this->logger()->info("# Generating route");
        $this->logger()->info("- [Required] Register the API route: Route::apiResource('{$resource->pluralSnake()}', Api\\{$resource->pluralPascal()}Controller::class);");
    }
}
