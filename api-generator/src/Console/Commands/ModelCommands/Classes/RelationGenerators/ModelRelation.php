<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators;


class ModelRelation
{
    private ?string $type;
    private ?string $model;
    private ?string $pivot;
    private ?string $on_delete;
    private ?bool $nullable = null;
    private BaseRelation $relation;

    public static function fromObj($data): self
    {
        $relation = new self();

        foreach ($data as $key => $item) {
            $relation->{$key} = $item;
        }

        return $relation;
    }

    public function getRelatedModelClassName()
    {
        return 'App\Models\\'. $this->model;
    }

    public static function bulkCreate($relationsData)
    {
        $relations = [];
        foreach ((array)$relationsData as $data) {
            $relations[] = self::fromObj($data);
        }

        return $relations;
    }

    public function handle()
    {
        $this->relation = RelationFactory::getRelationByType($this->type);
        $this->relation->setModelRelation($this);
        $this->relation->handle();
    }

    public function getFields()
    {
        return $this->relation->getFields();
    }

    public function getNullable()
    {
        return $this->nullable;
    }

    public function getOnDelete()
    {
        return $this->on_delete;
    }

}
