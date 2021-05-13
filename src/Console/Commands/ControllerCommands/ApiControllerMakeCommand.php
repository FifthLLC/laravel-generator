<?php

namespace Fifth\Generator\Console\Commands\ControllerCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;

class ApiControllerMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:apiController';

    protected $description = 'Api controller creation command';

    protected $type = 'ApiController';

    protected function getStub()
    {
        return __DIR__ . '/stubs/controller.api.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers\Api\V1' . '\\' . $this->getNameInput();
    }

    protected function getClassName()
    {
        return $this->getNameInput().'Controller';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        $stub = $this->replaceClassInstance($stub, $name);

        $stub = $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);

        return $this->replaceClassName($stub, $name);
    }

    protected function replaceClassName($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('Dummy', $class, $stub);
    }

    protected function replaceClassInstance($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('dummy', strtolower($class), $stub);
    }
}
