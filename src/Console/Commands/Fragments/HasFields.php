<?php


namespace Fifth\Generator\Console\Commands\Fragments;


use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;

trait HasFields
{
    protected $fields = [];
    private function setFields()
    {
        $this->fields = array_map(function ($fieldData) {
            return ModelField::fromObj($fieldData);
        }, json_decode($this->option('fields')));
    }

    protected function getImplodedFields()
    {
        return json_encode($this->fields);
    }
}
