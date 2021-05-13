<?php

namespace Fifth\Generator\Console\Commands\FilterCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;
use Fifth\Generator\Console\Commands\Fragments\HasFields;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Symfony\Component\Console\Input\InputOption;

class FilterMakeCommand extends MainMakeCommand
{
    use HasFields;

    protected $name = 'fifth:filter';

    protected $description = 'Make IndexFilter for given Model';

    protected $type = 'Filter';

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Filters'.'\\'.$this->argument('name');
    }

    protected function prepareData()
    {
        $this->setFields();
    }

    protected function getClassName()
    {
        return 'IndexFilter';
    }

    protected function getOrderableFieldsStr(): string
    {
        return join(",\n", array_map(function (ModelField $field) {
            return $field->toFilterOrderableString();
        }, array_filter($this->fields, function (ModelField $field) {
            return $field->orderable;
        })));
    }

    protected function getFilterableFields(): string
    {
        return join(",\n", array_map(function (ModelField $field) {
            return $field->toFilterString();
        }, array_filter($this->fields, function (ModelField $field) {
            return $field->filterable;
        })));
    }

    protected function getSearchableFields(): string
    {
        $fields = array_filter($this->fields, function (ModelField $field) {
            return $field->searchable;
        });

        $str = join(", ", array_map(function (ModelField $field) {
            return "'$field->name'";
        }, $fields)) ?: '[]';

        return "\t\t\t'search' => \$this->searchParams($str),";

    }

    protected function workoutReplaceableVariables(): array
    {
        return [
            'ORDER_FIELDS' => $this->getOrderableFieldsStr(),
            'SEARCH_FIELDS' => $this->getSearchableFields(),
            'FILTER_FIELDS' => $this->getFilterableFields(),
        ];
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/filter.stub';
    }

    protected function getOptions()
    {
        return [
            ['fields', 'f', InputOption::VALUE_NONE, 'migration model fields'],
        ];
    }
}
