<?php

namespace Fifth\Generator\Console\Commands\ModelCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;

class ModelFragmentsMakeCommand extends MainMakeCommand
{
    protected $signature = 'fifth:modelFragment {name} {--fragment=Relations}';

    protected $description = 'Create model fragment';

    protected function getStub()
    {
        return __DIR__.'/stubs/fragment.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $name = explode('/', $this->argument('name'));

        return $rootNamespace . "\Models\Fragments\\" . end($name);
    }

    protected function getNameInput()
    {
        return $this->option('fragment');
    }

    protected function getClassName()
    {
        return $this->option('fragment');
    }

}
