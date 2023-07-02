<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InformationService;
use App\Traits\ResponseTrait;
use App\Models\ServiceGarbage;
use App\Models\GarbageType;

class InformationController extends Controller
{
    use ResponseTrait;

    protected $informationService;

    public function __construct(InformationService $informationService)
    {
        return $this->informationService = $informationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): object
    {
        // Call method getCategoryServiceGarbages from informationService for get all ServiceGarbages
        $serviceGarbages = $this->informationService->getCategoryServiceGarbages();

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ServiceGarbage::NAME]),
            $serviceGarbages
        );
    }

    /**
     * Method getGarbageTypes
     *
     * @return object
     */
    public function getGarbageTypes(): object
    {
        // Call method getGarbagetypes from informationService for get all garbageTypes
        $garbageTypes = $this->informationService->getGarbagetypes();

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => GarbageType::NAME]),
            $garbageTypes
        );
    }

    /**
     * Method getServiceGarbage get all serviceGarbages sorted by name
     *
     * @return object
     */
    public function getServiceGarbage(): object
    {
        // Call method getServiceGarbages from informationService for get all serviceGarbages
        $serviceGarbageTypes = $this->informationService->getServiceGarbages();

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ServiceGarbage::NAME]),
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
     * @return object
     */
    public function show(int $id): object
    {
        // Call method getServiceGarbage from informationService for get a item ServiceGarbage with id
        $serviceGarbage = $this->informationService->getServiceGarbage($id);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ServiceGarbage::NAME]),
            $serviceGarbage
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
