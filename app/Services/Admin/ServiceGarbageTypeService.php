<?php

namespace App\Services\Admin;

use App\Models\ServiceGarbageType;

class ServiceGarbageTypeService
{
    protected $model;

    /**
     * Constructor function for the ServiceGarbageType class.
     *
     * @param ServiceGarbageType $model
     */
    public function __construct(ServiceGarbageType $model)
    {
        $this->model = $model;
    }

    /**
     * Get all serviceGarbageType records
     *
     * @param array $columns
     *
     * @return object
     */
    public function getServiceGarbageTypes(array $columns = []): object
    {
        $defaultColumns = ServiceGarbageType::COLUMNS;
        $selectedColumns = array_intersect($columns, $defaultColumns);

        return $this->model
            ->select($selectedColumns ?: $defaultColumns)
            ->get();
    }
}
