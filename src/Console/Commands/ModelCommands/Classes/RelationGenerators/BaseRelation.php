<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators;


abstract class BaseRelation
{
    protected ModelRelation $modelRelation;
    public function setModelRelation(ModelRelation $modelRelation)
    {
        $this->modelRelation = $modelRelation;
    }

    public function getFields()
    {
        return [];
    }

    public function handle()
    {
        $this->prepareData();
    }

    protected function prepareData() {}
}
