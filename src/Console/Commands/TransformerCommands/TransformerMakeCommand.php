<?php

namespace Fifth\Generator\Console\Commands\TransformerCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;
use Fifth\Generator\Console\Commands\Fragments\HasFields;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Symfony\Component\Console\Input\InputOption;

class TransformerMakeCommand extends MainMakeCommand
{
    use HasFields;

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

    protected function prepareData()
    {
        $this->setFields();
    }

    protected function workoutReplaceableVariables(): array
    {
        return [
            'FIELDS' => join(",\n", array_map(function (ModelField $field) {
                return $field->toTransformerField();
            }, $this->fields))
        ];
    }

    protected function getOptions()
    {
        return [
            ['fields', 'f', InputOption::VALUE_NONE, 'migration model fields'],
        ];
    }
}
