<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ColumnSelectedTrait;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\Admin\CityService;
use App\Models\City;

class CityController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $cityService;

    /**
     * Constructor
     *
     * @param CityService $cityService - Instance of DistrictService for handling cities
     */
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse - The JSON response object
     */
    public function index()
    {
        //calls the get method on the $this->districtService object to retrieve a list of cities
        $cities = $this->cityService->get();

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => City::NAME]),
            $cities
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
