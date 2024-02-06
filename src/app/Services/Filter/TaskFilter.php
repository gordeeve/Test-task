<?php

namespace App\Services\Filter;


class TaskFilter extends AbstractFilter
{
    public function title(string $value)
    {
        $this->builder->where('title', 'LIKE', '%' . $value . '%');
    }

    public function id(string $value)
    {
        $this->builder->where('id', $value);
    }

    public function description(string $value)
    {
        $this->builder->where('description', 'LIKE', '%' . $value . '%');
    }

    public function sortBy(string $value)
    {
        $this->builder->orderBy($value);
    }

    public function andSortBy(string $value)
    {
        $this->builder->orderBy($value);
    }
}
