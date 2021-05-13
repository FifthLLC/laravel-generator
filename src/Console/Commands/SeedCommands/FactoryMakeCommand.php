<?php

namespace Fifth\Generator\Console\Commands\SeedCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;
use Fifth\Generator\Console\Commands\Fragments\HasFields;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Symfony\Component\Console\Input\InputOption;

class FactoryMakeCommand extends MainMakeCommand
{
    use HasFields;

    protected $name = 'fifth:factory';

    protected $description = 'Factory creation command';

    protected $type = 'Factory';

    protected function getPath($rootNamespace)
    {
        $name = explode('/', $this->argument('name'));

        return $this->laravel->databasePath().DIRECTORY_SEPARATOR.'factories/' . end($name) . '.php';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/factory.stub';
    }

    protected function getClassName()
    {
        return $this->getNameInput();
    }

    protected function getNameInput()
    {
        return $this->option('model');
    }

    protected function prepareData()
    {
        $this->setFields();
    }

    protected function workoutReplaceableVariables(): array
    {
        return [
            'FIELDS' => join(",\n", array_map(function (ModelField $field) {
                return $field->toFactoryField();
            }, $this->fields))
        ];
    }

    protected function getOptions()
    {
        return [
            ['fields', 'f', InputOption::VALUE_NONE, 'model fields'],
            ['model', 'm', InputOption::VALUE_NONE, 'model name'],
        ];
    }
}
