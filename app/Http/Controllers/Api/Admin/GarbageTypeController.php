<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GarbageTypeRequest\GarbageTypeRequest;
use App\Http\Requests\Admin\GarbageTypeRequest\UpdateRequest;
use App\Http\Requests\Admin\ImageRequest\IconRequest;
use App\Services\Admin\GarbageTypeService;
use App\Traits\ResponseTrait;
use App\Traits\ColumnSelectedTrait;
use App\Models\GarbageType;

class GarbageTypeController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $garbageTypeService;

    public function __construct(GarbageTypeService $garbageTypeService)
    {
        $this->garbageTypeService = $garbageTypeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return object
     */
    public function index(Request $request): object
    {
        $columns = $this->columnSelected($request);

        // Call method getGarbageTypes from garbageTypeService to get list garbageType.
        $garbageTypes = $this->garbageTypeService->getGarbageTypes($columns);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => GarbageType::NAME]),
            $garbageTypes
        );
    }

    public function getGarbageTypeActive(Request $request)
    {
        $columns = $this->columnSelected($request);

        // Call method getGarbageTypeActives from garbageTypeService to get list garbageTypeActive.
        $garbageTypeActives = $this->garbageTypeService->getGarbageTypeActives($columns);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => GarbageType::NAME]),
            $garbageTypeActives
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GarbageTypeRequest $request [The validated request instance]
     *
     * @return object
     */
    public function store(GarbageTypeRequest $request): object
    {
        // Call method addGarbageType to add a garbageType with validated data.
        $garbageTypes = $this->garbageTypeService->addGarbageType($request->validated());

        if ($garbageTypes) {
            return $this->responseSuccess(
                __('string.response.store.success', ['name' => GarbageType::NAME]),
                $garbageTypes
            );
        }
        return $this->responseError(
            __('string.response.store.fail', ['name' => GarbageType::NAME]),
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GarbageTypeRequest $request [The validated request instance]
     * @param int $id
     *
     * @return object
     */
    public function update(UpdateRequest $request, int $id): object
    {
        // Update a garbageType record with the validated request data and the given ID.
        $garbageTypes = $this->garbageTypeService->updateGarbageType($id, $request->validated());

        if ($garbageTypes) {
            return $this->responseSuccess(
                __('string.response.update.success', ['name' => GarbageType::NAME]),
                $garbageTypes
            );
        }

        return $this->responseError(
            __('string.response.update.fail', ['name' => GarbageType::NAME]),
        );
    }

    /**
     * Update a icon in storage.
     *
     * @param IconRequest $request [The validated request instance]
     * @param $id $id
     *
     * @return object
     */
    public function updateIcon(IconRequest $request, $id): object
    {
        // Update icon of garbageType record with the validated request data and the given ID.
        $garbageTypes = $this->garbageTypeService->updateIconGarbageType($id, $request->all());

        if ($garbageTypes) {
            return $this->responseSuccess(
                __('string.response.update.success', ['name' => GarbageType::NAME]),
                $garbageTypes
            );
        }

        return $this->responseError(
            __('string.response.update.fail', ['name' => GarbageType::NAME]),
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return object
     */
    public function destroy(int $id): object
    {
        try {
            // Find garbage type item and detele
            GarbageType::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => GarbageType::NAME])
            );
        } catch (\Exception $e) {
            \Log::error($e);

            return $this->responseError(
                __('string.response.delete.fail', ['name' => GarbageType::NAME])
            );
        }
    }
}
