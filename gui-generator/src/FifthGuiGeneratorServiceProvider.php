<?php

namespace Fifth\GuiGenerator;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FifthGuiGeneratorServiceProvider extends ServiceProvider
{
    protected $namespace = 'Fifth\GuiGenerator\Http\Controllers';
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'fifth_gui_generator');

        $this->loadRoutes();
    }

    /**
     * Load Routes
     */
    private function loadRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->as('fifth.')
            ->prefix('fifth')
            ->group(__DIR__ . '/../routes.php');
    }
}
