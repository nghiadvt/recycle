<?php

namespace App\Services\Admin;

use App\Filters\AreaFilter;
use App\Models\Area;
use App\Traits\ResultPaginateTrait;
use Illuminate\Http\Request;

class AreaService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param Area $area The Area object to be assigned to the $model property.
     */
    public function __construct(Area $area)
    {
        $this->model = $area;
    }

    /**
     * Adds a new area to the model.
     *
     * @param array $data The data to create a new area.
     * @return mixed mixed Paginated 'areas' data with tables
     *'cities' and 'prefectures' use table relationship,
     * ordered by 'id' in descending order
     */
    public function addArea($data)
    {
        $this->model->create($data);

        return $this->getAreas(config('define.paginate.default'));
    }

    /**
     * Retrieves a list of areas with related city and prefecture information, paginated by given limit.
     *
     * @param int $limit The number of areas to retrieve per page.
     * @return mixed  mixed Paginated 'areas' data with tables
     *'cities' and 'prefectures' use table relationship,
     * ordered by 'id' in descending order
     */
    public function getAreas(int $limit, Request $request = new Request())
    {
        $areasFilter = new AreaFilter($request);

        $areas = $this->model
            ->with('prefecture:id,pref_no,name,active,order')
            ->with('city:id,pref_no,name,active,order')
            ->orderBy('id', 'desc')
            ->filter($areasFilter)
            ->paginate($limit)
            ->toArray();

        return $this->resultCustomizePaginate($areas);
    }

    /**
     * Get all areas
     *
     * @param array $columns
     *
     * @return object
     */
    public function getAllAreas(array $columns = []): object
    {
        $defaultColumns = $this->model::COLUMNS;

        // Select columns in $columns if they exist in $defaultColumns
        $selectedColumns = array_intersect($columns, $defaultColumns);

        return $this->model
            ->select($selectedColumns ?: $defaultColumns)
            ->active()
            ->orderByAddress()
            ->get();
    }

    /**
     * Updates an area with the given data.
     *
     * @param array $data The data to update the area with.
     * @param int $id The ID of the area to update.
     * @return Area|null The updated area on success, null on failure.
     */
    public function updateArea($data, $id)
    {
        $area = $this->model->find($id);
        if ($area) {
            $area->update($data);
            return $this->getAreas(config('define.paginate.default'));
        }
        return null;
    }

    /**
     * Deletes an area with the given ID.
     *
     *  @param int $id The ID of the area to delete.
     *  @return bool|null True on successful deletion, false on failure, null if area not found.
     */
    public function deleteArea($id)
    {
        if (!$isArea = $this->model->find($id)) {
            return null;
        }
        return $isArea->delete();
    }

    /**
     * Get details of an area by ID with related city and prefecture information
     *
     * @param int $id ID of the area to retrieve details for
     * @return mixed Area data retrieved from the database, including fields: 'areas', 'prefecture','city'
     */
    public function show($id)
    {
        $area = $this->model->find($id);
        if ($area) {
            return $area->toArray();
        }
        return null;
    }
}
