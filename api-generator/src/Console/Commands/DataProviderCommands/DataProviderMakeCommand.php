<?php

namespace Fifth\Generator\Commands\DataProviderCommands;

use Fifth\Generator\Commands\MainMakeCommand;

class DataProviderMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:indexDataProvider';

    protected $description = 'Make DataProvider for given Model';

    protected $type = 'DataProvider';

    protected function getClassName()
    {
        return 'IndexDataProvider';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/dataProvider.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\DataProviders'.'\\'.$this->argument('name');
    }
}
