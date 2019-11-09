<?php

namespace Fifth\Generator\Transformers;

use Illuminate\Database\Eloquent\Model;

abstract class Transformer
{
    public static function __callStatic($name, $arguments): array
    {
        $instance = new static();

        if(method_exists($instance, 'transform' . ucfirst($name))){

            return $instance->{'transform' . ucfirst($name)}(...$arguments);
        }

        return $instance->{$name . 'Transform'}(...$arguments);
    }

    /**
     * @param $paginator
     * @param string $method
     * @param mixed ...$args
     * @return array
     */
    public function transformPagination($paginator, string $method = 'simpleTransform', ...$args) : array
    {
        return [
            'total' => method_exists($paginator, 'total') ? $paginator->total() : null,
            'hasMorePages' => method_exists($paginator, 'hasMorePages') ? $paginator->hasMorePages() : null,
            'items' => $this->transformArray($paginator->items(), $method, ...$args)
        ];

    }

    public function transformCollection(\ArrayAccess $items, string $method = 'simpleTransform', ...$args) : array
    {
        return $items->map(function ($item) use ($method,$args) {
            return $this->{$method}($item, ...$args);
        })->toArray();
    }

    public function transformArray(array $items, string $method = 'simpleTransform', ...$args) : array
    {
        return array_map(function($item) use ($method,$args) {
            return $this->{$method}($item, ...$args);
        },$items);
    }

    abstract public function simpleTransform(Model $item): array;
}
