<?php

namespace Fifth\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class GenerateCommand extends Command
{
    protected $signature = 'fifth:generate {name}';

    protected $description = 'Generate Requests, Controller, DataProviders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        Artisan::call('fifth:baseModel', ['name' => 'Models/'.$this->argument('name')]);
        Artisan::call('fifth:apiController', ['name' => $this->argument('name')]);
        Artisan::call('fifth:indexDataProvider', ['name' => $this->argument('name')]);
        Artisan::call('fifth:transformer', ['name' => $this->argument('name')]);
        Artisan::call('fifth:filter', ['name' => $this->argument('name')]);
        Artisan::call('fifth:indexRequest', ['name' => $this->argument('name')]);
        Artisan::call('fifth:storeRequest', ['name' => $this->argument('name')]);
        Artisan::call('fifth:showRequest', ['name' => $this->argument('name')]);
        Artisan::call('fifth:updateRequest', ['name' => $this->argument('name')]);
        Artisan::call('fifth:destroyRequest', ['name' => $this->argument('name')]);
        Artisan::call('fifth:policy',  ['name' => $this->argument('name')]);
        Artisan::call('make:seeder',  ['name' => $this->getPluralName().'tableSeeder']);
        $this->info('Controller, Model, Migration, Transformer, Requests, Filter, Policy, Seeder created successfully.');
    }

    private function getPluralName()
    {
        return ucfirst(Str::snake(Str::plural(class_basename($this->argument('name')))));
    }
}
