<?php

namespace Fifth\Generator\Commands\TransformerCommands;

use Fifth\Generator\Commands\MainMakeCommand;

class TransformerMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:transformer';

    protected $description = 'Transformer creation command';

    protected $type = 'Transformer';

    protected function getStub()
    {
        return __DIR__.'/stubs/transformer.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Transformers';
    }

    protected function getClassName()
    {
        return $this->getNameInput().'Transformer';
    }
}
