<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ScheduleRequest\ScheduleRequest;
use App\Services\Admin\ScheduleService;
use App\Traits\ResponseTrait;
use App\Traits\ColumnSelectedTrait;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    use ResponseTrait;
    use ColumnSelectedTrait;

    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request [request instance]
     *
     * @return object
     */
    public function index(Request $request)
    {
        $columns = $this->columnSelected($request);

        // Call method getSchedules from scheduleService to get list schedule.
        $schedules = $this->scheduleService
            ->getSchedules(
                $request->input('_limit', config('define.paginate.default')),
                $columns,
                $request
            );

        return $this->responseSuccess(
            __('string.response.get.success', ['name' => Schedule::NAME]),
            $schedules
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
     * @param GarbageTypeRequest $request [The validated request instance]
     *
     * @return object
     */
    public function store(ScheduleRequest $request)
    {
        // Call method addGarbageType to add a garbageType with validated data.
        $schedules = $this->scheduleService->addSchedule($request->validated());

        if ($schedules) {
            return $this->responseSuccess(
                __('string.response.store.success', ['name' => Schedule::NAME]),
                $schedules
            );
        }
        return $this->responseError(
            __('string.response.store.fail', ['name' => Schedule::NAME])
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
     * @param GarbageTypeRequest $request
     * @param int $id
     *
     * @return object
     */
    public function update(ScheduleRequest $request, int $id)
    {
        // Call method updateSchedule() from scheduleService to update a schedule
        $schedules = $this->scheduleService->updateSchedule($request->validated(), $id);

        if ($schedules) {
            return $this->responseSuccess(
                __('string.response.update.success', ['name' => Schedule::NAME]),
                $schedules
            );
        }
        return $this->responseError(
            __('string.response.update.fail', ['name' => Schedule::NAME])
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return object
     */
    public function destroy(int $id)
    {
        try {
            Schedule::findOrFail($id)->delete();

            return $this->responseSuccess(
                __('string.response.delete.success', ['name' => Schedule::NAME])
            );
        } catch (\exception $e) {
            \Log::error($e);

            return $this->responseError(
                __('string.response.delete.fail', ['name' => Schedule::NAME])
            );
        }
    }
}
