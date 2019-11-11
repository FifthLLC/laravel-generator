<?php

namespace Fifth\Generator\Commands\RequestCommands;

use Fifth\Generator\Commands\MainMakeCommand;

class UpdateRequestMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:updateRequest';

    protected $description = 'Make UpdateRequest for given Model';

    protected $type = 'UpdateRequest';

    protected function getClassName()
    {
        return "UpdateRequest";
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/updateRequest.stub';
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
