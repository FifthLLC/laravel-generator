<?php

namespace Fifth\Generator\Console\Commands\ModelCommands;

use Fifth\Generator\Console\Commands\MainMakeCommand;
use Fifth\Generator\Console\Commands\Fragments\HasFields;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Symfony\Component\Console\Input\InputOption;

class ModelMigrationMakeCommand extends MainMakeCommand
{
    use HasFields;

    protected $name = 'fifth:migration';

    protected $description = 'Create model migration';

    public function handle()
    {
        $this->prepareFields();

        return parent::handle(); // TODO: Change the autogenerated stub
    }

    protected function prepareFields()
    {
        $this->setFields();

        $this->fields = array_map(function (ModelField $field) {
            return $field->toMigrationString(ModelField::MIGRATION_STRING_TYPES['create_with_foreign']);
        }, $this->fields);

        $this->fields[] = $this->appendTimeStamps();
    }

    protected function appendTimeStamps()
    {
        return $this->option('withTimestamps') ? "\t\t\t\$table->timestamps();" : '';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/migration.stub';
    }

    protected function getDatePrefix()
    {
        return date('Y_m_d_His');
    }

    protected function getPath($rootNamespace)
    {
        $name = explode('/', $this->argument('name'));

        return $this->laravel->databasePath().DIRECTORY_SEPARATOR.'migrations/' . $this->getDatePrefix() . '_' . end($name) . '.php';
    }

    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        return $this->replaceTableName($stub);
    }

    protected function replaceTableName($stub)
    {
        return str_replace('DummyTable', $this->option('create'), $stub);
    }

    protected function workoutReplaceableVariables(): array
    {
        return [
            'FIELDS' => $this->getPrepareFields(),
        ];
    }

    protected function getPrepareFields()
    {;
        return join("\n", $this->fields);
    }

    protected function getNameInput()
    {
        return 'Create' . ucfirst($this->option('create')) . 'Table';
    }

    protected function getClassName()
    {
        return $this->getNameInput();
    }

    protected function getOptions()
    {
        return [
            ['create', 'c', InputOption::VALUE_NONE, 'migration table name'],
            ['fields', 'f', InputOption::VALUE_NONE, 'migration model fields'],
            ['withTimestamps', 't', InputOption::VALUE_NONE, 'with timestamps'],
        ];
    }


}
