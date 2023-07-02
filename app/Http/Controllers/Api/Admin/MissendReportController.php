<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Requests\Admin\MissendReportRequest\MissendReportRequest;
use App\Http\Requests\Admin\MissendReportRequest\UpdateMissendReportRequest;
use App\Models\MissendReport;
use App\Services\Admin\MissendReportService;

class MissendReportController extends Controller
{
    use ResponseTrait;

    protected $missendReportService;

    /**
     * constructor function
     *
     * @param MissendReportService $missendReportService
     */
    public function __construct(MissendReportService $missendReportService)
    {
        $this->missendReportService = $missendReportService;
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
         * calls the get method on the $this->missendReportService object to retrieve a list of missed_reports
         */
        $missendReport = $this->missendReportService->get(
            $request->input('_limit', config('define.paginate.default'))
        );
        return $this->responseSuccess(
            __('string.response.get.success', ['name' => MissendReport::NAME]),
            $missendReport,
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
     * @param MissendReportRequest $request
     * @return mixed
     */
    public function store(MissendReportRequest $request)
    {
        //method call to the $this->missendReportService object to add a new MissendReport
        //to the system based on the validated data from the request sent by the client.
        $missendReport = $this->missendReportService->store($request->validated());

        return $this->responseSuccess(
            __('string.response.store.success', ['name' => MissendReport::NAME]),
            $missendReport,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return mixed
     */
    public function show(int $id)
    {
        $missendReport = $this->missendReportService
            ->show($id);

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => MissendReport::NAME]),
            $missendReport,
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
     * @param MissendReportRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(MissendReportRequest $request, int $id)
    {
        try {
            //method call to the $this->missendReportService object to update an MissendReport
            //with the specified $id using the validated data from the $request.
            $missendReport = $this->missendReportService
                ->update($request->validated(), $id);

            return $this->responseSuccess(
                __('string.response.update.success', ['name' => MissendReport::NAME]),
                $missendReport
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => MissendReport::NAME])
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
            MissendReport::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => MissendReport::NAME])
            );
        } catch (\Exception) {
            return $this->responseError(
                __('string.response.delete.fail', ['name' => MissendReport::NAME])
            );
        }
    }
}
