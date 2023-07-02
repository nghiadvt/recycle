<?php

namespace App\Services;

use App\Models\Schedule;
use Carbon\Carbon;

class CalendarService
{
    /**
     * Method getScheduleWithArea
     *
     * @param int $areaId
     *
     * @return object
     */
    public function getScheduleWithArea(int $areaId): object
    {
        return Schedule::where('area_id', $areaId)
            ->active()
            ->with('garbageTypeSchedules.garbageType')
            ->where('date_end_at', '>=', Carbon::now())
            ->where('active', Schedule::ACTIVE)
            ->select(Schedule::COLUMNS)
            ->get();
    }
}
