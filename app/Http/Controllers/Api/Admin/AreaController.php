<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AreaRequest\StoreAreaRequest;
use App\Traits\ResponseTrait;
use App\Services\Admin\AreaService;
use App\Models\Area;
use App\Traits\ColumnSelectedTrait;

class AreaController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $areaService;

    /**
     * Constructor
     *
     * @param AreaService $areaService - Instance of AreaService for handling geographical areas
     */
    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request - The HTTP request object
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function index(Request $request)
    {
        /**
         * calls the getAreas method on the $this->areaService object to retrieve a list of areas
         * the _limit value from provided (config('define.paginate.default')).
         */
        $areas = $this->areaService->getAreas(
            $request->input('_limit', config('define.paginate.default')),
            $request
        );

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => AREA::NAME]),
            $areas,
        );
    }

    /**
     * Method get all areas
     *
     * @param Request $request
     *
     * @return object
     */
    public function getAllAreas(Request $request): object
    {
        $columns = $this->columnSelected($request);
        $areas = $this->areaService->getAllAreas($columns);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => AREA::NAME]),
            $areas,
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
     * Store a newly created area resource in storage.
     *
     * @param StoreAreaRequest - The validated StoreAreaRequest instance
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function store(StoreAreaRequest $request)
    {
        //method call to the $this->areaService object to add a new area to the system
        //based on the validated data from the request sent by the client.
        $areas = $this->areaService->addArea($request->validated());

        return $this->responseSuccess(
            __('string.response.store.success', ['name' => Area::NAME]),
            $areas,
        );
    }

    /**
     * Display the specified area resource.
     *
     * @param int $id - The ID of the area to display
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function show($id)
    {
        //method call to the $this->areaService object to retrieve information about an area with the specified $id.
        $area = $this->areaService->show($id);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => AREA::NAME]),
            $area
        );
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
     * @param StoreAreaRequest $request - The request object with validated data
     * @param int $id - The ID of the area to update
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function update(StoreAreaRequest $request, int $id)
    {
        //method call to the $this->areaService object to update an area with the specified $id
        //using the validated data from the $request.
        $areas = $this->areaService->updateArea($request->validated(), $id);

        return $this->responseSuccess(
            __('string.response.store.success', ['name' => AREA::NAME]),
            $areas
        );
    }

    /**
     * Remove the specified area resource from storage.
     *
     * @param int $id - The ID of the area to delete
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function destroy($id)
    {
        //deletion operation for an area with the specified $id.
        try {
            Area::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => Area::NAME])
            );
        } catch (\Exception) {
            return $this->responseError(
                __('string.response.delete.fail', ['name' => Area::NAME])
            );
        }
    }
}
