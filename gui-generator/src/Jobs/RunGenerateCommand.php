<?php

namespace Fifth\GuiGenerator\Jobs;

use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class RunGenerateCommand
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        Artisan::call('fifth:generate', [
            'name' => $this->data['name'],
            '--withTimestamps' => $this->data['withTimestamps'] ?? '',
            '--fields' => $this->getFieldsString(),
        ]);
    }

    private function getFieldsString()
    {
        $fields = [];

        foreach ($this->data['fields'] as $field) {
            $fields []= $field['name'] . '=>' . join(',', $this->getModelFieldsData($field));
        }

        return join(':;:',$fields);
    }

    protected function getModelFieldsData($field)
    {
        return array_map(function ($item) use ($field) {
            return $field[$item] ?? null;
        }, ModelField::DATA_FIELDS);
    }
}
