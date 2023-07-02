<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest\StoreServiceRequest;
use App\Models\Service;
use App\Services\Admin\ServiceService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ImageRequest\ImageRequest;

class ServiceController extends Controller
{
    use ResponseTrait;

    protected $serviceService;

    /**
     * Summary of __construct
     * @param ServiceService $serviceService
     */
    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $service = $this->serviceService->get(
            $request->input('_limit', config('define.paginate.default'))
        );

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => Service::NAME]),
            $service,
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
     */
    public function store(StoreServiceRequest $request)
    {
        try {
            //method call to the $this->serviceService object to add a new Service
            //to the system based on the validated data from the request sent by the client.
            $service = $this->serviceService
                ->store($request->validated());

            return $this->responseSuccess(
                __('string.response.store.success', ['name' => Service::NAME]),
                $service,
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.store.fail', ['name' => Service::NAME])
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
     */
    public function update(StoreServiceRequest $request, string $id)
    {
        try {
            //method call to the $this->Service object to update an Service with
            //the specified $id using the validated data from the $request.
            $service = $this->serviceService
                ->update($request->validated(), $id);

            return $this->responseSuccess(
                __('string.response.update.success', ['name' => Service::NAME]),
                $service
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => Service::NAME])
            );
        }
    }

    /**
     * Update a image in storage.
     *
     * @param ImageRequest $request [The validated request instance]
     * @param $id $id
     *
     * @return object
     */
    public function updateImage(ImageRequest $request, $id)
    {
        // Update image of service record with the validated request data and the given ID.
        $service = $this->serviceService->updateImageService($id, $request->all());
        if ($service) {
            return $this->responseSuccess(
                __('string.response.update.success', ['name' => Service::NAME]),
                $service
            );
        }
        return $this->responseError(
            __('string.response.update.fail', ['name' => Service::NAME]),
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            // Find garbage type item and detele
            Service::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => Service::NAME])
            );
        } catch (\Exception $e) {
            \Log::error($e);

            return $this->responseError(
                __('string.response.delete.fail', ['name' => Service::NAME])
            );
        }
    }
}
