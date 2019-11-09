<?php

namespace Fifth\Generator\Http\DataProviders;

use Fifth\Generator\Http\Filters\AbstractFilter;

abstract class DataProvider
{
    const PER_PAGE_COUNT = 15;

    protected $filter;
    protected $builder;
    protected $request;
    protected $withoutPagination;

    protected abstract function setBuilder();

    protected function getPerPageCount()
    {
        return $this->withoutPagination ?: $this->request->items_per_page ?: self::PER_PAGE_COUNT;
    }

    public function getData()
    {
        if ($this->request->withoutPagination) {
            return $this->builder->get();
        }

        return $this->request->withCount ?
            $this->builder->paginate($this->getPerPageCount()) :
            $this->builder->simplePaginate($this->getPerPageCount());
    }

    public function init(AbstractFilter $filter): void
    {
        $this->filter = $filter;
        $this->request = $filter->request;

        $this->setBuilder();
    }
}
