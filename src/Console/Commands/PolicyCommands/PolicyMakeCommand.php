<?php

namespace Fifth\Generator\Commands\ModelCommands;

use Fifth\Generator\Commands\MainMakeCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class PolicyMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:policy';

    protected $type = 'Policy';

    protected function getStub()
    {
        return __DIR__ . '/stubs/policy.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Policies';
    }

    protected function getClassName()
    {
        return $this->getNameInput() . 'Policy';
    }
}
