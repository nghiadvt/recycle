<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportApp;
use App\Traits\ResponseTrait;
use App\Services\Admin\ReportAppService;
use App\Http\Requests\Admin\ReportAppRequest\StoreRequest;

class ReportAppController extends Controller
{
    use ResponseTrait;

    protected $reportAppService;

    /**
     * constructor function
     *
     * @param ReportAppService $reportAppService
     */
    public function __construct(ReportAppService $reportAppService)
    {
        $this->reportAppService = $reportAppService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        /**
         * calls the getAreas method on the $this->missendReportService object to retrieve a list of report_app
         */
        $reportApp = $this->reportAppService->get(
            $request->input('_limit', config('define.paginate.default'))
        );
        return $this->responseSuccess(
            __('string.response.get.success', ['name' => ReportApp::NAME]),
            $reportApp,
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
        //method call to the $this->reportAppService object to add a new ReportApp
        //to the system based on the validated data from the request sent by the client.
        $reportApp = $this->reportAppService->store($request->validated());

        return $this->responseSuccess(
            __('string.response.store.success', ['name' => ReportApp::NAME]),
            $reportApp,
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
