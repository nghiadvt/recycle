<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContainerGarbageRequest\ImageContainerGarbageRequest;
use Illuminate\Http\Request;
use App\Models\ContainerGarbageType;
use App\Traits\ResponseTrait;
use App\Services\Admin\ContainerGarbageService;
use App\Http\Requests\Admin\ContainerGarbageRequest\StoreRequest;
use App\Http\Requests\Admin\ContainerGarbageRequest\UpdateRequest;
use App\Http\Requests\Admin\ImageRequest\ImageRequest;

class ContainerGarbageTypeController extends Controller
{
    use ResponseTrait;

    protected $containerGarbageService;

    /**
     * constructor function
     *
     * @param ContainerGarbageService $containerGarbageService
     */
    public function __construct(ContainerGarbageService $containerGarbageService)
    {
        $this->containerGarbageService = $containerGarbageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $containerGarbage = $this->containerGarbageService->get(
            $request->input('_limit', config('define.paginate.default'))
        );

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ContainerGarbageType::NAME]),
            $containerGarbage,
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
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        try {
            //method call to the $this->containerGarbageService object to add a new Service
            //to the system based on the validated data from the request sent by the client.
            $containerGarbageType = $this->containerGarbageService
                ->store($request->validated());

            return $this->responseSuccess(
                __('string.response.store.success', ['name' => ContainerGarbageType::NAME]),
                $containerGarbageType,
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.store.fail', ['name' => ContainerGarbageType::NAME])
            );
        }
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
     * @param StoreRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(UpdateRequest $request, int $id)
    {
        try {
            //method call to the $this->containerGarbageService object to update an ContainerGarbageType
            //with the specified $id using the validated data from the $request.
            $containerGarbageType = $this->containerGarbageService
                ->update($request->validated(), $id);

            return $this->responseSuccess(
                __('string.response.update.success', ['name' => ContainerGarbageType::NAME]),
                $containerGarbageType
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => ContainerGarbageType::NAME])
            );
        }
    }

    /**
     * method destroy
     *
     * @param string $id
     * @return object
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ContainerGarbageType::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => ContainerGarbageType::NAME])
            );
        } catch (\Exception) {
            return $this->responseError(
                __('string.response.delete.fail', ['name' => ContainerGarbageType::NAME])
            );
        }
    }

    /**
     * update_container function
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return mixed
     */
    public function update_container(UpdateRequest $request, $id)
    {
        // Update container garbage types of service record with the validated request data and the given ID.
        $containerGarbage = $this->containerGarbageService->updateContainerService($request->validated(), $id);
        if ($containerGarbage) {
            return $this->responseSuccess(
                __('string.response.update.success', ['name' => ContainerGarbageType::NAME]),
                $containerGarbage
            );
        }
        return $this->responseError(
            __('string.response.update.fail', ['name' => ContainerGarbageType::NAME]),
        );
    }
}
