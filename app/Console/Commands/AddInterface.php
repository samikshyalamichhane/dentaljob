<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class AddInterface extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:interface';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface class';
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Interface';
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/interface.stub';
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
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
