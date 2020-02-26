<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes\DatabaseFieldGenerators;


use Faker\Factory;
use Faker\Generator;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\ModelField;

class FactoryFieldGenerator
{
    protected ModelField $modelField;

    public function __construct(ModelField $field)
    {
        $this->modelField = $field;
    }

    public function getFactoryString(): string
    {
        $factoryField = $this->getFactoryFunctionName();

        return "\t\t'{$this->modelField->name}' => " . ($factoryField ?  $factoryField : $this->getFactoryFunctionByType());
    }

    protected function getFactoryFunctionName(): ?string
    {
        $faker = Factory::create();

        try {
            $faker->{$this->modelField->name}();
            return '$faker->' . $this->modelField->name . '()';
        } catch (\Exception $exception) {
            try {
                $faker->{$this->modelField->name};

                return '$faker->' . $this->modelField->name;

            } catch (\Exception $exception) {
                return null;
            }
        }
    }

    protected function getFactoryFunctionByType(): string
    {
        return $this->getFactoryTypes()[$this->modelField->type] ?? '';
    }

    protected function getFactoryTypes(): array
    {
        return [
            'bigIncrements' => 'rand()',
            'increments' => 'rand()',
            'uuid' => '$faker->uuid',
            'string' => '$faker->text',
            'integer' => 'rand()',
            'text' => '$faker->text(200)',
        ];
    }
}
