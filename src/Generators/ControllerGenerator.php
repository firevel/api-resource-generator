<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class ControllerGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $stub = $this->getStub('controller');
        $params = $resource->toArray();
        $source = $this->buildStub($stub, $params);

        $path = app_path('Http/Controllers/Api') . '/' . "{$resource->pluralPascal()}Controller.php";

        $this->createFile($path, $source);
        $this->logger()->info("# Controller created: $path");
    }
}
