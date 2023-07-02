<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ScheduleFilter extends QueryFilter
{
    /**
     * Filter with date start at
     *
     * @param string $dateStartAt
     *
     * @return mixed
     */
    public function filterDateStartAt(string $dateStartAt): mixed
    {
        return $this->builder->where('date_start_at', 'like', '%' . $dateStartAt . '%');
    }

    /**
     * Filter with address
     *
     * @param string $address
     *
     * @return mixed
     */
    public function filterAddress(string $address): mixed
    {
        return $this->builder->whereHas('area', function ($query) use ($address) {
            $query->where('address', 'like', '%' . $address . '%');
        });
    }
}
