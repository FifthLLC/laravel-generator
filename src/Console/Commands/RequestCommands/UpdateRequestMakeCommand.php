<?php

namespace Fifth\Generator\Console\Commands\RequestCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;
use Fifth\Generator\Console\Commands\Fragments\HasFields;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Fifth\Generator\Console\Commands\RequestCommands\PersisterRequest;
use Symfony\Component\Console\Input\InputOption;

class UpdateRequestMakeCommand extends MainMakeCommand
{
    use HasFields, PersisterRequest;

    protected $name = 'fifth:updateRequest';

    protected $description = 'Make UpdateRequest for given Model';

    protected $type = 'UpdateRequest';

    protected function prepareData()
    {
        $this->prepareFields();
    }

    protected function getClassName()
    {
        return "UpdateRequest";
    }

    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $stub = $this->replaceClassInstance($stub, $name);

        return $stub;
    }

    protected function replaceClassInstance($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('dummyClass', strtolower($class), $stub);
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/updateRequest.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests'.'\\'.$this->argument('name');
    }

    protected function workoutReplaceableVariables(): array
    {
        return [
            'RULES' => $this->getRules(true)
        ];
    }
}
