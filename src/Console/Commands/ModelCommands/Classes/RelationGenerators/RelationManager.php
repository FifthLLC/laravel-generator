<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators;


class RelationManager
{
    private ?array $relations;
    private ?string $relationFragmentData = '';
    private ?array $relationFields = [];

    public function __construct($relationsData)
    {
        $this->relations = ModelRelation::bulkCreate($relationsData);
    }

    public function handle()
    {
        foreach ($this->relations as $relation) {
            $relation->handle();
        }
    }

    public function getRelationFragmentData()
    {
        return $this->relationFragmentData;
    }

    public function getRelationFields()
    {
        return array_map(function (ModelRelation $modelRelation) {
           return $modelRelation->getFields();
        }, $this->relations);
    }
}
