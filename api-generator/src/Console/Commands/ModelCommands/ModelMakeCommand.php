<?php

namespace Fifth\Generator\Commands\ModelCommands;

use Fifth\Generator\Commands\MainMakeCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ModelMakeCommand extends MainMakeCommand
{
    protected $name = 'make:baseModel';

    protected $type = 'Model';

    protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }

    public function handle()
    {
        $this->createFragments();

        $this->createMigration();

        parent::handle();
    }

    private function createFragments()
    {
        foreach ($this->getDefaultFragmentNames() as $fragment) {
            Artisan::call('make:modelFragment', [
                'name'       => $this->argument('name'),
                '--fragment' => $fragment
            ]);
        }
    }

    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    private function getDefaultFragmentNames()
    {
        return ['Relations', 'Scopes'];
    }

    protected function getClassName()
    {
        return $this->getNameInput();
    }
}
