<?php

namespace App\Services\Admin;

use App\Models\ServiceCategory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ServiceCategoryService
{
    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param ServiceCategory $serviceCategory The ServiceCategory object to be assigned to the $model property.
     */
    public function __construct(ServiceCategory $serviceCategory)
    {
        $this->model = $serviceCategory;
    }

    /**
     * processData
     *
     * @param array $data
     * @return array
     */
    protected function processData($data)
    {
        $categoryBuilder = $this->model->where('title', $data['title'])->orderBy('id', 'desc');
        $prefixId = '';
        if ($categoryBuilder->exists()) {
            $lastedCategoryByTitle = $categoryBuilder->first();
            $prefixId = "-" . $lastedCategoryByTitle->id;
        }
        $data['slug'] = Str::slug($data['title']) . $prefixId;

        return $data;
    }

    /**
     * store function
     *
     * @param array $data Data for create the service category
     * @return mixed The create service category object
     */
    public function store($data)
    {
        return $this->model->create($this->processData($data));
    }

    /**
     * Update a service category
     *
     * @param array $data Data for updating the service category
     * @param int $id ID of the service category to be updated
     * @return mixed The updated service category object
     */
    public function update($data, $id)
    {
        $serviceCategory = $this->model->find($id);
        if ($serviceCategory->update($this->processData($data))) {
            return $serviceCategory;
        }
        return null;
    }

    /**
     * Get paginated data with a limit
     *
     * @param int $limit The limit of data to be retrieved
     * @return mixed Paginated data retrieved from the database, ordered by 'id' in descending order
     */
    public function get($limit)
    {
        return $this->model
            ->orderBy('id', 'DESC')
            ->paginate($limit);
    }

    /**
     * Delete a service category by ID
     *
     * @param int $id ID of the service category to be deleted
     * @return mixed|null The deleted service category object or null if not found
     */
    public function delete($id)
    {

        if (!$isCategory = $this->model->find($id)) {
            return null;
        }
        return $isCategory->delete();
    }
}
