<?php

namespace Fifth\Generator\Commands\ModelCommands;

use Fifth\Generator\Commands\MainMakeCommand;

class ModelFragmentsMakeCommand extends MainMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:modelFragment {name} {--fragment=Relations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';



    protected function getStub()
    {
        return __DIR__.'/stubs/fragment.stub';
    }


    protected function getDefaultNamespace($rootNamespace)
    {
        $name = explode('/', $this->argument('name'));

        return $rootNamespace . "\Models\Fragments\\" . end($name);
    }

    protected function getNameInput()
    {
        return $this->option('fragment');
    }

    protected function getClassName()
    {
        return $this->option('fragment');
    }

}
