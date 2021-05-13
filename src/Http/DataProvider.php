<?php

namespace Fifth\Generator\Http;

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

    public function getBuilder()
    {
        return $this->builder;
    }

    public function getData()
    {
        if ($this->request->withoutPagination) {
            return $this->getBuilder()->get();
        }

        return $this->withCount() ?
            $this->getBuilder()->paginate($this->getPerPageCount(), ['*'], 'page', $this->getCurrentPage()) :
            $this->getBuilder()->simplePaginate($this->getPerPageCount(), ['*'], 'page', $this->getCurrentPage());
    }

    public function init(AbstractFilter $filter): void
    {
        $this->filter = $filter;
        $this->request = $filter->request;

        $this->setBuilder();
    }

    protected function getCurrentPage()
    {
        return null;
    }

    protected function withCount()
    {
        return $this->request->withoutCount;
    }
}
