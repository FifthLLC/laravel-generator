<?php

namespace Fifth\Generator\Commands\FilterCommands;

use Fifth\Generator\Commands\MainMakeCommand;

class FilterMakeCommand extends MainMakeCommand
{
    protected $name = 'make:filter';

    protected $description = 'Make IndexFilter for given Model';

    protected $type = 'Filter';

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Filters'.'\\'.$this->argument('name');
    }

    protected function getClassName()
    {
        return 'IndexFilter';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/filter.stub';
    }
}
