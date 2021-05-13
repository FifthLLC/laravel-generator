<?php


namespace Fifth\Generator\Console\Commands\RequestCommands;


use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Symfony\Component\Console\Input\InputOption;

trait PersisterRequest
{
    protected function prepareFields()
    {
        $this->setFields();

        $this->fields = array_filter($this->fields, function (ModelField $field) {
            return $field->validations;
        });
    }

    protected function getOptions()
    {
        return [
            ['fields', 'f', InputOption::VALUE_NONE, 'model fields'],
        ];
    }

    protected function getRules($forUpdate = false)
    {
        return join(",\n", array_map(function (ModelField $field) use ($forUpdate) {
            return $field->toValidationStr($forUpdate);
        }, $this->fields));
    }
}
