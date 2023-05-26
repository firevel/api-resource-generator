<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class ModelGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $stub = $this->getStub('model');
        $params = $resource->toArray();
        $params['fillable'] = '// @TODO set filables.';
        $params['casts'] = '// @TODO set casting.';
        $params['sortable'] = '// @TODO set sortable columns.';
        $source = $this->buildStub($stub, $params);
        $path = app_path('Models') . '/' . $resource->singularPascal() . ".php";
        $this->createFile($path, $source);
        $this->logger()->info("# Model {$path} created.");
        $this->logger()->info('- Optional: set model $fillable (all fields allowed by default)');
        $this->logger()->info('- Optional: set model $casts (no casting by default)');
        $this->logger()->info('- Optional: set model $sortable (all fields allowed by default)');
        $this->logger()->info('- Optional: set relationships');
    }
}