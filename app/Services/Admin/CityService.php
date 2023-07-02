<?php

namespace App\Services\Admin;

use App\Models\City;

class CityService
{
    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param City $city The city object to be assigned to the $model property.
     */
    public function __construct(City $city)
    {
        $this->model = $city;
    }

    /**
     *  Retrieves all cities with only their ID and name fields.
     *
     * @return \Illuminate\Database\Eloquent\Collection|null Collection of cities with
     * ID and name fields, or null if none found.
     */
    public function get()
    {
        $cities = $this->model
            ->orderBy('id', 'desc')
            ->get();

        return $cities;
    }
}
