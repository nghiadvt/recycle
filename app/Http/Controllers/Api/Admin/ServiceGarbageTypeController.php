<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Traits\ColumnSelectedTrait;
use App\Services\Admin\ServiceGarbageTypeService;
use App\Models\ServiceGarbageType;

class ServiceGarbageTypeController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $serviceGarbageTypeService;

    public function __construct(ServiceGarbageTypeService $serviceGarbageTypeService)
    {
        $this->serviceGarbageTypeService = $serviceGarbageTypeService;
    }

    /**
     * Method index
     *
     * @param Request $request
     *
     * @return object
     */
    public function index(Request $request): object
    {
        $columns = $this->columnSelected($request);

        // Call method getServiceGarbageTypes to get all serviceGarbageTypes
        $serviceGarbageTypes = $this->serviceGarbageTypeService->getServiceGarbageTypes($columns);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ServiceGarbageType::NAME]),
            $serviceGarbageTypes
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
