<?php

namespace Fifth\Generator\Commands\RequestCommands;

use Fifth\Generator\Commands\MainMakeCommand;

class IndexRequestMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:indexRequest';

    protected $description = 'Make IndexRequest for given Model';

    protected $type = 'IndexRequest';

    protected function getClassName()
    {
        return "IndexRequest";
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/indexRequest.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests'.'\\'.$this->argument('name');
    }
}
