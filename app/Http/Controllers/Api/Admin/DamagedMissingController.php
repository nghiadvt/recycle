<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DamagedMissingRequest\StoreRequest;
use App\Traits\ResponseTrait;
use App\Services\Admin\DamagedMissingService;
use App\Models\DamagedMissingReport;

class DamagedMissingController extends Controller
{
    use ResponseTrait;

    protected $damagedMissingService;

    /**
     * constructor function
     *
     * @param DamagedMissingService $damagedMissingService
     */
    public function __construct(DamagedMissingService $damagedMissingService)
    {
        $this->damagedMissingService = $damagedMissingService;
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
        //method call to the $this->damagedMissingService object to add a new DamagedMissing
        //to the system based on the validated data from the request sent by the client.
        $damagedMissing = $this->damagedMissingService->store($request->validated());

        return $this->responseSuccess(
            __('string.response.store.success', ['name' => DamagedMissingReport::NAME]),
            $damagedMissing,
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
     * @param StoreRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(StoreRequest $request, int $id)
    {
        try {
            //method call to the $this->missendReportService object to update an MissendReport
            //with the specified $id using the validated data from the $request.
            $damagedMissing = $this->damagedMissingService
                ->update($request->validated(), $id);

            return $this->responseSuccess(
                __('string.response.update.success', ['name' => DamagedMissingReport::NAME]),
                $damagedMissing
            );
        } catch (\Throwable $th) {
            return $this->responseError(
                __('string.response.update.fail', ['name' => DamagedMissingReport::NAME])
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
            DamagedMissingReport::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => DamagedMissingReport::NAME])
            );
        } catch (\Exception) {
            return $this->responseError(
                __('string.response.delete.fail', ['name' => DamagedMissingReport::NAME])
            );
        }
    }
}
