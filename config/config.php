<?php

return [
    /*
     * Generators used during resource generation.
     */
    'generators' => [
       'migration' => \Firevel\ApiResourceGenerator\Generators\MigrationGenerator::class,
       'model' => \Firevel\ApiResourceGenerator\Generators\ModelGenerator::class,
       'transformer' => \Firevel\ApiResourceGenerator\Generators\TransformerGenerator::class,
       'controller' => \Firevel\ApiResourceGenerator\Generators\ControllerGenerator::class,
       'requests' => \Firevel\ApiResourceGenerator\Generators\RequestsGenerator::class,
       'factory' => \Firevel\ApiResourceGenerator\Generators\FactoryGenerator::class,
       'seeder' => \Firevel\ApiResourceGenerator\Generators\SeederGenerator::class,
       'policy' => \Firevel\ApiResourceGenerator\Generators\PolicyGenerator::class,
       'route' => \Firevel\ApiResourceGenerator\Generators\RouteGenerator::class,
    ]
];
