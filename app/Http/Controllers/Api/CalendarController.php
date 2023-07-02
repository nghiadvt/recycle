<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CalendarService;
use App\Traits\ResponseTrait;
use App\Models\Schedule;

class CalendarController extends Controller
{
    use ResponseTrait;

    protected $CalendarService;

    public function __construct(CalendarService $calendarService)
    {
        return $this->CalendarService = $calendarService;
    }

    /**
     * Display a listing of the resource.
     * @param int $areaId
     * @return mixed
     */
    public function index(int $areaId): mixed
    {
        // Call method getScheduleWithArea from CalendarService for get all schedules
        $schedules = $this->CalendarService->getScheduleWithArea($areaId);

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
