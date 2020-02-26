<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators\RelationTypes;


use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\RelationGenerators\BaseRelation;
use Fifth\Generator\Models\FifthModelField;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class BelongsToOne extends BaseRelation
{
    protected array $fields = [];
    public function prepareData()
    {
        $this->setField();
        $this->relationData();
    }

    protected function setField()
    {;
        $className = $this->modelRelation->getRelatedModelClassName();
        $modelInstance = App::make($className);

        $relatedTableName = Str::snake(class_basename($className));
        $primaryKey = $modelInstance->getKeyName();

        $this->fields []= ModelField::fromObj((object)[
            'name' =>  $relatedTableName . '_' . $primaryKey,
            'type' => 'bigInteger',
            'unsigned' => true,
            'fillable' => true,
            'relatedColumn' => $primaryKey,
            'relatedTable' => $relatedTableName,
            'nullable' => $this->modelRelation->getNullable(),
            'onDelete' => $this->modelRelation->getOnDelete(),
            'isForeign' => true,
        ]);
    }

    protected function relationData()
    {

    }

    public function getFields()
    {
        return $this->fields;
    }
}
