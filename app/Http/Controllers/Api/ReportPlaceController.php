<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReportPlaceRequest\ReportPlaceRequest;
use App\Services\ReportPlaceService;
use App\Traits\ResponseTrait;

class ReportPlaceController extends Controller
{
    use ResponseTrait;

    protected $reportPlaceService;

    /**
     * Constructor function for the ReportPlaceController class.
     *
     * @param ReportPlaceService $reportPlaceService
     */
    public function __construct(ReportPlaceService $reportPlaceService)
    {
        $this->reportPlaceService = $reportPlaceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Add report in report__places table
     *
     * @param ReportPlaceRequest $request
     *
     * @return object
     */
    public function store(ReportPlaceRequest $request): object
    {
        // Call method storeReportPlace from reportPlaceService for add a new report
        $this->reportPlaceService->storeReportPlace($request->validated());

        return $this->responseSuccess(
            __('string.response.mail.reportPlace.success')
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
