<?php

namespace App\Services\Admin;

use App\Models\ServiceGarbage;
use App\Models\ServiceGarbageContent;
use App\Traits\ResultPaginateTrait;
use Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Filters\ServiceGarbageFilter;

class ServiceGarbageService
{
    use ResultPaginateTrait;

    protected $model;

    /**
     * Constructor function for the serviceGarbage class.
     *
     * @param ServiceGarbage $model
     */
    public function __construct(ServiceGarbage $model)
    {
        $this->model = $model;
    }

    /**
     * Add a record in ServiceGarbageContent
     *
     * @param array $data
     * @param int $serviceGarbageID
     *
     * @return void
     */
    private function storeServiceGarbageContent(array $data, int $serviceGarbageID): void
    {
        $serviceGarbageContents = [];
        if (array_key_exists('service_garbage_content', $data)) {
            $serviceGarbageContents = array_values($data['service_garbage_content']);
        }
        if (array_key_exists('service_garbage_type', $data)) {
            $serviceGarbageTypes = array_values($data['service_garbage_type']);

            for ($i = 0; $i < count($serviceGarbageTypes); $i++) {
                $content = isset($serviceGarbageContents[$i]) ? $serviceGarbageContents[$i] : "";
                ServiceGarbageContent::create(
                    [
                        'service_garbage_type_id' => $serviceGarbageTypes[$i],
                        'service_garbage_id' => $serviceGarbageID,
                        'content' => $content
                    ]
                );
            }
        }
    }

    /**
     * Get all service garbages for add a service garbage actions
     *
     * @param array $columns
     *
     * @return object
     */
    public function getServiceGarbageParents(array $columns = []): object
    {
        $serviceGarbages = $this->model
            ->select($columns ?: ['id', 'name'])
            ->get();

        return $serviceGarbages;
    }

    /**
     * Use the "paginate" method of the "ServiceGarbage" model to get all the record has limit item
     *
     * @param integer $limit from "index" method in ServiceGarbageController
     * @param array $columns from "index" method in ServiceGarbageController
     * @param Request $request
     * @return array
     */
    public function getServiceGarbages(int $limit, array $columns = [], Request $request = new Request()): array
    {
        $serviceGarbages = $this->model
            ->leftJoin('service_garbages as parent', 'parent.id', '=', 'service_garbages.parent_id')
            ->select('service_garbages.*', 'parent.name as parent_name')
            ->WithServiceType()
            ->paginate($limit)
            ->toArray();

        return $this->resultCustomizePaginate($serviceGarbages);
    }

    /**
     * Use the "create" method of the "ServiceGarbage" model to create a record with $data
     * from 'store' method in ServiceGarbageController
     *
     * @param array $data
     * @return array|bool
     */
    public function addServiceGarbage(array $data): array|bool
    {
        try {
            DB::beginTransaction();
            $serviceGarbage = $this->model->create($data);
            $serviceGarbageID = $serviceGarbage->id;
            $this->storeServiceGarbageContent($data, $serviceGarbageID);
            DB::commit();

            return $this->getServiceGarbages(config('define.paginate.default'));
        } catch (Exception $e) {
            \Log::error($e);
            DB::rollBack();

            return false;
        }
    }

    /**
     * Update a serviceGarbage record in the database with the given data and ID.
     *
     * @param array $data from "update" method in ServiceGarbageController
     * @param int $id from "update" method in ServiceGarbageController
     * @return array|bool
     */
    public function updateServiceGarbage(array $data, int $id): array|bool
    {
        try {
            DB::beginTransaction();
            $serviceGarbage =  $this->model->find($id);
            if ($serviceGarbage) {
                $serviceGarbage->update($data);
                ServiceGarbageContent::where('service_garbage_id', $serviceGarbage->id)->delete();
                $this->storeServiceGarbageContent($data, $serviceGarbage->id);
                DB::commit();

                return $this->getServiceGarbages(config('define.paginate.default'));
            }
            return false;
        } catch (Exception $e) {
            \Log::error($e);
            DB::rollBack();

            return false;
        }
    }
}
