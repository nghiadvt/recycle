<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class AreaFilter extends QueryFilter
{
    /**
     * Filter with Zipcode
     *
     * @param int $zipCode
     *
     * @return mixed
     */
    public function filterZipCode(int $zipCode): mixed
    {
        return $this->builder->where('zip_no', 'like', '%' . $zipCode . '%');
    }

    /**
     * Filter with Address name
     *
     * @param string $address
     *
     * @return mixed
     */
    public function filterAddress(string $address): mixed
    {
        return $this->builder->where('address', 'like', '%' . $address . '%');
    }
}
