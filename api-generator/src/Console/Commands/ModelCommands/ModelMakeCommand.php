<?php

namespace Fifth\Generator\Commands\ModelCommands;

use Fifth\Generator\Commands\MainMakeCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ModelMakeCommand extends MainMakeCommand
{
    protected $name = 'fifth:baseModel';

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
            Artisan::call('fifth:modelFragment', [
                'name'       => $this->argument('name'),
                '--fragment' => $fragment
            ]);
        }
    }

    protected function createMigration()
    {
        $table = Str::snake(Str::plural(class_basename($this->argument('name'))));

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
