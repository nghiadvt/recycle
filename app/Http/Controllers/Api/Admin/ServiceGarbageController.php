<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ServiceGarbageRequest\ServiceGarbageRequest;
use App\Traits\ResponseTrait;
use App\Traits\ColumnSelectedTrait;
use App\Services\Admin\ServiceGarbageService;
use App\Models\ServiceGarbage;

class ServiceGarbageController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $serviceGarbageService;

    public function __construct(ServiceGarbageService $serviceGarbageService)
    {
        $this->serviceGarbageService = $serviceGarbageService;
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

        /** Call method getServiceGarbages from serviceGarbageService to get list serviceGarbage
         * with pagination on the requested limit or the default limit.
         */
        $serviceGarbages = $this->serviceGarbageService->getServiceGarbages(
            $request->input('_limit', config('define.paginate.default')),
            $columns,
            $request
        );

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ServiceGarbage::NAME]),
            $serviceGarbages
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
     * Get list serviceGarbage for add a new record
     *
     * @param Request $request [explicite description]
     *
     * @return object
     */
    public function getServiceGarbageParents(Request $request): object
    {
        $columns = $this->columnSelected($request);

        // Call method getServiceGarbageParents to add a serviceGarbage with validated data.
        $serviceGarbageParents = $this->serviceGarbageService
            ->getServiceGarbageParents($columns, $request);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ServiceGarbage::NAME]),
            $serviceGarbageParents
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServiceGarbageRequest $request [The validated request instance]
     *
     * @return object
     */
    public function store(ServiceGarbageRequest $request): object
    {
        // Call method addServiceGarbage to add a garbage with validated data.
        $serviceGarbages = $this->serviceGarbageService->addServiceGarbage($request->validated());

        if ($serviceGarbages) {
            return $this->responseSuccess(
                __('string.response.store.success', ['name' => ServiceGarbage::NAME]),
                $serviceGarbages
            );
        }
        return $this->responseError(
            __('string.response.store.fail', ['name' => ServiceGarbage::NAME]),
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
     * @param GarbageRequest $request
     * @param int $id
     *
     * @return object
     */
    public function update(ServiceGarbageRequest $request, int $id): object
    {
        // Update a serviceGarbage record with the validated request data and the given ID.
        $serviceGarbages = $this->serviceGarbageService->updateServiceGarbage($request->validated(), $id);

        if ($serviceGarbages) {
            return $this->responseSuccess(
                __('string.response.update.success', ['name' => ServiceGarbage::NAME]),
                $serviceGarbages
            );
        }

        return $this->responseError(
            __('string.response.update.fail', ['name' => ServiceGarbage::NAME]),
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
            // Find a garbage to detele with id
            ServiceGarbage::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => ServiceGarbage::NAME])
            );
        } catch (\Exception $e) {
            \Log::error($e);

            return $this->responseError(
                __('string.response.delete.fail', ['name' => ServiceGarbage::NAME])
            );
        }
    }
}
