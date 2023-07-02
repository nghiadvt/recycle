<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ServiceGarbageFilter extends QueryFilter
{
    /**
     * Filter with name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function filterName(string $name): mixed
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }
}
