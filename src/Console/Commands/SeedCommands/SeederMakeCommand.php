<?php

namespace Fifth\Generator\Commands\SeedCommands;

use Fifth\Generator\Commands\MainMakeCommand;
use Fifth\Generator\Console\Commands\Fragments\HasFields;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Symfony\Component\Console\Input\InputOption;

class SeederMakeCommand extends MainMakeCommand
{
    use HasFields;

    protected $name = 'fifth:seeder';

    protected $description = 'Seeder creation command';

    protected $type = 'Seeder';

    protected function getPath($rootNamespace)
    {
        $name = explode('/', $this->argument('name'));

        return $this->laravel->databasePath().DIRECTORY_SEPARATOR.'seeds/' . end($name) . '.php';
    }

    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $stub = $this->replaceClassInstance($stub, $name);

        return $stub;
    }

    protected function replaceClassInstance($stub, $name)
    {
        return str_replace('DummyModel', $this->option('model'), $stub);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/seeder.stub';
    }

    protected function getClassName()
    {
        return $this->getNameInput();
    }

    protected function getNameInput()
    {
        return $this->argument('name');
    }

    protected function getOptions()
    {
        return [
            ['fields', 'f', InputOption::VALUE_NONE, 'model fields'],
            ['model', 'm', InputOption::VALUE_NONE, 'model name'],
        ];
    }
}
