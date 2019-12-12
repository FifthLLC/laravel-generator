<?php


namespace Fifth\Generator\Console\Commands\ModelCommands\Classes;


use Fifth\Generator\Console\Commands\ModelCommands\Classes\DatabaseFieldGenerators\FactoryFieldGenerator;
use Fifth\Generator\Console\Commands\ModelCommands\Classes\DatabaseFieldGenerators\MigrationFieldGenerator;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Object_;

class ModelField
{
    public const DATA_FIELDS = [
        'type', 'length', 'default', 'nullable', 'unique', 'index',
        'fillable', 'searchable', 'filterable', 'orderable', 'validations',
    ];

    public $name;
    public $type;
    public $length;
    public $nullable;
    public $unique;
    public $index;
    public $fillable;
    public $searchable;
    public $filterable;
    public $validations;
    public $default;
    public $orderable;

    public static function fromObj(Object $obj): self
    {
        $modelField = new ModelField();
        foreach (get_object_vars($obj) as $key => $value) {
            $modelField->{$key} = $value;
        }

        return $modelField;
    }

    public function toTransformerField(): string
    {
        return "\t\t\t'$this->name' => \$model->$this->name";
    }

    public function toFactoryField(): string
    {
        return (new FactoryFieldGenerator($this))->getFactoryString();
    }

    public static function fromStr(string $str): self
    {
        $modelField = new ModelField();
        $data = explode('=>', $str);
        $modelField->name = array_shift($data);

        $data = explode(',', $data[0] ?? []);

        foreach (self::DATA_FIELDS as $i => $fieldName) {
            $modelField->{$fieldName} = $data[$i] ?? null;
        }

        return $modelField;
    }

    public function toMigrationString(): string
    {
        return (new MigrationFieldGenerator($this))->getMigrationString();
    }

    public function toFilterOrderableString(): string
    {
        return "\t\t'$this->name' => '$this->name'";
    }

    public function toFilterString(): string
    {
        return "\t\t\t'$this->name' => \$this->params('$this->name')";
    }

    public function toValidationStr($forUpdate = false): string
    {
        $validations = explode('|', $this->validations);

        if($forUpdate && in_array('required', $validations)) {
            array_unshift($validations, 'sometimes');
        }

        return "\t\t\t'$this->name' => '". join('|', $validations) ."'";
    }

    protected function canHasLength(): bool
    {
        return in_array($this->type, ['string']);
    }

    public function getLength(): ?int
    {
        return $this->canHasLength() ? (int)$this->length : null;
    }

    public function getMigrationType()
    {
        return $this->type;
    }

    public function hasDefaultValue()
    {
        return !!$this->default;
    }

    public function getDefaultValue()
    {
        return "'$this->default'";
    }
}
