<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes\DatabaseFieldGenerators;


use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;

class MigrationFieldGenerator
{
    protected $modelField;
    protected $migrationString = '';

    public function __construct(ModelField $field)
    {
        $this->modelField = $field;
    }

    public function getMigrationString($migrationType)
    {
        if(!$this->migrationString) {
            $this->setMigrationString($migrationType);
        }

        return $this->migrationString;
    }

    protected function setMigrationString($migrationType)
    {
        if($migrationType != ModelField::MIGRATION_STRING_TYPES['only_create'] && !$this->modelField->getForeign()) {
            $migrationType = ModelField::MIGRATION_STRING_TYPES['only_create'];
        }

        switch ($migrationType) {
            case ModelField::MIGRATION_STRING_TYPES['only_create']: $this->migrationString = $this->compositeMigrationString(); break;
            case ModelField::MIGRATION_STRING_TYPES['only_foreign']: $this->migrationString = $this->compositeForeignMigrationString(); break;
            case ModelField::MIGRATION_STRING_TYPES['create_with_foreign']:
                $this->migrationString = $this->compositeMigrationString() ."\n" . $this->compositeForeignMigrationString(); break;
        }
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
        $str .= $this->appendUnsigned();
        $str .= $this->appendDefaultValue();
        $str .= $this->appendUnique();
        $str .= $this->appendIndex();

        return $this->finishRaw($str);
    }

    protected function appendUnique()
    {
        return $this->modelField->unique ? '->unique()' : '';
    }

    protected function appendUnsigned()
    {
        return $this->modelField->unsigned ? '->unsigned()' : '';
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
    public function compositeForeignMigrationString()
    {
        $str = $this->initRaw();
        $str .= $this->appendForeign();
        $str .= $this->appendReferences();
        $str .= $this->appendRelatedTable();
        $str .= $this->appendOnDelete();
        return $this->finishRaw($str);
    }

    protected function appendReferences()
    {
        return "->references('{$this->modelField->relatedColumn}')";
    }

    protected function appendRelatedTable()
    {
        return "->on('{$this->modelField->relatedTable}')";
    }

    protected function appendOnDelete()
    {
        return "->onDelete('{$this->modelField->getOnDelete()}')";
    }

    protected function appendForeign()
    {
        return "foreign('{$this->modelField->name}')";
    }
}
