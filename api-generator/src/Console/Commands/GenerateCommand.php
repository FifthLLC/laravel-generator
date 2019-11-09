<?php

namespace Fifth\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateCommand extends Command
{
    protected $signature = 'fifth:generate-all {name}';

    protected $description = 'Generate Requests, Controller, DataProviders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        Artisan::call('make:baseModel', ['name' => 'Models/'.$this->argument('name')]);
        Artisan::call('make:apiController', ['name' => $this->argument('name')]);
        Artisan::call('make:indexDataProvider', ['name' => $this->argument('name')]);
        Artisan::call('make:transformer', ['name' => $this->argument('name')]);
        Artisan::call('make:filter', ['name' => $this->argument('name')]);
        Artisan::call('make:indexRequest', ['name' => $this->argument('name')]);
        Artisan::call('make:storeRequest', ['name' => $this->argument('name')]);
        Artisan::call('make:showRequest', ['name' => $this->argument('name')]);
        Artisan::call('make:updateRequest', ['name' => $this->argument('name')]);
        Artisan::call('make:destroyRequest', ['name' => $this->argument('name')]);
//        Artisan::call('make:policy', ['name'  => $this->argument('name') . 'Policy','--model' => 'Models/' .$this->argument('name')]);
        Artisan::call('make:policy11',  ['name' => $this->argument('name')]);
        $this->info('Controller, Model, Migration, Transformer, Requests, Filter, Policy created successfully.');
    }
}
