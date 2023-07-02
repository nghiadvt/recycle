<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ReportRequest\StoreRequest;
use App\Models\Report;
use App\Services\Admin\ReportService;
use App\Traits\ResponseTrait;

class ReportController extends Controller
{
    use ResponseTrait;

    protected $reportService;

    /**
     * Summary of __construct
     * @param reportService $reportService
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
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
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        //method call to the $this->reportService object to add a new report
        //to the system based on the validated data from the request sent by the client.
        $report = $this->reportService->stores($request->validated());
        return $this->responseSuccess(
            __('string.response.store.success', ['name' => Report::NAME]),
            $report,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
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
