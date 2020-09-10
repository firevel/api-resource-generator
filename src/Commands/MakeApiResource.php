<?php

namespace Firevel\ApiResourceGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeApiResource extends Command
{
    /* Resource actions. */
    const ACTIONS = ['index', 'store', 'show', 'update', 'destroy'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api-resource {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API resource.';

    /**
     * Api namespace.
     *
     * @var string
     */
    protected $namespace = 'Api/';

    /**
     * Parameters used for replace on stub.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $table = Str::plural(Str::snake($name));

        $this->parameters = [
            '{$_singular}' => $name,
            '{$_plural}' => Str::plural($name),
            '{$_plural_snake}' => Str::plural(Str::snake($name)),
            '{$_lower}' => Str::snake($name),
            '{$_lcfirst}' => lcfirst($name),
            '{$_plural_lcfirst}' => Str::plural(lcfirst($name)),
        ];

        $this->makeModel($name);
        $this->makeSeeder(Str::plural($name));
        $this->makeRequests($name, self::ACTIONS);
        $this->makeController($name);
        $this->makeMigration($table);
        $this->makeTransformer($name);
        $this->makeFactory($name);
        $this->makePolicy($name);


        $this->info('To do:');
        $this->info("1. Setup schema in migration file.");
        $this->info("2. Setup fillables in model file.");
        $this->info("3. Setup permissions in policy file.");
        $this->info("4. Setup transformer.");
        $this->info("5. Setup api route: Route::apiResource('".Str::plural(Str::snake($name))."', '{$name}Controller');");

        $this->info('Optional:');
        $this->info("- Setup model factory.");
        $this->info("- Setup model seeder.");
        $this->info("- Setup validation at requests.");
    }

    /**
     * Get stubs path.
     *
     * @return type
     */
    public function getStubsPath()
    {
        if (is_dir(app_path('resources/stubs'))) {
            return app_path('resources/stubs');
        }

        return __DIR__ . '/../../stubs/';
    }

    /**
     * Make requests.
     *
     * @param string $name
     * @param array $actions
     * @return void
     */
    public function makeRequests($name, $actions)
    {
        foreach ($actions as $action) {
            if ($action == 'index') {
                $requestName = $name.'/'.Str::ucfirst($action).Str::plural($name);
            } else {
                $requestName = $name.'/'.Str::ucfirst($action).$name;
            }
            $this->info("Creating $requestName");
            $this->call('make:request', [
                'name' => $requestName,
            ]);
            $this->addUseToFile('App\\Http\\Requests\\ApiRequest', "App/Http/Requests/{$requestName}.php");
            $this->addUseToFile("App\\Models\\{$name}", "App/Http/Requests/{$requestName}.php");
            $this->replaceInFile('extends FormRequest', 'extends ApiRequest', "App/Http/Requests/{$requestName}.php");
            $this->replaceInFile('return false;', 'return true;', "App/Http/Requests/{$requestName}.php");
        }
    }

    /**
     * Make transformer.
     *
     * @param string $name
     * @return void
     */
    public function makeTransformer($name)
    {
        $code = $this->buildStub('transformer');

        if (! is_dir(app_path("Transformers"))) {
            mkdir(app_path("Transformers"));
        }

        file_put_contents(app_path("Transformers/{$name}Transformer.php"), $code);
        $this->info("{$name}Transformer created.");
    }

    /**
     * Get stub content.
     *
     * @param string $name
     * @return string
     */
    public function getStub($name)
    {
        return file_get_contents($this->getStubsPath().'/'.$name.'.stub');
    }

    /**
     * Get stub with parameters filled up.
     *
     * @param string $name
     * @return string
     */
    public function buildStub($name)
    {
        $stub = $this->getStub($name);
        $parameters = $this->parameters;

        return str_replace(
            array_keys($parameters),
            array_values($parameters),
            $stub
        );

        return file_get_contents($this->getStubsPath().'/'.$name.'.stub');
    }

    /**
     * Make seeder.
     *
     * @param string $name
     * @return void
     */
    public function makeSeeder($name)
    {
        $code = $this->buildStub('seeder');

        file_put_contents(database_path("seeds/{$name}TableSeeder.php"), $code);
        $this->info("{$name}Seeder created.");
    }

    /**
     * Make factory.
     *
     * @param string $name
     * @return void
     */
    public function makeFactory($name)
    {
        $this->call('make:factory', [
            'name' => "{$name}Factory",
            '--model' => "Models\\{$name}",
        ]);
    }

    /**
     * Make controller.
     *
     * @param string $name
     * @return void
     */
    public function makeController($name)
    {
        $code = $this->buildStub('api-controller');

        if (! is_dir(app_path("Http/Controllers/{$this->namespace}"))) {
            mkdir(app_path("Http/Controllers/{$this->namespace}"));
        }

        file_put_contents(app_path("Http/Controllers/{$this->namespace}{$name}Controller.php"), $code);
        $this->info("{$this->namespace}{$name}Controller created.");
    }

    /**
     * Make migration.
     *
     * @param string $table
     * @return void
     */
    public function makeMigration($table)
    {
        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Make Policy.
     *
     * @param string $name
     * @return void
     */
    public function makePolicy($name)
    {
        $code = $this->buildStub('policy');

        if (! is_dir(app_path("Policies"))) {
            mkdir(app_path("Policies"));
        }

        file_put_contents(app_path("Policies/{$name}Policy.php"), $code);
        $this->info("{$name}Policy created.");
    }

    /**
     * Make model.
     *
     * @param string $name
     * @return void
     */
    public function makeModel($name)
    {
        $code = $this->buildStub('model');

        if (! is_dir(app_path("Models"))) {
            mkdir(app_path("Models"));
        }

        file_put_contents(app_path("Models/{$name}.php"), $code);

        $this->info("{$name} model created.");
    }

    /**
     * Replace content in file.
     *
     * @param string $find
     * @param string $replace
     * @param string $filename
     * @return void
     */
    public function replaceInFile($find, $replace, $filename)
    {
        $file = file_get_contents($filename);
        $file = str_replace($find, $replace, $file);
        file_put_contents($filename, $file);
    }

    /**
     * Add class to use in specific file.
     *
     * @param string $class
     * @param string $filename
     * @return void
     */
    public function addUseToFile($class, $filename)
    {
        $file = file_get_contents($filename);
        $file = Str::replaceFirst("\nuse", "\nuse {$class};\nuse", $file);
        file_put_contents($filename, $file);
    }
}
