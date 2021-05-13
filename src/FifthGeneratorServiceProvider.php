<?php

namespace Fifth\Generator;

use Fifth\Generator\Commands\ModelCommands\ModelFragmentsMakeCommand;
use Fifth\Generator\Commands\ModelCommands\ModelMakeCommand;
use Fifth\Generator\Commands\ControllerCommands\ApiControllerMakeCommand;
use Fifth\Generator\Commands\DataProviderCommands\DataProviderMakeCommand;
use Fifth\Generator\Commands\FilterCommands\FilterMakeCommand;
use Fifth\Generator\Commands\GenerateCommand;
use Fifth\Generator\Commands\MigrateRefreshCommand;
use Fifth\Generator\Commands\ModelCommands\ModelMigrationMakeCommand;
use Fifth\Generator\Commands\ModelCommands\PolicyMakeCommand;
use Fifth\Generator\Commands\RequestCommands\DestroyRequestMakeCommand;
use Fifth\Generator\Commands\RequestCommands\IndexRequestMakeCommand;
use Fifth\Generator\Commands\RequestCommands\ShowRequestMakeCommand;
use Fifth\Generator\Commands\RequestCommands\StoreRequestMakeCommand;
use Fifth\Generator\Commands\RequestCommands\UpdateRequestMakeCommand;
use Fifth\Generator\Commands\SeedCommands\FactoryMakeCommand;
use Fifth\Generator\Commands\SeedCommands\SeederMakeCommand;
use Fifth\Generator\Commands\TransformerCommands\TransformerMakeCommand;
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
