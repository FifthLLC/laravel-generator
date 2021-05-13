<?php

namespace Fifth\Generator\Console\Commands\RequestCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;

class DestroyRequestMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:destroyRequest';

    protected $description = 'Make DestroyRequest for given Model';

    protected $type = 'DestroyRequest';

    protected function getStub()
    {
        return __DIR__.'/stubs/destroyRequest.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests'.'\\'.$this->argument('name');
    }

    protected function getClassName()
    {
        return "DestroyRequest";
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
