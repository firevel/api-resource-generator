<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class PolicyGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $stub = $this->getStub('policy');
        $params = $resource->toArray();
        $source = $this->buildStub($stub, $params);

        $path = app_path('Policies') . '/' . "{$resource->singularPascal()}Policy.php";

        $this->createFile($path, $source);
        $this->logger()->info("# Policy created: {$path}");
        $this->logger()->info('- [Optional] Set policies https://laravel.com/docs/authorization#writing-policies');
    }
}
