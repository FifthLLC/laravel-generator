<?php

namespace Fifth\Generator\Commands;

use Fifth\Generator\Console\Commands\Fragments\HasFields;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class GenerateCommand extends Command
{
    use HasFields;

    protected $signature = 'fifth:generate {name} {--fields=} {--withTimestamps} {--relations}';

    protected $description = 'Generate Requests, Controller, DataProviders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->setFields();

        Artisan::call('fifth:model', [
            'name' => $this->argument('name'),
            '--fields' => $this->getImplodedFields(),
            '--withTimestamps' => $this->option('withTimestamps'),
            '--relations' => $this->getRelations(),
        ]);

        Artisan::call('fifth:apiController', ['name' => $this->argument('name')]);
        Artisan::call('fifth:indexDataProvider', ['name' => $this->argument('name')]);
        Artisan::call('fifth:transformer', [
            'name' => $this->argument('name'),
            '--fields' => $this->getImplodedFields(),
        ]);
        Artisan::call('fifth:filter', [
            'name' => $this->argument('name'),
            '--fields' => $this->getImplodedFields(),
        ]);
        Artisan::call('fifth:indexRequest', ['name' => $this->argument('name')]);
        Artisan::call('fifth:showRequest', ['name' => $this->argument('name')]);
        Artisan::call('fifth:destroyRequest', ['name' => $this->argument('name')]);

        Artisan::call('fifth:storeRequest', [
            'name' => $this->argument('name'),
            '--fields' => $this->getImplodedFields(),
        ]);
        Artisan::call('fifth:updateRequest', [
            'name' => $this->argument('name'),
            '--fields' => $this->getImplodedFields(),
        ]);
        Artisan::call('fifth:policy',  ['name' => $this->argument('name')]);
        Artisan::call('fifth:seeder',  [
            'name' => $this->getPluralName().'TableSeeder',
            '--model' => $this->argument('name'),
            '--fields' => $this->getImplodedFields(),
        ]);
        Artisan::call('fifth:factory',  [
            'name' => $this->argument('name').'Factory',
            '--model' => $this->argument('name'),
            '--fields' => $this->getImplodedFields(),
        ]);
        dd('enddd');
        $this->info('Controller, Model, Migration, Transformer, Requests, Filter, Policy, Seeder created successfully.');
    }

    protected function getFieldsData()
    {

        return array_filter((array)explode(':;:', $this->option('fields')));
    }

    protected function getRelations()
    {
        return $this->option('relations');
    }

    protected function setFields()
    {
        foreach ($this->getFieldsData() as $fieldData) {
            $this->fields[] = ModelField::fromStr($fieldData);
        }
    }

    private function getPluralName()
    {
        return ucfirst(Str::snake(Str::plural(class_basename($this->argument('name')))));
    }
}
