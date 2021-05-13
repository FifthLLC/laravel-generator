<?php

namespace Fifth\Generator\Common;

use Fifth\Generator\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait BaseFragment
{
    private static function getBuilderWithClauses(string $columnName, ?string $value): Builder
    {
        $clauses = [];

        // Developer can find by multiple columns too, so in case when only one clause passed, we convert it to array
        if(!is_array($columnName)) {
            $clauses[] = [$columnName, $value];
        }

        $builder = self::query();

        foreach ($clauses as $clause) {
            $builder->where(...$clause);
        }

        return $builder;
    }

    public function scopeFilterUsing(Builder $query, ?AbstractFilter $filter, string $method = 'handle', ...$args) : Builder
    {
        return $filter ? $filter->{$method}($query,...$args) : $query;
    }

    public static function findBy(string $columnName, ?string $value) : ?self
    {
        return self::getBuilderWithClauses($columnName, $value)->first();
    }

    public static function findOrFailBy(string $columnName, ?string $value = null) : self
    {
        return self::getBuilderWithClauses($columnName, $value)->firstOrFail();
    }

    public static function bulkDelete(array $ids): int
    {
        return static::destroy($ids);
    }

    public static function getTableName(): string
    {
        return (new static)->getTable();
    }

    public static function getDefaultAttributes(): array
    {
        return (new static)->getAttributes();
    }

    public static function getConstant(string $variable)
    {
        return constant('static::'. $variable);
    }

    public function safeUpdate(array $attributes = [], array $options = []) : bool
    {
        $attributes = Arr::except($attributes, $this->nonUpdatable);

        return $this->update($attributes, $options);
    }
}
