<?php

namespace Fifth\Generator\Commands\RequestCommands;

use Fifth\Generator\Commands\MainMakeCommand;

class StoreRequestMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:storeRequest';

    protected $description = 'Make StoreRequest for given Model';

    protected $type = 'StoreRequest';

    protected function getClassName()
    {
        return "StoreRequest";
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/storeRequest.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests'.'\\'.$this->argument('name');
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $stub = $this->replaceClassInstance($stub, $name);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    protected function replaceClassInstance($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('dummyClass', strtolower($class), $stub);
    }
}
