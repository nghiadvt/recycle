<?php

namespace App\Services\Admin;

use App\Models\GarbageType;
use App\Models\ContainerGarbageType;
use Illuminate\Support\Str;
use App\Traits\ResultPaginateTrait;
use Illuminate\Support\Facades\DB;

class ContainerGarbageService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor for initializing the model object.
     *
     * @param ContainerGarbageType $containerGarbageType The ContainerGarbageType object to be assigned to
     * the $model property.
     */
    public function __construct(ContainerGarbageType $containerGarbageType)
    {
        $this->model = $containerGarbageType;
    }

    /**
     * store function
     *
     * @param array $data Data for create the service
     * @return mixed The create service object
     */
    public function store(array $data)
    {
        foreach ($data as $userGarbageType) {
            $userGarbage = new $this->model();
            $userGarbage->garbage_type_id = $userGarbageType['garbage_type_id'];
            $userGarbage->bin_size = $userGarbageType['bin_size'];
            $userGarbage->type = $userGarbageType['type'];
            $userGarbage->save();
        }
        return $this->get(config('define.paginate.default'));
    }

    /**
     * get function
     *
     * @param string $limit
     * @return array
     */
    public function get($limit)
    {
        $containerGarbage = $this->model
            ->with('garbageType:id,name,icon,price')
            ->orderBy('id', 'desc')
            ->paginate($limit)
            ->toArray();

        return $this->resultCustomizePaginate($containerGarbage);
    }

    /**
     *  Update a ContainerGarbageType record in the database with the given data and ID.
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($data, $id)
    {
        $containerGarbageType = $this->model->find($id);
        if ($containerGarbageType) {
            // Prevent from going into observer
            if (!array_key_exists('image', $data)) {
                $data['image'] = $containerGarbageType->image;
            }
            $containerGarbageType->withoutEvents(function () use ($containerGarbageType, $data) {
                $containerGarbageType->update($data);
            });

            return $this->get(config('define.paginate.default'));
        }
        return null;
    }

    /**
     *  Update a service image record in the database with the given data and ID.
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     */
    public function updateContainerService($data, $id)
    {
        try {
            DB::beginTransaction();
            $ids = [];
            $ids = DB::table('container_garbage_types')
                ->where('garbage_type_id', '<>', $id)
                ->pluck('id')
                ->toArray();
            foreach ($data as $containerGarbageType) {
                if (array_key_exists('container_id', $containerGarbageType)) {
                    $containerGarbage = $this->model->find($containerGarbageType['container_id']);
                    $ids[] = (int)$containerGarbageType['container_id'];
                }
            }
            $this->model->whereNotIn('id', $ids)->delete();
            foreach ($data as $containerGarbageType) {
                $containerGarbage = new $this->model();
                if (array_key_exists('container_id', $containerGarbageType)) {
                    $containerGarbage = $this->model->find($containerGarbageType['container_id']);
                }
                $containerGarbage->garbage_type_id = $id;
                $containerGarbage->bin_size = $containerGarbageType['bin_size'];
                if (array_key_exists('image', $containerGarbageType)) {
                    $containerGarbage->image = $containerGarbageType['image'];
                }
                $containerGarbage->save();
            }
            DB::commit();

            return $this->get(config('define.paginate.default'));
        } catch (\Exception $e) {
            \Log::error($e);
            DB::rollBack();

            return false;
        }
    }
}
