<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class RepoInterface extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:ri';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->getNameInput();
        $name = explode('/', $name);
        $name = 'Modules\\' . $name[0] . '\\Repositories\\' . $name[0] . $this->type;

        $path = $this->getPath($name);

        if ($this->alreadyExists($name)) {
            $this->error($this->type . ' already exists!');

            return false;
        }


        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type . ' created successfully.');

        if ($this->option('interface')) {
            $this->createInterface();
        }
    }

    /**
     * Create a interface class.
     *
     * @return void
     */
    protected function createInterface()
    {
        $interface = Str::studly(class_basename($this->argument('name')));

        $this->call('make:interface', [
            'name' => "$interface/{$interface}Interface",
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/repository.stub';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['interface', 'i', InputOption::VALUE_NONE, 'Create a new interface class'],
        ];
    }

    protected function getPath($name)
    {
        return  str_replace('\\', '/', $name) . '.php';
    }

    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($rawName));
    }
}

 // if (parent::handle() === false && !$this->option('force')) {
        //     return false;
        // }
