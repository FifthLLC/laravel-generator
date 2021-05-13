<?php

namespace Fifth\Generator\Console\Commands\PolicyCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;
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
