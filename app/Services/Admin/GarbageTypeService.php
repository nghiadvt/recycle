<?php

namespace App\Services\Admin;

use App\Models\ContainerGarbageType;
use App\Models\GarbageType;
use Illuminate\Support\Facades\DB;

class GarbageTypeService
{
    protected $model;

    /**
     * Constructor function for the GarbageTypeService class.
     *
     * @param Model GarbageType model instance to be used by the service.
     */
    public function __construct(GarbageType $model)
    {
        $this->model = $model;
    }

    /**
     * Get all garbageType records
     *
     * @param array $columns
     *
     * @return array
     */
    public function getGarbageTypes($columns = [])
    {
        $defaultColumns = GarbageType::COLUMNS;
        $selectedColumns = array_intersect($columns, $defaultColumns);

        return $this->model
            ->with('containerGarbageTypes:id,bin_size,garbage_type_id,image')
            ->select($selectedColumns ?: $defaultColumns)
            ->get();
    }

    public function getGarbageTypeActives($columns = [])
    {
        $defaultColumns = GarbageType::COLUMNS;
        $selectedColumns = array_intersect($columns, $defaultColumns);

        return $this->model
            ->with('containerGarbageTypes:id,bin_size,garbage_type_id,image')
            ->select($selectedColumns ?: $defaultColumns)
            ->active()
            ->get();
    }

    /**
     * storeContainerGarbageType function
     *
     * @param array $data
     * @param int $garbage_type_id
     * @return void
     */
    public function storeContainerGarbageType(array $data, $garbage_type_id)
    {
        $containerGarbageTypes = array_values($data['container_garbage_types']);
        foreach ($containerGarbageTypes as $containerGarbageType) {
            $containerGarbage = new ContainerGarbageType();
            $containerGarbage->garbage_type_id = $garbage_type_id;
            $containerGarbage->bin_size = $containerGarbageType['bin_size'];
            $containerGarbage->image = $containerGarbageType['image'];
            $containerGarbage->save();
        }
    }

    /**
     * Use the "create" method of the "GarbageType" model to create a record with $data
     * from 'store' method in GarbageTypeController
     *
     * @param array $data
     * @return mixed
     */
    public function addGarbageType(array $data)
    {
        try {
            DB::beginTransaction();
            $garbage_type = $this->model->create($data);
            $garbage_type_id = $garbage_type->id;
            $this->storeContainerGarbageType($data, $garbage_type_id);
            DB::commit();

            return $this->getGarbageTypes();
        } catch (Exception $e) {
            \Log::error($e);
            DB::rollBack();

            return false;
        }
    }

    /**
     *  Update a garbageTtype record in the database with the given data and ID.
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function updateGarbageType($id, $data)
    {
        $garbageType = $this->model->find($id);
        if ($garbageType) {
            // Prevent from going into observer
            $garbageType->withoutEvents(function () use ($garbageType, $data) {
                $garbageType->update($data);
            });
            return $this->getGarbageTypes();
        }
        return null;
    }

    /**
     *  Update a garbageTtype icon record in the database with the given data and ID.
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function updateIconGarbageType($id, $data)
    {
        $garbageType = $this->model->find($id);

        if ($garbageType) {
            if (!array_key_exists('icon', $data)) {
                deleteImage(GarbageType::ICON_DIRECTORY . '/' . $garbageType->icon);
                $garbageType->update(
                    ['icon' => null]
                );
            } else {
                // If icon = true, Update image in observe
                $garbageType->update(
                    $data
                );
            }
            return $this->getGarbageTypes();
        }
        return null;
    }
}
