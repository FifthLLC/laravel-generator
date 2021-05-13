<?php

namespace Fifth\Generator;

use Fifth\Generator\Console\Commands\ModelCommands\ModelFragmentsMakeCommand;
use Fifth\Generator\Console\Commands\ModelCommands\ModelMakeCommand;
use Fifth\Generator\Console\Commands\ControllerCommands\ApiControllerMakeCommand;
use Fifth\Generator\Console\Commands\DataProviderCommands\DataProviderMakeCommand;
use Fifth\Generator\Console\Commands\FilterCommands\FilterMakeCommand;
use Fifth\Generator\Console\Commands\GenerateCommand;
use Fifth\Generator\Console\Commands\MigrateRefreshCommand;
use Fifth\Generator\Console\Commands\ModelCommands\ModelMigrationMakeCommand;
use Fifth\Generator\Console\Commands\PolicyCommands\PolicyMakeCommand;
use Fifth\Generator\Console\Commands\RequestCommands\DestroyRequestMakeCommand;
use Fifth\Generator\Console\Commands\RequestCommands\IndexRequestMakeCommand;
use Fifth\Generator\Console\Commands\RequestCommands\ShowRequestMakeCommand;
use Fifth\Generator\Console\Commands\RequestCommands\StoreRequestMakeCommand;
use Fifth\Generator\Console\Commands\RequestCommands\UpdateRequestMakeCommand;
use Fifth\Generator\Console\Commands\SeedCommands\FactoryMakeCommand;
use Fifth\Generator\Console\Commands\SeedCommands\SeederMakeCommand;
use Fifth\Generator\Console\Commands\TransformerCommands\TransformerMakeCommand;
use Illuminate\Support\ServiceProvider;

class FifthGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/fifth.php';
        $this->mergeConfigFrom($configPath, 'fifth');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            GenerateCommand::class,
            ApiControllerMakeCommand::class,
            ModelMakeCommand::class,
            DataProviderMakeCommand::class,
            TransformerMakeCommand::class,
            FilterMakeCommand::class,
            IndexRequestMakeCommand::class,
            StoreRequestMakeCommand::class,
            ShowRequestMakeCommand::class,
            UpdateRequestMakeCommand::class,
            DestroyRequestMakeCommand::class,
            ModelFragmentsMakeCommand::class,
            MigrateRefreshCommand::class,
            PolicyMakeCommand::class,
            ModelMigrationMakeCommand::class,
            SeederMakeCommand::class,
            FactoryMakeCommand::class
        ]);
    }

}
