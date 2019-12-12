<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes\DatabaseFieldGenerators;


use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;

class MigrationFieldGenerator
{
    protected ModelField $modelField;
    protected string $migrationString = '';

    public function __construct(ModelField $field)
    {
        $this->modelField = $field;
    }

    public function getMigrationString()
    {
        if(!$this->migrationString) {
            $this->setMigrationString();
        }

        return $this->migrationString;
    }

    protected function setMigrationString()
    {
        $this->migrationString = $this->compositeMigrationString();
    }

    protected function initRaw()
    {
        return "\t\t\t\$table->";
    }

    protected function finishRaw(string $str)
    {
        return $str . ";";
    }

    protected function compositeMigrationString()
    {
        $str = $this->initRaw();
        $str .= $this->appendType();
        $str .= $this->appendNullable();
        $str .= $this->appendDefaultValue();
        $str .= $this->appendUnique();
        $str .= $this->appendIndex();

        return $this->finishRaw($str);
    }

    protected function appendUnique()
    {
        return $this->modelField->unique ? '->unique()' : '';
    }

    protected function appendIndex()
    {
        return $this->modelField->index ? '->index()' : '';
    }

    protected function appendNullable()
    {
        return $this->modelField->nullable ? '->nullable()' : '';
    }

    protected function appendDefaultValue()
    {
        return $this->modelField->hasDefaultValue() ? "->default({$this->modelField->getDefaultValue()})" : '';
    }

    protected function appendType(): string
    {
        return "{$this->modelField->getMigrationType()}('{$this->modelField->name}'" .
            ($this->modelField->getLength() ? ", {$this->modelField->getLength()}" : '') .")";
    }
}
