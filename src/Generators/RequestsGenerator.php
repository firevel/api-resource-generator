<?php

namespace Firevel\ApiResourceGenerator\Generators;

use Firevel\ApiResourceGenerator\Resource;

class RequestsGenerator extends BaseGenerator
{
    public function generate()
    {
        $resource = $this->resource();
        $params = $resource->toArray();
        $actions = ['index', 'store', 'show', 'update', 'destroy'];

        foreach ($actions as $action) {
            $stub = $this->getStub('requests/' . $action);
            $source = $this->buildStub($stub, $params);
            $filename = $resource->singularPascal();
            if ($action == 'index') {
                $filename = $resource->pluralPascal();
            }
            $path = app_path("Http/Requests/Api/{$resource->singularPascal()}") . '/' . ucfirst($action). "$filename.php";
            $this->logger()->info($action .': ' .$path);

            $this->createFile($path, $source);
            $this->logger()->info("# Request {$path} created.");
            $this->logger()->info('- Required: set rules (https://laravel.com/docs/validation#available-validation-rules).');
            $this->logger()->info('- Optional: set authorize() if validation is based on request content.');
        }
   }

}