<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Traits\ResultPaginateTrait;
use Illuminate\Http\Request;

class CategoryService
{
    use ResultPaginateTrait;
    protected $model;

    /**
     * Constructor function for the GarbageTypeService class.
     *
     * @param $model GarbageType model instance to be used by the service.
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Get all category records
     *
     * @param array $columns
     *
     * @return array
     */
    public function get($limit)
    {
        $containerGarbage = $this->model
            ->orderby('id', 'desc')
            ->paginate($limit)
            ->toArray();

        return $this->resultCustomizePaginate($containerGarbage);
    }

    /**
     * Add a new category to the model.
     *
     * @param array $data The data to create a new category.
     * @return mixed mixed Paginated 'category' data
     * ordered by 'id' in descending order
     */
    public function store(array $data)
    {
        $this->model->create($data);

        return $this->get(config('define.paginate.default'));
    }

    /**
     *  Update a category record in the database with the given data and ID.
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($data, $id)
    {
        $category = $this->model->find($id);
        if ($category) {
            // Prevent from going into observer
            $category->withoutEvents(function () use ($category, $data) {
                $category->update($data);
            });

            return $this->get(config('define.paginate.default'));
        }
        return null;
    }

    /**
     *  Update a category icon record in the database with the given data and ID.
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function updateIcon($data, $id)
    {
        $category = $this->model->find($id);

        if ($category) {
            if (!array_key_exists('icon', $data)) {
                deleteImage(Category::ICON_DIRECTORY . '/' . $category->icon);
                $category->update(
                    ['icon' => null]
                );
            } else {
                // If icon = true, Update image in observe
                $category->update(
                    $data
                );
            }
            return $this->get(config('define.paginate.default'));
        }
        return null;
    }
}
